<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{

    public function get_data()
    {
        return $this->db->get('produk_category')->result();
    }

    public function insert_data($data)
    {
        $this->db->insert('produk_category', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }
}

/* End of file M_kategori.php */
