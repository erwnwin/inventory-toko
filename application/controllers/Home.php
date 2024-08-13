<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_item');
        $this->load->model('setting_model');
    }


    public function index()
    {
        $data['title'] = "Home : Toko Fadhil";
        $data['setting_info'] = $this->setting_model->get_info();
        $data['product'] = $this->m_item->get_products(4);

        $this->load->view('depan/home', $data);
    }

    public function produks()
    {
        $data['title'] = "Home : Toko Fadhil";
        $data['product'] = $this->m_item->get_all_items_all();

        $this->load->view('depan/produk', $data);
    }
}

/* End of file Home.php */
