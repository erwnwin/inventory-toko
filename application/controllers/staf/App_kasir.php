<?php

defined('BASEPATH') or exit('No direct script access allowed');

class App_kasir extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sale');
        $this->load->model('m_item');
        $this->load->model('m_barang');
        $this->load->model('m_penjualan');
        $this->load->model('m_detail_penjualan');
        $this->load->model('kasir_model');
    }


    protected function get_allowed_roles()
    {
        return array('kasir'); // Only 'admin' and 'owner' can access this controller
    }

    public function index()
    {

        $data['title'] = "Aplikasi Kasir : Toko Fadhil";

        $data['item'] = $this->m_item->get()->result();
        $data['cart'] = $this->m_sale->get_cart();
        $data['invoice'] = $this->m_sale->invoice_no();
        $data['produk'] = $this->m_barang->lihat_stok();

        $this->load->view('kasir-layout/head', $data);
        $this->load->view('kasir-layout/header', $data);
        $this->load->view('kasir-layout/sidebar', $data);
        $this->load->view('kasir/app_kasir', $data);
        $this->load->view('kasir-layout/footer', $data);
    }

    public function process()
    {
        $post = $this->input->post(null, true);

        if (isset($_POST['add_cart'])) {

            $id_item = $this->input->post('id_item');
            $cek_cart = $this->m_sale->get_cart(['tbl_cart.id_item' => $id_item]);
            if ($cek_cart->num_rows() > 0) {
                $this->m_sale->update_cart_qty($post);
            } else {
                $this->m_sale->add_cart($post);
            }

            #Update Stock Item
            $qty = $this->input->post('qty');

            $get_item = $this->m_item->get($id_item)->row_array();
            $stok = intval($get_item['stock'] - $qty);

            $data = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('id_item', $id_item);
            $this->db->update('produk_item', $data);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if (isset($_POST['process_payment'])) {
            $id_sale = $this->m_sale->add_sale($post);
            $id_sale = $this->db->insert_id();
            $cart = $this->m_sale->get_cart()->result();

            foreach ($cart as $c) {
                $this->m_sale->add_sale_detail(
                    [
                        'id_sale' => $id_sale,
                        'id_item' => $c->id_item,
                        'price' => $c->cart_price,
                        'qty' => $c->qty,
                        'discount_item' => $c->discount_item,
                        'total' => $c->total
                    ]
                );
            }

            $this->m_sale->del_cart();

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(['success' => false, 'message' => 'Transaction failed']);
            } else {
                echo json_encode(['success' => true, 'id_sale' => $id_sale]); // Ensure id_sale is correctly set here
            }
        }
    }






    public function cart_data()
    {
        $cart = $this->m_sale->get_cart();
        $data['cart'] = $cart;
        $this->load->view('kasir/cart_data', $data);
    }

    public function cart_del()
    {
        $id_cart = $this->input->post('id_cart');

        #mengembalikan stok
        $data = $this->m_sale->get($id_cart)->row_array();
        $get_item = $this->m_item->get($data['id_item'])->row_array();
        $stok = intval($get_item['stock'] + $data['qty']);

        $stoks = [
            'stock' => $stok,
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_item', $data['id_item']);
        $this->db->update('produk_item', $stoks);

        #delete cart
        $this->m_sale->del_cart(['id_cart' => $id_cart]);

        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect(base_url('apps-kasir'));
    }

    public function reset()
    {
        if (isset($_POST['cancel_payment'])) {
            // // $userid = $this->session->userdata('userid');
            // $this->m_sale->del_cart(['id_user' => 1]);

            // if ($this->db->affected_rows() > 0) {
            //     $params = array("success" => true);
            // } else {
            //     $params = array("success" => false);
            // }
            // echo json_encode($params);
            $id_cart = $this->input->post('id_cart');

            #mengembalikan stok
            $data = $this->m_sale->get($id_cart)->row_array();
            $get_item = $this->m_item->get($data['id_item'])->row_array();
            $stok = intval($get_item['stock'] + $data['qty']);

            $stoks = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('id_item', $data['id_item']);
            $this->db->update('produk_item', $stoks);

            #delete cart
            // $this->m_sale->del_cart(['id_cart' => $id_cart]);
            $this->m_sale->del_cart(['id_user' => 1]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function print($id)
    {
        $data['sale'] = $this->m_sale->get_sale($id)->row();
        $data['sale_detail'] = $this->m_sale->get_sale_detail($id)->result();
        $this->load->view('kasir/print_invoice', $data);
    }
}

    // public function get_all_barang()
    // {
    //     $data = $this->m_barang->lihat_nama_produk($_POST['nama_barang']);
    //     echo json_encode($data);
    // }

    // public function keranjang_barang()
    // {
    //     $this->load->view('kasir/keranjang');
    // }

    // public function store()
    // {
    //     $data = $this->input->post();
    //     // Process the data and save to database
    //     $result = $this->kasir_model->save_transaction($data);
    //     if ($result) {
    //         echo json_encode(['success' => true, 'message' => 'Transaksi berhasil diproses.']);
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat memproses transaksi.']);
    //     }
    // }

    


/* End of file App_kasir.php */