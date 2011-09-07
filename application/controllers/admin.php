<?php

class Admin extends CI_Controller {

    function  __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin')) {
            redirect('home');
        }
    }

    function index() {
        redirect('admin/dashboard');
    }

    function dashboard() {
        $hdata['admin_css'] = 1;		
		$template['sidebar'] = $this->load->view('admin/menu', '', true);
		$template['content'] = $this->load->view('admin/dashboard', '', true);
        $this->load->view('layout/header', $hdata);
		$this->load->view('layout/content',$template);
        $this->load->view('layout/footer');		
		
    }

    function manage() {
        $hdata['admin_css'] = 1;
		$template['sidebar'] = $this->load->view('admin/menu', '', true);
		$template['content'] = $this->load->view('admin/manage', '', true);
        $this->load->view('layout/header', $hdata);
		$this->load->view('layout/content',$template);
        $this->load->view('layout/footer');	
    }
}

?>
