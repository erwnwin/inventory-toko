<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
    public function lihat_nama_produk($nama_barang)
    {
        $query = $this->db->select('*');
        $query = $this->db->where(['nama_barang' => $nama_barang]);
        $query = $this->db->get('produk_item');
        return $query->row();
    }

    public function lihat_stok()
    {
        $query = $this->db->get_where('produk_item', 'stock > 1');
        return $query->result();
    }


    public function min_stok($stock, $nama_produk)
    {
        $query = $this->db->set('stock', 'stock-' . $stock, false);
        $query = $this->db->where('nama_produk', $nama_produk);
        $query = $this->db->update('produk_item');
        return $query;
    }
}

/* End of file M_barang.php */
