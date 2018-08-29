<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AllAjax extends CI_Controller {
		
		public function __construct()
		{
			parent::__construct();
			
			$this->load->helper(array('form','url'));
			$this->load->library(array('session','form_validation','email','upload'));
			$this->load->model('common/AllajaxModel');
			
			if ($this->session->has_userdata('is_customer')){
				$GLOBALS['curentuserID'] = $this->session->userdata['is_customer']['user_id'];
			}
			
		}
		
		
		/*****************************************************************************
			*	Description : Function use for add product to wishlist
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 19-April-2017
		******************************************************************************/	
		
		public function Wishlist(){
			
			if (!$this->session->has_userdata('is_customer')) {
				$rtnData = array(
				'success'	=> 'login',
				'msg'		=> 'Invalid request, You have to login first',
				);
				echo json_encode($rtnData);
				die();
			}
			
			
			if(isset($_POST['RequestMethod']) && $_POST['RequestMethod'] == 'AddWishList')
			{
				
				$wisharray = array(
				'wish_pId' 		=> $_POST['productid'],
				'wish_uid' 		=> $GLOBALS['curentuserID'],
				'wish_created'	=> date('Y-m-d H:i:s'),
				);
				
				$this->AllajaxModel->UpdateWishlist($wisharray);
			}
			else
			{
				echo json_encode(array('success' => '0', 'msg' => 'Invalid request !'));
			}
			
			
			
			
		}
		
		
/*****************************************************************************
*	Description : @AjaxFilterProducts
*	Developer	:	Manish Kumar Pathak
*	DOC			: 19-April-2017
******************************************************************************/	
		
	public function AjaxFilterProducts(){
		
		
		if(isset($_POST) ){
			
			$data['AllProductsList'] =	$this->AllajaxModel->ProductsFilter($_POST);
			
			if(!empty($data['AllProductsList'])){
				echo $this->load->view('frontend/templates/sub_template/filterProductsHTML', $data , TRUE);
			}else{
				/* echo $this->load->view('frontend/templates/sub_template/NoRecordFoundHTML', '', TRUE);*/
				echo "2"; /* if no product found 2 response display */
			}	
		}else{
				echo '0';
		}
		
	}
				
/*****************************************************************************
*	Description : @AjaxLoadMoreProducts
*	Developer	:	Manish Kumar Pathak
*	DOC			: 19-April-2017
******************************************************************************/	
		
	public function AjaxLoadMoreProducts(){
		
		if(isset($_GET) ){
			
			$PageNo = $_GET['page'];	
			
			$data['AllProductsList'] =	$this->AllajaxModel->ProductsFilter($_GET,$PageNo);
			
			if(!empty($data['AllProductsList'])){
				echo $this->load->view('frontend/templates/sub_template/filterProductsHTML', $data , TRUE);
			}else{
				echo '2'; /* if no product found 2 response display */
			}	
		}else{
				echo '0'; /* for invalid request */
		}
		
	}
		
		
		
/*****************************************************************************
			*	Description : Function use for cancel order
			*	Developer	:	Manish Kumar Pathak
			*	DOC			: 16-may-2017
		******************************************************************************/	
		
		public function CancelOrderRequest(){
		
		
			
			if (!$this->session->has_userdata('is_customer')) {
				$rtnData = array(
				'success'	=> 'login',
				'msg'		=> 'Invalid request, You have to login first',
				);
				echo json_encode($rtnData);
				die();
			}
			
			
			if(isset($_POST['cancelorderre']) && !empty($_POST['cancelorderre']))
			{
				
				
				
				$this->AllajaxModel->UpdateCancelorder($_POST['cancelorderid'],$GLOBALS['curentuserID'],$_POST['cancelorderre']);
			}
			else
			{
				echo json_encode(array('success' => '0', 'msg' => 'Invalid request !'));
			}
			
			
			
			
		}		
		
		
		
	}
