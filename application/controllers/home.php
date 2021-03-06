<?php

class Home extends CI_Controller {

    function __contstruct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('post_model');
		$data_header['title'] = "DCUO Nexus | Your Guide to DC Universe Online";
		$data_header['meta_description'] = "Your guide to the latest DC Universe Online news and updates. Check out the free Alert walkthroughs and video guides.";
        $data_header['jquery_slider'] = 1;
		$data_header['nav_selected'] = "home";		
		$data_content['featured_news'] = $this->post_model->getFeatured(3);
		$data_content['posts'] = $this->post_model->getPosts(10);
        $data_content['categories'] = $this->post_model->getCategories();
		$data_content['featured_videos'] = $this->post_model->getFeaturedVideos(5);
		$data_content['most_commented'] = $this->post_model->getMostComments();
        $this->load->view('layout/header', $data_header);
		$this->load->view('home/index',$data_content);
        $this->load->view('layout/footer');	
    }

	function about() {
		$data_header['title'] = "About Us | DCUO Nexus";
		$template['content'] = $this->load->view('about/about','', true);
        $this->load->view('layout/header', $data_header);
		$this->load->view('layout/content',$template);
        $this->load->view('layout/footer');		
	}
	
	function privacy() {
		$data_header['title'] = "Privacy Policy | DCUO Nexus";
		$template['content'] = $this->load->view('about/privacy','', true);
        $this->load->view('layout/header', $data_header);
		$this->load->view('layout/content',$template);
        $this->load->view('layout/footer');
	}
	
	function contact() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('describe', 'Message', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$data_header['title'] = "Contact Us | DCUO Nexus";
			$template['content'] = $this->load->view('about/contact','', true);
        	$this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
        	$this->load->view('layout/footer');
		} else {
			$to = 'sctsnipe@gmail.com,jordan@jordanblanco.com';
			$subject = "Contact Form Submission from ".$this->input->post('email');
			$headers = 'From: no-reply@dcuonexus.com' . "\r\n" .
			    'Reply-To: no-reply@dcuonexus.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			$body = $this->input->post('describe');
			mail($to,$subject,$body,$headers);
			$this->session->set_flashdata('contact_sent',1);
			$data_header['title'] = "Contact Us | DCUO Nexus";
			$data['contact_sent'] = 1;
			$template['content'] = $this->load->view('about/contact',$data, true);
        	$this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
        	$this->load->view('layout/footer');
		}
	}
}

?>
