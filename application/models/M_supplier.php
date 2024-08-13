<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_supplier extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('supplier')->result();
    }

    public function insert_data($data)
    {
        $this->db->insert('supplier', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }

    public function update_data($id_supplier, $data)
    {
        $this->db->where('id_supplier', $id_supplier); // Assuming 'id' is your primary key column
        return $this->db->update('supplier', $data); // Assuming 'suppliers' is your table name
    }
}

/* End of file M_supplier.php */
