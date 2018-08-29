<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Products extends MY_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('session','form_validation');
			$this->load->model('frontend/ProductFrontendModel');
			$this->load->model('frontend/CategoryModel');
			
				//pr($this->session->userdata());
		}
		
		/****************************************************************************
			* Description	: 	@index is use for listing of all products
			* Developer		:	Er.Parwinder Singh
			* Date			:	14-April-2017
		****************************************************************************/
		
		public function index(){
			
			$pageData = array();
			
			$limit = '12'; /* product limit */
			
			$pageData['AllProductsList'] = $this->ProductFrontendModel->getAllProductsList($limit);
			
			/* 	pr($pageData); */
			
			$orderBy = array( 'orderBy' => 'categaryName', 'sort' =>'ASC');
			
			$pageData['AllCategories'] = $this->CategoryModel->GetAllParentCategories($orderBy);
			
			//pr($pageData['AllCategories'])	;	
			
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/products_listing_view', $pageData);
			$this->load->view('frontend/templates/footer'); 
		}  
		
		
		/****************************************************************************
			* Description	: 	@index is use for listing of all products
			* Developer		:	Er.Parwinder Singh
			* Date			:	14-April-2017
			* Modify on 	: 	17-april-2017 by Puneet singh
		****************************************************************************/
		
		public function SingleProduct($slug_Id){
			
			if(empty($slug_Id)){
				
				redirect('404');
			}
			
			//Get single product data
			$pageData['ProductData'] = $this->ProductFrontendModel->GetSingleProduct($slug_Id);

			if(empty($pageData['ProductData'])){
				
				redirect('404');
			}
			
			//Get Featured Product data on Product page
			$pageData['featureproduct'] = $this->ProductFrontendModel->getFeaturedProductsHome();
			
		/* <<<< Check is current Product add into cart or not  @IsProductInCart >>>> */
		
			// Product "option" is for future functionality if "Size, color" option assign to product
			// Then this will by-pass the checking of product is already into cart or not. 
			// Because user can add same product into cart with different color or size.
			
			$pageData['ProductData']->option = "";
			
		if(empty($pageData['ProductData']->option)){ 
			
			
				if(!empty($cartData = $this->cart->contents())){
					
					foreach($cartData as $key =>$cartVal){
				
						if($cartVal['id'] == $pageData['ProductData']->pId ){
							$pageData['ProductData']->IsProductInCart = TRUE;
							break ; // if product id found break Loop
						}else{
							$pageData['ProductData']->IsProductInCart = FALSE;
						}
					}
				}else{
					$pageData['ProductData']->IsProductInCart = FALSE;
				}
			}else{
				$pageData['ProductData']->IsProductInCart = FALSE;
			}	
			
			/*** End of IsProductInCart Section ***/
			
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/single_product_view', $pageData);
			$this->load->view('frontend/templates/footer'); 
		}  
		
		
		
		
		
		
	}
