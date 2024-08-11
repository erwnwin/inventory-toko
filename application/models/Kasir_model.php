<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Generate invoice number
    public function generate_invoice()
    {
        $query = $this->db->select_max('invoice')->get('tbl_sale');
        $result = $query->row();
        return $result->invoice ? $result->invoice + 1 : 1;
    }

    // Mendapatkan data produk
    public function get_items($id = null)
    {
        // Select necessary columns from produk_item and related tables
        $this->db->select('
            produk_item.id_item, 
            produk_item.barcode, 
            produk_item.nama_barang, 
            produk_item.price, 
            produk_item.stock,  
            produk_category.nama_kategori AS name_category, 
            produk_unit.nama_unit AS name_unit
        ');
        $this->db->from('produk_item');
        $this->db->join('produk_category', 'produk_item.id_kategori = produk_category.id_kategori');
        $this->db->join('produk_unit', 'produk_item.id_unit = produk_unit.id_unit');

        // Apply filter if $id is provided
        if ($id !== null) {
            $this->db->where('produk_item.id_item', $id);
        }

        // Order the results by barcode
        $this->db->order_by('produk_item.barcode', 'ASC');

        // Execute the query and get the result
        $query = $this->db->get();

        // Check if the query was successful
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return []; // Return an empty array if no results found
        }
    }

    // public function get_items()
    // {
    //     return $this->db->get('produk_i')->result();
    // }

    // Mendapatkan data pelanggan
    public function get_customers()
    {
        return $this->db->get('customer')->result();
    }

    // Menambahkan item ke cart
    public function add_to_cart($id, $barcode, $price, $qty)
    {
        $cart = $this->session->userdata('cart') ?? [];

        if (!is_array($cart)) {
            $cart = [];
        }

        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['qty'] += $qty;
                $item['total'] = $item['price'] * $item['qty'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $id,
                'barcode' => $barcode,
                'price' => $price,
                'qty' => $qty,
                'total' => $price * $qty
            ];
        }

        $this->session->set_userdata('cart', $cart);
    }

    public function remove_from_cart($id)
    {
        $cart = $this->session->userdata('cart') ?? [];

        if (!is_array($cart)) {
            $cart = [];
        }

        $new_cart = array_filter($cart, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        $this->session->set_userdata('cart', $new_cart);
    }

    public function update_cart($id, $qty)
    {
        $cart = $this->session->userdata('cart') ?? [];

        if (!is_array($cart)) {
            $cart = [];
        }

        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['qty'] = $qty;
                $item['total'] = $item['price'] * $qty;
                break;
            }
        }

        $this->session->set_userdata('cart', $cart);
    }

    public function process_payment($date, $id_customer, $discount, $cash, $note)
    {
        $cart = $this->session->userdata('cart') ?? [];
        $total_price = array_sum(array_column($cart, 'total'));
        $final_price = $total_price - $discount;
        $kembalian = $cash - $final_price;

        // Insert into tbl_sale
        $this->db->insert('tbl_sale', [
            'invoice' => $this->generate_invoice(),
            'total_price' => $total_price,
            'discount' => $discount,
            'final_price' => $final_price,
            'cash' => $cash,
            'kembalian' => $kembalian,
            'note' => $note,
            'date' => $date,
            'id_user' => $this->session->userdata('user_id')
        ]);
        $id_sale = $this->db->insert_id();

        // Insert into tbl_sale_detail
        foreach ($cart as $item) {
            $this->db->insert('tbl_sale_detail', [
                'id_sale' => $id_sale,
                'id_item' => $item['id'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'discount_item' => 0, // Adjust if there's item-level discount
                'total' => $item['total']
            ]);

            // Update stock
            $this->db->set('stock', 'stock - ' . $item['qty'], FALSE);
            $this->db->where('id_item', $item['id']);
            $this->db->update('tbl_produk');
        }
    }

    public function save_transaction($data)
    {
        // Check if 'details' is set in the incoming data
        if (!isset($data['details'])) {
            throw new Exception('Details not provided');
        }

        // Decode the JSON string
        $details = json_decode($data['details'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid JSON format in details');
        }

        $this->db->trans_start();

        // Insert transaction header
        $this->db->insert('tbl_transaksi', [
            'invoice' => $data['invoice'],
            'nama_kasir' => $data['nama_kasir'],
            'date' => $data['date'],
            'jam_penjualan' => $data['jam_penjualan'],
            'total' => $data['grand_total'],
            'diskon' => $data['diskon'],
            'cash' => $data['cash'],
            'kembalian' => $data['kembalian']
        ]);

        $transaction_id = $this->db->insert_id();

        // Insert transaction details and update stock
        foreach ($details as $detail) {
            // Insert transaction details
            $this->db->insert('tbl_detail_transaksi', [
                'transaction_id' => $transaction_id,
                'nama_barang' => $detail['nama_barang'],
                'harga_barang' => $detail['harga_barang'],
                'jumlah' => $detail['jumlah'],
                'sub_total' => $detail['sub_total']
            ]);

            $product_name = $detail['nama_barang'];
            $quantity = (int)$detail['jumlah'];

            // Update stock in produk_item
            $this->db->set('stock', 'stock - ' . $quantity, TRUE);
            $this->db->where('nama_barang', $product_name);
            $this->db->update('produk_item');

            // Check for SQL errors
            if ($this->db->affected_rows() === 0) {
                $error = $this->db->error();
                $message = 'Failed to update stock for product: ' . $product_name . '. SQL Error: ' . $error['message'];
                error_log($message); // Log the error message
                throw new Exception($message);
            }
        }

        $this->db->trans_complete();

        if (!$this->db->trans_status()) {
            throw new Exception('Transaction failed');
        }

        return TRUE;
    }
}
