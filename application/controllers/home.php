<?php

class Home extends CI_Controller {

    function __contstruct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('post_model');
        $data['jquery_slider'] = 1;
        $data['categories'] = $this->post_model->getCategories();
        $this->load->view('layout/header',$data);
        $this->load->view('home/index',$data);
        $this->load->view('layout/footer');
    }
}

?>
