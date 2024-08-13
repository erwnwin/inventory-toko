<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StockModel extends CI_Model
{
    public function get_filtered_stock_data($type, $start_date, $end_date)
    {
        $this->db->select('tbl_stock.*, supplier.nama_supplier, produk_item.nama_produk');
        $this->db->from('tbl_stock');
        $this->db->join('produk_item', 'tbl_stock.id_item = produk_item.id_item', 'left');
        $this->db->join('supplier', 'tbl_stock.id_supplier = supplier.id_supplier', 'left');

        if ($type) {
            $this->db->where('tbl_stock.type', $type);
        }

        if ($start_date && $end_date) {
            $this->db->where('tbl_stock.date >=', $start_date);
            $this->db->where('tbl_stock.date <=', $end_date);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
}
