<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kasir_model');
        $this->load->model('cart_model');
        $this->load->model('m_sale');
        $this->load->model('m_item');
        $this->load->model('transaction_model');
    }

    protected function get_allowed_roles()
    {
        return array('kasir'); // Only 'admin' and 'owner' can access this controller
    }

    // Menampilkan halaman kasir
    public function index()
    {
        $data['title'] = "Aplikasi Kasir : Toko Fadhil";

        $data['invoice'] = $this->m_sale->invoice_no();
        $data['item'] = $this->kasir_model->get_items();
        $data['customer'] = $this->kasir_model->get_customers();
        $this->load->view('kasir-layout/head', $data);
        $this->load->view('kasir-layout/header', $data);
        $this->load->view('kasir-layout/sidebar', $data);
        $this->load->view('kasir/app_kasir', $data);
        $this->load->view('kasir-layout/footer', $data);
    }

    public function process()
    {
        $response = array('success' => false);

        if ($this->input->post('add_cart')) {
            $id_item = $this->input->post('id_item');
            $price = $this->input->post('price');
            $qty = $this->input->post('qty');

            // Cek stock
            $stock = $this->m_item->get_stock($id_item);
            if ($qty > $stock) {
                echo json_encode($response);
                return;
            }

            // Tambahkan ke cart
            $result = $this->cart_model->add_item($id_item, $price, $qty);
            $response['success'] = $result;
        }

        echo json_encode($response);
    }

    // Menghapus item dari cart
    public function cart_del()
    {
        $response = array('success' => false);

        if ($this->input->post('id_cart')) {
            $id_cart = $this->input->post('id_cart');

            // Hapus dari cart
            $result = $this->cart_model->delete_item($id_cart);
            $response['success'] = $result;
        }

        echo json_encode($response);
    }

    // Memproses pembayaran
    public function process_payment()
    {
        $response = array('success' => false);

        if ($this->input->post('process_payment')) {
            $id_customer = $this->input->post('id_customer');
            $sub_total = $this->input->post('sub_total');
            $discount = $this->input->post('discount');
            $grand_total = $this->input->post('grand_total');
            $cash = $this->input->post('cash');
            $change = $this->input->post('change');
            $note = $this->input->post('note');
            $date = $this->input->post('date');

            // Proses transaksi
            $transaction_id = $this->transaction_model->process_transaction(
                $id_customer,
                $sub_total,
                $discount,
                $grand_total,
                $cash,
                $change,
                $note,
                $date
            );

            if ($transaction_id) {
                // Mendapatkan detail cart
                $cart_details = $this->Cart_model->get_cart_items();

                // Menyimpan detail penjualan ke tbl_sale_detail
                foreach ($cart_details as $item) {
                    $sale_detail = array(
                        'sale_id' => $transaction_id,
                        'id_item' => $item['id_item'],
                        'price' => $item['price'],
                        'qty' => $item['qty'],
                        'total' => $item['total']
                    );
                    $this->Sale_model->add_sale_detail($sale_detail);
                }

                $response['success'] = true;
                $response['id_sale'] = $transaction_id;
            }
        }

        echo json_encode($response);
    }

    // Membatalkan transaksi
    public function reset()
    {
        $response = array('success' => false);

        if ($this->input->post('cancel_payment')) {
            // Hapus semua item dari cart
            $result = $this->Cart_model->clear_cart();
            $response['success'] = $result;
        }

        echo json_encode($response);
    }

    // Mendapatkan data item
    public function get_data()
    {
        $items = $this->m_item->get_all_items();
        echo json_encode($items);
    }
}
