<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Barang Keluar : Optik Fadhel';

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/barang_keluar/keluar', $data);
        $this->load->view('layouts/footer', $data);
    }
}

/* End of file Barang_keluar.php */
