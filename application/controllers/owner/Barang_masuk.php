<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('m_item');
        $this->load->model('m_supplier');
        $this->load->model('m_stok');
        $this->load->model('m_filter_in');
        $this->load->model('m_response');
    }

    protected function get_allowed_roles()
    {
        return array('petugas'); // Only 'admin' and 'owner' can access this controller
    }


    public function index()
    {
        // $data['title'] = 'Barang Masuk : Optik Fadhel';



        // $data['stock'] = $this->m_stok->get()->result();

        // $this->load->view('layouts/head', $data);
        // $this->load->view('layouts/header', $data);
        // $this->load->view('layouts/sidebar', $data);
        // $this->load->view('owner/barang_masuk/new_masuk', $data);
        // $this->load->view('layouts/footer', $data);

        $data['title'] = 'Barang Masuk : Optik Fadhel';

        // Ambil parameter tanggal dari URL
        $start_date = $this->input->get('tanggal_mulai');
        $end_date = $this->input->get('tanggal_selesai');

        // Mengambil data dengan filter tanggal jika ada
        if ($start_date && $end_date) {
            $data['stock'] = $this->m_stok->get_filtered_data($start_date, $end_date);
        } else {
            $data['stock'] = $this->m_stok->get(); // Ambil semua data jika tidak ada filter
        }

        // Load view dengan data
        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/barang_masuk/new_masuk', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Barang Masuk : Optik Fadhel';

        $data['product'] = $this->m_item->get()->result();
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



    public function delete_in()
    {
        $id_stock = $this->input->post('id_stock');
        $id_item = $this->input->post('id_item');
        $qty = $this->m_stok->get_stock($id_stock)->row()->qty;
        $data = [
            'qty' => $qty,
            'id_item' => $id_item
        ];
        $this->m_item->update_stock_out($data);
        $this->m_stok->del($id_stock);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('pesan', 'Data Product Masuk berhasil dihapus');
            redirect(base_url('barang-masuk'));
        }
    }


    public function delete_response()
    {
        $id_stock = $this->input->post('id_stock');

        // Retrieve stock information
        $stock_info = $this->m_stok->get_stock($id_stock);

        if ($stock_info) {
            // Check if 'qty' property exists before accessing it
            if (property_exists($stock_info, 'qty')) {
                $qty = $stock_info->qty;

                // Proceed with deletion and stock update logic
                $deleted = $this->m_stok->del($id_stock);

                if ($deleted) {
                    // Prepare data for updating stock in tbl_product
                    $data = [
                        'qty' => $qty,
                        'id_item' => $stock_info->id_item // Adjust according to your actual field name
                    ];

                    // Update stock in tbl_product table
                    $updated = $this->m_item->update_stock_out($data);

                    if ($updated) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Data Product Masuk berhasil dihapus dan stok berhasil diperbarui'
                        ];
                    } else {
                        $response = [
                            'status' => 'error',
                            'message' => 'Gagal memperbarui stok di tbl_product'
                        ];
                    }
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Gagal menghapus data Product Masuk'
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Property "qty" tidak ditemukan pada objek hasil query'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Data Product Masuk tidak ditemukan'
            ];
        }

        // Return JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }



    // public function filter_data()
    // {
    //     $data['title'] = 'Barang Masuk : Optik Fadhel';

    //     // $data['stock'] = $this->m_stok->get();

    //     $data['bulan'] = date('m'); // Ambil bulan saat ini (format dua digit, misalnya '01' untuk Januari)
    //     $data['tahun'] = date('Y'); // Ambil tahun saat ini

    //     // Jika form telah disubmit, ambil nilai bulan dan tahun dari input post
    //     if ($this->input->post()) {
    //         $data['bulan'] = $this->input->post('bulan');
    //         $data['tahun'] = $this->input->post('tahun');

    //         $data['stock'] = $this->m_filter_in->get_filtered_data($data['bulan'], $data['tahun']);
    //         $this->load->view('owner/barang_masuk/filter', $data);
    //         // $this->load->view('layouts/_footer', $data);
    //     } else {

    //         redirect(base_url('barang-masuk'));
    //     }
    // }
}

/* End of file Barang_masuk.php */
