<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_statistik extends CI_Model
{

    public function get_stock_statistics($month, $year)
    {
        $this->db->select('p.nama_produk, 
                            SUM(CASE WHEN s.type = "in" THEN s.qty ELSE 0 END) AS total_in, 
                            SUM(CASE WHEN s.type = "out" THEN s.qty ELSE 0 END) AS total_out');
        $this->db->from('tbl_stock s');
        $this->db->join('produk_item p', 's.id_item = p.id_item', 'left');
        $this->db->where('MONTH(s.date)', $month);
        $this->db->where('YEAR(s.date)', $year);
        $this->db->group_by('p.nama_produk');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_available_months()
    {
        // Example months
        return [
            ['month' => '01', 'name' => 'Januari'],
            ['month' => '02', 'name' => 'Februari'],
            ['month' => '03', 'name' => 'Maret'],
            ['month' => '04', 'name' => 'April'],
            ['month' => '05', 'name' => 'Mei'],
            ['month' => '06', 'name' => 'Juni'],
            ['month' => '07', 'name' => 'Juli'],
            ['month' => '08', 'name' => 'Agustus'],
            ['month' => '09', 'name' => 'September'],
            ['month' => '10', 'name' => 'Oktober'],
            ['month' => '11', 'name' => 'November'],
            ['month' => '12', 'name' => 'Desember']
            // Add other months
        ];
    }

    public function get_available_years()
    {
        $this->db->distinct();
        $this->db->select('YEAR(date) as year');
        $this->db->from('tbl_stock');
        $this->db->order_by('year', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}

/* End of file M_statistik.php */
