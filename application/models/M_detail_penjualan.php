<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail_penjualan extends CI_Model
{
    public function tambah($data)
    {
        return $this->db->insert_batch('tbl_detail_penjualan', $data);
    }
}

/* End of file m_detail_penjualan.php */
