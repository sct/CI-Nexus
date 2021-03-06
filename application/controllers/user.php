<?php

class User extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('post_model');
    }

    function index() {
        $this->load->view('user/index');
    }

    function profile() {
        if (($display_name = $this->uri->segment(2)) != FALSE) {
			$this->load->model('post_model');
            $data_content['user'] = $this->user_model->getUserByDisplayName($display_name);
			$data_content['comments'] = $this->user_model->getUserComments($data_content['user']->id);
			$data_header['title'] = $data_content['user']->display_name.'\'s Profile | DCUO Nexus';
			$data_header['tab_content'] = 1;
			$sidebar['featured_videos'] = $this->post_model->getFeaturedVideos();
			$sidebar['most_commented'] = $this->post_model->getMostComments();
			$template['content'] = $this->load->view('user/profile',$data_content, true);
			$template['sidebar'] = $this->load->view('layout/sidebar',$sidebar, true);
            $this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
        } elseif (($user_id = $this->session->userdata('id'))) {
			redirect('profile/'.$this->session->userdata('display_name'));
		}
    }

    function login() {
        if ($this->session->userdata('username') == false) {
            $data['error'] = 0;
            if (isset($_POST) && isset($_POST['username'])) {
                if ($this->user_model->validateUser($_POST['username'],$_POST['password'])) {
                    $this->session->set_userdata($this->user_model->getUserByUsername($_POST['username']));
                    $this->session->unset_userdata('password');
                    if (preg_match('/dcuonexus/',$this->session->flashdata('redirect_save'))) {
                        header("Location: ".$this->session->flashdata('redirect_save'));
                    } else {
                        redirect('home');
                    }
                } else {
                    $data['error'] = 1;
                }
            }
            if ($this->session->flashdata('redirect_save') == FALSE) {
                $redirect_save = $this->session->set_flashdata('redirect_save',$_SERVER['HTTP_REFERER']);
            } else {
                $this->session->keep_flashdata('redirect_save');
            }

            $template['content'] = $this->load->view('user/login',$data, true);
            $this->load->view('layout/header');
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
        } else {
			redirect('home');
		}
    }

    function register() {
        if ($this->session->userdata('username') == false) {
            $this->load->helper('form');
            $this->load->library('form_validation');
			$this->load->library('recaptcha');
			$this->lang->load('recaptcha');

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[18]|callback_check_username');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[pass_conf]');
            $this->form_validation->set_rules('pass_conf', 'Password Confirmation', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
			$this->form_validation->set_rules('recaptcha_response_field', 'lang:recaptcha_field_name', 'required|callback_check_captcha');

            if ($this->form_validation->run() == FALSE) {				
				$data['recaptcha'] = $this->recaptcha->get_html();
				$template['content'] = $this->load->view('user/register', $data, true);
				$this->load->view('layout/header');
				$this->load->view('layout/content',$template);
				$this->load->view('layout/footer');
            } else {
                $this->user_model->createUser();
				$template['content'] = $this->load->view('user/register_success', '', true);
				$this->session->set_userdata($this->user_model->getUserByUsername($this->input->post('username')));
				$this->session->unset_userdata('password');
                $this->load->view('layout/header');
				$this->load->view('layout/content',$template);
                $this->load->view('layout/footer');
            }
        } else {
            redirect('home');
        }
    }

	function check_username($username) {
		$existing_username = $this->user_model->getUserByUsername($username);
        if (isset($existing_username->username)) {
			$this->form_validation->set_message('check_username', '%s already exists');
            return false;
        } else {
			return true;
		}
	}
	
	function check_email($email) {
		$existing_email = $this->user_model->getUserByEmail($email);
        if (isset($existing_email->username)) {
			$this->form_validation->set_message('check_email', '%s already exists');
            return false;
        } else {
			return true;
		}
	}

	function check_captcha($val) {
	  if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val)) {
	    return TRUE;
	  } else {
	    $this->form_validation->set_message('check_captcha',$this->lang->line('recaptcha_incorrect_response'));
	    return FALSE;
	  }
	}

    function logout() {
        $redirect = $_SERVER['HTTP_REFERER'];
        $this->session->sess_destroy();
        header('Location: '.$redirect);
    }

	function edit_profile() {
		if (!$this->session->userdata('username')) {
			redirect('home');
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		if ($this->form_validation->run() == FALSE) {
			
		} else {
			$data['users'] = $this->user_model->getUser($this->session->userdata('id'));
			$this->load->view('layout/header');
			$this->load->view('user/edit_profile',$data);
			$this->load->view('layout/footer');
		}
	}
	
	function edit_password() {
		if (!$this->session->userdata('username')) {
			redirect('home');
		}
		
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|min_length[5]|max_length[24]|callback_password_validation');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[5]|max_length[24]|matches[conf_password]');
        $this->form_validation->set_rules('conf_password', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$data_header['title'] = 'Change Password | DCUO Nexus';
			$template['content'] = $this->load->view('user/edit_password','', true);
            $this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
		} else {
			$new_password = $_POST['new_password'];
			
			$this->user_model->getUser($this->session->userdata('id'));
			
			$this->user_model->changePassword($this->session->userdata('id'),$new_password);
			$this->session->set_flashdata('password_change',1);
			redirect('profile');
		}
	}
	
	function password_validation($password) {
		$user = $this->user_model->getUser($this->session->userdata('id'));
		if ($this->user_model->encryptPassword($password) == $user->password) {
			return true;
		} else {
			$this->form_validation->set_message('password_validation', 'The %s did not match the one we have on account');
			return false;
		}
	}

        function recover_password() {
            if ($this->session->userdata('username') != FALSE) {
                redirect('home');
            }

            $this->load->helper('form');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email','Email','required|valid_email|callback_verify_email');

            if ($this->form_validation->run() == FALSE) {
                $data_header['title'] = "Reset Password | DCUO Nexus";
                $template['content'] = $this->load->view('user/recover', '', true);
                $this->load->view('layout/header',$data_header);
                $this->load->view('layout/content',$template);
                $this->load->view('layout/footer');
            } else {
                $key = $this->user_model->encryptPassword($this->input->post('email'));
                $key = md5(time().$key);

                $this->user_model->setRecoveryPhrase($key);

                $to = $this->input->post('email');
                $subject = "DCUO Nexus - Password Change Request";
                $headers = 'From: no-reply@dcuonexus.com' . "\r\n" .
			    'Reply-To: no-reply@dcuonexus.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
                $message = "Someone has requested a password change on www.dcuonexus.com.\n\nIf this was you, please clink the link below. If it was not you, disregard this message.\n\n".base_url()."reset-password/verify/".$key."\n\nDCUO Nexus - www.dcuonexus.com";
                mail($to,$subject,$message,$headers);
                
                $data_header['title'] = "Reset Password | DCUO Nexus";
                $template['content'] = $this->load->view('user/recover_sent', array('email' => $this->input->post('email')), true);
                $this->load->view('layout/header',$data_header);
                $this->load->view('layout/content',$template);
                $this->load->view('layout/footer');
            }

        }

        function verify_email($email) {
            $result = $this->user_model->getUserByEmail($email);
            if (isset($result->username)) {
                return true;
            } else {
                $this->form_validation->set_message('verify_email', 'That %s does not exist in our system');
                return false;
            }
        }

        function recover_password_verify() {
            if ($this->session->userdata('username') != FALSE || !$this->uri->segment(3)) {
                redirect('home');
            }

            $key = $this->uri->segment(3);

            if (($user = $this->user_model->verifyRecoveryPhrase($key)) != FALSE) {

                $to = $user->email;
                $subject = "DCUO Nexus - Password Change Complete";
                $headers = 'From: no-reply@dcuonexus.com' . "\r\n" .
			    'Reply-To: no-reply@dcuonexus.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
                $message = "Your password has been succesfully reset! Your new password is below. Make sure you log in and change it immediatly!\n\n";
                $message .= "        Username: ".$user->username."\n";
                $message .= "        Password: ".$user->password."\n";
                $message .= "\nYou can log in here: ".base_url()."login\n\n";
                $message .= "DCUO Nexus - www.dcuonexus.com";
                mail($to,$subject,$message,$headers);

                $data_header['title'] = "Reset Password | DCUO Nexus";
                $template['content'] = $this->load->view('user/recover_success', '', true);
                $this->load->view('layout/header',$data_header);
                $this->load->view('layout/content',$template);
                $this->load->view('layout/footer');
            } else {
                redirect('home');
            }
        }
	
	function edit_avatar() {
		if (!$this->session->userdata('username')) {
			redirect('home');
		}
		
		$this->load->helper('form');
		
		if (isset($_FILES['avatar'])) {
			$user_id = $this->session->userdata('id');
			$filename = basename($_FILES["avatar"]["name"]); 
			$file_ext = substr($filename, strrpos($filename, ".") + 1);
		    if ($file_ext!="jpg" && $file_ext != "png" && $file_ext != "gif") {  
		    	$this->session->set_flashdata('image_error','Please select a JPG, PNG, or GIF for upload!');
				redirect('profile/avatar');
				die();
		    }
		
			if (move_uploaded_file($_FILES['avatar']['tmp_name'], $this->config->item('upload_path').'images/tmp_avatars/avatar-'.$user_id.'.jpg')) {
                $config['image_library'] = 'gd2';
                $config['source_image']	= $this->config->item('upload_path').'images/tmp_avatars/avatar-'.$user_id.'.jpg';
                $config['maintain_ratio'] = TRUE;
				$config['master_dim'] = "auto";
                $config['width']	 = 350;
                $config['height']	= 350;

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
				$this->image_lib->clear();
            }
			
			$data['uploaded_image'] = $config['source_image'];
			$data['user_id'] = $user_id;
			$data['extension'] = $file_ext;
			$data_header['title'] = 'Change Your Avatar | DCUO Nexus';
			$data_header['edit_avatar'] = 1;						
			$sidebar['featured_videos'] = $this->post_model->getFeaturedVideos();
			$sidebar['most_commented'] = $this->post_model->getMostComments();
			$template['content'] = $this->load->view('user/edit_avatar_step2',$data, true);
			$template['sidebar'] = $this->load->view('layout/sidebar',$sidebar, true);
            $this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
		} else {
			$data_header['edit_avatar'] = 1;	
			$data_header['title'] = 'Change Your Avatar | DCUO Nexus';		
			$sidebar['featured_videos'] = $this->post_model->getFeaturedVideos();
			$sidebar['most_commented'] = $this->post_model->getMostComments();
			$template['content'] = $this->load->view('user/edit_avatar_step1','', true);
			$template['sidebar'] = $this->load->view('layout/sidebar',$sidebar, true);
            $this->load->view('layout/header', $data_header);
			$this->load->view('layout/content',$template);
            $this->load->view('layout/footer');
		}
	}
	
	function save_avatar() {
		if (isset($_POST['upload_avatar'])) {
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$x2 = $_POST["x2"];
			$y2 = $_POST["y2"];
			$w = $_POST["w"];
			$h = $_POST["h"];
			$ext = $_POST['extension'];
			//Scale the image to the thumb_width set above
			$scale = 100/$w;
			$cropped = resizeThumbnailImage($this->config->item('upload_path').'images/avatars/avatar-'.$_POST['user_id'].'.jpg', $this->config->item('upload_path').'images/tmp_avatars/avatar-'.$_POST['user_id'].'.jpg',$ext,$w,$h,$x1,$y1,$scale);
			
			redirect('profile');
		}
	}

	
	/* Adminstration */

    function admin() {
        $hdata['admin_css'] = 1;
		$template['sidebar'] = $this->load->view('admin/menu', '', true);
		$template['content'] = $this->load->view('admin/users', '', true);
		$this->load->view('layout/header', $hdata);
		$this->load->view('layout/content',$template);
		$this->load->view('layout/footer');	
    }

}

?>
