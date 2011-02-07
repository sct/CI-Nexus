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
            if ($salted_password != $result->password) {
                return false;
            } else {
                return true;
            }
        }
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


    function getUsers($limit = 0,$offset = 0) {
        $query = $this->db->get('users',$limit,$offset);
        return $query->result();
    }

}

?>
