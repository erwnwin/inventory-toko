<?php

defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorHTML;

class Items extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('BarcodeGeneratorHTML');
        $this->load->model('m_kategori');
        $this->load->model('m_unit');
        $this->load->model('m_item');
    }

    public function index()
    {

        $data['title'] = 'Items Produk : Optik Fadhel';
        $data['product'] = $this->m_item->get()->result();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/items/items_produk', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
        $data['title'] = "Create Users : Toko Fadhil";

        $data['kategori'] = $this->m_kategori->get_data();
        $data['unit'] = $this->m_unit->get();

        $data['barcode'] = $this->m_item->generate_product_code();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/items/create_items_produk', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function store()
    {

        $barcode = $this->input->post('barcode');
        $nama_produk = $this->input->post('nama_produk');
        $id_kategori = $this->input->post('id_kategori');
        $id_unit = $this->input->post('id_unit');
        $price = $this->input->post('price');

        $config['upload_path'] = './public/upload/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 3048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode(
                array(
                    'status' => 'error',
                    'message' => $error['error']
                )
            );
            // $response['status'] = 'error';
            // $response['message'] = $error['error'];
        } else {
            $upload_data = $this->upload->data();
            $image_path = $upload_data['file_name'];
            // $image_path = 'public/upload/' . $upload_data['file_name'];

            $gambar = $image_path;

            $barcode = $this->input->post('barcode');
            $nama_produk = $this->input->post('nama_produk');
            $id_kategori = $this->input->post('id_kategori');
            $id_unit = $this->input->post('id_unit');
            $price = $this->input->post('price');

            $insert_id = $this->m_item->insert_image($gambar, $barcode, $nama_produk, $id_kategori, $id_unit, $price);

            echo json_encode(
                array(
                    'success' => true,
                    'status' => 'success',
                    'message' => 'Data item product berhasil disimpan!',
                    'redirect' => base_url('items'),
                    'insert_id' => $insert_id
                )
            );
        }
    }
}

/* End of file Items.php */
