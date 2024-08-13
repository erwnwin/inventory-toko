<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_filter extends CI_Model
{
    public function get_sales($tanggal_mulai, $tanggal_selesai)
    {
        $this->db->select('*');
        $this->db->from('tbl_sale');
        $this->db->where('date >=', $tanggal_mulai);
        $this->db->where('date <=', $tanggal_selesai);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_filtered_stock_data($type, $start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('tbl_stock');

        if ($type) {
            $this->db->where('type', $type);
        }

        if ($start_date && $end_date) {
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
}

/* End of file M_filter.php */
