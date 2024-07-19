<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Filter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_filter_in');
        $this->load->model('m_stok');
    }

    public function all()
    {
        $filtered_data = $this->m_filter_in->getAllItems();

        // Kirim data hasil filter dalam bentuk JSON
        echo json_encode($filtered_data);
    }


    public function filter_by_date_ajax()
    {
        // Ambil data tanggal mulai dan tanggal selesai dari POST
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        // Panggil method model untuk mengambil data berdasarkan range tanggal
        $filtered_data = $this->m_filter_in->get_data_by_date_range($tanggal_mulai, $tanggal_selesai);

        // Kirim data hasil filter dalam bentuk JSON
        echo json_encode($filtered_data);
    }

    public function filter_by_date_ajax_out()
    {
        // Ambil data tanggal mulai dan tanggal selesai dari POST
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        // Panggil method model untuk mengambil data berdasarkan range tanggal
        $filtered_data = $this->m_filter_in->get_data_by_date_range_out($tanggal_mulai, $tanggal_selesai);

        // Kirim data hasil filter dalam bentuk JSON
        echo json_encode($filtered_data);
    }
}

/* End of file Filter.php */
