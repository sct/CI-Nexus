<?php

class Post extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('post_model');
    }

    function index() {
        $data['posts'] = $this->post_model->getPosts(10);

        $this->load->view('layout/header');
        $this->load->view('post/index',$data);
        $this->load->view('layout/footer');
    }

    function show() {
        if (($post_seo = $this->uri->segment(2)) != "" || ($post_seo = $this->uri->segment(3)) != "") {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('comment-text', 'Comment Content', 'required');

            if ($this->form_validation->run() == TRUE) {
                $comment_id = $this->post_model->createComment();
            }

            $post_id = $this->post_model->getPostIDBySeo($post_seo);
            $data['post'] = $this->post_model->getPost($post_id);
            $data['comments'] = $this->post_model->getComments($post_id);
            $this->load->view('layout/header');
            $this->load->view('post/show',$data);
            $this->load->view('layout/footer');
        }
    }

    function category() {
        $category_name = $this->uri->segment(1);
        if (($category_id = $this->post_model->getCategoryIDByName($category_name)) != "") {
            $data['posts'] = $this->post_model->getPostsByCategory($category_id);
            $this->load->view('layout/header');
            $this->load->view('post/index',$data);
            $this->load->view('layout/footer');
        }
    }

    function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('post_title', 'Title', 'required');
        $this->form_validation->set_rules('post_content', 'Content', 'required');
        $this->form_validation->set_rules('post_excerpt', 'Excerpt', 'required');
        
        if ($this->session->userdata('username') == false) {
            redirect('user/login');
        }
        if ($this->form_validation->run() == FALSE) {
            $data['categories'] = $this->post_model->getCategories();
            $hdata['tiny_mce'] = 1;
            $this->load->view('layout/header',$hdata);
            $this->load->view('post/create',$data);
            $this->load->view('layout/footer');
        } else {
            $data['post_seo'] = strtolower(url_title($this->input->post('post_title')));
            $insert_id = $this->post_model->createPost();
            $this->load->view('post/create_success',$data);
            if (move_uploaded_file($_FILES['post_image']['tmp_name'], $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg')) {
                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg';
                $config['new_image'] = $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-310x121.jpg';
                $config['maintain_ratio'] = TRUE;
                $config['width']	 = 310;
                $config['height']	= 121;

                $this->load->library('image_lib', $config);
                $this->image_lib->clear();

                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg';
                $config['new_image'] = $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-70x27.jpg';
                $config['maintain_ratio'] = TRUE;
                $config['width']	 = 70;
                $config['height']	= 27;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                echo $this->image_lib->display_errors();
            }
        }
    }
}

?>
