<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Filter_laporan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('StockModel');
    }

    protected function get_allowed_roles()
    {
        return array('admin', 'petugas', 'owner'); // Only 'admin' and 'owner' can access this controller
    }

    public function index()
    {
        $data['title'] = "Filter Laporan : Toko Fadhil";

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/laporan/filter_laporan', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function filter_laporan()
    {
        $type = $this->input->get('type');
        $start_date = $this->input->get('tanggal_mulai');
        $end_date = $this->input->get('tanggal_selesai');

        $data = $this->StockModel->get_filtered_stock_data($type, $start_date, $end_date);
        echo json_encode($data);
    }

    public function export_pdf()
    {
        $this->load->library('dompdf_gen');

        // Mengambil data dari GET parameters
        $type = $this->input->get('type');
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        // Ambil data dari model
        $data['stocks'] = $this->StockModel->get_filtered_stock_data($type, $tanggal_mulai, $tanggal_selesai);
        $data['type'] = $type; // Tambahkan type ke data yang dikirim ke view

        // Muat tampilan ke dalam buffer
        $html = $this->load->view('owner/laporan/filter_inout_pdf_view', $data, TRUE);

        // Load HTML ke Dompdf
        $this->dompdf_gen->load_html($html);
        $this->dompdf_gen->set_paper('A4', 'portrait');
        $this->dompdf_gen->render();
        $this->dompdf_gen->stream("riwayat_penjualan.pdf", array('Attachment' => 0));
    }



    public function export_excel()
    {
        $type = $this->input->get('type');  // Ambil type dari query parameter
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        if ($tanggal_mulai && $tanggal_selesai) {
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_mulai));
            $tanggal_selesai = date('Y-m-d', strtotime($tanggal_selesai));
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_selesai = date('Y-m-d');
        }

        // Ambil data dari model
        $stocks = $this->StockModel->get_filtered_stock_data($type, $tanggal_mulai, $tanggal_selesai);

        $data = [];
        foreach ($stocks as $stock) {
            $data[] = [
                $stock['nama_produk'],
                $stock['nama_supplier'],
                $stock['qty'],
                $stock['date'],
                $stock['type']
            ];
        }

        // Create Excel file
        $this->load->library('Spout_lib_inout');
        $filePath = $this->spout_lib_inout->export_excel($data, $type);  // Pass type here

        // Set headers and force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);

        // Optionally, delete the file after download
        unlink($filePath);
    }
}

/* End of file Filter_laporan.php */
