<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_response extends CI_Model
{
    // m_stok model
    public function del($id_stock)
    {
        $this->db->where('id_stock', $id_stock);
        $this->db->delete('tbl_stock'); // Replace 'tbl_stock' with your actual table name

        return $this->db->affected_rows() > 0;
    }

    public function get_stock($id_stock)
    {
        return $this->db->get_where('tbl_stock', ['id_stock' => $id_stock])->row();
    }

    // m_item model
    public function update_stock_out($data)
    {
        $this->db->where('id_item', $data['id_item']);
        $this->db->update('produk_item', ['qty' => $data['qty']]); // Adjust table name and field name as per your schema
        return $this->db->affected_rows() > 0;

        // $qty = $data['qty'];
        // $id = $data['id_item'];
        // $sql = "UPDATE produk_item SET stock = stock - '$qty' WHERE id_item = '$id'";
        // $this->db->query($sql);
    }
}

/* End of file M_response.php */
