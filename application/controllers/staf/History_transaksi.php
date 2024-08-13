<?php

defined('BASEPATH') or exit('No direct script access allowed');

class History_transaksi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sale');
        $this->load->model('m_item');
        $this->load->model('transaction_model');
        $this->encryption->initialize(array('driver' => 'openssl'));
    }

    protected function get_allowed_roles()
    {
        return array('kasir'); // Only 'admin' and 'owner' can access this controller
    }

    public function index()
    {
        $data['title'] = "History Transaksi : Toko Fadhil";

        $data['item'] = $this->m_item->get()->result();
        $data['cart'] = $this->m_sale->get_cart();
        $data['invoice'] = $this->m_sale->invoice_no();

        $this->load->view('kasir-layout/head', $data);
        $this->load->view('kasir-layout/header', $data);
        $this->load->view('kasir-layout/sidebar', $data);
        $this->load->view('kasir/history', $data);
        $this->load->view('kasir-layout/footer', $data);
    }


    public function filter()
    {
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        if ($tanggal_mulai && $tanggal_selesai) {
            // Fetch filtered data
            $sales = $this->transaction_model->get_sales_by_date_range($tanggal_mulai, $tanggal_selesai);

            // Check if $sales is an array of objects
            if (is_array($sales) || is_object($sales)) {
                // Load the partial view and pass the data
                $this->load->view('kasir/filtered_sales_view', ['sales' => $sales]);
            } else {
                echo '<tr><td colspan="10" style="text-align: center;">Invalid data format.</td></tr>';
            }
        } else {
            echo '<tr><td colspan="10" style="text-align: center;">Invalid date range.</td></tr>';
        }
    }

    public function print($encrypted_id)
    {
        $id = decrypt_id($encrypted_id);

        $data['sale'] = $this->m_sale->get_sale($id)->row();
        $data['sale_detail'] = $this->m_sale->get_sale_detail($id)->result();
        $this->load->view('kasir/print_invoice', $data);
    }
}

/* End of file History_transaksi.php */
