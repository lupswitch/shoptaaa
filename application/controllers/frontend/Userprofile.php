<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Userprofile extends MY_Controller {
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper(array('form','url'));
			$this->load->library(array('session','form_validation','email','upload'));
			$this->load->model('frontend/UsersModel');
			$this->load->model('admin/AdminUserModel');
			$this->load->model('frontend/CheckoutModel');
		
			if (!$this->session->has_userdata('is_customer')) {
				redirect('home');
			}
			else {
        			$GLOBALS['currentUserId'] = $this->session->userdata['is_customer']['user_id'];
}
		}
		
		
		/*****************************************************************************
			*	Description : Function use for display user profile
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 18-April-2017
		******************************************************************************/	
		
		public function index()
		{
			
			$uid = $this->session->userdata['is_customer']['user_id'];
			
			// Get user profile data 
			$Pagedata['profile'] = $this->UsersModel->fetchCurrentUserProfile($uid);
			
			// Get user address
			$Pagedata['myAddress'] = $this->CheckoutModel->GetMyAddress($uid);
			
			$this->load->view("frontend/templates/header" );
			$this->load->view('frontend/profile_view', $Pagedata);
			$this->load->view("frontend/templates/footer");
			
		}
		
		/*****************************************************************************
			*	Description : Function use for manage user profile
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 18-April-2017
		******************************************************************************/	
		
		public function UpdateUserProfile()
		{
			
			$uid = $this->session->userdata['is_customer']['user_id'];
	 
			if(isset($_POST['updateprofile'])){
				
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
				$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'trim|required|numeric');
				$this->form_validation->set_rules('userLocation', 'Location', 'trim|required');
				
				if ($this->form_validation->run() == True){
					
					$Data = array ( 
					                 
											'email'			=> $_POST['email'],
											'firstName'		=> $_POST['firstName'],
											'lastName'		=> $_POST['lastName'],
											'dob'			=> $_POST['dob'],	
											'userGender'	=> $_POST['userGender'],	
											'userBio'		=> $_POST['userBio'],	
											'userLocation'	=> $_POST['userLocation'],	
											'phoneNumber'	=> $_POST['phoneNumber'],	
											
										);
					

					if(!empty($_POST['password']))
					{
						$Data['password'] = md5(md5($_POST['password']));
					} 
					
					
					
					$returnReq	=	$this->AdminUserModel->UpdateUser($uid, $Data);
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-success text-center">Successfully updated &nbsp;&nbsp;<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></div>');
						}else{
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-danger text-center"><strong>Error ! </strong> Not able profile update!</div>');
					}
				}
				
				
			}  
			
			$Pagedata['profile'] = $this->UsersModel->fetchCurrentUserProfile($uid);
	
			$this->load->view("frontend/templates/header");
			$this->load->view('frontend/edit_user_profile', $Pagedata);
			$this->load->view("frontend/templates/footer");
			
		}
		
		
		
		/*****************************************************************************
			*	Description : Function use for manage user Address
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 05-April-2017
		******************************************************************************/	
		
		public function UpdateUserAddress()
		{
			
			$uid = $this->session->userdata['is_customer']['user_id'];
	 
			if(isset($_POST['updatemyaddress'])){
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('state', 'State', 'trim|required');
				$this->form_validation->set_rules('country', 'Country', 'trim|required');
				$this->form_validation->set_rules('zip', 'Zip', 'trim|required');
				$this->form_validation->set_rules('phonenumber', 'Phone Number', 'trim|required|numeric');
				
				if ($this->form_validation->run() == True){
					
					$Datas = array 
								( 
									'addr_uid'			=> $GLOBALS['currentUserId'],
									'address'		=> $_POST['address'],
									'City'			=> $_POST['city'],
									'State'			=> $_POST['state'],
									'Country'		=> $_POST['country'],	
									'Zip'			=> $_POST['zip'],	
									'PhoneNumber'	=> $_POST['phonenumber'],	
											
								);
								
					$returnReq	=	$this->UsersModel->UpdateBillingAddress($Datas);
					
					
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-success text-center">Successfully updated &nbsp;&nbsp;<i class="fa fa-tick"></i></div>');
						}else{
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-danger text-center"><strong>Error ! </strong> Not able profile update!</div>');
					}
				}else{echo"bvn";}
				
				
			}  
			$Pagedata['country'] = $this->UsersModel->GetAllCountry();
			// Get user address
			$Pagedata['myAddress'] = $this->CheckoutModel->GetMyAddress($GLOBALS['currentUserId']);
	      
			$this->load->view("frontend/templates/header");
			$this->load->view('frontend/edit_user_address', $Pagedata);
			$this->load->view("frontend/templates/footer");
			
		}
	}
