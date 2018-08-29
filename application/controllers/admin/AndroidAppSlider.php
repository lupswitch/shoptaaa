<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AndroidAppSlider extends CI_Controller {
		
		public function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			$this->load->model('admin/AndroidAppSliderModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('admin/dashboard');
			}	
			
		}	
		
		
		
		
		/****************************************************************************
			Description		:	Function use for Display App Slide
			Developer	:	Manish Kumar Pathak
			Doc				:	27/April/2017
		****************************************************************************/
		
		public function index()
		{
			$pageHeader = 	array(  'pagetitle' => 'App Slide',
			'slug'=>'setting',
			'font_icon'=>'android',
			);
			
			$data['appslidedata']	=	$this->AndroidAppSliderModel->GetAllAppSlide();

			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_android_app_slide_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for update single App slide  
			Developer	:	Manish Kumar Pathak
			Doc				:	28/April/2017
		****************************************************************************/
		
		public function UpdateAppSlide($slide)
		{
			$pageHeader = 	array(  'pagetitle' => 'Update App-Slide',
			'slug'=>'setting',
			'font_icon'=>'android',
			);
			
			if(isset($_POST['updateSlide']))
			{
			
				if( isset($_FILES["welcomeImage"]["name"]) && $_FILES["welcomeImage"]["name"] !="" ) {
					
					$ImageNewName = 'App-slide'.rand_string(5); /* generate the random name */
					$uploadPath = "./uploads";
					$thumbPath = "./uploads/App-thumb-images";
					
					$imgRetData = Upload_Single_Images('welcomeImage', $ImageNewName , $uploadPath, $thumbPath );

					if($imgRetData['success'] =="1")
					{
						$ProImg_uploadPath = 'uploads/'.$imgRetData['RtnFileNData']['file_name'];
						
						$pro_Mainimg = array(
							'id' => 	$this->input->post('id'),
							'welcomeImage' => $ProImg_uploadPath,
						);
						/*  ---Image Section End Here---  */	
						$returnReq	=	$this->AndroidAppSliderModel->UpdateAppSlide($pro_Mainimg);
					}
					
					else
					{
						
						$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
					} 
					
					if($returnReq == true){
					
					$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Successfully Updated. </div>');
					$url = base_url('admin/app-slider');
					header("Refresh:4; url= ".$url."");
					
					}else{
					$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> '.$errorImg.'</div>');
					}
					
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">You have to select a image</div>');
				}
				 
				
				
				
			}		
			
			
			$data['slidedata']	=	$this->AndroidAppSliderModel->GetslectedAppSlide($slide);
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_android_app_slide_update_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for Edit single slide  
			Developer	:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		public function do_uploads($img, $name)
		{
			$this->load->library('upload');
			$this->load->library('image_lib');
			
			$config['upload_path'] =  './uploads';
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
				'new_image'         =>  './uploads', //path to
				'maintain_ratio'    => false,
				);
				
				
				$config = array(
				'source_image'      => $file['full_path'],
				'new_image'         => './uploads/thumb_images',
				'maintain_ratio'    => true,
				'width'             => 316,
				'height'            => 236
				);
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$data = array('upload_data' => $this->upload->data());
				return array($file['file_name'],'');
				
			}
		}
		
	}							
