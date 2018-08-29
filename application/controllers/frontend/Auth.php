<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Auth extends MY_Controller {
		
		public function __construct(){
			parent::__construct();
			
			$this->load->helper(array('form','url'));
			$this->load->model('frontend/UsersModel');
			$this->load->model('frontend/CartModel');
			$this->load->library('session','form_validation','cart');
			
			
			
			
		}
		
		/****************************************************************************
			* Description	: 	Function is use for check frontend user is exist or not
			* Developer	:	Manish Kumar Pathak
			* Date			:	03-April-2017
		****************************************************************************/
		
		public function LoginConfirmation(){
			
			$user = $this->UsersModel->LoginConfirmation();
			if(!empty($user)){
				
				// Insert session_Cart Data into User DB_cart 
				$this->CartModel->InsertUserCart_inDB($user['user_id']);
				
				
				$this->session->set_userdata('is_customer', $user);
			

					echo "1";
			}else{
					echo "0";
			}
			
			
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for Logout frontend user
			* Developer	:	Manish Kumar Pathak
			* Date			:	03-April-2017
		****************************************************************************/
		
		public function Logout()
		{
			$this->cart->destroy();
			$this->session->unset_userdata('is_customer');
			
			redirect();
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for check frontend user is exist or not
			* Developer	:	Manish Kumar Pathak
			* Date			:	21-April-2017
		****************************************************************************/
		
		public function UserSignup(){
			
			if(isset($_POST['registersubmit'])){
				
				$data = array(
				'email' => $this->input->post('email'),
				'password' => md5(md5($this->input->post('password'))),
				'userType' => 'user',
				'userName' => $this->input->post('userName'),
				);
				
				$user = $this->UsersModel->signup($data);
				if (!empty($user))
				{

                   
					$this->session->set_userdata('is_customer', $user);
					
				// Insert session_Cart Data into User DB_cart 
				$this->CartModel->InsertUserCart_inDB($user['user_id']);
					echo "1";
				}
				else
				{
					echo "0";
				}
				
			}
			
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for check email exist or not
			* Developer	:	Manish Kumar Pathak
			* Date			:	03-April-2017
		****************************************************************************/
		
		public function chk_email_ext()
		{
			$this->form_validation->set_rules('email', 'email', 'is_unique[Registration.email]');
			if ($this->form_validation->run() == FALSE)
			{
				echo 'false';
			}
			else
			{
				echo 'true';
			}
		}
		
		
		
		/****************************************************************************
			* Description	: 	Function is use for send email of reset password
			* Developer	:	Manish Kumar Pathak
			* Date			:	24-April-2017
		****************************************************************************/
		
		public function ForgotPassword()
		{ 
			if(isset($_POST['forgotsubmit'])){
				
				$email = $this->input->post('email');
				$Emaildata['userdata'] = $this->UsersModel->ForgotPassword($email);
				
				if (!empty($Emaildata['userdata']))
				{
					$emailTemp = $this->load->view('frontend/templates/sub_template/emails_template/reset_password_template', $Emaildata, TRUE);
				
					$subject ="Shopta App | Reset Password";
					
					$rtnEmailVal = SendEmails($email , $subject , $emailTemp);
					
					if($rtnEmailVal == true)
					{
						echo ' <div id="request" class="alert alert-success text-center"><strong>Your request was successfully sending &nbsp;&nbsp;<i class="fa fa-check"></i></div>';
					}
					else
					{
						echo '<div id="request" class="alert alert-danger text-center">Your request was not sending !. please try again later</div>';
					}
					
				}
				else
				{
					echo '<div id="request" class="alert alert-danger text-center">Your Email was not registered !please enter a registered email</div>';
				}
				
			}
		}
		
		
		/****************************************************************************
			* Description	: 	Function is use for set new  password
			* Developer	:	Manish Kumar Pathak
			* Date			:	24-April-2017
		****************************************************************************/
		
		public function ResetPassword($pass_token)
		{
			
			// Get password Token for validate
			$validateRequest = $this->UsersModel->ValidatePasswordResetRequest($pass_token);
			//pr($validateRequest['user_id']);
			
			if(!empty($validateRequest))
			{
							
				if(isset($_POST['resetsubmit']))
				{

				$this->form_validation->set_rules('new_passwords', 'Password', 'required');
				$this->form_validation->set_rules('match_password', 'Confirm password' , 'required');
					
					if ($this->form_validation->run() == TRUE){
					
						$reset = $this->UsersModel->ResetPassword($validateRequest['user_id'],$pass_token);
						
						if($reset == TRUE)
						{
							echo "1";
						}
						else
						{
							echo "0";
						}
						die();
					}
					
					
				} 
				
				$data['is_validRequest'] = TRUE;
			}
			else
			{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"> Invalid Request ! </div>');
			
				$data['is_validRequest'] = FALSE;
			
			}
			
			
			$data['password_token'] = $pass_token;
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/resetpassword_view', $data);
			$this->load->view('frontend/templates/footer');
			
		}
		
	}				