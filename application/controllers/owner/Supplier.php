<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_supplier');
    }


    protected function get_allowed_roles()
    {
        return array('admin', 'petugas'); // Only 'admin' and 'owner' can access this controller
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


    public function update()
    {
        $response = array('status' => 'error', 'message' => 'Update failed');

        if ($this->input->is_ajax_request()) {
            $id_supplier = $this->input->post('id_supplier'); // Get supplier ID
            $data = array(
                'nama_supplier' => $this->input->post('nama_supplier'),
                'alamat_supplier' => $this->input->post('alamat_supplier'),
                'desk_supplier' => $this->input->post('desk_supplier'),
                'no_hp_wa' => $this->input->post('no_hp_wa'),
                'updated' => date('Y-m-d H:i:s') // Updated timestamp
            );

            if ($this->m_supplier->update_data($id_supplier, $data)) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Supplier successfully updated!'
                );
            } else {
                $response['message'] = 'Failed to update supplier';
            }

            echo json_encode($response);
        } else {
            show_404(); // Handle non-AJAX requests
        }
    }

    public function edit()
    {
        $data = array(
            'nama_supplier' => $this->input->post('nama_supplier'),
            'alamat_supplier' => $this->input->post('alamat_supplier'),
            'desk_supplier' => $this->input->post('desk_supplier'),
            'no_hp_wa' => $this->input->post('no_hp_wa'),
            'created' => date('Y-m-d H:i:s'),
        );

        $where = array(
            'id_supplier' => $this->input->post('id_supplier'),
        );

        $udpate_id = $this->m_supplier->update_supplier($data, $where);

        if ($udpate_id) {
            $response = array(
                'status' => 'success',
                'message' => 'Supplier berhasil disimpan!',
                'udpate_id' => $udpate_id
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
