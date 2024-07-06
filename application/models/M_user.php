<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function save_data($data)
    {
        return $this->db->insert('tbl_users', $data);
    }


    public function check_duplicate_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_users');
        return $query->num_rows() > 0;
    }


    public function record_count()
    {
        return $this->db->count_all("tbl_users");
    }

    public function fetch_items($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("tbl_users");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }


    public function get_item($id)
    {
        $query = $this->db->get_where('tbl_users', array('id_user' => $id));
        return $query->row();
    }

    public function update_item($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('tbl_users', $data);
    }


    public function delete_users($users_id)
    {
        $this->db->where('id_user', $users_id);
        $this->db->delete('tbl_users');

        return ($this->db->affected_rows() > 0);
    }
}

/* End of file M_user.php */
