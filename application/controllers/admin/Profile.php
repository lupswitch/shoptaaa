<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Profile extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper(array('form','url'));
			$this->load->library(array('session','form_validation','email','upload'));
			$this->load->model('admin/AdminUserModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('home');
			}
			
		}
		
		
		/*****************************************************************************
			*	Description : Function use for manage admin profile
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 18-April-2017
		******************************************************************************/	
		
		public function index($uId)
		{
			$pageHeader = 	array(  'pagetitle' => 'Profile',
									'slug'=>'profile',
									'font_icon'=>'user',
								);
			
			$PageData['currentUid'] = $uId;  
			
			if(isset($_POST['updateadmin'])){
				
				$this->form_validation->set_rules('firstName', 'User First Name', 'trim|required');
				$this->form_validation->set_rules('userName', 'User Name', 'trim|required');
				$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'trim|required');
				
				if ($this->form_validation->run() == True){
					
					$AdminArray = array (	
											'firstName'		=> $this->input->post('firstName'),
											'lastName'		=> $this->input->post('lastName'),
											'userName' 		=> $this->input->post('userName'),
											'dob'			=> $this->input->post('dob'),	
											'userGender'	=> $this->input->post('userGender'),	
											'userBio'		=> $this->input->post('userBio'),	
											'userLocation'	=> $this->input->post('userLocation'),	
										);
					

					if(!empty($_POST['password']) ){
						$AdminArray['password'] = md5(md5($this->input->post('password')));
					}
					 
					
					/************** Images section start here ***************/	
					
					if( isset($_FILES["user_profileImage"]["name"]) && $_FILES["user_profileImage"]["name"] !="" ) {		
						$ImageNewName  =  'profile-'.date('Y-m-d_H:i:s').'-'.rand_string(10);  /* generate the random name */
						$uploadPath = "./uploads/users_Profile_images/";
						
						$imgRetData = Upload_Single_Images('user_profileImage', $ImageNewName , $uploadPath ); /* upload image */
						
						if($imgRetData['success'] =="1"){
							$url = base_url();
							$ProfileImg_uploadPath = $url.'uploads/users_Profile_images/'.$imgRetData['RtnFileNData']['file_name'];
							}else{
							$ProfileImg_uploadPath = "";
							$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
						}	
						
						$AdminArray['profileImage'] = $ProfileImg_uploadPath;
						
					}
					/*  ---Image Section End Here---  */
					
					$returnReq	=	$this->AdminUserModel->UpdateUser($uId, $AdminArray);
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Successfully updated. </div>');
						}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able profile update!</div>');
					}
				}
				
			}
			
			$Pagedata['profile'] = $this->AdminUserModel->getAdminProfile($uId);
			
			$this->load->view("admin/share-template/header", $pageHeader);
			$this->load->view('admin/admin_profile_view', $Pagedata);
			$this->load->view("admin/share-template/footer");
			
		}
		
	}
