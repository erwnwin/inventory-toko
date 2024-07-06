<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_unit extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select();
        $this->db->from('produk_unit');
        if ($id != null) {
            $this->db->where('id_unit', $id);
        }
        $query = $this->db->get()->result();
        return $query;
    }

    public function save($data)
    {
        $this->db->insert('produk_unit', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }

    public function update($post)
    {
        $data = [
            'nama_unit' => $this->input->post('nama_unit'),
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id_unit', $this->input->post('id_unit'));
        $this->db->update('produk_unit', $data);
    }

    public function cek_data($nama_unit)
    {
        $this->db->select();
        $this->db->from('produk_unit');
        $this->db->where('nama_unit', $nama_unit);
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('id_unit', $id);
        $this->db->delete('produk_unit');
    }
}
