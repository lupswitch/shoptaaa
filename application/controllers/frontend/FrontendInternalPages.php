<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class FrontendInternalPages extends MY_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('session','form_validation');
			$this->load->model('frontend/FrontendInternalPagesModel');
			
		}
		
	/****************************************************************************
	* Description	: 	Function is use for View Internal Pages
	* Developer	:	Manish Kumar Pathak
	* Date			:	06-April-2017
	****************************************************************************/
	
		public function index($slug)
		{
			
			//Get Innternal pages 
			$data['pagecontent'] = $this->FrontendInternalPagesModel->GetInternalPage($slug);
			
			if(empty($data['pagecontent'])){
				redirect('404');
			}
		
			
			
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/internal_pages_view', $data);
			$this->load->view('frontend/templates/footer'); 
		} 
			
		
	}
	
	