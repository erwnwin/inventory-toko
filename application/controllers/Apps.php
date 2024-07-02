<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Apps extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Pilih Apps : Toko Fadhil";

       
        $this->load->view('apps', $data);
    }
}

/* End of file Apps.php */
