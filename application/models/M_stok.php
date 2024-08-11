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


    public function get_filtered_data($start_date, $end_date)
    {
        $this->db->select('tbl_stock.*, produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item = tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier = tbl_stock.id_supplier', 'left');
        $this->db->where('tbl_stock.date >=', $start_date);
        $this->db->where('tbl_stock.date <=', $end_date);
        $this->db->where('tbl_stock.type', 'in');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_filtered_data_out($start_date, $end_date)
    {
        $this->db->select('tbl_stock.*, produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item = tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier = tbl_stock.id_supplier', 'left');
        $this->db->where('tbl_stock.date >=', $start_date);
        $this->db->where('tbl_stock.date <=', $end_date);
        $this->db->where('tbl_stock.type', 'out');
        $query = $this->db->get();
        return $query->result();
    }

    // public function get()
    // {
    //     $query = $this->db->get('tbl_stock'); // Ganti 'tbl_stock' dengan nama tabel Anda
    //     return $query;
    // }


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

    public function add_stock_out($post)
    {
        $data = [
            'id_item' => $post['id_item'],
            'type' => 'out',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'id_user' => 1
        ];

        $this->db->insert('tbl_stock', $data);
    }


    // public function get($id = null)
    // {
    //     $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
    //     $this->db->from('tbl_stock');
    //     $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
    //     $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
    //     $this->db->where('type', 'in');
    //     if ($id != null) {
    //         $this->db->where('id_stock', $id);
    //     }
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function get()
    {
        $this->db->select('tbl_stock.*, produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item = tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier = tbl_stock.id_supplier', 'left');
        $this->db->where('tbl_stock.type', 'in');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_stock_out()
    {
        $this->db->select('tbl_stock.*, produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item = tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier = tbl_stock.id_supplier', 'left');
        $this->db->where('tbl_stock.type', 'out');
        $query = $this->db->get();
        return $query->result();
    }


    // public function get_stock_out($id = null)
    // {
    //     $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
    //     $this->db->from('tbl_stock');
    //     $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
    //     $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
    //     $this->db->where('type', 'out');
    //     if ($id != null) {
    //         $this->db->where('id_stock', $id);
    //     }
    //     $query = $this->db->get();
    //     return $query;
    // }


    public function get_posts($limit, $start)
    {
        $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        }
        return false;
    }

    public function count_posts()
    {
        return $this->db->count_all_results('tbl_stock');
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
