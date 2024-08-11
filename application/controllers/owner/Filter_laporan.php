<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Filter_laporan extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Filter Laporan : Toko Fadhil";

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/laporan/filter_laporan', $data);
        $this->load->view('layouts/footer', $data);
    }
}

/* End of file Filter_laporan.php */
