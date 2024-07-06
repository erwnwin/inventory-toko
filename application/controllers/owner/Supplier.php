<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_supplier');
    }


    public function index()
    {
        $data['title'] = 'Supplier : Toko Fadhel';

        $data['supplier'] = $this->m_supplier->get_data();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/supplier/data_supplier', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function store()
    {
        $data = array(
            'nama_supplier' => $this->input->post('nama_supplier'),
            'alamat_supplier' => $this->input->post('alamat_supplier'),
            'desk_supplier' => $this->input->post('desk_supplier'),
            'no_hp_wa' => $this->input->post('no_hp_wa'),
            'created' => date('Y-m-d H:i:s'),
        );

        $insert_id = $this->m_supplier->insert_data($data);

        if ($insert_id) {
            $response = array(
                'status' => 'success',
                'message' => 'Supplier berhasil disimpan!',
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

/* End of file Supplier.php */
