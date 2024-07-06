<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->encryption->initialize(array('driver' => 'openssl'));
    }


    public function index()
    {
        $data['title'] = "Users : Toko Fadhil";

        $config = array();
        $config["base_url"] = base_url() . "users";
        $config["total_rows"] = $this->m_user->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["users"] = $this->m_user->fetch_items($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/users/users', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function create()
    {
        $data['title'] = "Create Users : Toko Fadhil";

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/users/create_users', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function check_duplicate()
    {
        $email = $this->input->post('email');

        $exists = $this->m_user->check_duplicate_email($email);

        if ($exists) {
            $response['status'] = 'error';
            $response['message'] = 'Email ini telah digunakan!';
        } else {
            // $response['redirect'] = base_url('users'); 
        }
        header('Content-Type: application/json');
        echo json_encode(array('exists' => $exists));
    }


    public function store()
    {
        $nama_user = $this->input->post('nama_user');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        // Example: Save data using a model
        $data = array(
            'email' => $email,
            'nama_user' => $nama_user,
            'password' => $password,
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s')
        );

        $exists = $this->m_user->check_duplicate_email($email);
        if ($exists) {
            $response['status'] = 'error';
            $response['message'] = 'Email ini telah digunakan!';
        } else {
            $result = $this->m_user->save_data($data);

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'Data berhasil disimpan!';
                $response['redirect'] = base_url('users');
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Gagal menyimpan data!';
                $response['redirect'] = base_url('users');
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function edit($encrypted_id)
    {
        $data['title'] = "Edit Users : Toko Fadhil";

        $id = decrypt_id($encrypted_id);

        $users = $this->m_user->get_item($id);
        if (!$users) {
            show_404();
        }
        $data['users'] = $users;

        $this->load->view('layouts/head', $data);
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('owner/users/form_edit_users', $data);
        $this->load->view('layouts/footer', $data);
    }


    public function update()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $id = $this->input->post('id_user');
            $data = array(
                'email' => $this->input->post('email'),
                'nama_user' => $this->input->post('nama_user'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'created_at' => date('Y-m-d H:i:s'),

            );
            $result = $this->m_user->update_item($id, $data);

            if ($result) {
                echo json_encode(
                    array(
                        'status' => 'success',
                        'message' => 'User berhasil diupdate!',
                        'redirect' => base_url('users')
                    )
                );
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Gagal diupdate!'));
            }
        } else {
            // ke halaman not fount
            show_404();
        }
    }


    public function delete()
    {

        if (!$this->input->is_ajax_request()) {
            show_404(); // arahkan ke error page katanya
        }

        $users_id = $this->input->post('id_user');

        $success = $this->m_user->delete_users($users_id);

        $response = array();
        if ($success) {
            $response['status'] = 'success';
            $response['message'] = 'Berhasil dihapus!';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Gagal dihapus!';
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}

/* End of file User.php */
