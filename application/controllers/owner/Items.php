<?php

defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorHTML;

class Items extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('BarcodeGeneratorHTML');
        $this->load->model('m_kategori');
        $this->load->model('m_unit');
        $this->load->model('m_item');
    }

    protected function get_allowed_roles()
    {
        return array('admin', 'petugas'); // Only 'admin' and 'owner' can access this controller
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


    public function edit($encrypted_id)
    {
        $data['title'] = "Edit Users : Toko Fadhil";

        $id = decrypt_id($encrypted_id);

        $data['kategori'] = $this->m_kategori->get_data();
        $data['unit'] = $this->m_unit->get();

        $produk = $this->m_item->get_item($id);
        if (!$produk) {
            show_404();
        }
        $data['produk'] = $produk;

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/items/form_edit_edit', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function update()
    {
        $barcode = $this->input->post('barcode');
        $nama_produk = $this->input->post('nama_produk');
        $id_kategori = $this->input->post('id_kategori');
        $id_unit = $this->input->post('id_unit');
        $stock = $this->input->post('stock');
        $price = $this->input->post('price');
        $id_item = $this->input->post('id_item'); // ID of the product being edited

        $config['upload_path'] = './public/upload/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 3048; // 3MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        // Check if an image file is uploaded
        if ($_FILES['gambar']['name']) {
            // Image file is uploaded
            if (!$this->upload->do_upload('gambar')) {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode(array(
                    'status' => 'error',
                    'message' => $error['error']
                ));
                return;
            } else {
                // Get uploaded image data
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];
            }
        } else {
            // No new image uploaded, keep the existing image
            $existing_item = $this->m_item->get_item_by_id($id_item);
            $gambar = $existing_item->gambar;
        }

        // Prepare data for update
        $update_data = array(
            'barcode' => $barcode,
            'nama_produk' => $nama_produk,
            'id_kategori' => $id_kategori,
            'id_unit' => $id_unit,
            'stock' => $stock,
            'price' => $price,
            'gambar' => $gambar,
            'updated' => date('Y-m-d H:i:s')
        );

        // Update or insert item
        if ($id_item) {
            // Update existing item
            $update = $this->m_item->update_item($id_item, $update_data);
        } else {
            // Insert new item
            $insert_id = $this->m_item->insert_item($update_data);
        }

        if ($update || $insert_id) {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data item produk berhasil disimpan!',
                'redirect' => base_url('items'),
                'insert_id' => $insert_id ?? null
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data gagal disimpan'
            ));
        }
    }
}

/* End of file Items.php */
