<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_kategori');
    }


    protected function get_allowed_roles()
    {
        return array('admin'); // Only 'admin' and 'owner' can access this controller
    }


    public function index()
    {

        $data['title'] = 'Kategori : Optik Fadhel';
        $data['kategori'] = $this->m_kategori->get_data();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/kategori/kategori', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function store()
    {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
            'created' => date('Y-m-d H:i:s'),
        );

        $insert_id = $this->m_kategori->insert_data($data);

        if ($insert_id) {
            $response = array(
                'status' => 'success',
                'message' => 'Kategori berhasil disimpan!',
                'insert_id' => $insert_id
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data gagal disimpan'
            );
        }
        echo json_encode($response);
    }
}

/* End of file Kategori.php */
