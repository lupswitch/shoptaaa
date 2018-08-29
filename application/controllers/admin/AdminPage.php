<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminPage extends CI_Controller {
		
		public function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			$this->load->model('admin/AdminPageModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('admin/dashboard');
			}	
			
		}	
		
		/****************************************************************************
			Description		:	Function use for View Page listing
			Developer	:	Manish Kumar Pathak
			Doc			:	06/April/2017
		****************************************************************************/
		
		public function index()
		{
			$pageHeader = 	array(  'pagetitle' => 'Page Listing',
			'slug'=>'pages',
			'font_icon'=>'book',
			);
			
			//Get All pages data
			$data['pagesdata'] = $this->AdminPageModel->GetAllPages();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_pages_listing_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for Add New Page
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		
		public function AddNewpage()
		{
			$pageHeader = 	array(  'pagetitle' => 'Create New Slide',
			'slug'=>'pages',
			'font_icon'=>'plus',
			);
			
			//Post Page Data
			if(isset($_POST['addNewPage'])){
				
				
				//Validation on Form
				$this->form_validation->set_rules('pageTitle', 'Add Page Title', 'trim|required');
				$this->form_validation->set_rules('pageSlug', 'Add Page Slug', 'trim|required|is_unique[InternalPages.pageSlug]');	
				$this->form_validation->set_rules('is_page_active', 'Select Page Status', 'trim|required');
				$this->form_validation->set_rules('pageContent', 'Add Page Content', 'trim|required');
				
				if ($this->form_validation->run() == True){
					
					$data = 	array 	( 	
					'pid'				=>	$this->input->post('pid'),	
					'pageTitle'		=>	$this->input->post('pageTitle'),	
					'pageSlug'	=>	$this->input->post('pageSlug'),	
					'is_page_active'		=>	$this->input->post('is_page_active'),	
					'pageContent'			=>	$this->input->post('pageContent'),
					'page_meta_title'		=> $this->input->post('page_meta_title'),
					'page_meta_keyword'		=> $this->input->post('page_meta_keyword'),
					'page_meta_description'	=> $this->input->post('page_meta_description'),
					);
					
					$returnReq	=	$this->AdminPageModel->CreateNewPage($data);
					
					if($returnReq == true)
					{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> New Page successfully created. </div>');
						redirect('/admin/pages');
					}else
					{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to create new Page!</div>');
					}
				}		
			}
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_create_new_page');
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Update Selected Page
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function UpdatePage($page)
		{
			$pageHeader = 	array(  'pagetitle' => 'Update Page',
			'slug'=>'pages',
			'font_icon'=>'pencil-square-o',
			);
			
			if(isset($_POST['updateNewPage'])){
				//Validation on Form
				$this->form_validation->set_rules('pageTitle', 'Add Page Title', 'trim|required');
				//$this->form_validation->set_rules('pageSlug', 'Add Page Slug', 'trim|required');	
				$this->form_validation->set_rules('is_page_active', 'Select Page Status', 'trim|required');
				$this->form_validation->set_rules('pageContent', 'Add Page Content', 'trim|required');
				
				if ($this->form_validation->run() == True){
					
					$updatedata = 	array 	( 	
					'pid'			=>	$this->input->post('pid'),	
					'pageTitle'		=>	$this->input->post('pageTitle'),	
					//'pageSlug'	=>	$this->input->post('pageSlug'),	
					'is_page_active'		=>	$this->input->post('is_page_active'),	
					'pageContent'			=>	$this->input->post('pageContent'),
					'page_meta_title'		=> $this->input->post('page_meta_title'),
					'page_meta_keyword'		=> $this->input->post('page_meta_keyword'),
					'page_meta_description'	=> $this->input->post('page_meta_description'),
					);
					
					$returnReq	=	$this->AdminPageModel->UpdatePage($updatedata);
					
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Page Successfully Updated. </div>');
						redirect('admin/pages');
					}
					else
					{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to update Page!</div>');
					}
					
				}		
			}
			
			$data['pagedata']	=	$this->AdminPageModel->GetslectedPage($page); 
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_page_update_view', $data);
			$this->load->view('admin/share-template/footer');
		}
		
		
		/****************************************************************************
			Description		:	Function use for delete Selected Page
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function DeletePage($pid){
			
			if(empty($pid)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/pages');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Page Delete Request',
			'slug'=>'pages',
			'font_icon'=>'book',
			);			
			
			
			$returnReq	=	$this->AdminPageModel->DeletePage($pid);
			
			if($returnReq == true){
				
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Page Successfully Deleted </div>');
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Page!</div>');
			}
			
			redirect('admin/pages');
			
		}
	}				