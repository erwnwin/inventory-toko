<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MY_Controller
{
    public function index()
    {
        $data['title'] = "Profil : Toko Fadhil";

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/profil', $data);
        $this->load->view('layouts/footer', $data);
    }
}

/* End of file Profil.php */
