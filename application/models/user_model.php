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

}

?>
