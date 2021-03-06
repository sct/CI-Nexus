<?php

class User_model extends CI_Model {

    function  __construct() {
        parent::__construct();
    }

    function validateUser($username,$password) {
        if (!$query = $this->db->get_where('users',array('username' => $username))) {
            return false;
        } else {
            $salt = $this->config->item('md5_salt');
            $salted_password = md5(md5($salt).md5($password));
            if (!$result = $query->row()) {
                return false;
            }
            if ($salted_password != $result->password || $result->active == 0) {
                return false;
            } else {
                $this->last_login = time();
                $this->last_ip = $_SERVER['REMOTE_ADDR'];
                $this->db->where('id',$result->id);
                $this->db->update('users',$this);
                return true;
            }
        }
    }

    function createuser() {
        $this->username = $this->input->post('username');
        $this->display_name = $this->input->post('username');
        $this->password = $this->encryptPassword($this->input->post('password'));
        $this->email = $this->input->post('email');
        $this->created = time();

        $this->db->insert('users',$this);

        return $this->db->insert_id();
    }

	function changePassword($user_id,$new_password) {
		$this->db->where('id',$user_id);
		$this->password = $this->encryptPassword($new_password);
		$this->db->update('users',$this);
		return true;
	}

    function encryptPassword($password) {
        $encrypted = md5(md5($this->config->item('md5_salt')).md5($password));
        return $encrypted;
    }


    function getUser($user_id) {
        $query = $this->db->get_where('users',array('id' => $user_id));
        return $query->row();
    }

    function getUserByUsername($username) {
        $query = $this->db->get_where('users',array('username' => $username));
        return $query->row();
    }

    function getUserByDisplayName($display_name) {
        $query = $this->db->get_where('users',array('display_name' => $display_name));
        return $query->row();
    }

    function getUserByEmail($email) {
        $query = $this->db->get_where('users',array('email' => $email));
        return $query->row();
    }

    function getUsers($limit = 0,$offset = 0) {
        $query = $this->db->get('users',$limit,$offset);
        return $query->result();
    }

	function getUserComments($user_id, $num = 5) {
		$this->db->select('c.*,p.post_title,p.post_seo,u.display_name,ct.category_name,ct.category_display');
        $this->db->from('comments AS c');
        $this->db->join('users AS u','c.user_id = u.id');
        $this->db->join('posts as p','p.id = c.post_id');
        $this->db->join('categories AS ct','ct.id = p.category_id');
		$this->db->where('c.user_id',$user_id);
		$this->db->order_by('c.id','DESC');
        $this->db->limit($num);
        $query = $this->db->get();
        return $query->result();
	}
	
	function getUserCommentCount($user_id) {
		$this->db->select('id, COUNT(*) AS comment_count');
		$this->db->from('comments');
		$this->db->where('user_id',$user_id);
		$this->db->group_by('id');
		$query = $this->db->get();
		$result = $query->row();
		return $result->comment_count;
	}

    function setRecoveryPhrase($key) {
        $user = $this->getUserByEmail($this->input->post('email'));

        $this->recover_phrase = $key;
        $this->db->where('id',$user->id);
        $this->db->update('users',$this);
    }

    function verifyRecoveryPhrase($key) {
        $query = $this->db->get_where('users',array('recover_phrase' => $key));
        $user = $query->row();
        if (isset($user->username)) {
            $password = '';
            $length = round(rand(8,12));
            $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
            $maxlength = strlen($possible);
            $i = 0;
            while ($i < $length) { 
              $char = substr($possible, mt_rand(0, $maxlength-1), 1);
              if (!strstr($password, $char)) { 
                $password .= $char;
                $i++;
              }
            }
            $user->password = $password;
            $this->changePassword($user->id, $password);

            $this->recover_phrase = '';
            $this->db->where('id',$user->id);
            $this->db->update('users',$this);
            return $user;
        } else {
            return false;
        }
    }
}

?>
