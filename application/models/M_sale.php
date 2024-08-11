<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sale extends CI_Model
{
    public function invoice_no()
    {
        // Ambil tanggal dan waktu saat ini
        $date_time_prefix = date('ymdHis'); // Format: yyyymmddHHMMSS

        // Query untuk mendapatkan nomor invoice maksimal berdasarkan prefix waktu
        $sql = "SELECT MAX(MID(invoice,15,4)) AS invoice_no 
            FROM tbl_sale 
            WHERE MID(invoice,1,14) = ?";

        $query = $this->db->query($sql, [$date_time_prefix]);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%04d", $n);
        } else {
            $no = "0001";
        }

        $invoice = "INV" . $date_time_prefix . $no;
        return $invoice;
    }



    public function insert($data)
    {
        $this->db->insert('tbl_sale', $data);
        return $this->db->insert_id();
    }



    public function get_sales_by_date_range($start_date, $end_date)
    {
        // Menggunakan try-catch untuk menangkap exception
        try {
            $this->db->select('*');
            $this->db->from('tbl_sale');
            $this->db->where('created_at >=', $start_date);
            $this->db->where('created_at <=', $end_date);
            $query = $this->db->get();

            // Cek apakah query berhasil
            if ($query === FALSE) {
                throw new Exception('Database query failed.');
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Exception caught: ' . $e->getMessage());
            return []; // Mengembalikan array kosong jika terjadi kesalahan
        }
    }

    // public function get_cart($params = null)
    // {
    //     $this->db->select('*,produk_item.barcode, produk_item.nama_produk as item_name, tbl_cart.price as cart_price');
    //     $this->db->from('tbl_cart');
    //     $this->db->join('produk_item', 'tbl_cart.id_item=produk_item.id_item');
    //     if ($params != null) {
    //         $this->db->where($params);
    //     }
    //     $this->db->where('id_user', 1);
    //     $query = $this->db->get();
    //     return $query;
    // }
    // public function get_cart($where = array())
    // {
    //     $this->db->select('*,produk_item.barcode, produk_item.nama_produk as item_name, tbl_cart.price as cart_price');
    //     $this->db->from('tbl_cart');
    //     $this->db->join('produk_item', 'tbl_cart.id_item=produk_item.id_item');
    //     if (!empty($where)) {
    //         $this->db->where($where);
    //     }
    //     return $this->db->get();
    // }

    public function add_sale($post)
    {
        $data = [
            'invoice' => $this->invoice_no(),
            'id_customer' => $post['id_customer'] != null ? $post['id_customer'] : null,
            'total_price' => $post['sub_total'],
            'discount' => $post['discount'],
            'final_price' => $post['grand_total'],
            'cash' => $post['cash'],
            'uang_kembalian' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'id_user' => $this->session->userdata('id_user'),

            // 'id_user' => 1
        ];

        $this->db->insert('tbl_sale', $data);
        return $this->db->insert_id();
    }

    // public function add_sale_detail($batch_data)
    // {
    //     $this->db->insert('tbl_sale_detail', $batch_data);
    //     return $this->db->affected_rows() > 0;
    // }

    public function add_sale_detail($data)
    {
        return $this->db->insert('tbl_sale_detail', $data);
    }

    public function get($id = null)
    {
        $this->db->select('*,produk_item.barcode, produk_item.nama_produk as item_name, tbl_cart.price as cart_price, tbl_cart.id_item as cart_item');
        $this->db->from('tbl_cart');
        $this->db->join('produk_item', 'tbl_cart.id_item=produk_item.id_item');
        if ($id != null) {
            $this->db->where('id_cart', $id);
        }
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $sql = "SELECT MAX(id_cart) AS cart_no FROM tbl_cart";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = '1';
        }
        $params = [
            'id_cart' => $car_no,
            'id_item' => $post['id_item'],
            'price' => $post['price'],
            'discount_item' => 0,
            'qty' => $post['qty'],
            'total' => ($post['price'] * $post['qty']),
            'id_user' => $this->session->userdata('id_user')
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
            'id_user' => $this->session->userdata('id_user')
        ];

        $this->db->where('id_cart', $post['id_cart']);
        $this->db->update('tbl_cart', $data);
    }

    // public function update_cart_qty($post)
    // {
    //     $sql = "UPDATE tbl_cart SET price = '$post[price]', qty = qty + '$post[qty]', total = '$post[price]' * qty WHERE id_item = '$post[id_item]'";
    //     $this->db->query($sql);
    // }

    // public function del_cart($params = null)
    // {
    //     if ($params != null) {
    //         $this->db->where($params);
    //     }
    //     $this->db->delete('tbl_cart');
    // }

    public function get_sale($id = null)
    {
        $this->db->select('*, customer.name as customer_name, tbl_users.nama_user as user_name, tbl_sale.created as sale_created');
        $this->db->from('tbl_sale');
        $this->db->join('tbl_users', 'tbl_sale.id_user=tbl_users.id_user');
        $this->db->join('customer', 'tbl_sale.id_customer=customer.id_customer', 'left');
        if ($id != null) {
            $this->db->where('id_sale', $id);
        }
        $this->db->order_by('tbl_sale.created', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($id_sale = null)
    {
        $this->db->select('*, customer.name as customer_name, produk_item.nama_produk as item_name');
        $this->db->from('tbl_sale_detail');
        $this->db->join('produk_item', 'tbl_sale_detail.id_item=produk_item.id_item');
        $this->db->join('tbl_sale', 'tbl_sale_detail.id_sale=tbl_sale.id_sale');
        $this->db->join('customer', 'tbl_sale.id_customer=customer.id_customer', 'left');
        if ($id_sale != null) {
            $this->db->where('tbl_sale_detail.id_sale', $id_sale);
        }
        $query = $this->db->get();
        return $query;
    }

    public function sale_detail()
    {
        $this->db->select('*, SUM(qty) as qty');
        $this->db->from('tbl_sale_detail');
        $this->db->join('produk_item', 'tbl_sale_detail.id_item=produk_item.id_item');
        $this->db->group_by('tbl_sale_detail.id_item');
        $this->db->order_by('tbl_sale_detail.qty', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_cart($where = array())
    {
        $this->db->select('*,produk_item.barcode, produk_item.nama_produk as item_name, tbl_cart.price as cart_price');
        $this->db->from('tbl_cart');
        $this->db->join('produk_item', 'tbl_cart.id_item=produk_item.id_item');
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->get();
    }


    public function update_cart_qty($post)
    {
        $sql = "UPDATE tbl_cart SET price = '$post[price]', qty = qty + '$post[qty]', total = '$post[price]' * qty WHERE id_item = '$post[id_item]'";
        $this->db->query($sql);
    }

    public function del_cart()
    {
        $this->db->empty_table('tbl_cart');
    }
}
