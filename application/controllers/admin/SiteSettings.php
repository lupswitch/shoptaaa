<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SiteSettings extends CI_Controller {
		
		public function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			$this->load->model('admin/SiteSettingsModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('admin/dashboard');
			}	
			
		}	
		
		/****************************************************************************
			Description	:	Function use for Manage Social setting
			Developer	:	Puneet Singh
			Doc			:	07/April/2017
		****************************************************************************/
		
		public function UpdateSocialLinkSetting()
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Soical Connect',
			'slug'=>'setting',
			'font_icon'=>'facebook',
			);
			
			if(isset($_POST['updateSocialLinks'])){
				
				unset($_POST['updateSocialLinks']);
				
				foreach($_POST as $key=>$postdata){
					$this->SiteSettingsModel->UpdateSocialLinks($key, $postdata); 
				}
				
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Successfully updated </strong></div>');
				redirect('/admin/social-connect');
			}
			
			//Get All social links
			$data['socialData'] = $this->SiteSettingsModel->GetSocialLinks();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_social_widget_view',$data);
			$this->load->view('admin/share-template/footer');
		}
		
		
		
		/****************************************************************************
			Description	:	Function use for Manage Site setting
			Developer	:	Puneet Singh
			Doc			:	10/April/2017
		****************************************************************************/
		
		public function Siteoption()
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Site Option',
			'slug'=>'setting',
			'font_icon'=>'cog',
			);
			
			
			if(isset($_POST['UpdatesiteOption'])){
				
				if(!isset($_POST['is_active_siteTaglineKey'])){ 
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteTaglineKey', '0'); 
				}
				
				if(!isset($_POST['is_active_sitePhoneKey'])){
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_sitePhoneKey', '0');
				}
				
				if(!isset($_POST['is_active_siteMobileKey'])){
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteMobileKey', '0');
				}
				
				if(!isset($_POST['is_active_siteAndroidKey'])){
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteAndroidKey', '0');
				}
				
				if(!isset($_POST['is_active_siteWishlistKey'])){ 
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteWishlistKey', '0');
				}
				
				if(!isset($_POST['is_active_siteCartKey'])){
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteCartKey', '0');
				}
				
				if(!isset($_POST['is_active_siteSigninKey'])){ 
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteSigninKey', '0');
				}
				
				if(!isset($_POST['is_active_siteCopyrightKey'])){
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteCopyrightKey', '0');
				}
				
				if(!isset($_POST['is_active_siteSidebarKey'])){ 
					$this->SiteSettingsModel->UpdateSiteoptionData('is_active_siteSidebarKey', '0');
				}
				
				
				if(isset($_FILES) && !empty($_FILES)) { 
					
					$ImageNewName = 'Logo-'.date('Y-m-d_H:i:s').'-'.rand_string(5); /* generate the random name */
					$uploadPath = "./uploads/main/";
					
					$imgRetData = Upload_Single_Images('siteLogoKey', $ImageNewName , $uploadPath ); /* upload image */
					//	pr($imgRetData['RtnFileNData']); 
					//$img = $this->do_uploads('siteLogoKey', $this->input->post('siteLogoKey'));
					
					if($imgRetData['success'] =="1"){
						
						$this->SiteSettingsModel->UpdateSiteoptionData('siteLogoKey',$imgRetData['RtnFileNData']['file_name']);	
						
						}else{
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'!</div>');
						
					}
					
				} 
				
				unset($_POST['UpdatesiteOption']);
				
				foreach($_POST as $key=>$postdata){
					$this->SiteSettingsModel->UpdateSiteoptionData($key, $postdata); 
				}
				
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Successfully updated </strong></div>');
				redirect('/admin/site-option');
				
			}
			
			$data['siteData'] = $this->SiteSettingsModel->GetSiteoptionData();
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_site_option_view', $data);
			$this->load->view('admin/share-template/footer');
		}
		
		
		/****************************************************************************
			Description		:	Function use for Edit Header Logo  
			Developer		:	Puneet Singh
			Doc				:	10/April/2017
		****************************************************************************/
		
		public function Gridoption(){
			
			$pageHeader = 	array(  'pagetitle' => 'Grid Option',
			'slug'		=>'setting',
			'font_icon'	=>'table',
			);
			
			
			if(isset($_POST['UpdateGridoption'])){
				
				unset($_POST['UpdateGridoption']);
				
				foreach($_POST as $key=>$postdata){
					$this->SiteSettingsModel->UpdateSiteoptionData($key, $postdata); 
				}
				
				
				if( isset($_FILES["siteGridImageOne"]["name"]) && $_FILES["siteGridImageOne"]["name"] !="" ) {
					
					$ImageNewName = 'siteGridImageOne-'.date('Y-m-d_H:i:s').'-'.rand_string(5); /* generate the random name */
					$uploadPath = "./uploads/main/";
					
					$imgRetData = Upload_Single_Images('siteGridImageOne', $ImageNewName , $uploadPath ); /* upload image */
					
					
					if($imgRetData['success'] =="1"){
						$GridImg = $imgRetData['RtnFileNData']['file_name'];
						
						$this->SiteSettingsModel->UpdateSiteoptionData('siteGridImageOne',$GridImg);
						
						}else{
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong> One Image Error ! </strong>  '.$imgRetData['error'].'!</div>');
						
					}
				}
				
				if( isset($_FILES["siteGridImageTwo"]["name"]) && $_FILES["siteGridImageTwo"]["name"] !="" ) {
					
					$ImageNewName = 'siteGridImageTwo-'.date('Y-m-d_H:i:s').'-'.rand_string(5); /* generate the random name */
					$uploadPath = "./uploads/main/";
					
					$imgRetData = Upload_Single_Images('siteGridImageTwo', $ImageNewName , $uploadPath ); /* upload image */
					
					if($imgRetData['success'] =="1"){
						$GridImg = $imgRetData['RtnFileNData']['file_name'];
						
						$this->SiteSettingsModel->UpdateSiteoptionData('siteGridImageTwo',$GridImg);
						
						}else{
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong> Two Image Error ! </strong>  '.$imgRetData['error'].'!</div>');
						
					}
					
				}
				
				if( isset($_FILES["siteGridImageThree"]["name"]) && $_FILES["siteGridImageThree"]["name"] !="" ) {
					
					
					$ImageNewName = 'siteGridImageThree-'.date('Y-m-d_H:i:s').'-'.rand_string(5); /* generate the random name */
					$uploadPath = "./uploads/main/";
					
					$imgRetData = Upload_Single_Images('siteGridImageThree', $ImageNewName , $uploadPath ); /* upload image */
					
					if($imgRetData['success'] =="1"){
						$GridImg = $imgRetData['RtnFileNData']['file_name'];
						
						$this->SiteSettingsModel->UpdateSiteoptionData('siteGridImageThree',$GridImg);
						
						}else{
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong> Third Image Error ! </strong>  '.$imgRetData['error'].'!</div>');
						
					}
				}
				
				
				if( isset($_FILES["siteGridImageFour"]["name"]) && $_FILES["siteGridImageFour"]["name"] !="" ) {
					
					
					$ImageNewName = 'siteGridImageFour-'.date('Y-m-d_H:i:s').'-'.rand_string(5); /* generate the random name */
					$uploadPath = "./uploads/main/";
					
					$imgRetData = Upload_Single_Images('siteGridImageFour', $ImageNewName , $uploadPath ); /* upload image */
					
					if($imgRetData['success'] =="1"){
						$GridImg = $imgRetData['RtnFileNData']['file_name'];
						
						$this->SiteSettingsModel->UpdateSiteoptionData('siteGridImageFour',$GridImg);
						
						}else{
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong> Forth Image Error ! </strong>  '.$imgRetData['error'].'!</div>');
						
					}
					
				} 
				
			}
			
			$pageData['SiteGridOption']	= $this->SiteSettingsModel->GetOptionData('SiteGridOption');
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_grid_option_view',$pageData);
			$this->load->view('admin/share-template/footer');	
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Edit Header Logo  
			Developer		:	Puneet Singh
			Doc				:	10/April/2017
		****************************************************************************/
		
		public function do_uploads($img, $name){
			$this->load->library('upload');
			$this->load->library('image_lib');
			
			$config['upload_path'] =  './assets/frontend/images';
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
				'new_image'         =>  './assets/frontend/images', //path to
				'maintain_ratio'    => false
				);
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$data = array('upload_data' => $this->upload->data());
				
				return array($file['file_name'],'');
				
			}
		}
		
		
		/****************************************************************************
			Description		:	Function use for Manage Contact info on conatct us page
			Developer		:	Puneet Singh
			Doc				:	10/April/2017
		****************************************************************************/
		public function ContactInfoOption()
		{
			
			$pageHeader = 	array(
									'pagetitle' => 'Contact Info',
									'slug'=>'setting',
									'font_icon'=>'info',
								);
			if(isset($_POST['UpdateContactInfo'])){
				
				unset($_POST['UpdateContactInfo']);
				
				foreach($_POST as $key=>$postdata){
					$this->SiteSettingsModel->UpdateContactUsInfo($key, $postdata); 
				}
				
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Successfully updated </strong></div>');
				redirect('/admin/contact-info');
			}
			
			$Pagedata['contactusinfo'] = $this->SiteSettingsModel->GetContactInfoData();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_contact_info_view', $Pagedata);
			$this->load->view('admin/share-template/footer');
			
		}
		
      public function OutofStockProducts()


      {

        $pageHeader =  array(
        	           'pagetitle' =>'Out of Stock Products',
                        'slug' =>'setting',
                        'font_icon' => 'info',

                          );

                  if(isset($_POST['UpdateOutofstockOption']))

                  {


                        if(!isset($_POST['is_display_outofstock_products'])){ 
					$this->SiteSettingsModel->UpdateOutofStockProduct('is_display_outofstock_products', '0'); 
				}

                       unset($_POST['UpdateOutofstockOption']);


                    foreach($_POST as $key=>$postdata){
					$this->SiteSettingsModel->UpdateOutofStockProduct($key, $postdata); 




				}

             $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Successfully updated </strong></div>');
				redirect('/admin/outofstock-option');
				

                }


        	$data['OutofStockData'] = $this->SiteSettingsModel->GetOUtofStockData();
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_outofstock_view', $data);
			$this->load->view('admin/share-template/footer');



      }
       








	}							