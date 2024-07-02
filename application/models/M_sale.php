<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sale extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no FROM tbl_sale WHERE MID(invoice,3,6) = DATE_FORMAT(CURRENT_DATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "MP" . date('ymd') . $no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*,produk_item.barcode, produk_item.name as item_name, tbl_cart.price as cart_price');
        $this->db->from('tbl_cart');
        $this->db->join('produk_item', 'tbl_cart.item_id=produk_item.item_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_sale($post)
    {
        $data = [
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'] != null ? $post['customer_id'] : null,
            'total_price' => $post['sub_total'],
            'discount' => $post['discount'],
            'final_price' => $post['grand_total'],
            'cash' => $post['cash'],
            'uang_kembalian' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->insert('tbl_sale', $data);
        return $this->db->insert_id();
    }

    public function add_sale_detail($data)
    {
        $this->db->insert_batch('tbl_sale_detail', $data);
    }

    public function get($id = null)
    {
        $this->db->select('*,produk_item.barcode, produk_item.name as item_name, t_cart.price as cart_price, t_cart.item_id as cart_item');
        $this->db->from('t_cart');
        $this->db->join('produk_item', 't_cart.item_id=produk_item.item_id');
        if ($id != null) {
            $this->db->where('cart_id', $id);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $sql = "SELECT MAX(cart_id) AS cart_no FROM tbl_cart";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = '1';
        }
        $params = [
            'cart_id' => $car_no,
            'item_id' => $post['item_id'],
            'price' => $post['price'],
            'discount_item' => 0,
            'qty' => $post['qty'],
            'total' => ($post['price'] * $post['qty']),
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->insert('tbl_cart', $params);
    }

    public function update_cart($post)
    {
        $data = [
            'price' => $post['item_price'],
            'discount_item' => $post['item_discount'],
            'qty' => $post['item_qty'],
            'total' => (($post['item_price'] * $post['item_qty']) - $post['item_discount']),
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('tbl_cart', $data);
    }

    public function update_cart_qty($post)
    {
        $sql = "UPDATE tbl_cart SET price = '$post[price]', qty = qty + '$post[qty]', total = '$post[price]' * qty WHERE item_id = '$post[item_id]'";
        $this->db->query($sql);
    }

    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('tbl_cart');
    }

    public function getbl_sale($id = null)
    {
        $this->db->select('*, customer.name as customer_name, user.name as user_name, tbl_sale.created as sale_created');
        $this->db->from('tbl_sale');
        $this->db->join('user', 'tbl_sale.user_id=user.user_id');
        $this->db->join('customer', 'tbl_sale.customer_id=customer.customer_id', 'left');
        if ($id != null) {
            $this->db->where('sale_id', $id);
        }
        $this->db->order_by('tbl_sale.created', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getbl_sale_detail($sale_id = null)
    {
        $this->db->select('*, customer.name as customer_name, produk_item.name as item_name');
        $this->db->from('tbl_sale_detail');
        $this->db->join('produk_item', 'tbl_sale_detail.item_id=produk_item.item_id');
        $this->db->join('tbl_sale', 'tbl_sale_detail.sale_id=tbl_sale.sale_id');
        $this->db->join('customer', 'tbl_sale.customer_id=customer.customer_id', 'left');
        if ($sale_id != null) {
            $this->db->where('tbl_sale_detail.sale_id', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function sale_detail()
    {
        $this->db->select('*, SUM(qty) as qty');
        $this->db->from('tbl_sale_detail');
        $this->db->join('produk_item', 'tbl_sale_detail.item_id=produk_item.item_id');
        $this->db->group_by('tbl_sale_detail.item_id');
        $this->db->order_by('tbl_sale_detail.qty', 'desc');
        $query = $this->db->get();
        return $query;
    }
}
