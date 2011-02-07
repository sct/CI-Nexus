<?php

class User extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    function index() {
        $this->load->view('user/index');
    }

    function profile() {
        if (($display_name = $this->uri->segment(2)) != FALSE) {
            $data['user'] = $this->user_model->getUserByDisplayName($display_name);
            $this->load->view('layout/header');
            $this->load->view('user/profile',$data);
            $this->load->view('layout/footer');
        }
    }

    function login() {
        if ($this->session->userdata('username') == false) {
            $data['error'] = 0;
            if (isset($_POST) && isset($_POST['username'])) {
                if ($this->user_model->validateUser($_POST['username'],$_POST['password'])) {
                    $this->session->set_userdata($this->user_model->getUserByUsername($_POST['username']));
                    $this->session->unset_userdata('password');
                    redirect('home');
                } else {
                    $data['error'] = 1;
                }
            }
            $this->load->view('layout/header');
            $this->load->view('user/login',$data);
            $this->load->view('layout/footer');
        }
    }

    function register() {
        if ($this->session->userdata('username') == false) {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[pass_conf]');
            $this->form_validation->set_rules('pass_conf', 'Password Confirmation', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header');
                $this->load->view('user/register');
                $this->load->view('layout/footer');
            } else {
                $existing_username = $this->user_model->getUserByUsername($this->input->post('username'));
                if (isset($existing_username->username)) {
                    $data['username_exists'] = 1;
                }
                $existing_email = $this->user_model->getUserByEmail($this->input->post('email'));
                if (isset($existing_email->username)) {
                    $data['email_exists'] = 1;
                }
                if (isset($data['username_exists']) || isset($data['email_exists'])) {
                    $this->load->view('layout/header');
                    $this->load->view('user/register',$data);
                    $this->load->view('layout/footer');
                } else {
                    $this->user_model->createUser();
                    $this->load->view('layout/header');
                    $this->load->view('user/register_success');
                    $this->load->view('layout/footer');
                }
                
            }
        } else {
            redirect('home');
        }
    }

    function logout() {
        $redirect = $_SERVER['HTTP_REFERER'];
        $this->session->sess_destroy();
        header('Location: '.$redirect);
    }

}

?>
