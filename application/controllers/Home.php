<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Home : Toko Fadhil";

        $this->load->view('depan/home', $data);
    }
}

/* End of file Home.php */
