<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Info_app extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');
    }

    protected function get_allowed_roles()
    {
        return array('admin'); // Only 'admin' and 'owner' can access this controller
    }

    public function index()
    {
        $data['title'] = "Info Apps : Toko Fadhil";
        $data['info'] = $this->setting_model->get_info();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/info_app', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function update()
    {
        $response = array('status' => 'error');

        // Validasi form
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telp', 'required');
        $this->form_validation->set_rules('deskripsi_depan', 'Deskripsi Depan', 'required');
        $this->form_validation->set_rules('tentang_toko', 'Tentang Toko', 'required');
        $this->form_validation->set_rules('jam_buka', 'Jam Buka', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $response['message'] = validation_errors();
        } else {
            // Ambil data dari POST
            $data = array(
                'nama_toko' => $this->input->post('nama_toko'),
                'no_telp' => $this->input->post('no_telp'),
                'deskripsi_depan' => $this->input->post('deskripsi_depan'),
                'tentang_toko' => $this->input->post('tentang_toko'),
                'jam_buka' => $this->input->post('jam_buka')
            );

            // Update data ke database
            if ($this->setting_model->update_info($data)) {
                $response['status'] = 'success';
            } else {
                $response['message'] = 'Update gagal.';
            }
        }

        // Kirim response ke AJAX
        echo json_encode($response);
    }
}

/* End of file Info_app.php */
