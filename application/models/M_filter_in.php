<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_filter_in extends CI_Model
{
    public function get_filtered_data($bulan, $tahun)
    {

        $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
        $this->db->where('MONTH(tbl_stock.date)', $bulan);
        $this->db->where('YEAR(tbl_stock.date)', $tahun);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllItems()
    {
        $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
        $query = $this->db->get();
        return $query->result(); // Return result as an array of objects
    }

    public function get_data_by_date_range($tanggal_mulai, $tanggal_selesai)
    {
        $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
        $this->db->where('type', 'in');
        $this->db->where('date >=', $tanggal_mulai);
        $this->db->where('date <=', $tanggal_selesai);
        $query = $this->db->get();

        return $query->result(); // Mengembalikan hasil query dalam bentuk array
    }

    public function get_data_by_date_range_out($tanggal_mulai, $tanggal_selesai)
    {
        $this->db->select('tbl_stock.*,produk_item.barcode, produk_item.gambar, produk_item.nama_produk as nama_item, supplier.nama_supplier as nama_supplier');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'produk_item.id_item=tbl_stock.id_item');
        $this->db->join('supplier', 'supplier.id_supplier=tbl_stock.id_supplier', 'left');
        $this->db->where('type', 'out');
        $this->db->where('date >=', $tanggal_mulai);
        $this->db->where('date <=', $tanggal_selesai);
        $query = $this->db->get();

        return $query->result(); // Mengembalikan hasil query dalam bentuk array
    }
}

/* End of file M_filter_in.php */
