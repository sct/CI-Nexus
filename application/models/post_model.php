<?php

class Post_model extends CI_Model {

    function  __construct() {
        parent::__construct();
    }

    function getPosts($num = 10,$offset = 0) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->where(array('p.published' => 1));
        $this->db->group_by('p.id');
        $this->db->order_by('p.posted_on','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();

        return $query->result();
    }

    function getPostsByCategory($category_id,$num = 10,$offset = 0) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->where(array('p.category_id' => $category_id,'p.published' => 1));
        $this->db->group_by('p.id');
        $this->db->order_by('p.posted_on','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();

        return $query->result();
    }
    
    function getPostsByCategoryCount($category_id) {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where(array('category_id' => $category_id,'published' => 1));
        $query = $this->db->get();

        return $query->num_rows();
    }

    function getAllPosts($num = 10,$offset = 0) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->group_by('p.id');
        $this->db->order_by('p.posted_on','desc');
        $this->db->limit($num,$offset);
        $query = $this->db->get();

        return $query->result();
    }

    function getPost($post_id) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->where('p.id',$post_id);
        $query = $this->db->get();
        return $query->row();
    }

    function postExists($post_id) {
        $query = $this->db->get_where('posts',array('id' => $post_id));
        $result = $query->row();
        if (empty($result->post_title)) {
            return false;
        } else {
            return true;
        }
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
        $this->post_content = $this->fixYoutube($this->input->post('post_content'));
        $this->post_excerpt = $this->input->post('post_excerpt');
        $this->seo_description = $this->input->post('seo_description');
        $this->keywords = $this->input->post('keywords');
        $this->posted_on = time();
        $this->published = $this->input->post('published');
        $this->featured = $this->input->post('featured');
        $this->db->insert('posts',$this);
        $last_id = $this->db->insert_id();

        $updateArray = array('post_seo' => $last_id.'-'.str_replace('.','',url_title(trim($this->input->post('post_title')),'dash',TRUE)));
        $this->db->where('id', $last_id);
        $this->db->update('posts',$updateArray);
        return $last_id;
    }
    
    function editPost() {
        $this->category_id = $this->input->post('category');
        $this->post_title = $this->input->post('post_title');
        $this->post_seo = $this->input->post('post_id').'-'.str_replace('.','',url_title(trim($this->input->post('post_title')),'dash',TRUE));
        $this->post_content = $this->fixYoutube($this->input->post('post_content'));
        $this->post_excerpt = $this->input->post('post_excerpt');
        $this->seo_description = $this->input->post('seo_description');
        $this->keywords = $this->input->post('keywords');
        $this->published = $this->input->post('published');
        $this->featured = $this->input->post('featured');
        $this->db->where('id',$this->input->post('post_id'));
        $this->db->update('posts',$this);
        return true;
    }
    
    function fixYoutube($content) {
        $match_string = '/<object width="([0-9]+)" height="([0-9]+)"><param name="movie" value="http:\/\/www.youtube.com/';
        $replace_string = '<object width="610" height="373"><param name="movie" value="http://www.youtube.com';
        
        $match2_string = '/allowscriptaccess="always" allowfullscreen="true" width="([0-9]+)" height="([0-9]+)"><\/embed>/';
        $replace2_string = 'allowscriptaccess="always" allowfullscreen="true" width="610" height="373"></embed>';
        if (preg_match($match_string,$content,$matches)) {
            if ($matches[0] > 600) {
                $content = preg_replace($match_string,$replace_string,$content);
                $content = preg_replace($match2_string,$replace2_string,$content);
            }
        }
        
        return $content;
    }

    function deletePost() {
        if (($delete_id = $this->input->post('delete_id')) != FALSE) {
            $this->db->delete('posts', array('id' => $delete_id));
            return true;
        } else return false;
    }
    
    function getPostIDBySeo($post_seo) {
        $query = $this->db->get_where('posts',array('post_seo' => $post_seo));
        $result = $query->row();
        if (isset($result->id)) {
            return $result->id;
        } else { return false; }
    }

    function getFeatured($num =3) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->where(array('p.published' => 1,'p.featured' => 1,'p.category_id' => 5));
        $this->db->group_by('p.id');
        $this->db->order_by('p.posted_on','desc');
        $this->db->limit($num);
        $query = $this->db->get();

        return $query->result();
    }

    function createComment() {
        $this->user_id = $this->session->userdata('id');
        $this->post_id = $this->input->post('post_id');
        $this->parent_id = $this->input->post('parent_id');
        $this->content = $this->input->post('comment-text');
        $this->posted_on = time();

        $this->db->insert('comments',$this);
        return $this->db->insert_id();
    }

    function deleteComment($comment_id) {
        $this->db->where('id',$comment_id);
        $this->db->delete('comments');
    }

    function getComment($comment_id) {
        $query = $this->db->get_where('comments',array('id' => $comment_id));
        $result = $query->row();
        return $result;
    }

    function getComments($post_id,$parent_id,$num = 0, $offset = 0) {
        $this->db->select('c.*,u.display_name');
        $this->db->from('comments AS c');
        $this->db->join('users AS u','c.user_id = u.id');
        $this->db->where(array('c.post_id' => $post_id,'c.parent_id' => $parent_id));
        $this->db->order_by('c.id','ASC');
        if ($num != 0) {
            $this->db->limit($num,$offset);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getRecentComments($num = 5, $offset = 0) {
        $this->db->select('c.*,p.post_title,p.post_seo,u.display_name,ct.category_name,ct.category_display');
        $this->db->from('comments AS c');
        $this->db->join('users AS u','c.user_id = u.id');
        $this->db->join('posts as p','p.id = c.post_id');
        $this->db->join('categories AS ct','ct.id = p.category_id');
        $this->db->order_by('c.id','DESC');
        $this->db->limit($num,$offset);
        $query = $this->db->get();
        return $query->result();
    }

    function getMostComments($num = 5) {
        $lastMonth = time() - (60 * 60 * 24 * 30);
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->where(array('p.published' => 1,'p.posted_on >' => $lastMonth));
        $this->db->group_by('p.id');
        $this->db->order_by('comment_count','desc');
        $this->db->limit($num);
        $query = $this->db->get();

        return $query->result();
    }

    function getFeaturedVideos($num = 1) {
        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->where(array('p.published' => 1,'p.featured' => 1,'p.category_id' => 7));
        $this->db->group_by('p.id');
        $this->db->order_by('p.posted_on','desc');
        $this->db->limit($num);
        $query = $this->db->get();

        return $query->result();
    }

    function getRelatedPosts($tags,$cur_post_id,$num = 5) {
        $reg_array = explode(',',$tags);

        for ($x=0;$x<count($reg_array);$x++) {
            $reg_array[$x] = trim($reg_array[$x]);
        }
        $regexp = implode('|',$reg_array);

        $this->db->select('p.*,c.category_name,c.category_display,u.display_name,COUNT(cm.post_id) AS comment_count');
        $this->db->from('posts AS p');
        $this->db->join('categories AS c', 'c.id = p.category_id');
        $this->db->join('users AS u','u.id = p.user_id');
        $this->db->join('comments AS cm','p.id = cm.post_id','left');
        $this->db->where(array('p.published' => 1,'p.id !=' => $cur_post_id,'p.keywords REGEXP' => $regexp));
        $this->db->group_by('p.id');
        $this->db->order_by('p.posted_on','desc');
        $this->db->limit($num);
        $query = $this->db->get();
        return $query->result();
    }
}

?>
