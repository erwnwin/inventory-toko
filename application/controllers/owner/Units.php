<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Units extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_unit');
    }

    protected function get_allowed_roles()
    {
        return array('admin'); // Only 'admin' and 'owner' can access this controller
    }

    public function index()
    {
        $data['title'] = 'Units : Optik Fadhel';

        $data['unit'] = $this->m_unit->get();


        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/units/units', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function store()
    {
        $data = array(
            'nama_unit' => $this->input->post('nama_unit'),
            'created' => date('Y-m-d H:i:s'),
        );

        $insert_id = $this->m_unit->save($data);

        if ($insert_id) {
            $response = array(
                'status' => 'success',
                'message' => 'Units berhasil disimpan!',
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

/* End of file Units.php */
