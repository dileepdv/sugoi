<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    /**
     * REDIRECTING TO LOGIN PAGE
     */
    public function index()
    {
        $this->get_login();
    }

    /**
     * LOGIN PAGE
     */
    public function get_login()
    {
        $data['errors'] = $this->session->flashdata('errors');
        $data['success'] = $this->session->flashdata('success');

        $this->load->view('layouts/header');
        $this->load->view('user/login', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * ATTEMPT LOGIN
     */
    public function post_login()
    {
        $this->load->library('form_validation');
        //
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('users/get_login');
            return;
        }

        $user = $this->user->validate();
        if ($user) {
            $data['auth'] = [
                'user_id' => $user->id,
                'email'   => $user->email,
                'phone'   => $user->phone
            ];
            $this->session->set_userdata($data);
            redirect('games/');
        }
        $this->session->set_flashdata('errors', 'Users match not found. Please register to play the game.');
        redirect('users/get_registration');
    }

    /**
     * REGISTRATION PAGE
     */
    public function get_registration()
    {
        $data = ['errors' => $this->session->flashdata('errors')];
        $this->load->view('layouts/header');
        $this->load->view('user/registration', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * REGISTER NEW USER
     * @return bool
     */
    public function post_registration()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('users/get_registration');
            return true;
        }

        $new_user = $this->user->store();

        if (!$new_user) {
            $this->session->set_flashdata('errors', 'User with same email id exits');
            redirect('users/get_registration');
            $this->load->view('layouts/header');
            $this->load->view('user/registration');
            $this->load->view('layouts/footer');
            return true;
        }
        $data['auth'] = [
            'user_id' => $new_user->id,
            'email'   => $new_user->email,
            'phone'   => $new_user->phone
        ];
        $this->session->set_userdata($data);
        redirect('games/index');
    }

    /**
     * LOGOUT
     */
    public function logout()
    {
        $this->session->unset_userdata('auth');
        redirect('users/get_login');
    }
}
