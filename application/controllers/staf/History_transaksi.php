<?php

defined('BASEPATH') or exit('No direct script access allowed');

class History_transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sale');
        $this->load->model('m_item');
    }


    public function index()
    {
        $data['title'] = "History Transaksi : Toko Fadhil";

        $data['item'] = $this->m_item->get()->result();
        $data['cart'] = $this->m_sale->get_cart();
        $data['invoice'] = $this->m_sale->invoice_no();

        $this->load->view('kasir-layout/head', $data);
        $this->load->view('kasir-layout/header', $data);
        $this->load->view('kasir-layout/sidebar', $data);
        $this->load->view('kasir/history', $data);
        $this->load->view('kasir-layout/footer', $data);
    }


    public function filter_sales()
    {
        $data['title'] = "History Transaksi : Toko Fadhil";

        $start_date = $this->input->post('tanggal_mulai');
        $end_date = $this->input->post('tanggal_selesai');

        if ($start_date && $end_date) {
            $sales = $this->m_sale->get_sales_by_date_range($start_date, $end_date);
        } else {
            $sales = []; // Atau data default jika tidak ada input tanggal
        }

        // Mengirim data ke view
        $data['sales'] = $sales;
        $this->load->view('kasir-layout/head', $data);
        $this->load->view('kasir-layout/header', $data);
        $this->load->view('kasir-layout/sidebar', $data);
        $this->load->view('kasir/history', $data);
        $this->load->view('kasir-layout/footer', $data);
    }
}

/* End of file History_transaksi.php */
