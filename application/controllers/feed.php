<?php

class Feed extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('xml');
        $this->load->helper('text');
        $this->load->model('posts_model', 'posts');
    }

    function index() {
        $data['feed_name'] = 'DCUONexus.com';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = 'http://www.dcuonexus.com/feed';
        $data['page_description'] = 'DCUO is your one stop site for all information regarding the MMO DC Universe Online!';
        $data['page_language'] = 'en-en';
        $data['creator_email'] = 'contact@dcuonexus.com';
        $data['posts'] = $this->posts->getPosts(10);
        header("Content-Type: application/rss+xml");

        $this->load->view('feed/rss',$data);
    }

}

?>
