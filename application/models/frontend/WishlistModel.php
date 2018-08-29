<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class WishlistModel extends CI_Model {
		
		
		
		public function __construct()
		{
			parent::__construct();
			
			
			if ($this->session->has_userdata('is_customer')) 
			{
				$GLOBALS['curentuserID'] = $this->session->userdata['is_customer']['user_id'];
			}
			
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
			*	Author 		: Puneet singh	 
			*	Date		: 21 April 2017
		**********************************************************************/
		
		public function GetWishlistProduct($uid)
		{
			
			$this->db->select('*');
			$this->db->from('Product');
			$this->db->join('CustomerWishlist', 'CustomerWishlist.wish_pId = Product.pId','LEFT JOIN');
			$this->db->where('CustomerWishlist.wish_uid', $uid);
			$this->db->order_by('CustomerWishlist.wish_created','DESC');
			$query = $this->db->get();
			$rtnStaffData = $query->result();
			
		
			foreach($rtnStaffData AS $key=>$proVal){
				
				$mainImageData	= $this->GetActiveProductImg($rtnStaffData[$key]->pId);
				
				if(!empty($mainImageData)){
					$rtnStaffData[$key]->MainImageName	=	$mainImageData['productImage'] ;
					$rtnStaffData[$key]->MainImagePath	=	$mainImageData['product_imagePath'] ;
					}else{
					$rtnStaffData[$key]->MainImageName	= "";
					$rtnStaffData[$key]->MainImagePath	= "";
				}
			}
			
			return $rtnStaffData;
			
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
		
		
		/*****************************************************************************
			*	Description : '@Delete Wishlist Product ajax based' 
			*	Developer   : Puneet Singh
			*	DOC			: 21-April-2017
			*	DOM			: --------		
		******************************************************************************/		
		public function DeleteWishlistProduct($wish_id)
		{
		
		 //return $this->db->delete('CustomerWishlist',array('wish_id'=>$wish_id));
		 $resultset = $this->db->delete('CustomerWishlist',array('wish_id'=>$wish_id));	
			if($resultset) {
				echo "Record Deleted";
			}
		
		}
		
	}
