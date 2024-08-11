<?php
class Cart_model extends CI_Model
{

    public function add_item($data)
    {

        return $this->db->insert('tbl_cart', $data);
    }

    public function delete_item($id_cart)
    {
        // Hapus item dari cart
        $this->db->where('id_cart', $id_cart);
        return $this->db->delete('tbl_cart');
    }

    public function clear_cart()
    {
        // Hapus semua item dari cart
        return $this->db->empty_table('tbl_cart');
    }

    public function get_cart_items()
    {
        // Mengambil semua item dari cart dan informasi produk terkait
        $this->db->select('
            tbl_cart.id_item,
            tbl_cart.id_cart,
            produk_item.barcode,
            produk_item.nama_produk AS name,
            produk_item.price,
            tbl_cart.qty,
            (tbl_cart.qty * produk_item.price) AS total,
            produk_item.stock
        ');
        $this->db->from('tbl_cart');
        $this->db->join('produk_item', 'tbl_cart.id_item = produk_item.id_item', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
}
