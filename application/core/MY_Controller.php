<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model
        $this->load->model('m_user');
        // Fetch user count
        $data['user_count'] = $this->m_user->record_count();
        // Pass data to views
        $this->load->vars($data);

        if (!$this->session->userdata('id_user')) {
            // Redirect to login page if not logged in
            redirect(base_url('login'));
        }

        // Check if the user has the required role
        $this->check_role();
    }


    private function check_role()
    {
        $role = $this->session->userdata('role');
        $allowed_roles = $this->get_allowed_roles();

        if (!in_array($role, $allowed_roles)) {
            // If the role is not allowed, redirect to an error page or access denied page
            show_error('You do not have permission to access this page.', 403);
        }
    }

    // Define allowed roles for each controller
    protected function get_allowed_roles()
    {
        // Default roles allowed for this controller
        return array();
    }
}


/* End of file Controllername.php */
