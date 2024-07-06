<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_stok extends CI_Model
{
    public function get_stock($id = null)
    {
        $this->db->select('*');
        $this->db->from('tbl_stock');
        if ($id != null) {
            $this->db->where('id_stock', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function add_stock_in($post)
    {
        $data = [
            'id_item' => $post['id_item'],
            'type' => 'in',
            'detail' => $post['detail'],
            'id_supplier' => $post['id_supplier'] == null ? null : $post['id_supplier'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'id_user' => 1
        ];

        $this->db->insert('tbl_stock', $data);
    }


    public function get($id = null)
    {
        $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
        if ($id != null) {
            $this->db->where('id_stock', $id);
        }
        $query = $this->db->get()->result();
        return $query;
    }

    public function del($id)
    {
        $this->db->where('id_stock', $id);
        $this->db->delete('tbl_stock');
    }

    // public function add_stock_out($post)
    // {
    //     $data = [
    //         'id_item' => $post['id_item'],
    //         'type' => 'out',
    //         'detail' => $post['detail'],
    //         'qty' => $post['qty'],
    //         'date' => $post['date'],
    //         'user_id' => $this->session->userdata('userid')
    //     ];

    //     $this->db->insert('tbl_stock', $data);
    // }
}

/* End of file M_stok.php */
