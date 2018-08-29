<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MainCart extends MY_Controller {

	public function __construct(){
		
		parent::__construct();
		
		$this->load->library('cart','URL','form','session');
		
		$this->load->model('frontend/CartModel');
		$this->load->model('frontend/ProductFrontendModel');
		
		//pr($this->session->userdata());
		if($this->session->has_userdata('is_customer')) {
				$GLOBALS['custmerId'] = $this->session->userdata['is_customer']['user_id'];
		}	
	
	}

	
	public function index(){	
		$this->data['title'] = 'Shopping Carts';
		
		
		
	/* pr($this->cart->contents());  */
		
		
		//pr($_SESSION);
		
		if($this->session->has_userdata('is_customer')) {
		//	$this->CartModel->InsertUserCart_inDB($GLOBALS['custmerId']);
				$data = $this->CartModel->FetchUser_CartData($GLOBALS['custmerId']);
		
		// Testing Region 
		
			if(!empty($data)){
				
			 $cartdata = unserialize($data['cartValues']);

			$this->session->set_userdata('cart_contents',$cartdata);
		
			}	
	
		}
		
		
		
		if (!$this->cart->contents()){
			$this->session->set_flashdata('verify_msg','<div class="alert-danger alert-dismissable"> <strong> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </strong>Cart is empty Right Now !</div>');
		
		}
		
		
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/cart_view', $this->data);
		$this->load->view('frontend/templates/footer'); 
		
		
	}

	public function addToCart(){
		
		if(isset($_POST['AddtoCart'])){
			
		/*	$cart_room 	= 	array(
								'id' => $this->input->post('pro_id'),
								'name' => $this->input->post('pro_name'),
								'price' => $this->input->post('pro_price'),
								'qty' => $this->input->post('pro_PruchaseQuantity'),
								'options' =>'',
								'pro_SUK' => $this->input->post('pro_SUK'),
								'pro_slug' => $this->input->post('pro_slug'),
								'pro_categaryId' => $this->input->post('pro_categaryId'),
								'pro_image' => $this->input->post('pro_image'),
								'isWishlist' => $this->input->post('isWishlist'),
							);		GLOBALS
		*/	
		$isGallery ='no';
		$ProductData = $this->ProductFrontendModel->GetSingleProduct($this->input->post('pro_id'), $isGallery);
		
				$cart_room 	= 	array(
								'id' 			=> $ProductData->pId,
								'name' 			=> $ProductData->productName,
								'price' 		=> $ProductData->productPrice,
								'qty' 			=> $this->input->post('pro_PruchaseQuantity'),
								'options' 		=> '',
								'pro_SUK' 		=> $ProductData->pro_SUK,
								'pro_slug' 		=> $ProductData->pro_slug,
								'pro_description'=> $ProductData->productDescription,
								'pro_categaryName'=> $ProductData->CatName,
								'pro_categaryId'=> $ProductData->cId,
								'pro_brandId'	=> $ProductData->bId,
								'pro_image' 	=> $ProductData->MainImageName,
								'pro_ImagePath' => $ProductData->MainImagePath,
								'instock'		=> $ProductData->proQuantity, /* this is used in APP only contain total pending Qty of pro added variable on 21st-June-2017 */ 
							   /*'isWishlist' 	=> $ProductData->isWishlist,*/
							);		

			$RetnCArtData =	$this->cart->insert($cart_room);
	
			if($this->session->has_userdata('is_customer')) {
				$this->CartModel->InsertUserCart_inDB($GLOBALS['custmerId']);
			}
			
			
			$this->session->set_flashdata('verify_msg','<div class="alert-success alert-dismissable"> <strong> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </strong> Product Successfully Added into cart. </div>');
			
			redirect('cart');
			
		}else{
			redirect('products');
		}
		
		
	}
	
	
	
	public function addToCartByAjax(){
		
		if(isset($_POST['RequestMethod']) && $_POST['RequestMethod'] == 'AddToCartajax' ){
			
		

			$prodata = $this->IsProductIncart($_POST['pidadd']);
    
			if($prodata === true){
				echo  json_encode( array('success'=>'1' ,'msg'=> 'This product already  in cart.' ,'total_items'=> count($this->cart->contents())));
	   
			}else{     
			
				$isGallery ='no';
				$ProductData = $this->ProductFrontendModel->GetSingleProduct($_POST['pidadd'], $isGallery);
			
			
				$cart_roomAjax 	= 	array(
									'id' 			=> $ProductData->pId,
									'name' 			=> $ProductData->productName,
									'price' 		=> $ProductData->productPrice,
									'qty' 			=> '1',
									'options' 		=> '',
									'pro_SUK' 		=> $ProductData->pro_SUK,
									'pro_slug' 		=> $ProductData->pro_slug,
									'pro_description'=> $ProductData->productDescription,
									'pro_categaryName'=>$ProductData->CatName,
									'pro_categaryId'=> $ProductData->cId,
									'pro_brandId'	=> $ProductData->bId,
									'pro_image' 	=> $ProductData->MainImageName,
									'pro_ImagePath' => $ProductData->MainImagePath,
									'instock'		=> $ProductData->proQuantity, /* this is used in APP only contain total pending Qnty of pro*/ 
								/*	'isWishlist' 	=> $ProductData->isWishlist, */
									
								);		
			
				$RetnCArtData =	$this->cart->insert($cart_roomAjax);
		
				if($this->session->has_userdata('is_customer')) {
				 $this->CartModel->InsertUserCart_inDB($GLOBALS['custmerId']);
					
					
				}
			
			 
			
				echo  json_encode( array('success'=>'1' ,'msg'=> 'Product Successfully Added into cart.','total_items'=> count($this->cart->contents())));
			
			}
		}else{
			echo  json_encode( array('success'=>'0' ,'msg'=> 'invalid Request for add to card!'));
		}
		
	}
	
	
	
	
	function EmptyCurrentCart($rowid) {
		if ($rowid=="all"){
			$this->cart->destroy();
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);

			$this->cart->update($data);
			
		}
		
		if($this->session->has_userdata('is_customer')) {
				
			if(empty($this->cart->contents())){
				$this->CartModel->EmptyUserCart_inDb($GLOBALS['custmerId']);
			}else{
				$this->CartModel->RemoveCartProduct_inUserCartDb($GLOBALS['custmerId']);
			}
			
			
		}
		
		
		redirect('cart');
	}	

	function updateCartVal(){
		
 		foreach($_POST['cart'] as $id => $cart){
			
			$price = $cart['price'];
			$amount = $price * $cart['qty'];
			
			$this->CartModel->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
			
		}
		
		
		/**
		* Add and Update cart values into db when user is login
		*
		**/
		
		
		if($this->session->has_userdata('is_customer')) {
			$this->CartModel->UpdateUserCart_inDB($GLOBALS['custmerId']);
			
		}	
		
		/* <<<<<< END OF CODE HERE >>>>> */
		
		
		
			$this->session->set_flashdata('verify_msg','<div class="alert-success alert-dismissable"> <strong> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </strong> Cart Successfully Updated. </div>');
		
		
		redirect('cart');
	}	
	
	
	public function IsProductIncart($proid){
		$allproductlist = $this->cart->contents();
		
			foreach ($allproductlist as $item){
				if ($item['id'] === $proid){
				   return true; 
				}
			}
   // return false;
   //echo 'not exists';
	
	}
	
	
}