<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MyOrdersModel extends CI_Model {
		
		
		public function __construct()
		{
			parent::__construct();
			
		}
		
		
		/**********************************************************************
			*	Description : Function use for count wishlist of product
			*	Author 		: Puneet singh	 
			*	Date		: 20 April 2017
		**********************************************************************/
		
		public function CountUserWishlist($uid)
		{
			$this->db->select(' COUNT(*) AS TotalCount');
			$this->db->from('CustomerWishlist');
			$this->db->where('wish_uid',$uid);
			$query = $this->db->get();
			$result = $query->result();
			
			if(!empty($result)){
				return $result[0]->TotalCount;
				}else{
				return '0';
			}
			
		}
		
		
		/**********************************************************************
			*	Description : Function use for get wishlist product
			*	Author 		: Harish Chander	 
			*	Date		: 15 May 2017
		**********************************************************************/
		
		public function Fetch_allOrders($uid)
		{
			
			$this->db->select('*');
			$this->db->from('UserOrders');
			$this->db->where('UserOrders.order_uid', $uid);
			$this->db->order_by('UserOrders.o_id','DESC');
			$query = $this->db->get();
			$rtnStaffData = $query->result_array();
			 return $rtnStaffData;
			
		
			/* foreach($rtnStaffData AS $key=>$proVal){
				
				$mainImageData	= $this->GetActiveProductImg($rtnStaffData[$key]->pId);
				
				if(!empty($mainImageData)){
					$rtnStaffData[$key]->MainImageName	=	$mainImageData['productImage'] ;
					$rtnStaffData[$key]->MainImagePath	=	$mainImageData['product_imagePath'] ;
					}else{
					$rtnStaffData[$key]->MainImageName	= "";
					$rtnStaffData[$key]->MainImagePath	= "";
				}
			}
			
			return $rtnStaffData; */
			
		}
		
		/**********************************************************************
			*	Description : Function use for get wishlist product
			*	Author 		: Harish Chander	 
			*	Date		: 15 May 2017
		**********************************************************************/
		
		public function  Fetch_SingleOrder($orderid)

		{
			
			
			
			
			$this->db->select('*');
			$this->db->from('UserOrders');
			
			
			$this->db->where('UserOrders.o_id', $orderid);
			$this->db->where('UserOrders.order_uid', $GLOBALS['CurrentuserID']);
			//$this->db->order_by('CustomerWishlist.wish_created','DESC');
			$query = $this->db->get();
			$singleoderData = $query->result_array();
			
			
			if(!empty($singleoderData)){
					return $singleoderData[0];
			}else{
					//return $singleoderData;
					//redirect('404');
			
			}
			
			
			
			
	    }
		/**********************************************************************/
		
		public function  User_Details()

		{
			
			
			
			
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('Registration.user_id', $GLOBALS['CurrentuserID']);
			//$this->db->order_by('CustomerWishlist.wish_created','DESC');
			$query = $this->db->get();
			$userData = $query->result_array();
			
			
			if(!empty($userData)){
					return $userData[0];
			}else{
					//return $singleoderData;
					//redirect('404');
			
			}
			
			
			
			
	    }
		
		
		
		
		
		
		
		/*****************************************************************************
			*	Description : '@GetActiveProductImg' is used to Get Product based on  passed id
			*	Developer   : Puneet Singh
			*	DOC			: 04-April-2017		
		******************************************************************************/	
		
		function GetActiveProductImg($pid){
			$this->db->select('*');
			$this->db->from('ProductImage');
			$whereCon = (" `p_id`=".$pid." AND `is_main_img` ='1' ");
			$this->db->where($whereCon);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0];
				}else{
				return $rtnData;
			}	 
			//$rtnData;
		}
		
	
		
	}
