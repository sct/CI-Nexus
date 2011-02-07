<?php

class Home extends CI_Controller {

    function __contstruct() {
        parent::__construct();
    }

    function index() {
        $this->load->helper('nexus_tools');
        $this->load->model('post_model');
        $data_header['jquery_slider'] = 1;
	$data['posts'] = $this->post_model->getPosts(10);
        $data['categories'] = $this->post_model->getCategories();
        $this->load->view('layout/header',$data_header);
        $this->load->view('home/index',$data);
        $this->load->view('layout/footer');
    }
}

?>
