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
}

/* End of file M_filter.php */
