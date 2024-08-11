<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_sale_detail extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('tbl_sale_detail', $data);
    }
}

/* End of file M_sale_detail.php */
