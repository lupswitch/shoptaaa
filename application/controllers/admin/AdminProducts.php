<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	Class AdminProducts extends CI_Controller{
		
		function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation','email','upload','pagination'));
			$this->load->database();
			$this->load->model('admin/AdminProductModel');
			$this->load->model('admin/AdminCategoryModel');
			$this->load->model('admin/AdminBrandModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('home');
			}	
			
		}
		
		public function index($offset ="1"){
			
			$pageHeader = 	array(  'pagetitle' => 'Product Listing',
			'slug'=>'product',
			'font_icon'=>'cart-plus',
			);	
			
			/**********************
				* Description	: pagination Section Start here 	
				* Developer	:	Manish Kumar Pathak
				* DOC			: 04/April/2017
			*********************/
			
			$config = array();
			$config["base_url"] = base_url() . "admin/product-listing/";
			$config["total_rows"] = $this->AdminProductModel->Count_Products();
			$config['per_page'] = 5; 
			
			$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] =$config['num_tag_open'] = '<li>';
			
			$config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = "<li><span><b>";
			$config['cur_tag_close'] = "</b></span></li>";
			
			
			$this->pagination->initialize($config); 
			
			/* $PageData['all_Products']	=	$this->AdminProductModel->getAllProducts($config["per_page"], $offset); */
			$PageData['all_Products']	=	$this->AdminProductModel->getAllProducts();
			
			
			$PageData["links"] = $this->pagination->create_links();
			
			/************************ END HERE **********************/
			$PageData['counter'] =  $offset;
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_product_listing_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}
		
		
		
		/*****************************************************************************
			*	Description : '@UpdateProduct' is used Update Single Product. 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function CreateNewProduct(){

			

			
			$pageHeader = 	array(  'pagetitle' => 'Create New Product',
			'slug'=>'product',
			'font_icon'=>'cart-plus',
			);			
			
			if(isset($_POST['addNew_product'])){
				
				$this->form_validation->set_rules('productName', 'Product Name', 'trim|required');
				$this->form_validation->set_rules('pro_slug', 'Product Slug', 'trim|required|is_unique[Product.pro_slug]');
				$this->form_validation->set_rules('pro_SUK', 'Product SUK Code', 'trim|required|is_unique[Product.pro_SUK]');
				$this->form_validation->set_rules('cId', 'Category Id', 'trim|required|numeric');
				$this->form_validation->set_rules('proQuantity', 'Product Quantity', 'trim|required|numeric');
				$this->form_validation->set_rules('productPrice', 'Product Price', 'trim|required|numeric');
				$this->form_validation->set_rules('bId', 'Product Brand', 'trim|required|numeric');
				//$this->form_validation->set_rules('useCare', 'Use Care', 'trim|required');
				//$this->form_validation->set_rules('productDesign', 'Product Design', 'trim|required');
				$this->form_validation->set_rules('productDescription', 'Product Description', 'trim');
				
				if ($this->form_validation->run() == True){
					
					
					if(empty($this->input->post('pro_isFeature')) ){
						$pro_isFeature = '0'; 
						}else{
						$pro_isFeature = '1'; 
					}
					if(empty($this->input->post('pro_isFeature')) ){
						$pro_isNewArrivals = '0'; 
						}else{
						$pro_isNewArrivals = '1'; 
					}
					
					
					$ProNewArray = 	array 	(
					'productName' 				=> 	$this->input->post('productName'),
					'cId' 						=>	$this->input->post('cId'),	
				//	'useCare' 					=>	$this->input->post('useCare'),	
				//	'productDesign' 			=>	$this->input->post('productDesign'),	
					'productPrice' 				=> 	$this->input->post('productPrice'),	
					'productDescription'		=>	$this->input->post('productDescription'),
					'pro_SUK'					=> 	$this->input->post('pro_SUK'),
					'proQuantity'				=>	$this->input->post('proQuantity'),
					'pro_isActive'				=>	$this->input->post('pro_isActive'),
					'pro_isFeature'				=>	$pro_isFeature,
					'pro_isNewArrivals'			=>	$pro_isNewArrivals,
					'product_create_date'		=> strtotime(date('Y-m-d H:i:s')),
					'pro_slug'					=> $this->input->post('pro_slug'),
					'bId'						=> $this->input->post('bId'),
					'product_meta_title'		=> $this->input->post('product_meta_title'),
					'product_meta_keyword'		=> $this->input->post('product_meta_keyword'),
					'product_meta_description'	=> $this->input->post('product_meta_description'),
					);
					

                    $InsertGalleryData = "";					
					
					if( isset($_FILES["ProductGalleryImage"]["name"]) && !empty($_FILES['ProductGalleryImage'])) {		
						$InsertGalleryData = ProductGalleryUpload($_FILES);	
					}


					
					/* Add priduct image */
					$ProImg_uploadPath = "";
					
					if( isset($_FILES["ProductMainImage"]["name"]) && $_FILES["ProductMainImage"]["name"] !="" ) {
						
						
						$ImageNewName = 'Pro-'.date('Y-m-d_H:i:s').'-'.rand_string(5).rand_string(5); /* generate the random name */
						$uploadPath = "./uploads/product_images/";

						$imgRetData = Upload_Single_Images('ProductMainImage', $ImageNewName , $uploadPath );


						
						/* upload image */
						
						if($imgRetData['success'] =="1"){
							$ProImg_uploadPath = 'uploads/product_images/'.$imgRetData['RtnFileNData']['file_name'];		
							
							$pro_Mainimg = array(
							'productImage' => $imgRetData['RtnFileNData']['file_name'],
							'product_imagePath' => $ProImg_uploadPath,
							);
							
						}
						else
						{
							$pro_Mainimg = "";
							$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
						} 
						
					}
					
					/* Add priduct image */
					
					
					$returnReq	=	$this->AdminProductModel->CreateNewProduct($ProNewArray,$pro_Mainimg,$InsertGalleryData);
					
					if($returnReq == true){
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> New product successfully created. </div>');
						redirect('admin/create-product');
						}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to create new product!</div>');
					}
				}else{
				echo "invalid"; 
				}	
			}
			
			$PageData['all_categories']	=	$this->AdminCategoryModel->GetActiveParentCategories();
			$PageData['all_Brands']		=	$this->AdminBrandModel->GetActiveParentBrands();
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_product_create_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		
		
		
		/*****************************************************************************
			*	Description : Method is used Delete a Single Product 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function DeleteProduct($ProId){
			
			if(empty($ProId)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/product-listing');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Product Delete Request',
			'slug'=>'product',
			'font_icon'=>'cart-plus',
			);			
			
			
			$returnReq	=	$this->AdminProductModel->DeleteProduct($ProId);
			
			if($returnReq == true){
				
				$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Product Successfully Deleted </div>');
				}else{
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to delete Product!</div>');
			}
			
			redirect('admin/product-listing');
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : '@UpdateProduct' is used Update Single Product. 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function UpdateProduct($ProId){
			
			if(empty($ProId)){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error!</strong> Invalid Request! </div>');
				
				redirect('admin/product-listing');
			}
			
			$pageHeader = 	array(  'pagetitle' => 'Update Product',
			'slug'=>'product',
			'font_icon'=>'cart-plus',
			);	
			
			$PageData['currentProId'] = $ProId; 
			
			if(isset($_POST['update_product'])){
				
				$this->form_validation->set_rules('productName', 'Product Name', 'trim|required');
				$this->form_validation->set_rules('cId', 'Category Id', 'trim|required');
				//$this->form_validation->set_rules('useCare', 'Use Care', 'trim|required');
				//$this->form_validation->set_rules('productDesign', 'Product Design', 'trim|required');
				$this->form_validation->set_rules('productPrice', 'Product Price', 'trim|required|numeric');
				$this->form_validation->set_rules('productDescription', 'Product Description', 'trim|required');
				$this->form_validation->set_rules('pro_SUK', 'Product SUK Code', 'trim|required');

				
				
				if ($this->form_validation->run() == True){
					
					
					$ProUpdateArray = 	array ( 'productName' => $this->input->post('productName'),
					'cId' => $this->input->post('cId'),	
					'bId' => $this->input->post('bId'),	
					//'useCare' => $this->input->post('useCare'),	
					//'productDesign' => $this->input->post('productDesign'),	
					'productPrice' => $this->input->post('productPrice'),	
					'productDescription' => $this->input->post('productDescription'),
					'pro_SUK'			=> 	$this->input->post('pro_SUK'),
					'proQuantity'		=>	$this->input->post('proQuantity'),
					'pro_isActive'		=>	$this->input->post('pro_isActive'),
					'pro_isFeature'		=>	$this->input->post('pro_isFeature'),
					'pro_isNewArrivals'		=>	$this->input->post('pro_isNewArrivals'),
					'product_update_date'=> strtotime(date('Y-m-d H:i:s')),
					// 'pro_slug'			=> $this->input->post('pro_slug'),
					'product_meta_title'		=> $this->input->post('product_meta_title'),
					'product_meta_keyword'		=> $this->input->post('product_meta_keyword'),
					'product_meta_description'	=> $this->input->post('product_meta_description'),
					);
					
					$UploadGalleryData = "";					
					
					if( isset($_FILES["ProductGalleryImage"]["name"]) && !empty($_FILES['ProductGalleryImage'])) {		
						$UploadGalleryData = ProductGalleryUpload($_FILES);	
					}				
					
					
					$ProImg_uploadPath = "";					
					/****
						*
						* 	Description : Upload Images Section
						*	DOC			: 30th-March-2017
						*	
					*****/
					
					if( isset($_FILES["ProductMainImage"]["name"]) && $_FILES["ProductMainImage"]["name"] !="" ) {
						
						$ImageNewName = 'Pro-'.date('Y-m-d_H:i:s').'-'.rand_string(5).rand_string(5); /* generate the random name */
						$uploadPath = "./uploads/product_images/";
						
						$imgRetData = Upload_Single_Images('ProductMainImage', $ImageNewName , $uploadPath ); /* upload image */
						/* pr($imgRetData); */
						
						if($imgRetData['success'] =="1")
						{
							$ProImg_uploadPath = 'uploads/product_images/'.$imgRetData['RtnFileNData']['file_name'];
							
							$pro_Mainimg = array(
							'productImage' => $imgRetData['RtnFileNData']['file_name'],
							'product_imagePath' => $ProImg_uploadPath,
							);
						}
						else
						{
							$pro_Mainimg = "";
							$errorImg	= '<br/><div class="alert alert-danger text-center"><strong>Error ! </strong> '.$imgRetData['error'].'</div><br/>';
						}
						
					}
					
					/*  ---Image Section End Here---  */					
					
					
					
					$returnReq	=	$this->AdminProductModel->UpdateProducts($ProId, $ProUpdateArray, $pro_Mainimg, $UploadGalleryData);
					
					if($returnReq == true){
						
						$this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center"><strong>Success </strong> Product Successfully Updated. </div>');
						redirect('admin/product-listing');
						
						}else{
						$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> Not able to update Product!</div>');
					}
					
				}		
			}
			
			$PageData['all_categories']	=	$this->AdminCategoryModel->GetActiveParentCategories();
			$PageData['all_Brands']		=	$this->AdminBrandModel->GetActiveParentBrands();
			$PageData['SingleProduct']	=	$this->AdminProductModel->GetSingleProduct($ProId);
			
			
			if(empty($PageData['SingleProduct'])){
				$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center"><strong>Error ! </strong> No Record Found! </div>');
			}
			
			$this->load->view("admin/share-template/header",$pageHeader);
			$this->load->view('admin/admin_product_update_view',$PageData);
			$this->load->view("admin/share-template/footer");
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		/*****************************************************************************
			*	Description : '@Delete Product Gallery images' 
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 17-April-2017
		******************************************************************************/	
		
		public function DeleteGalleryImage($imgId)
		{
			$this->AdminProductModel->DeleteGalleryImage($imgId);	
			echo "Success";
		}
		
	}				
