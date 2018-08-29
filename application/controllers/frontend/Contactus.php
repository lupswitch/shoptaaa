<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Contactus extends MY_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->helper(array('form','url',));
			$this->load->library('session','form_validation');
			$this->load->model('admin/SiteSettingsModel');
			$this->load->model('frontend/UserfeedModel');
			
		}
		
		/****************************************************************************
			* Description	: 	Function is use for View Internal Pages
			* Developer	:	Manish Kumar Pathak
			* Date			:	15-April-2017
		****************************************************************************/
		
		public function index()
		{
			
			if(isset($_POST['adduserfeed'])){
				
				$this->form_validation->set_rules('feed_name', 'Name', 'required');
				$this->form_validation->set_rules('feed_email', 'Email', 'required');
				$this->form_validation->set_rules('feed_msg', 'Message', 'required');
				
				if ($this->form_validation->run() == True){
					
					$FeedArray = 	array 	(
					'feed_name' 				=> 	$this->input->post('feed_name'),
					'feed_email' 				=>	$this->input->post('feed_email'),	
					'feed_msg' 					=>	$this->input->post('feed_msg'),	
					'feed_date'					=>  date("Y-m-d H:i:s"),
					);
					
					$this->UserfeedModel->AddUserFeedData($FeedArray);
					
					$bodyMsg = 'Your Request was successful accepted, thank you for Feedback. <br/>';
					$bodyMsg .= 'Regards <br/>';
					$bodyMsg .= 'Shopta App';
					
					$subject ="Shopta App Feed";
					
					$rtnEmailVal = SendEmails($this->input->post('feed_email') ,$subject ,$bodyMsg);
					
					if($rtnEmailVal == true)
					{
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-success text-center">Your request was successfully sending &nbsp;&nbsp;<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></div>');
					}
					else
					{
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-danger text-center">Your request was not sending !. please try again later</div>');
					}
				
				}
			}
			
			$Pagedata['contactusinfo'] = $this->SiteSettingsModel->GetContactInfoData();
			
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/contactus_view', $Pagedata);
			$this->load->view('frontend/templates/footer'); 
		} 
		
		
		
	}
	
