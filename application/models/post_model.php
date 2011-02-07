<?php

class Post_model extends CI_Model {

    function  __construct() {
        parent::__construct();
    }

    function getPosts($num = 10,$offset = 0) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->order_by('p.id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query->result();
    }

    function getPostsByCategory($category_id,$num = 10,$offset = 0) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->where(array('p.category_id' => $category_id));
        $this->db->order_by('p.id','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query->result();
    }

    function getPost($post_id) {
        $this->db->select('p.*,c.*,u.display_name');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->where('p.id',$post_id);
        $query = $this->db->get();
        return $query->row();
    }

    function getCategories() {
        $query = $this->db->get('categories');
        return $query->result();
    }

    function getCategoryIDByName($category_name) {
        $query = $this->db->get_where('categories',array('category_name' => $category_name));
        $result = $query->row();
        return $result->id;
    }

    function createPost() {
        $this->user_id = $this->session->userdata('id');
        $this->category_id = $this->input->post('category');
        $this->post_title = $this->input->post('post_title');
        $this->post_seo = strtolower(url_title($this->input->post('post_title')));
        $this->post_content = $this->input->post('post_content');
        $this->post_excerpt = $this->input->post('post_excerpt');
        $this->keywords = $this->input->post('keywords');
        $this->posted_on = time();
        $this->db->insert('posts',$this);
        return $this->db->insert_id();
    }

    function getPostIDBySeo($post_seo) {
        $query = $this->db->get_where('posts',array('post_seo' => $post_seo));
        $result = $query->row();
        return $result->id;
    }
}

?>
