<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class CheckoutModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
			
			// Get Current user ID for cart items
			if($this->session->has_userdata('is_customer')) 
			{
				$GLOBALS['custmerId'] = $this->session->userdata['is_customer']['user_id'];
			}
		}
		
		
	/****************************************************************************
		Description		:	Function use for Get All cart items
		Developer		:	Puneet Singh
		Doc				:	01/May/2017
	****************************************************************************/
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
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
	/****************************************************************************
		Description		:	Function use for Get particular user
		Developer		:	Puneet Singh
		Doc				:	26/April/2017
	****************************************************************************/
		public function GetUserDetail($uid)
		{
			
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('is_active', '1');
			$this->db->where('user_id', $uid);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0];
				}else{
				return false;
			}
			
		}
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	
		
		
	/****************************************************************************
		Description		:	Function use for Create confirm order
		Developer		:	Puneet Singh
		Doc				:	2/may/2017
	****************************************************************************/
		public function GenerateOrder($order)
		{
			$this->db->insert(' UserOrders', $order);
			$oId = $this->db->insert_id();
			if(!empty($oId)){
				
				$CustomOrder_id = 'OD'.strtotime(date('Y-m-d H:m:i')).'SA'.$oId;
				
				$this->db->set('order_id',$CustomOrder_id);
				$this->db->where('o_id', $oId);
				$confirmOrder = $this->db->update('UserOrders');
				
				if($confirmOrder == TRUE) {
			
					//update user cart
					$this->db->set('is_order','false');
					$this->db->where('cart_uid', $GLOBALS['custmerId'] );
					$confirmOrder = $this->db->update('UsersCart');
					
				}
				
				
				return $oId;
				
			}
			return false;
		}
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	
	
	/****************************************************************************
		Description		:	@UpdatePaymentTransectionId us
		Developer		:	Puneet Singh
		Doc				:	02/may/2017
	****************************************************************************/
		
		public function UpdatePaymentTransectionId($oderid, $PaymentData){
		    
		    $this->db->set('transactionId',$PaymentData['Paypal_trans_id']);
			$this->db->set('payment_method','Paypal');
			
			$this->db->where('o_id', $oderid );
			$confirmOrder = $this->db->update('UserOrders');
			
			
			if($confirmOrder){
			   $this->EmptyCart($GLOBALS['custmerId']);
			}else{
				return $confirmOrder;
			}
		}
		
		
		
		
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
	
	
	
		
	/****************************************************************************
		Description		:	Function use for get My-address
		Developer		:	Puneet Singh
		Doc				:	02/may/2017
	****************************************************************************/
		
		public function GetMyAddress()
		{
			
			$this->db->select('*');
			$this->db->from('MyAddress');
			$this->db->where('addr_uid', $GLOBALS['custmerId']);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0];
				}else{
				return false;
			}
			
		}
	
	
	/****************************************************************************
		Description		:	Function use for update My-address
		Developer		:	Puneet Singh
		Doc				:	02/may/2017
	****************************************************************************/
		
		public function UpdateMyAddress($address)
		{
			$myAddress = $this->GetMyAddress();
					
			if(empty($myAddress))
			{
				return $this->db->insert('MyAddress', $address);
			}
			
		}
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	
		
	/****************************************************************************
		Description		:	Function use for get My-address
		Developer		:	Puneet Singh
		Doc				:	02/may/2017
	****************************************************************************/
		
		public function EmptyCart($uid)
		{
			
			
			$this->db->where('cart_uid', $GLOBALS['custmerId']);
		return	$this->db->delete('UsersCart');
			
		}
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	
	
      
	
		
	public function UpdateInventoryProduct($pid,$proqty)
	{
	      $proOldval = $this->GetSingleProduct($pid);
	      //pr($proOldval);
	
	      $newQnt =  (int)$proOldval['proQuantity'] - (int)$proqty;
	   
	      $this->db->set('proQuantity',$newQnt);
			$this->db->where('pId', $pid );
		return	$this->db->update('Product');	       
	}
	
	
	
	/*****************************************************************************
			*	Description : '@GetSingleProduct' all data of single product
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 14-April-2017		
		******************************************************************************/	
		
		function GetSingleProduct($slugId){
			$this->db->select("*");
			$this->db->from('Product');
			
			$whereCon = "( `pro_isActive` = '1' AND ( `pro_slug` = '".$slugId."' OR  `pId`= '".$slugId."' ))";
			
			$this->db->where($whereCon);
			$query = $this->db->get();
			$rtnProData = $query->result_array();	
			
			
			
			if(!empty($rtnProData)){
				$rtnProData = $rtnProData[0];
			}
			
			return $rtnProData;
		}	
		
		
	
	}					