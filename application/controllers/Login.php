<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function index()
    {
        $data['title'] = "Login : Toko Fadhil";

        $this->load->view('login/login', $data);
    }
}

/* End of file Login.php */
