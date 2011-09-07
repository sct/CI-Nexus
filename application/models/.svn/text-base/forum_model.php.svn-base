<?php

class Forum_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getCategories() {
        $query = $this->db->get_where('forums',array('is_category' => 1));
        return $query->result();
    }
    
    function getForum($forum_id) {
        $query = $this->db->get_where('forums',array('id' => $forum_id));
        return $query->row();
    }
    
    function forumExists($forum_uri) {
        $query = $this->db->get_where('forums',array('uri_name' => $fou,_uri));
        $result = $query->row();
        if (empty($result->name)) {
            return false;
        } else {
            return $result->id;
        }
    }
    
    function getForums($category_id) {
        $this->db->select('f.*,(SELECT COUNT(*) FROM threads WHERE forum_id=f.id) AS thread_count,COUNT(p.id) AS post_count');
        $this->db->from('forums AS f');
        $this->db->join('threads AS t','f.id = t.forum_id','left');
        $this->db->join('forum_posts AS p','t.id = p.thread_id','left');
        $this->db->where('parent_id',$category_id);
        $this->db->group_by('f.id');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getForumLatestPost($forum_id) {
        $this->db->select("t.title,t.uri_title,p.*,u.display_name");
        $this->db->from("forums AS f");
        $this->db->join("threads AS t","f.id = t.forum_id","left");
        $this->db->join("forum_posts AS p","t.id = p.thread_id","left");
        $this->db->join("users AS u","p.user_id = u.id","left");
        $this->db->where("f.id",$forum_id);
        $this->db->order_by("p.id","DESC");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
    
    function getForumByURI($uri) {
        $query = $this->db->get_where('forums',array('uri_name' => $uri));
        return $query->row();
    }
    
    function getThreads($forum_id,$sticky,$num = 30,$offset = 0) {
        $this->db->select("t.*,u.id,u.username,u.display_name,p.id AS lp_id,p.user_id AS lp_user_id,p.posted_on AS lp_posted_on,lu.display_name AS lu_display_name,COUNT(p2.id) AS total_posts");
        $this->db->from("threads AS t");
        $this->db->join("users AS u","t.creator_id = u.id");
        $this->db->join('forum_posts AS p','p.thread_id = t.id');
        $this->db->join('forum_posts AS p2','p2.thread_id = t.id','left');
        $this->db->join('users AS lu','lu.id = p.user_id','left');
        $this->db->where("t.forum_id",$forum_id);
        $this->db->where("t.is_sticky",$sticky);
        $this->db->order_by("lp_posted_on","DESC");
        $this->db->group_by('p.id');
        $this->db->having('lp_id = MAX(p2.id)');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query->result();
    }

    function getThreadByURI($uri) {
        $this->db->select("t.*,f.name AS forum_name,f.uri_name AS forum_uri");
        $this->db->from("threads AS t");
        $this->db->join("forums AS f","t.forum_id = f.id");
        $this->db->where("t.uri_title",$uri);
        $query = $this->db->get();
        return $query->row();
    }
    
    function getPosts($thread_id,$num = 20,$offset = 0) {
        $this->db->select("p.*,u.id AS user_id,u.username,u.display_name,u.signature,COUNT(p2.id) AS post_count");
        $this->db->from("forum_posts AS p");
        $this->db->join("users AS u","p.user_id = u.id");
        $this->db->join("forum_posts AS p2","p.user_id = p2.user_id","left");
        $this->db->where("p.thread_id",$thread_id);
        $this->db->order_by("p.id","ASC");
        $this->db->group_by("p.id");
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query->result();
    }
    
    function createThread() {
        /* First, create row for threads table */
        $this->creator_id = $this->session->userdata('id');
        $this->forum_id = $this->input->post('forum_id');
        $this->title = $this->input->post('title');
        $this->uri_title = '';
        $this->created_on = time();
        $this->db->insert('threads',$this);
        $last_id = $this->db->insert_id();
        
        $update = array('uri_title' => $last_id.'-'.url_title($this->title,'dash',TRUE));
        $this->db->where('id',$last_id);
        $this->db->update('threads',$update);
        
        /* Now create the first post! */
        
        $post = array(
                        'thread_id' => $last_id,
                        'user_id' => $this->session->userdata('id'),
                        'content' => $this->input->post('content'),
                        'posted_on' => time()
                    );
        $this->db->insert('forum_posts',$post);
        return $update['uri_title'];
    }
    
    function createReply() {
        $this->thread_id = $this->input->post('thread_id');
        $this->user_id = $this->session->userdata('id');
        $this->content = $this->input->post('content');
        $this->posted_on = time();
        
        $this->db->insert('forum_posts',$this);
    }
}

?>