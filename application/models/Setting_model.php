<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{

    // Method untuk mendapatkan data informasi
    public function get_info()
    {
        $query = $this->db->get('setting_info');
        return $query->row_array(); // Mengembalikan hasil sebagai array asosiatif
    }

    public function update_info($data)
    {
        $this->db->where('id_user', $this->session->userdata('id_user')); // Sesuaikan dengan ID yang relevan
        return $this->db->update('setting_info', $data);
    }
}

/* End of file ModelName.php */
