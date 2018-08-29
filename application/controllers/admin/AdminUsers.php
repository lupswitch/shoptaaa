<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminUsers extends CI_Controller {
		
		public function __construct(){
			parent::__construct();
			
			$this->load->helper(array('form','url'));
			$this->load->library(array('session','form_validation','email','upload'));
			$this->load->database();
			$this->load->model('admin/AdminUserModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('home');
			}
		}	
		
		/*****************************************************************************
			*	Description : Index method is used to fetch all customer as well as staff members
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function index()
		{
			
			$pageHeader = 	array(  'pagetitle' => 'User Listing',
			'slug'		=>'user',
			'font_icon' =>'users',
			);			
			
			$PageData['all_Customers']	=	$this->AdminUserModel->getAllCustomers();
			$PageData['all_Staff']		=	$this->AdminUserModel->getAllStaff();
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_users_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}
		
		
		/*****************************************************************************
			*	Description : DeleteUser method is used to delete the requested user.
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function DeleteUser($uid)
		{
			
			if(empty($uid)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/user-listing');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Delete',
			'slug'		=>'user',
			'font_icon' =>'users',
			);		
			
			$returnReq	=	$this->AdminUserModel->DeleteUser($uid);
			
			if($returnReq == true){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> User Successfully Deleted </div>');
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete user </div>');
			}
			
			redirect('admin/user-listing');
			
		}
		
		/*****************************************************************************
			*	Description : '@UpdateCategory' is used Update Single Category. 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function UpdateUser($uId)
		{
			
			if(empty($uId)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/user-listing');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Update User',
			'slug'=>'user',
			'font_icon'=>'user',
			);			
			$PageData['currentUid'] = $uId; 
			
			if(isset($_POST['update_user']))
			{
				
				$this->form_validation->set_rules('firstName', 'User First Name', 'trim|required');
				$this->form_validation->set_rules('userName', 'User Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('userType', 'User Type', 'trim|required');
				$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'trim|required');
				
				if ($this->form_validation->run() == True)
				{

					$userUpdateArray = 	array ( 'firstName' 	=> $this->input->post('firstName'),
					'userName' => $this->input->post('userName'),
					'email' => $this->input->post('email'),	
					'userType' => $this->input->post('userType'),	
					'phoneNumber' => $this->input->post('phoneNumber'),	
					'is_active' => $this->input->post('is_active'),	
					//'cat_update_date'=> strtotime(date('Y-m-d H:i:s')),
					);
					
					/************
						* Description	: Update Password if set by admin 	
						* Developer	:	Manish Kumar Pathak	
						* DOC 			: 03rd-April-2017	
					***********/		
					
					if(!empty($this->input->post('password'))){
						
						$userUpdateArray['password']	= md5(md5($this->input->post('password')));
						
					}
					
					/**************End Here *************/
					
					/******************************
						*
						* 	Description : Upload Images Section
						*	DOC			: 30th-March-2017
						*	
					*****************************/	
					
					if( isset($_FILES["user_profileImage"]["name"]) && $_FILES["user_profileImage"]["name"] !="" ) 
					{		
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
						
						$userUpdateArray['profileImage'] = $ProfileImg_uploadPath;
						
					}
					/*  ---Image Section End Here---  */
					
					$returnReq	=	$this->AdminUserModel->UpdateUser($uId, $userUpdateArray);
					
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>User successfully updated.  </strong> </div>'. $errorImg );
						redirect('admin/user-listing');
						}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to update user!</div>'. $errorImg );
					}
				}		
			}
			
			$PageData['singleUser']	=	$this->AdminUserModel->GetSingleUser($uId);
			
			if(empty($PageData['singleUser'])){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> No Record Found! </div>');
			}
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_user_update_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		
		/*****************************************************************************
			*	Description : '@CreateNewUser' is used to create New User. 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function CreateNewUser(){
			
			$pageHeader = 	array(  'pagetitle' => 'Create New User',
			'slug'=>'user',
			'font_icon'=>'user',
			);	
			
			$PageData	=	array();
			
			if(isset($_POST['create_user'])){
				
				$this->form_validation->set_rules('firstName', 'User First Name', 'trim|required');
				$this->form_validation->set_rules('userName', 'User Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email Id already registered.', 'trim|required|is_unique[Registration.email]');
				$this->form_validation->set_rules('userType', 'User Type', 'trim|required');
				$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'numeric|trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				
				if ($this->form_validation->run() == True){
					
					
					$userCreateArray = 	array ( 'firstName' 	=> $this->input->post('firstName'),
					'userName' => $this->input->post('userName'),
					'email' => $this->input->post('email'),	
					'userType' => $this->input->post('userType'),	
					'phoneNumber' => $this->input->post('phoneNumber'),	
					'is_active' => $this->input->post('is_active'),	
					'password' =>  md5(md5($this->input->post('password'))),
					'oauth_provider' => 'globe',
					);
					
					
					/******************************
						*
						* 	Description : Upload Images Section
						*	DOC			: 30th-March-2017
						*	
					*****************************/	
					
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
						
						$userCreateArray['profileImage'] = $ProfileImg_uploadPath;
					}
					/*  ---Image Section End Here---  */
					
					/* pr($imgRetData); */
					
					/* if($imgRetData['success'] =="1"){
						$ProfileImg_uploadPath = 'uploads/users_Profile_images/'.$imgRetData['RtnFileNData']['file_name'];
						}else{
						$ProfileImg_uploadPath = "";
						$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
					}	 */
					
					
					$returnReq	=	$this->AdminUserModel->CreateUser($userCreateArray);
					
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>User successfully created.  </strong> </div>');
						redirect('admin/user-listing');
						}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to create new user!</div>');
					}
				}		
			}
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_user_create_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		
		
		
		/*****************************************************************************
			*	Description : Method is used upload image. 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 30th-March-2016	
		******************************************************************************/
		
		function Upload_images($img, $name, $ImagePath){
			
			$this->load->library('image_lib');
			//$config['upload_path'] = './assets/uploads/profile-img/'; 
			$config['upload_path']   = $ImagePath; 
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '10000';
			$config['max_width']  = '10000';
			$config['max_height']  = '10000';
			$config['file_name'] = $name;
			
			//$this->load->library('upload', $config);
			$this->upload->initialize($config);
			//	print_r($config);
			
			if ( ! $this->upload->do_upload($img)){ /* check is image upload or not */
				return $error = array('success' =>'0','error' => $this->upload->display_errors());
				}else{   
				$file = $this->upload->data();
				$files = glob($config['upload_path'].'/*'); // get all file names
				
				$config = 	array(
				'source_image'      => $file['full_path'], //path to the uploaded image
				/* 'new_image'         => './assets/uploads/profile-img/', //path to */
				'new_image'         => $ImagePath, //path to
				'maintain_ratio'    => True,
				'width'             => 480,
				'height'            => 294
				);
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$data = array('upload_data' => $this->upload->data());
				
				return array('success' =>'1','RtnFileNData' => $file);
			}
		}
		
		
		/*****************************************************************************
			*	Description : Method is used Generate Random string 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 30th-March-2017	
		******************************************************************************/
		
		
		public function rand_string( $length ){
			
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			
			$size = strlen( $chars );
			$str = '';
			for( $i = 0; $i < $length; $i++ ){
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
			
			return $str;
		}
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */		
		
		
		/*****************************************************************************
			*	Description :  method is used to fetch all Delivery boys list
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 31-May-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function FetchAllDeliveryBoys()
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Delivery Boys Listing',
			'slug'		=>'user',
			'font_icon' =>'users',
			);			
			
			
			$PageData['all_Staff']		=	$this->AdminUserModel->getAllDeliveryBoys();
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_deliveryboy_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}
		
		
		
		/*****************************************************************************
			*	Description : DeleteUser method is used to delete the requested user.
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function DeleteDeliveryBoys($uid)
		{
			
			if(empty($uid)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/deliveryboys-listing');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Delete',
			'slug'		=>'user',
			'font_icon' =>'users',
			);		
			
			$returnReq	=	$this->AdminUserModel->DeleteUser($uid);
			
			if($returnReq == true){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong>Delivery Boy  Successfully Deleted </div>');
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Delivery Boy</div>');
			}
			
			redirect('admin/deliveryboys-listing');
			
		}
		
		
		
		
		
		/*****************************************************************************
			*	Description :  method is used to fetch all Delivery boys list
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 5-June-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function FetchAllStaff()
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Staff Listing',
			'slug'		=>'staff',
			'font_icon' =>'users',
			);			
			
			
			$PageData['all_Staff']		=	$this->AdminUserModel->getAllStaff();
			
			
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_staff_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}
		
		
		
		/*****************************************************************************
			*	Description : DeleteUser method is used to delete the requested user.
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		public function DeleteStaff($uid)
		{
			
			if(empty($uid)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/staff-listing');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Delete',
			'slug'		=>'staff',
			'font_icon' =>'staff',
			);		
			
			$returnReq	=	$this->AdminUserModel->DeleteUser($uid);
			
			if($returnReq == true){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong>Delivery Boy  Successfully Deleted </div>');
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Staff</div>');
			}
			
			redirect('admin/staff-listing');
			
		}
		
		
		
		
		
		
		
	}		
