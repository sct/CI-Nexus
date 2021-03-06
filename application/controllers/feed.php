<?php

class Feed extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->helper('xml');
        $this->load->helper('text');
        $this->load->model('post_model');
        $data['feed_name'] = 'DC Universe Online News, Guides, and Videos';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = 'http://www.dcuonexus.com/feed';
        $data['page_description'] = 'DC Universe Online Nexus is your one stop site for all information regarding the MMO DC Universe Online!';
        $data['page_language'] = 'en-en';
        $data['creator_email'] = 'contact@dcuonexus.com';
        $data['posts'] = $this->post_model->getPosts(10);
        header("Content-Type: application/rss+xml");

        $this->load->view('feed/rss',$data);
    }

}

?>
