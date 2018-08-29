<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
Class AdminCategory extends CI_Controller{
	
	function  __construct(){
		
		parent:: __construct();
		
		$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation','email','upload','pagination'));
		$this->load->database();
		$this->load->model('admin/AdminCategoryModel');
		
		if (!$this->session->has_userdata('is_admin')) {
			redirect('home');
        }	
		
	}
	
		public function index($offset ="1"){
			
			$pageHeader = 	array(  'pagetitle' => 'Category Listing',
									'slug'=>'category',
									'font_icon'=>'sitemap',
							);	
			
			/**********************
			 * Description	: pagination Section Start here 	
			 * Developer	:	Manish Kumar Pathak
			 * DOC			: 04/April/2017
			 *********************/
			
			/*	$config = array();
				$config["base_url"] = base_url() . "admin/category-listing/";
				$config["total_rows"] = $this->AdminCategoryModel->Count_ParentCategories();
				$config['per_page'] = 5; 
				
				$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] =$config['num_tag_open'] = '<li>';
				
				$config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        
				$config['cur_tag_open'] = "<li><span><b>";
				$config['cur_tag_close'] = "</b></span></li>";
				
				
				$this->pagination->initialize($config); 
			
				$PageData['all_Cat'] = $this->AdminCategoryModel->GetAllParentCategories($config["per_page"], $offset);
			
				$PageData["links"] = $this->pagination->create_links();
				$PageData['counter'] =  $offset;
			/************************ END HERE **********************/
			$PageData['all_Cat'] = $this->AdminCategoryModel->GetAllParentCategories();
			
			
		//	pr($PageData);
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_category_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}

/*****************************************************************************
*	Description : '@GetSubCategoryListing' is used get list of all sub cat
*	Developer	:	Manish Kumar Pathak
*	DOC			: 29-March-2017
*	DOM			: --------		
******************************************************************************/	
	

	
		public function GetSubCategoryListing($catId =""){
			
			$pageHeader = 	array(  'pagetitle' => 'Sub Category Listing',
									'slug'		=> 'sub-category-listing',
									'font_icon'	=> 'sitemap',
							);	
			
			
			
			$PageData['all_Cat']	=	$this->AdminCategoryModel->FetchAll_SubCategories($catId);
		
		//	pr($PageData);
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_category_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}



/*****************************************************************************
*	Description : '@CreateNewCategory' is used to create new Category. 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 29-March-2017
*	DOM			: --------		
******************************************************************************/	
	
	public function CreateNewCategory(){
		
		$pageHeader = 	array(  'pagetitle' => 'Create New Category',
								'slug'=>'category',
								'font_icon'=>'sitemap',
							);			
		$PageData =array();
		if(isset($_POST['addNew_category'])){
			
			$this->form_validation->set_rules('categaryName', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('is_cat_active', 'Category Status ', 'trim|required');
			$this->form_validation->set_rules('catDescription', 'Category Description', 'trim|required');
			
			if ($this->form_validation->run() == True){
				
				
					$CatNewArray = 	array ( 'categaryName' => $this->input->post('categaryName'),
										'catDescription' => $this->input->post('catDescription'),
										'is_cat_active' => $this->input->post('is_cat_active'),
										'parent_cat' => $this->input->post('parent_cat'),
										'cat_create_date'=> strtotime(date('Y-m-d H:i:s')),
									);
				
				
				
				
				
				/* 	---Upload Images Section---  */		
					if( isset($_FILES["CategoryMainImage"]["name"]) && $_FILES["CategoryMainImage"]["name"] !="" ) {
						
						$ImageNewName = 'cat-'.date('Y-m-d_H:i:s').'-'.rand_string(5).rand_string(5); /* generate the random name */
						$uploadPath = "./uploads/categories_images/";
						
							$imgRetData = Upload_Single_Images('CategoryMainImage', $ImageNewName , $uploadPath ); /* upload image */
						/* pr($imgRetData); */
							
							if($imgRetData['success'] =="1"){
								$CatImg_uploadPath = $imgRetData['RtnFileNData']['file_name'];
							}else{
								$CatImg_uploadPath = "";
								$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
							}

						$CatNewArray['categaryImage']	= $CatImg_uploadPath;	
							
					}		
			/*  ---Image Section End Here---  */
				
				
				
				
				
				$returnReq	=	$this->AdminCategoryModel->CreateNewCategory($CatNewArray);
			
					if($returnReq == true){
					
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> New Category successfully created. </div>');
						redirect('admin/category-listing');
					
					}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to create new category!</div>');
					}
			}		
		}
		
			$PageData['all_ParentCategories']	=	$this->AdminCategoryModel->GetAllParentCategories();
		
		
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_category_create_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */



		
	
	
/*****************************************************************************
*	Description : Method is used Delete a Single Product 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 28-March-2017
*	DOM			: --------		
******************************************************************************/	
	
	public function DeleteCategory($CatId){
		
		if(empty($CatId)){
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
			
			redirect('admin/category-listing');
		}
		
		$pageHeader = 	array(  'pagetitle' => 'Category Delete Request',
								'slug'=>'category',
								'font_icon'=>'sitemap',
							);			

		
		$returnReq	=	$this->AdminCategoryModel->DeleteCategory($CatId);
		
		if($returnReq == true){
		
			$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Category Successfully Deleted </div>');
		}else{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Category!</div>');
		}
		
		redirect('admin/category-listing');
			
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */


/*****************************************************************************
*	Description : '@UpdateCategory' is used Update Single Category. 
*	Developer	:	Manish Kumar Pathak
*	DOC			: 29-March-2017
*	DOM			: --------		
******************************************************************************/	
	
	public function UpdateCategory($CatId){
		
		if(empty($CatId)){
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
			
			redirect('admin/product-listing');
		}
		
		$pageHeader = 	array(  'pagetitle' => 'Update Category',
								'slug'=>'category',
								'font_icon'=>'sitemap',
							);			
		$PageData['currentCatId'] = $CatId; 
		
		if(isset($_POST['update_category'])){
			
			$this->form_validation->set_rules('categaryName', 'Category Name', 'trim|required');
			$this->form_validation->set_rules('is_cat_active', 'Category Status', 'trim|required');
			$this->form_validation->set_rules('catDescription', 'Category Description', 'trim|required');
			
			if ($this->form_validation->run() == True){
				
				
				
				$CatNewArray = 	array ( 'categaryName' 	=> $this->input->post('categaryName'),
										'catDescription'=> $this->input->post('catDescription'),
										'is_cat_active' => $this->input->post('is_cat_active'),
										'parent_cat' => $this->input->post('parent_cat'),
										'cat_update_date'=> strtotime(date('Y-m-d H:i:s')),
								);
				
					
			/* 	---Upload Images Section--- */		
					if( isset($_FILES["CategoryMainImage"]["name"]) && $_FILES["CategoryMainImage"]["name"] !="" ) {
						$ImageNewName = 'cat-'.date('Y-m-d_H:i:s').'-'.rand_string(5).rand_string(5); /* generate the random name */
						$uploadPath = "./uploads/categories_images/";
						
							$imgRetData = Upload_Single_Images('CategoryMainImage', $ImageNewName , $uploadPath ); /* upload image */
						/* pr($imgRetData); */
							
							if($imgRetData['success'] =="1"){
								$CatImg_uploadPath = $imgRetData['RtnFileNData']['file_name'];
							}else{
								$CatImg_uploadPath = "";
								$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
							}
						
							$CatNewArray['categaryImage']	= $CatImg_uploadPath;	
							
					}
					
			/*  ---Image Section End Here---  */
					
					
				
				
					$returnReq	=	$this->AdminCategoryModel->UpdateCategory($CatId, $CatNewArray);
			
					if($returnReq == true){
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> category successfully updated. </div>');
						redirect('admin/category-listing');
					}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to update category!</div>');
					}
					
			}		
		}
		
		$PageData['singleCat']	=	$this->AdminCategoryModel->GetSingleCategory($CatId);
		$PageData['all_ParentCategories']	=	$this->AdminCategoryModel->GetAllParentCategories();
		
		if(empty($PageData['singleCat'])){
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> No Record Found! </div>');
		}
		
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_category_update_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	
	
}	