<?php

class Home extends CI_Controller {

    function __contstruct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('post_model');
        
        $data['categories'] = $this->post_model->getCategories();
        $this->load->view('layout/header');
        $this->load->view('home/index',$data);
        $this->load->view('layout/footer');
    }
}

?>
