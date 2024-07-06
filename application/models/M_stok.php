<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_stok extends CI_Model
{
    public function add_stock_in($post)
    {
        $data = [
            'id_item' => $post['id_item'],
            'type' => 'in',
            'detail' => $post['detail'],
            'id_supplier' => $post['id_supplier'] == null ? null : $post['id_supplier'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'id_user' => 1
        ];

        $this->db->insert('tbl_stock', $data);
    }

    // public function add_stock_out($post)
    // {
    //     $data = [
    //         'item_id' => $post['item_id'],
    //         'type' => 'out',
    //         'detail' => $post['detail'],
    //         'qty' => $post['qty'],
    //         'date' => $post['date'],
    //         'user_id' => $this->session->userdata('userid')
    //     ];

    //     $this->db->insert('tbl_stock', $data);
    // }
}

/* End of file M_stok.php */
