<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Apps extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }


    public function index()
    {
        $data['title'] = "Pilih Apps : Toko Fadhil";


        $this->load->view('apps', $data);
    }


    public function validate()
    {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Validation failed
            $response = array(
                'success' => false,
                'message' => validation_errors()
            );
            echo json_encode($response);
            return;
        }

        // Get POST data
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Check credentials
        $user = $this->m_user->login($email, $password);

        if ($user) {
            // Determine redirect URL based on user role
            $role = $user->role;

            // Define redirect URLs and access levels based on role
            switch ($role) {
                case 'kasir':
                    $redirect_url = base_url('apps-kasir');
                    $access = '1';
                    break;
                case 'owner':
                    $redirect_url = base_url('dashboard');
                    $access = '2';
                    break;
                case 'petugas':
                    $redirect_url = base_url('dashboard');
                    $access = '3';
                    break;
                case 'admin':
                    $redirect_url = base_url('dashboard');
                    $access = '4';
                    break;
                default:
                    $redirect_url = base_url('default-dashboard');
                    $access = '0';
                    break;
            }

            // Set user data and access rights in session
            $this->session->set_userdata(array(
                'id_user' => $user->id_user,
                'nama_user' => $user->nama_user,
                'email' => $user->email,
                'role' => $user->role,
                'hak_akses' => $access
            ));

            // Successful login
            $response = array(
                'success' => true,
                'redirect_url' => $redirect_url,
                'user' => array(
                    'id_user' => $user->id_user,
                    'nama_user' => $user->nama_user,
                    'email' => $user->email,
                    'role' => $user->role,
                    'hak_akses' => $access
                )
            );
        } else {
            // Login failed
            $response = array(
                'success' => false,
                'message' => 'Invalid email or password'
            );
        }

        echo json_encode($response);
    }
}

/* End of file Apps.php */
