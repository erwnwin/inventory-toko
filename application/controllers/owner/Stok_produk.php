<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stok_produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_item');
        $this->load->library('dompdf_gen');
        $this->load->library('spout_lib_produk');
    }


    public function index()
    {
        $data['title'] = "Laporan Stok : Toko Fadhil";
        $data['product'] = $this->m_item->get()->result();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/laporan/laporan_stok', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function get_product_data()
    {
        $id = $this->input->get('id');
        $data = $this->m_item->get_filter($id);
        echo json_encode(['data' => $data]);
    }



    public function export_excel()
    {
        $id = $this->input->get('id'); // Ambil ID produk dari query parameter

        if (!$id) {
            show_error('No product ID specified.');
            return;
        }

        // Ambil data produk berdasarkan ID
        $data = $this->m_item->get_filter2($id);

        if (empty($data)) {
            show_error('No data found for the specified product ID.');
            return;
        }

        // Export data ke Excel
        $filePath = $this->spout_lib_produk->export_excel($data);

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

    public function export_pdf()
    {
        $this->load->library('dompdf_gen');

        // Mengambil ID produk dari GET parameters
        $id = $this->input->get('id');

        if (!$id) {
            show_error('No product ID specified.');
            return;
        }

        // Ambil data dari model
        $data['product'] = $this->m_item->get_filter2($id);

        // Pastikan data ada
        if (empty($data['product'])) {
            show_error('No data found for the specified product ID.');
            return;
        }

        // Muat tampilan ke dalam buffer
        $html = $this->load->view('owner/laporan/stok_pdf_view', $data, TRUE);

        // Load HTML ke Dompdf
        $this->dompdf_gen->load_html($html);
        $this->dompdf_gen->set_paper('A4', 'portrait');
        $this->dompdf_gen->render();

        // Stream PDF ke browser
        $pdfFilePath = 'Data_stok_produk_' . date('YmdHis') . '.pdf';
        $this->dompdf_gen->stream($pdfFilePath, array('Attachment' => 0));
    }
}

/* End of file Stok_produk.php */
