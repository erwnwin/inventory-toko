<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_sale_detail');
        $this->load->model('m_statistik');
    }

    protected function get_allowed_roles()
    {
        return array('admin', 'owner', 'petugas'); // Only 'admin' and 'owner' can access this controller
    }


    public function index()
    {
        $data['title'] = "Dashboard : Toko Fadhil";
        $data['user_count'] = $this->m_user->record_count();

        $month = $this->input->get('month');
        $year = $this->input->get('year');

        // Default to current month and year if not provided
        if (!$month) {
            $month = date('m');
        }
        if (!$year) {
            $year = date('Y');
        }

        $data['sales'] = $this->m_sale_detail->get_sales_statistics_by_date($month, $year);
        $data['months'] = $this->get_months_in_indonesian();
        $data['years'] = $this->get_years();

        // stock
        $data['stats'] = $this->m_statistik->get_stock_statistics($month, $year);
        $data['months1'] = $this->m_statistik->get_available_months();
        $data['years1'] = $this->m_statistik->get_available_years();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/dashboard', $data);
        $this->load->view('layouts/footer', $data);
    }


    private function get_months_in_indonesian()
    {
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
        ];
    }

    private function get_years()
    {
        return $this->m_sale_detail->get_available_years();
    }
}

/* End of file Dashboard.php */
