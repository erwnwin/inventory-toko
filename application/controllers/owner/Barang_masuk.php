<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_item');
        $this->load->model('m_supplier');
        $this->load->model('m_stok');
    }


    public function index()
    {
        $data['title'] = 'Barang Masuk : Optik Fadhel';

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/barang_masuk/masuk', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Barang Masuk : Optik Fadhel';

        $data['product'] = $this->m_item->get();
        $data['supplier'] = $this->m_supplier->get_data();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/barang_masuk/create_barang_masuk', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function store()
    {

        // if (isset($_POST['in_add'])) {
        $post = $this->input->post(null, true);
        $this->m_stok->add_stock_in($post);
        $this->m_item->update_stock_in($post);

        if ($this->db->affected_rows() > 0) {
            // $this->session->set_flashdata('pesan', 'Data Stock-In berhasil ditambah');
            // redirect(base_url('barang-masuk'));

            $response = array(
                'status' => 'success',
                'message' => 'Stock Product berhasil diupdate!',
                'redirect' => base_url('barang-masuk'),
            );
        }
        echo json_encode($response);

        // }
        // else {
        //     $post = $this->input->post(null, true);
        //     $this->m_stok->add_stock_out($post);
        //     $this->m_item->update_stock_out($post);

        //     if ($this->db->affected_rows() > 0) {
        //         // $this->session->set_flashdata('pesan', 'Data Stock-Out berhasil ditambah');
        //         // redirect(base_url('barang-keluar'));
        //         $response = array(
        //             'status' => 'success',
        //             'message' => 'Data Stock-Out berhasil ditambah!',
        //             'redirect' => base_url('barang-keluar'),
        //         );
        //     }
        // }

        // echo json_encode($response);



    }
}

/* End of file Barang_masuk.php */
