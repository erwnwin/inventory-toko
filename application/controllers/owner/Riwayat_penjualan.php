<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Riwayat_penjualan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_filter');
        $this->load->library('dompdf_gen');
        $this->load->library('spout_lib');
        // require_once APPPATH . 'third_party/vendor/autoload.php';
    }

    protected function get_allowed_roles()
    {
        return array('admin', 'petugas', 'owner'); // Only 'admin' and 'owner' can access this controller
    }
    // public function __construct()
    // {
    //     parent::__construct();
    //     // Memuat autoloader Composer jika menggunakan Composer
    //     require_once APPPATH . 'third_party/vendor/autoload.php';
    // }

    public function index()
    {
        $data['title'] = "Riwayat Penjualan : Toko Fadhil";

        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        // Validasi tanggal
        if ($tanggal_mulai && $tanggal_selesai) {
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_mulai));
            $tanggal_selesai = date('Y-m-d', strtotime($tanggal_selesai));
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_selesai = date('Y-m-d');
        }

        // Ambil data dari model dengan filter
        $data['sales'] = $this->m_filter->get_sales($tanggal_mulai, $tanggal_selesai);

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/laporan/riwayat_penjualan', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function export_pdf()
    {
        $this->load->library('dompdf_gen');

        // Mengambil data dari GET parameters
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        // Ambil data dari model
        $data['sales'] = $this->m_filter->get_sales($tanggal_mulai, $tanggal_selesai);

        // Muat tampilan ke dalam buffer
        $html = $this->load->view('owner/laporan/riwayat_penjualan_pdf', $data, TRUE);

        // Load HTML ke Dompdf
        $this->dompdf_gen->load_html($html);
        $this->dompdf_gen->set_paper('A4', 'portrait');
        $this->dompdf_gen->render();
        $this->dompdf_gen->stream("riwayat_penjualan.pdf", array('Attachment' => 0));
    }

    public function export_excel()
    {
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        if ($tanggal_mulai && $tanggal_selesai) {
            $tanggal_mulai = date('Y-m-d', strtotime($tanggal_mulai));
            $tanggal_selesai = date('Y-m-d', strtotime($tanggal_selesai));
        } else {
            $tanggal_mulai = date('Y-m-d');
            $tanggal_selesai = date('Y-m-d');
        }

        $this->load->model('m_filter');
        $sales = $this->m_filter->get_sales($tanggal_mulai, $tanggal_selesai);

        $data = [];
        foreach ($sales as $sale) {
            $data[] = [
                $sale->invoice,
                $sale->total_price,
                $sale->final_price,
                $sale->date,
            ];
        }

        $this->load->library('Spout_lib');
        $filePath = $this->spout_lib->export_excel($data);

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
    // public function index()
    // {
    //     $data['title'] = "Riwayat Penjualan : Toko Fadhil";

    //     $tanggal_mulai = $this->input->get('tanggal_mulai');
    //     $tanggal_selesai = $this->input->get('tanggal_selesai');

    //     // Validasi tanggal
    //     if ($tanggal_mulai && $tanggal_selesai) {
    //         $tanggal_mulai = date('Y-m-d', strtotime($tanggal_mulai));
    //         $tanggal_selesai = date('Y-m-d', strtotime($tanggal_selesai));
    //     } else {
    //         $tanggal_mulai = date('Y-m-d');
    //         $tanggal_selesai = date('Y-m-d');
    //     }

    //     // Ambil data dari model dengan filter
    //     $data['title'] = 'Riwayat Penjualan';
    //     $data['sales'] = $this->m_filter->get_sales($tanggal_mulai, $tanggal_selesai);


    //     $this->load->view('layouts/head', $data);
    //     $this->load->view('layouts/header', $data);
    //     $this->load->view('layouts/sidebar', $data);
    //     $this->load->view('owner/laporan/riwayat_penjualan', $data);
    //     $this->load->view('layouts/footer', $data);
    // }
}

/* End of file Riwayat_penjualan.php */
