<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Revslider extends CI_Controller 
	{
		
		public function  __construct()
		{
			parent:: __construct();
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			$this->load->model('admin/RevsliderModel');
			if (!$this->session->has_userdata('is_admin'))
			{
				redirect('admin/dashboard');
			}	
			
		}	
		
		/****************************************************************************
			Description		:	Function use for View Revslide listing
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		
		public function index()
		{
			$pageHeader = 	array(  'pagetitle' => 'Revslide Listing',
			'slug'=>'setting',
			'font_icon'=>'list',
			);
			
			//Get All slide data
			$data['revslide'] = $this->RevsliderModel->GetAllRevSlide();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_revslider_view',$data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Add new Rev-slide 
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		
		public function AddSlide()
		{
			//Pass page info details
			$pageHeader = 	array(  'pagetitle' => 'Create New Slide',
			'slug'=>'Revslider',
			'font_icon'=>'plus',
			);
			
			//Post Slide Data
			if(isset($_POST['addNewSlide'])){
				
				//call rand string and upload()
				$ref = $this->rand_string(10).''.$this->rand_string(10);
				$img = $this->do_upload('images', 'rev-'.$ref);
				
				//Validation on Form
				$this->form_validation->set_rules('slideTitle', 'Add Slide Title', 'trim|required');
				$this->form_validation->set_rules('slideDescription', 'Add Slide Description', 'trim|required');
				$this->form_validation->set_rules('buttonText', 'Add Button Text', 'trim|required');
				$this->form_validation->set_rules('buttonUrl', 'Add Button Url', 'trim|required');
				
				if ($this->form_validation->run() == True){
					
					$data = 	array 	( 	
					'rid'				=>	$this->input->post('rid'),	
					'slideTitle'		=>	$this->input->post('slideTitle'),	
					'slideDescription'	=>	$this->input->post('slideDescription'),	
					'buttonText'		=>	$this->input->post('buttonText'),	
					'buttonUrl'			=>	$this->input->post('buttonUrl'),
					'slide_isActive'	=>	$this->input->post('slide_isActive'),
					'image'		=>	$img[0]	
					);
					
					$returnReq	=	$this->RevsliderModel->CreateNewSlide($data);
					
					if($returnReq == true)
					{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> New Slide successfully created. </div>');
						redirect('/admin/revslider');
					}else
					{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to create new slide!</div>');
					}
				}		
			}
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_create_slide');
			$this->load->view("admin/share-template/footer");
			
			
		}
		
		/****************************************************************************
			Description		:	Create random string of Image name 
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		
		public function rand_string( $length )
		{
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			
			$size = strlen( $chars );
			$str = '';
			for( $i = 0; $i < $length; $i++ )
			{
				$str .= $chars[ rand( 0, $size - 1 ) ];
			}
			
			return $str;
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for upload single image  
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		
		public function do_upload($img, $name)
		{
			$this->load->library('upload');
			$this->load->library('image_lib');
			
			$config['upload_path'] = './assets/revslideimage';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '4000';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['file_name'] = $name;
			
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload($img))
			{
				$error = array('error' => $this->upload->display_errors());
				//pr($error); 
				//DIE('BC');
				//return array('','');
			}
			else
			{   
				
				
				$file = $this->upload->data();
				$files = glob($config['upload_path'].'/*'); // get all file names
				
				$config = array(
				'source_image'      => $file['full_path'], //path to the uploaded image
				'new_image'         =>  './assets/revslideimage', //path to
				'maintain_ratio'    => false,
				'width'             => 1360,
				'height'            => 570
				);
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$data = array('upload_data' => $this->upload->data());
				
				return array($file['file_name'],'');
				
			}
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for update single slide  
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		
		public function UpdateRevSlide($slide)
		{
			$pageHeader = 	array(  'pagetitle' => 'Update Revslide',
			'slug'=>'setting',
			'font_icon'=>'pencil-square-o',
			);
			
			if(isset($_POST['updateSlide'])){
				
				//Validation on Form
				$this->form_validation->set_rules('slideTitle', 'Add Slide Title', 'trim|required');
				$this->form_validation->set_rules('slideDescription', 'Add Slide Description', 'trim|required');
				$this->form_validation->set_rules('buttonText', 'Add Button Text', 'trim|required');
				$this->form_validation->set_rules('buttonUrl', 'Add Button Url', 'trim|required');
				
				
				if ($this->form_validation->run() == True){
					
					
					$img = $this->do_uploads('images', $this->input->post('old-img'));
					
					$updatedata = 	array 	( 	
					'rid' 				=> 	$this->input->post('rid'),
					'slideTitle'		=>	$this->input->post('slideTitle'),	
					'slideDescription'	=>	$this->input->post('slideDescription'),	
					'buttonText'		=>	$this->input->post('buttonText'),	
					'buttonUrl'			=>	$this->input->post('buttonUrl'),
					'slide_isActive'	=>	$this->input->post('slide_isActive'),
					'image'		=>	$img[0]	
					);
					
					$returnReq	=	$this->RevsliderModel->UpdateRevSlide($updatedata);
					
					if($returnReq == true){
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Slide Successfully Updated. </div>');
						redirect('admin/revslider');
						
						}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to update Slide!</div>');
					}
					
				}		
			}
			
			$data['slidedata']	=	$this->RevsliderModel->GetslectedRevSlide($slide);
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_slide_update_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for Delete single slide  
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		
		public function DeleteRevSlide($Rid){
			
			if(empty($Rid)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/revslider');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Product Delete Request',
			'slug'=>'product',
			'font_icon'=>'cart-plus',
			);			
			
			
			$returnReq	=	$this->RevsliderModel->DeleteRevslide($Rid);
			
			if($returnReq == true){
				
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Slide Successfully Deleted </div>');
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Slide!</div>');
			}
			
			redirect('admin/revslider');
			
		}
		
		/****************************************************************************
			Description		:	Function use for Edit single slide  
			Developer		:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		public function do_uploads($img, $name)
		{
			$this->load->library('upload');
			$this->load->library('image_lib');
			
			$config['upload_path'] =  './assets/revslideimage';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '4000';
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['file_name'] = $name;
			
			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload($img))
			{
				$error = array('error' => $this->upload->display_errors());
				
				return array($name,'');
			}
			else
			{   
				$file = $this->upload->data();
				$files = glob($config['upload_path'].'/*'); // get all file names
				
				$config = array(
				'source_image'      => $file['full_path'], //path to the uploaded image
				'new_image'         =>  './assets/revslideimage', //path to
				'maintain_ratio'    => false,
				'width'             => 1360,
				'height'            => 570
				);
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$data = array('upload_data' => $this->upload->data());
				
				return array($file['file_name'],'');
				
			}
		}
		
	}					