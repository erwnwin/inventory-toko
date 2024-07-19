<?php

defined('BASEPATH') or exit('No direct script access allowed');

class App_kasir extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_sale');
        $this->load->model('m_item');
    }


    public function index()
    {

        $data['title'] = "Aplikasi Kasir : Toko Fadhil";

        $data['item'] = $this->m_item->get()->result();
        $data['cart'] = $this->m_sale->get_cart();
        $data['invoice'] = $this->m_sale->invoice_no();

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
            $cart = $this->m_sale->get_cart()->result();
            $row = [];

            foreach ($cart as $c) {
                $row[] = array(
                    'id_sale' => $id_sale,
                    'id_item' => $c->id_item,
                    'price' => $c->cart_price,
                    'qty' => $c->qty,
                    'discount_item' => $c->discount_item,
                    'total' => $c->total
                );
            }

            $this->m_sale->add_sale_detail($row);
            // $this->db->insert_batch('tbl_sale_detail', $row);
            // $this->m_sale->del_cart(['id_user' => $this->session->userdata('userid')]);
            $this->m_sale->del_cart(['id_user' => 1]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "id_sale" => $id_sale);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function edit()
    {
        $id = $this->input->post('id_cart');
        $data = $this->m_sale->get($id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
        //var_dump($data);
    }

    public function update()
    {
        $post = $this->input->post();
        $get_item = $this->m_item->get($post['cart_item'])->row_array();
        $old_qty = $post['old_qty'];

        if ($old_qty > $post['item_qty']) {
            $stock_qty = $old_qty - $post['item_qty'];
            $stok = intval($get_item['stock'] + $stock_qty);

            $data = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('id_item', $post['cart_item']);
            $this->db->update('produk_item', $data);
        } elseif ($old_qty < $post['item_qty']) {
            $stock_qty = $post['item_qty'] - $old_qty;
            $stok = intval($get_item['stock'] - $stock_qty);

            $data = [
                'stock' => $stok,
                'updated' => date('Y-m-d H:i:s')
            ];

            $this->db->where('id_item', $post['cart_item']);
            $this->db->update('produk_item', $data);
        }

        $this->m_sale->update_cart($post);
        $this->session->set_flashdata('pesan', 'Cart berhasil diupdate.');
        redirect(base_url('apps-kasir'));
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

/* End of file App_kasir.php */
