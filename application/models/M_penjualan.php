<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
    public function tambah($data)
    {
        return $this->db->insert('tbl_penjualan', $data);
    }
}

/* End of file M_penjualan.php */
