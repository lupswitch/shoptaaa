<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library(array('session','form_validation','email','upload','Template'));

		$this->load->database();
		$this->load->model('admin/AdminUserModel');
	}


    function login(){
		
			if($this->session->has_userdata('is_admin')) {
				redirect('admin/dashboard');
			}
		
		
            /* Valid form */
            $this->form_validation->set_rules('identity', 'Identity', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required');
			//$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');	
			
			
            /* Data */
            $this->data['title']               = 'Login Page';
            $this->data['title_lg']            = 'Eng';
     //       $this->data['auth_social_network'] = $this->config->item('auth_social_network');
      //      $this->data['forgot_password']     = $this->config->item('forgot_password');
     //       $this->data['new_membership']      = $this->config->item('new_membership');

			if ($this->form_validation->run() == True){
			
				$loginData = array(
					'email' 		=> $this->input->post('identity'),
					'password' 		=> $this->input->post('password'),
				);
				
				
				$islogin = 	$this->AdminUserModel->loggedIn($loginData);			
					
				if($islogin){
					$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success!</strong> Redirecting...</div>');
					// Login success fully		
					if($islogin->userType == 'admin'){
						
							$successData = 	array( 'is_admin' => array(
															'user_id'  	  => $islogin->user_id,
															'userName'   => $islogin->userName,
															'firstName' => 	$islogin->firstName,
															'email'  => $islogin->email,
															'user_active' => $islogin->is_active,
															'userType'	  => $islogin->userType,
															'is_admin_login'=> true,
														)	
											);
							$this->session->set_userdata($successData);/* Set data into session */	
							redirect('admin/dashboard');	
							
					}else{
						
						$successData = array( 'is_user' => array(
															'user_id'		=> $islogin->user_id,
															'userName'  	=> $islogin->userName,
															'firstName'		=> $islogin->firstName,
															'email' 		=> $islogin->email,
															'user_active' 	=> $islogin->is_active,
															'userType'	  	=> $islogin->userType,
															'is_user_login'	=> true,
														)	
											);
							
						$this->session->set_userdata($successData);/* Set data into session */	
						redirect('home');	
						
					}
				
				}else{
				
					$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid email or password. </div>');
					redirect('admin/');
				}		
		}
		
			$this->data['identity'] = array(
                    'name'        => 'identity',
                    'id'          => 'identity',
                    'type'        => 'email',
                    'value'       => $this->form_validation->set_value('identity'),
                    'class'       => 'form-control',
                    'placeholder' => 'Enter your email'
                );
                $this->data['password'] = array(
                    'name'        => 'password',
                    'id'          => 'password',
                    'type'        => 'password',
                    'class'       => 'form-control',
                    'placeholder' => 'Enter your password'
                );
			
		
		  /* Load Template */
              //  $this->template->auth_render('admin/auth/login', $this->data);
		
		
		$this->load->view('admin/login_view' , $this->data);
		 
	}
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */		


		function Logout(){
				if($this->session->has_userdata('is_admin')) {
					$this->session->unset_userdata('is_admin');
				}
			$this->session->sess_destroy();
		   redirect('admin');
		}

}
