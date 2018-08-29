<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
Class AdminBrand extends CI_Controller{
	
	function  __construct(){
		
		parent:: __construct();
		
		$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation','email','upload','pagination'));
		$this->load->database();
		$this->load->model('admin/AdminBrandModel');
		
		if (!$this->session->has_userdata('is_admin')) {
			redirect('home');
        }	
		
	}
	
		public function index($offset ="1"){
			
			$pageHeader = 	array(  'pagetitle' => 'Brand Listing',
									'slug'=>'brands',
									'font_icon'=>'tags',
							);	
			
			
			
			
			/**********************
			 * Description	: pagination Section Start here 	
			 * Developer		:	Manish Kumar Pathak
			 * DOC			: 05/April/2017
			 *********************/
			
			/*	$config = array();
				$config["base_url"] = base_url() . "admin/brand-listing/";
				$config["total_rows"] = $this->AdminBrandModel->Count_ParentBrand();
				$config['per_page'] = 5; 
				
				$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] =$config['num_tag_open'] = '<li>';
				
				$config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        
				$config['cur_tag_open'] = "<li><span><b>";
				$config['cur_tag_close'] = "</b></span></li>";
				
				
				$this->pagination->initialize($config); 
			
				$PageData['all_Brands'] = $this->AdminCategoryModel->GetAllParentBrands($config["per_page"], $offset);
			
				$PageData["links"] = $this->pagination->create_links();
				$PageData['counter'] =  $offset;
			/************************ END HERE **********************/
			$PageData['all_Brands'] = $this->AdminBrandModel->GetAllParentBrands();
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_brand_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}

/*****************************************************************************
*	Description : '@GetSubBrandListing' is used get list of all sub cat
*	Developer		:	Manish Kumar Pathak
*	DOC			: 05-April-2017
*	DOM			: --------		
******************************************************************************/	
	

	
		public function GetSubBrandListing($brandId =""){
			
			$pageHeader = 	array(  'pagetitle' => 'Sub Brand Listing',
									'slug'=>'brands',
									'font_icon'=>'tags',
							);		
			
			
			
			$PageData['all_Brands']	=	$this->AdminBrandModel->FetchAll_SubBrands($brandId);
		
		//	print_R($PageData);
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_brand_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}



/*****************************************************************************
*	Description : '@CreateNewCategory' is used to create new Category. 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 29-March-2017
*	DOM			: --------		
******************************************************************************/	
	
	public function CreateNewBrand(){
		
		$pageHeader = 	array(  'pagetitle' => 'Create New Brand',
								'slug'=>'brands',
								'font_icon'=>'tags',
							);			
		$PageData =array();
		if(isset($_POST['addNew_brand'])){
			
			$this->form_validation->set_rules('BrandName', 'Brand Name', 'trim|required');
			$this->form_validation->set_rules('is_brand_active', 'Brand Status ', 'trim|required');
			$this->form_validation->set_rules('BrandDescription', 'Brand Description', 'trim|required');
			
			if ($this->form_validation->run() == True){
				
				
				
					$BrandNewArray = 	array ( 'BrandName' => $this->input->post('BrandName'),
												'BrandDescription' => $this->input->post('BrandDescription'),
												'is_brand_active' => $this->input->post('is_brand_active'),
												'Brand_create_date'=> strtotime(date('Y-m-d H:i:s')),
										);
				
					if(!empty($this->input->post('parentBrand'))){
							$BrandNewArray['parentBrand']	= $this->input->post('parentBrand');
					}
				
				
				
				/* 	---Upload Images Section---  */		
					if( isset($_FILES["BrandMainImage"]["name"]) && $_FILES["BrandMainImage"]["name"] !="" ) {
						
						$ImageNewName = 'Brand_'.$this->input->post('BrandName').'_'.date('Y-m-d_H:i:s').'_'.rand_string(5).rand_string(5); /* generate the random name */
						$uploadPath = "./uploads/categories_images/";
						
							$imgRetData = Upload_Single_Images('BrandMainImage', $ImageNewName , $uploadPath ); /* upload image */
						/* pr($imgRetData); */
							
							if($imgRetData['success'] =="1"){
								$BrandImg_uploadPath 	= 'uploads/categories_images/'.$imgRetData['RtnFileNData']['file_name'];
								$BrandImgName			= $imgRetData['RtnFileNData']['file_name'];
							}else{
								$BrandImg_uploadPath = "";
								$BrandImgName = "";
								$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
							}

						$BrandNewArray['BrandImage']	= $BrandImgName;	
						$BrandNewArray['BrandImgPath']	= $BrandImg_uploadPath;	
							
					}		
			/*  ---Image Section End Here---  */
				
				
				
				
				
				$returnReq	=	$this->AdminBrandModel->CreateNewBrand($BrandNewArray);
			
					if($returnReq == true){
					
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> New Brand successfully created. </div>');
						redirect('admin/create-brand');
					
					}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to create new Brand!</div>');
					}
			}		
		}
		
			$PageData['all_ParentBrand']	=	$this->AdminBrandModel->GetAllParentBrands();
		
		
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_brand_create_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */



		
	
	
/*****************************************************************************
*	Description : Method is used Delete a Single Product 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 05-April-2017
*	DOM			: --------		
******************************************************************************/	
	
	public function DeleteBrand($BrandId){
		
		if(empty($BrandId)){
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
			
			redirect('admin/brand-listing');
		}
		
		$pageHeader = 	array(  'pagetitle' => 'Brand Delete Request',
								'slug'=>'brands',
								'font_icon'=>'tags',
							);			

		
		$returnReq	=	$this->AdminBrandModel->DeleteBrand($BrandId);
		
		if($returnReq == true){
		
			$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Brand Successfully Deleted </div>');
		}else{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Brand!</div>');
		}
		
		redirect('admin/brand-listing');
			
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */


/*****************************************************************************
*	Description : '@UpdateBrand' is used Update Single Category. 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 29-March-2017
*	DOM			: --------		
******************************************************************************/	
	
	public function UpdateBrand($BrandId){
		
		if(empty($BrandId)){
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
			
			redirect('admin/product-listing');
		}
		
		$pageHeader = 	array(  'pagetitle' => 'Update Brand',
								'slug'=>'brands',
								'font_icon'=>'tags',
							);			
		$PageData['currentBrandId'] = $BrandId; 
		
		if(isset($_POST['update_brand'])){
			
			$this->form_validation->set_rules('BrandName', 'Brand Name', 'trim|required');
			$this->form_validation->set_rules('is_brand_active', 'Brand Status', 'trim|required');
			$this->form_validation->set_rules('BrandDescription', 'Brand Description', 'trim|required');
			
			if ($this->form_validation->run() == True){
				
				
				
				$BrandNewArray = 	array ( 'BrandName' 	=> $this->input->post('BrandName'),
											'BrandDescription'=> $this->input->post('BrandDescription'),
											'is_brand_active' => $this->input->post('is_brand_active'),
											'Brand_update_date'=> strtotime(date('Y-m-d H:i:s')),
								);
				
				if(!empty($this->input->post('parentBrand'))){
					$BrandNewArray['parentBrand']	=	$this->input->post('parentBrand');
				}
				
					
			/* 	---Upload Images Section--- */		
					if( isset($_FILES["BrandMainImage"]["name"]) && $_FILES["BrandMainImage"]["name"] !="" ) {
						
						$ImageNewName = 'Brand_'.$this->input->post('BrandName').'_'.date('Y-m-d_H:i:s').'_'.rand_string(5).rand_string(5); /* generate the random name */
						
						$uploadPath = "./uploads/categories_images/";
						
							$imgRetData = Upload_Single_Images('BrandMainImage', $ImageNewName , $uploadPath ); /* upload image */
						/* pr($imgRetData); */
							
							
							if($imgRetData['success'] =="1"){
								$BrandImg_uploadPath = 'uploads/categories_images/'.$imgRetData['RtnFileNData']['file_name'];
								$BrandImgName			= $imgRetData['RtnFileNData']['file_name'];
							}else{
								$BrandImg_uploadPath = "";
								$BrandImgName = "";
								$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
							}

						$BrandNewArray['BrandImage']	= $BrandImgName;	
						$BrandNewArray['BrandImgPath']	= $BrandImg_uploadPath;	
							
					}
					
			/*  ---Image Section End Here---  */
					
					
				
				
					$returnReq	=	$this->AdminBrandModel->UpdateBrand($BrandId, $BrandNewArray);
			
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Brand successfully updated. </div>');
						redirect('admin/brand-listing');
					}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to update Brand!</div>');
					}
					
			}		
		}
		
		$PageData['singleBrand']		=	$this->AdminBrandModel->GetSingleBrand($BrandId);
		$PageData['all_ParentBrand']	=	$this->AdminBrandModel->GetAllParentBrands();
		
	/*	pr($PageData['singleBrand']);*/
		
		if(empty($PageData['singleBrand'])){
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> No Record Found! </div>');
		}
		
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_brand_update_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	
	
}	