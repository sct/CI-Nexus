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
            if (isset($_POST) && isset($_POST['username'])) {
                if ($this->user_model->validateUser($_POST['username'],$_POST['password'])) {
                    $this->session->set_userdata($this->user_model->getUserByUsername($_POST['username']));
                    $this->session->unset_userdata('password');
                    redirect('home');
                } else {
                    echo "fail!";
                }
            }

            $this->load->view('layout/header');
            $this->load->view('user/login');
            $this->load->view('layout/footer');
        }
    }

}

?>
