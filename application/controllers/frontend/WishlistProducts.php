<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class WishlistProducts extends MY_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('session','form_validation');
			$this->load->model('frontend/WishlistModel');
			
			if ($this->session->has_userdata('is_customer')) 
			{
				$GLOBALS['CurrentuserID'] = $this->session->userdata['is_customer']['user_id'];
			}
			else
			{
				redirect('home');
			}
			
		}
		
		/****************************************************************************
			* Description	: 	@index is use for Get Wishlist Products
			* Developer		:	Puneet Singh
			* Date			:	21-April-2017
		****************************************************************************/
		
		public function index()
		{
			if(!empty($this->session->has_userdata('is_customer'))){
			
				$pageData['wishlistProduct'] = $this->WishlistModel->GetWishlistProduct($GLOBALS['CurrentuserID']);
			}
			
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/wishlist_product_view', $pageData);
			$this->load->view('frontend/templates/footer'); 
		}  
		
		
		/****************************************************************************
			* Description	: 	@DeleteWishlistProduct is use for delete Wishlist Product
			* Developer		:	Puneet Singh
			* Date			:	21-April-2017
		****************************************************************************/
		public function DeleteWishlistProduct($wishID)
		{
			$this->WishlistModel->DeleteWishlistProduct($wishID);	
			echo "Success";
		}
		
	
		
	}
