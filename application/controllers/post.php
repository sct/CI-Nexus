<?php

class Post extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('post_model');
    }

    function index() {
		$data_header['nav_selected'] = "news";
        $data['posts'] = $this->post_model->getPosts(10);
		$data['featured_videos'] = $this->post_model->getFeaturedVideos();
		$data['most_commented'] = $this->post_model->getMostComments();

        $this->load->view('layout/header', $data_header);
        $this->load->view('post/index',$data);
        $this->load->view('layout/footer');
    }

    function show() {
        if (($post_seo = $this->uri->segment(2)) != "" || ($post_seo = $this->uri->segment(3)) != "") {
            $this->load->helper('form');
            $this->load->library('form_validation');


            $this->form_validation->set_rules('comment-text', 'Comment Content', 'required');

            $post_id = $this->post_model->getPostIDBySeo($post_seo);
            
            if ($post_id == FALSE) {
                /* CHECK TO SEE IF WE CAN AT LEAST FIND THE CRAP */
                preg_match('/([0-9]+)-/',$post_seo,$uri_matches);
                $post = $this->post_model->getPost($uri_matches[0]);
                if (empty($post->id)) {
                    redirect('home');
                } else {
                    redirect($post->category_name.'/'.$post->post_seo,'location',301);
                }
            } else {
                $data_content['post'] = $this->post_model->getPost($post_id);
			}

            if ($this->form_validation->run() == TRUE) {
                $comment_id = $this->post_model->createComment();
                redirect($data_content['post']->category_name.'/'.$data_content['post']->post_seo.'#comment-'.$comment_id);
            }
			
			$data_header['title'] = $data_content['post']->post_title;
			if ($data_content['post']->category_name == 'video-guides') {
				$data_header['title'] .= " | DC Universe Online Video Guide";
			}else{
				$data_header['title'] .= " | DCUO Nexus";			
			}
			$data_header['meta_description'] = $data_content['post']->seo_description;
			$data_header['canonical'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
			$data_content['related'] = $this->post_model->getRelatedPosts($data_content['post']->keywords, $post_id, 5);
          
            $data_content['comments'] = $this->thread_comments($post_id);
            
			$sidebar['featured_videos'] = $this->post_model->getFeaturedVideos();
			$sidebar['most_commented'] = $this->post_model->getMostComments();
			$template['content'] = $this->load->view('post/show',$data_content, true);
			$template['sidebar'] = $this->load->view('layout/sidebar',$sidebar, true);
            $this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');			
        }
    }
    
    function thread_comments($post_id,$parent_id = 0) {
        global $lvl;
        $lvl += 1;
        $loop = 0;
        $cm_view = '';
        $comments = $this->post_model->getComments($post_id,$parent_id);
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $loop++;
                if ($lvl > 1 && $loop == 1) {
                    $data['comment_arrow'] = " comment-arrow";
                } else { $data['comment_arrow'] = ""; }
                $data['comment'] = $comment;
                $data['lvl'] = $lvl;
                $cm_view .= $this->load->view('post/comment',$data,TRUE);
                $cm_view .= $this->thread_comments($post_id,$comment->id);
            }
        }
        $lvl -= 1;
        return $cm_view;
    }

    function delete_comment() {
        $approved = 0;
        if ($this->session->userdata('admin')) {
            $approved = 1;
        }
        if (($comment_id = $this->uri->segment(3)) != FALSE) {
            $comment = $this->post_model->getComment($comment_id);
            if (empty($comment->id)) { redirect('home'); }
            if ($approved == 1 || $this->session->userdata('id') == $comment->user_id) {
                $this->post_model->deleteComment($comment->id);
            }

            header('Location: '.$_SERVER['HTTP_REFERER'].'#comments');
        } else {
            redirect('home');
        }
    }

    function category() {
        $category_name = $this->uri->segment(1);
        if (($category_id = $this->post_model->getCategoryIDByName($category_name)) != "") {
			$this->load->library('pagination');
			
			$per_page = 10;
			if (($page = $this->uri->segment(3)) != FALSE) {
			    $offset = ($page * $per_page) - $per_page;
			} else { $offset = 0; }
			
			$post_count = $this->post_model->getPostsByCategoryCount($category_id);
			$data['posts'] = $this->post_model->getPostsByCategory($category_id,$per_page,$offset);
			if (empty($data['posts'][0]->post_title)) {
			    redirect('home');
			}
			
			$config['base_url'] = base_url().$category_name.'/page/';
            $config['total_rows'] = $post_count;
            $config['per_page'] = $per_page; 
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
			$data_header['nav_selected'] = $category_name;			
			$sidebar['featured_videos'] = $this->post_model->getFeaturedVideos();
			$sidebar['most_commented'] = $this->post_model->getMostComments();
			$template['content'] = $this->load->view('post/index',$data, true);
			$template['sidebar'] = $this->load->view('layout/sidebar',$sidebar, true);
            $this->load->view('layout/header',$data_header);
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');			
        }
    }

    function admin() {
        if (!$this->session->userdata('admin')) redirect('home');
        $data['posts'] = $this->post_model->getAllPosts();
        $hdata['admin_css'] = 1;		
		$template['sidebar'] = $this->load->view('admin/menu', '', true);
		$template['content'] = $this->load->view('admin/posts', $data, true);
        $this->load->view('layout/header', $hdata);
		$this->load->view('layout/content',$template);
        $this->load->view('layout/footer');	
    }

    function create() {
        if (!$this->session->userdata('admin')) redirect('home');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('post_title', 'Title', 'required');
        $this->form_validation->set_rules('post_content', 'Content', 'required');
        $this->form_validation->set_rules('post_excerpt', 'Excerpt', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['categories'] = $this->post_model->getCategories();
            $hdata['tiny_mce'] = 1;
            $hdata['admin_css'] = 1;			
			$template['sidebar'] = $this->load->view('admin/menu', '', true);
			$template['content'] = $this->load->view('post/create', $data, true);
			$this->load->view('layout/header', $hdata);
			$this->load->view('layout/content',$template);
			$this->load->view('layout/footer');	
        } else {
            $data['post_seo'] = strtolower(url_title($this->input->post('post_title')));
            $insert_id = $this->post_model->createPost();
            $this->load->library('image_lib');
            if (move_uploaded_file($_FILES['post_image']['tmp_name'], $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg')) {
                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg';
                $config['new_image'] = $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-310x121.jpg';
                $config['maintain_ratio'] = TRUE;
                $config['width']	 = 310;
                $config['height']	= 121;
                $config['quality'] = "70%";

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg';
                $config['new_image'] = $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-70x27.jpg';
                $config['maintain_ratio'] = TRUE;
                $config['width']	 = 70;
                $config['height']	= 27;
                $config['quality'] = "50%";

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
				$this->image_lib->clear();
            }
			if (move_uploaded_file($_FILES['large_image']['tmp_name'],$this->config->item('upload_path').'images/posts/article-'.$insert_id.'-1000x253.jpg')) {
				$config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-1000x253.jpg';
                $config['new_image'] = NULL;
                $config['maintain_ratio'] = FALSE;
                $config['width']	 = 1000;
                $config['height']	= 253;
                $config['quality'] = '95%';

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
				$this->image_lib->clear();
			}
            $data['posts'] = $this->post_model->getAllPosts();
            $hdata['admin_css'] = 1;
            $data['created'] = 1;			
			$template['sidebar'] = $this->load->view('admin/menu', '', true);
			$template['content'] = $this->load->view('admin/posts', $data, true);
			$this->load->view('layout/header', $hdata);
			$this->load->view('layout/content',$template);
			$this->load->view('layout/footer');	
			
        }
    }

    function edit() {
        if (!$this->session->userdata('admin')) redirect('home');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!($post_id = $this->uri->segment(4))) {
            header('admin/posts');
        }

        $this->form_validation->set_rules('post_title', 'Title', 'required');
        $this->form_validation->set_rules('post_content', 'Content', 'required');
        $this->form_validation->set_rules('post_excerpt', 'Excerpt', 'required');

        if ($this->session->userdata('username') == false) {
            redirect('user/login');
        }
        if ($this->form_validation->run() == FALSE) {
            /* Since this is an edit post, we need to grab the post! ofc. */
            $data['post'] = $this->post_model->getPost($post_id);
            $data['categories'] = $this->post_model->getCategories();
            $hdata['tiny_mce'] = 1;
			$hdata['admin_css'] = 1;		
			$template['sidebar'] = $this->load->view('admin/menu', '', true);
			$template['content'] = $this->load->view('post/edit', $data, true);
			$this->load->view('layout/header', $hdata);
			$this->load->view('layout/content',$template);
			$this->load->view('layout/footer');				
        } else {
            $data['post_seo'] = strtolower(url_title($this->input->post('post_title')));
            $this->post_model->editPost();
            $insert_id = $this->input->post('post_id');
			$this->load->library('image_lib');
            if (move_uploaded_file($_FILES['post_image']['tmp_name'], $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg')) {
                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg';
                $config['new_image'] = $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-310x121.jpg';
                $config['maintain_ratio'] = TRUE;
                $config['width']	 = 310;
                $config['height']	= 121;
                $config['quality'] = '70%';

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-640x250.jpg';
                $config['new_image'] = $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-70x27.jpg';
                $config['maintain_ratio'] = TRUE;
                $config['width']	 = 70;
                $config['height']	= 27;
                $config['quality'] = '50%';

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
			if (move_uploaded_file($_FILES['large_image']['tmp_name'],$this->config->item('upload_path').'images/posts/article-'.$insert_id.'-1000x253.jpg')) {
				$config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/posts/article-'.$insert_id.'-1000x253.jpg';
                $config['new_image'] = NULL;
                $config['maintain_ratio'] = FALSE;
                $config['width']	 = 1000;
                $config['height']	= 253;
                $config['quality'] = '95%';

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
				$this->image_lib->clear();
			}
            $data['post'] = $this->post_model->getPost($post_id);
            $data['success'] = 1;
            $data['categories'] = $this->post_model->getCategories();
            $hdata['tiny_mce'] = 1;
            $hdata['admin_css'] = 1;			
			$template['sidebar'] = $this->load->view('admin/menu', '', true);
			$template['content'] = $this->load->view('post/edit', $data, true);
			$this->load->view('layout/header', $hdata);
			$this->load->view('layout/content',$template);
			$this->load->view('layout/footer');	
        }
    }

    function delete() {
        if (!$this->session->userdata('admin')) { redirect('home'); die(); }
        $this->load->helper('form');
        if (!($post_id = $this->uri->segment(4))) {
            header('admin/posts');
        }

        if (isset($_POST['delete_id'])) {
            $this->post_model->deletePost();
            $hdata['admin_css'] = 1;
            $data['deleted'] = 1;
            $this->load->view('layout/header',$hdata);
            $this->load->view('admin/menu');
            $this->load->view('admin/posts',$data);
            $this->load->view('layout/footer');
        }

        if ($this->post_model->postExists($post_id) == TRUE) {
            $data['post_id'] = $post_id;
            $hdata['admin_css'] = 1;
            $this->load->view('layout/header',$hdata);
            $this->load->view('admin/menu');
            $this->load->view('post/delete',$data);
            $this->load->view('layout/footer');
        } else {
            redirect('admin/posts');
        }
    }
}

?>
