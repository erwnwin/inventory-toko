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
}

/* End of file History_transaksi.php */
