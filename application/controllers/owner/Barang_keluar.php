<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_stok');
        $this->load->model('m_item');
        $this->load->model('m_supplier');
    }

    protected function get_allowed_roles()
    {
        return array('petugas'); // Only 'admin' and 'owner' can access this controller
    }


    public function index()
    {
        $data['title'] = 'Barang Keluar : Optik Fadhel';

        // $data['stock'] = $this->m_stok->get_stock_out()->result();

        $start_date = $this->input->get('tanggal_mulai');
        $end_date = $this->input->get('tanggal_selesai');

        // Mengambil data dengan filter tanggal jika ada
        if ($start_date && $end_date) {
            $data['stock'] = $this->m_stok->get_filtered_data_out($start_date, $end_date);
        } else {
            $data['stock'] = $this->m_stok->get_stock_out(); // Ambil semua data jika tidak ada filter
        }

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/barang_keluar/keluar', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Barang Keluar : Optik Fadhel';

        $data['product'] = $this->m_item->get()->result();
        $data['supplier'] = $this->m_supplier->get_data();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/barang_keluar/create_barang_keluar', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function store()
    {
        $post = $this->input->post(null, true);
        $this->m_stok->add_stock_out($post);
        $this->m_item->update_stock_out($post);

        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 'success',
                'message' => 'Stock Product berhasil diupdate!',
                'redirect' => base_url('barang-keluar'),
            );
        }
        echo json_encode($response);
    }

    // public function delete_out()
    // {
    //     $id_stock = $this->input->post('id_stock');
    //     $id_item = $this->input->post('id_item');
    //     $qty = $this->m_stok->get_stock($id_stock)->row()->qty;
    //     $data = [
    //         'qty' => $qty,
    //         'id_item' => $id_item
    //     ];
    //     $this->m_item->update_stock_out($data);
    //     $this->m_stok->del($id_stock);

    //     if ($this->db->affected_rows() > 0) {
    //         $this->session->set_flashdata('pesan', 'Data Product Masuk berhasil dihapus');
    //         redirect(base_url('barang-keluar'));
    //     }
    // }

    public function delete_out()
    {
        $id_stock = $this->input->post('id_stock');
        $id_item = $this->input->post('id_item');

        // Get the original quantity of the item
        $original_qty = $this->m_stok->get_stock($id_stock)->row()->qty;

        // Delete the stock out entry
        $this->m_stok->del($id_stock);

        // Check if the deletion was successful
        if ($this->db->affected_rows() > 0) {
            // Restore the original quantity of the item
            $data = [
                'qty' => $original_qty,  // Restore to the original quantity
                'id_item' => $id_item
            ];
            $this->m_item->update_stock_out($data);

            // Check if the update was successful
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('pesan', 'Data Product Keluar berhasil dihapus dan stok dikembalikan');
            } else {
                $this->session->set_flashdata('pesan', 'Data Product Keluar berhasil dihapus, tetapi gagal mengembalikan stok');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Gagal menghapus data Product Keluar');
        }

        redirect(base_url('barang-keluar'));
    }
}

/* End of file Barang_keluar.php */
