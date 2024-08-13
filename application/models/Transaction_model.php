<?php
class Transaction_model extends CI_Model
{

    public function get_sales_by_date_range($tanggal_mulai, $tanggal_selesai)
    {
        $this->db->select('*');
        $this->db->from('tbl_sale');
        // $this->db->join('tbl_sale_detail', 'tbl_sale.id_sale = tbl_sale_detail.id_sale');
        $this->db->where('tbl_sale.date >=', $tanggal_mulai);
        $this->db->where('tbl_sale.date <=', $tanggal_selesai);
        $query = $this->db->get();

        return $query->result();
    }
}
