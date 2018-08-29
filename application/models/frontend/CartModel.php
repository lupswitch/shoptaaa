<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CartModel extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	function update_cart($rowid, $qty, $price, $amount) {
 		
		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount
		);

		$this->cart->update($data);
		
		
		
	}
	
	
	
	public function InsertUserCart_inDB($userId){
		
		$rtnCartData	=	$this->FetchUser_CartData($userId);/* check is Database cart empty or not */

   
		
		if(empty($rtnCartData)){
			
			if($this->cart->contents()){

          //pr($this->cart->contents());			
				$NewCartArry = 	array(	
										'cart_uid' 			=>	$userId,
										'cart_TotalPrice'	=>	$this->cart->format_number($this->cart->total()),
										'cartValues'		=>	serialize($this->cart->contents()),
								);
					
				$this->db->insert('UsersCart', $NewCartArry);
			
				return $insert_id = $this->db->insert_id();
				
			}		
		
		}else{
			
				// Get existing Cart Data and un-serialize the CartValue 
				$GetUserCartArray		=	unserialize($rtnCartData['cartValues']); 
				
				
				// Get Session Cart Data
				$sessionCartArray = $this->cart->contents();
				
		
					foreach($GetUserCartArray AS $key =>$Cartval){
				     
						if (array_key_exists($key,$sessionCartArray)){


                   	//	Key exists!
							$price = $Cartval['price'];
							$amount = $price * $Cartval['qty'];
			
							$this->update_cart($Cartval['rowid'], $Cartval['qty'], $price, $amount);
							
						}else{
						//	Key does not exist!
							
							$RetnCArtData =	$this->cart->insert($GetUserCartArray[$key]); 
						}
					}
				
				// Insert UserCart Values into session Cart to update the Cart Values with Saved Cart Data, New CartData which is add by user before login into system 
		
				$rtnCartData['cartValues']	= serialize($this->cart->contents());
				$rtnCartData['cart_TotalPrice']	= $this->cart->format_number($this->cart->total());
				
				
				return $this->UpdateUserCartTbl($rtnCartData); /* update Cart in user DB table*/
				
		}
		
	}
	
	
	public function FetchUser_CartData($user_id){
		
		$this->db->Select('*');
		$this->db->from('UsersCart');
		$this->db->Where('cart_uid',$user_id);
		$this->db->Where('is_order', 'false');
		
		$getQry = $this->db->get();
		$result = $getQry->result_array();
		
		if(!empty($result)){
			$result = $result[0];
		}
		
		return $result;
		
	}
	
/****************************************************
*	Description : '@UpdateUserCartTbl' is used to Update the User Cart In Db
*	Developer	: Er.Parwinder Singh	
*	DOC			: 29th-April-2017
*****************************************************/
	
	
	public function  UpdateUserCartTbl($CartData){
		
				$this->db->where('cartId',$CartData['cartId']);
		return	$rntData	=	$this->db->update('UsersCart',$CartData);
		
		
	}
	
	
/****************************************************
*	Description : '@EmptyUserCart_inDb' is used to empty the User Cart In Db
*	Developer	: Er.Parwinder Singh	
*	DOC			: 29th-April-2017
*****************************************************/
	
	
	
	Function EmptyUserCart_inDb($userId){
		
		$rtnCartData	=	$this->FetchUser_CartData($userId);

		
		
		if(!empty($rtnCartData)){
			$this->db->where('cartId',$rtnCartData['cartId']);
			return	$rntRecord = $this->db->delete('UsersCart'); 
		}
		
		
	}
	
	
/****************************************************
*	Description : '@RemoveCartProduct_inUserCartDb' is update the cart Db tbl when any product is
					removed from cart.
*	Developer	: Er.Parwinder Singh	
*	DOC			: 29th-April-2017
*****************************************************/
	
	
	
	Function RemoveCartProduct_inUserCartDb($userId){
		
		$rtnCartData	=	$this->FetchUser_CartData($userId);
		
		if(!empty($rtnCartData)){
			

				$rtnCartData['cartValues']	= serialize($this->cart->contents());
				$rtnCartData['cart_TotalPrice']	= $this->cart->format_number($this->cart->total());

			
			$this->UpdateUserCartTbl($rtnCartData);
			
		}
		
		
	}
	
		
		
/****************************************************
*	Description : '@UpdateUserCart_inDB' is update the cart Db tbl when any product is
					Update into cart.
*	Developer	: Er.Parwinder Singh	
*	DOC			: 29th-April-2017
*****************************************************/
	
	
	
	function UpdateUserCart_inDB($userId){
		
		
		
		$rtnCartData	=	$this->FetchUser_CartData($userId);
		
		
		
		if(!empty($rtnCartData)){
			

				$rtnCartData['cartValues']	= serialize($this->cart->contents());
				$rtnCartData['cart_TotalPrice']	= $this->cart->format_number($this->cart->total());
		
			return 	$this->UpdateUserCartTbl($rtnCartData);
			
		}
		
		
	}
	
	
	
	
}