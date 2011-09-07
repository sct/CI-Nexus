<?php

class Forum extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('forum_model','forum');
    }
    
    function index() {
        $this->load->model('forum_mode','forum');
        $categories = $this->forum->getCategories();
        $forums = '';
        foreach ($categories as $category) {
            if (($category->private == 1 && $this->session->userdata('admin') == 1) || $category->private == 0) {
                $data['category'] = $category;
                $forums .= $this->load->view('forum/tmpl/home/category', $data, true);
                $forums .= $this->load->view('forum/tmpl/home/tableheader', '', true);
                $subs = $this->forum->getForums($category->id);
                foreach ($subs as $sub) {
                    if (($sub->private == 1 && $this->session->userdata('admin') == 1) || $sub->private == 0) {
                        $data_sub['forum'] = $sub;
                        $data_sub['latest_post'] = $this->forum->getForumLatestPost($sub->id);
                        $forums .= $this->load->view('forum/tmpl/home/forum',$data_sub,true);
                    }
                }
            }
        }
        $data['forums'] = $forums;
        $template['content'] = $this->load->view('forum/index', $data, true);
        $this->load->view('layout/header');
        $this->load->view('layout/content',$template);
        $this->load->view('layout/footer');
    }
    
    function viewforum() {
        if (!$this->uri->segment(2)) {
            redirect('forum');
        }
        
        $forum = $this->forum->getForumByURI($this->uri->segment(2));
        if (empty($forum->name)) { redirect('forum'); }
        $stickies = $this->forum->getThreads($forum->id,1);
        $threads = $this->forum->getThreads($forum->id,0);
        $data['threads'] = '';
        foreach ($stickies as $sticky) {
            $data_sub['thread'] = $sticky;
            $data['threads'] .= $this->load->view('forum/tmpl/forum/sticky', $data_sub, true);
        }
        foreach ($threads as $thread) {
            $data_sub['thread'] = $thread;
            $data['threads'] .= $this->load->view('forum/tmpl/forum/thread', $data_sub, true);
        }
        $data['forum'] = $forum;
        $breadcrumb[] = array($data['forum']->name);
        $data_breadcrumb['breadcrumb'] = $breadcrumb;
        $data['breadcrumb'] = $this->load->view('forum/breadcrumb',$data_breadcrumb, true);
        $template['content'] = $this->load->view('forum/viewforum', $data, true);
        $this->load->view('layout/header');
        $this->load->view('layout/content',$template);
        $this->load->view('layout/footer');
    }
    
    function viewthread() {
        if (!$this->uri->segment(3)) {
            redirect('forum');
        }
        
        $this->load->helper('form');
        
        $thread = $this->forum->getThreadByURI($this->uri->segment(3));
        if (empty($thread->title)) { redirect('forum'); }
        $posts = $this->forum->getPosts($thread->id);
        $data['posts'] = '';
        foreach ($posts as $post) {
            $data_sub['post'] = $post;
            $data['posts'] .= $this->load->view('forum/tmpl/thread/postbit',$data_sub,true);
        }
        $data['thread'] = $thread;
        $breadcrumb[] = array($thread->forum_name, 'forum/'.$thread->forum_uri);
        $breadcrumb[] = array($thread->title);
        $data_breadcrumb['breadcrumb'] = $breadcrumb;
        $data['breadcrumb'] = $this->load->view('forum/breadcrumb',$data_breadcrumb, true);
        $template['content'] = $this->load->view('forum/viewthread', $data, true);
        $this->load->view('layout/header');
        $this->load->view('layout/content',$template);
        $this->load->view('layout/footer');
    }
    
    function no_access() {
        redirect('register');
    }
    
    function newthread() {
        if (!$this->session->userdata('username')) {
            redirect('register');
        }
        
        $data['forum'] = $this->forum->getForumByURI($this->uri->segment(2));
        if (empty($data['forum']->name)) { redirect('forum'); }
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        $this->form_validation->set_rules('title','Thread Title','required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('content','Message','required|min_length[5]');
        
        if ($this->form_validation->run() == FALSE) {
            $breadcrumb[] = array($data['forum']->name, 'forum/'.$data['forum']->uri_name);
            $breadcrumb[] = array('New Thread');
            $data_breadcrumb['breadcrumb'] = $breadcrumb;
            $data['breadcrumb'] = $this->load->view('forum/breadcrumb',$data_breadcrumb, true);
            $template['content'] = $this->load->view('forum/newthread', $data, true);
            $this->load->view('layout/header');
            $this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
        } else {
            $uri_name = $this->forum->createThread();
            redirect('forum/thread/'.$uri_name);
        }
    }

    function reply() {
        if (!$this->session->userdata('username')) {
            redirect('register');
        }
        
        $thread = $this->forum->getThreadByURI($this->uri->segment(3));
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        $this->form_validation->set_rules('content','Message','required|min_length[5]');
        
        if ($this->form_validation->run() == FALSE) {
            $breadcrumb[] = array($thread->forum_name, 'forum/'.$thread->forum_uri);
            $breadcrumb[] = array($thread->title, 'forum/thread/'.$thread->uri_title);
            $breadcrumb[] = array('Reply');
            $data_breadcrumb['breadcrumb'] = $breadcrumb;
            $data['thread'] = $thread;
            $data['breadcrumb'] = $this->load->view('forum/breadcrumb',$data_breadcrumb, true);
            $template['content'] = $this->load->view('forum/reply', $data, true);
            $this->load->view('layout/header');
            $this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
        } else {
            $this->forum->createReply();
            redirect('forum/thread/'.$thread->uri_title);
        }
    }
    
}

?>