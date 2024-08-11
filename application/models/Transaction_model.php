<?php
class Transaction_model extends CI_Model
{

    public function process_transaction($id_customer, $sub_total, $discount, $grand_total, $cash, $change, $note, $date)
    {
        // Simpan transaksi
        $data = array(
            'id_customer' => $id_customer,
            'sub_total' => $sub_total,
            'discount' => $discount,
            'grand_total' => $grand_total,
            'cash' => $cash,
            'change' => $change,
            'note' => $note,
            'date' => $date
        );
        $this->db->insert('tbl_sale', $data);
        return $this->db->insert_id(); // Return ID transaksi yang baru dibuat
    }
}
