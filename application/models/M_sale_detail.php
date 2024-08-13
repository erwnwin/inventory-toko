<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_sale_detail extends CI_Model
{


    public function get_sales_statistics_by_date($month = null, $year = null)
    {
        $this->db->select('tbl_sale_detail.id_item, 
                           produk_item.nama_produk AS nama_produk,
                           SUM(tbl_sale_detail.total) AS total_penjualan, 
                           SUM(tbl_sale_detail.qty) AS total_qty');
        $this->db->from('tbl_sale_detail');
        $this->db->join('tbl_sale', 'tbl_sale.id_sale = tbl_sale_detail.id_sale');
        $this->db->join('produk_item', 'produk_item.id_item = tbl_sale_detail.id_item');

        if ($month && $year) {
            $this->db->where('MONTH(tbl_sale.date)', $month);
            $this->db->where('YEAR(tbl_sale.date)', $year);
        }

        $this->db->group_by('tbl_sale_detail.id_item');
        $this->db->order_by('total_penjualan', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_available_years()
    {
        $this->db->distinct();
        $this->db->select('YEAR(date) as year');
        $this->db->from('tbl_sale');
        $this->db->order_by('year', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}

/* End of file M_sale_detail.php */
