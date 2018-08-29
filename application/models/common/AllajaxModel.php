<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AllajaxModel extends CI_Model {
		
		
		public function __construct()
		{
			parent::__construct();
		}
		
		
		/**********************************************************************
		*	Description : Function use for count wishlist of product
		*	Author 		: Puneet singh	 
		*	Date		: 19 April 2017
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
			*	Description : Function use for Update product wishlist
			*	Author 		: Puneet singh	 
			*	Date		: 19 April 2017
		**********************************************************************/
		
		public function UpdateWishlist($wisharray)
		{
			
			$this->db->select('*');
			$this->db->from('CustomerWishlist');
			$this->db->where('wish_pId',$wisharray['wish_pId']);
			$this->db->where('wish_uid',$wisharray['wish_uid']);
			$query = $this->db->get();
			$result = $query->result_array();
			
			if(empty($result))
			{
				$this->db->insert('CustomerWishlist', $wisharray);
				$insert_id = $this->db->insert_id();
				
					if(!empty($insert_id))
					{
						$countwishlist = $this->CountUserWishlist($wisharray['wish_uid']);
						
						echo json_encode(array('success' => '1', 'msg' => 'Product successfully added to wishlist', 'wishcount' => $countwishlist ));
					}
			}
			else 
			{
				$this->db->where('wish_uid',$wisharray['wish_uid']);
				$this->db->where('wish_pId',$wisharray['wish_pId']);
				$this->db->delete('CustomerWishlist');
				
					if ($this->db->affected_rows()) 
					{
						$countwishlist = $this->CountUserWishlist($wisharray['wish_uid']);
						
						echo json_encode(array('success' => '2', 'msg' => 'Product successfully Removed from wishlist', 'wishcount' => $countwishlist ));
						
					}
					else
					{
						$countwishlist = $this->CountUserWishlist($wisharray['wish_uid']);
						
						echo json_encode(array('success' => '0', 'msg' => 'Unable to Remove product fron wishlist', 'wishcount' => $countwishlist ));
						
					}
				 
			}
			
		}
		
		
		
/*****************************************************************************
 *	Description : '@geAllProductsList' is used to fetch all Products
 *	Developer   : Er.Parwinder Singh
 *	DOC			: 04-April-2017	
 *****************************************************************************/	
		
		public function geAllProductsList(){
			
			$this->db->select("*");
			$this->db->from('Product');
			$this->db->where('pro_isActive','1');
			$this->db->where('proQuantity !=',0,FALSE);
			$this->db->order_by('product_create_date','DESC');
			//	$this->db->limit();
			$query = $this->db->get();
			
			if(!empty($rtnProData)){
			
				foreach($rtnProData AS $key=>$proVal){
					
					$mainImageData	= $this->GetActiveProductImg($rtnProData[$key]->pId);
					
					if(!empty($mainImageData)){
						$rtnProData[$key]->MainImageName	=	$mainImageData['productImage'] ;
						$rtnProData[$key]->MainImagePath	=	$mainImageData['product_imagePath'] ;
						}else{
						$rtnProData[$key]->MainImageName	= "";
						$rtnProData[$key]->MainImagePath	= "";
					}
				}
			
			return $rtnProData;
			
			}else{
				return $rtnProData;
			}
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
				
/*****************************************************************************
 *	Description : '@ProductsFilter' is used to Filter all product based on category and price. 
 *	Developer   : Er.Parwinder Singh
 *	DOC			: 20-April-2017	
 *****************************************************************************/	
		
		public function ProductsFilter($FilterData, $pageNo=""){
			$outofstock = $this->is_outofstock_products_display();
			
			$wherecon = "  `pro_isActive`='1' ";
			
		/****
		 * add categories Filter
		 * Developer : er.ParwinderSingh
		 * DOC		 : 21th-April-2017
		 ****/	
		
				if(!empty($FilterData['FilterCategory'])){
				
					$allCatIdString = implode("," , $FilterData['FilterCategory']);
					$wherecon .= "  AND  (  `cId` IN ( ".$allCatIdString." ) ) ";
					$this->db->order_by('cId','ASC');
				
				}
		/*** End HERE ***/				
			
		/****
		 * add Price Range Filter
		 * Developer : er.ParwinderSingh
		 * DOC		 : 21th-April-2017
		 ****/	
		 
			if(!empty($FilterData['range'])){
			
				$RangeData =  explode(';', $FilterData['range']);
				$PriceFilterFrom = $RangeData[0];
				$PriceFilterUpTo = $RangeData[1];
				$wherecon .=  " AND ( `productPrice` BETWEEN ".$PriceFilterFrom." AND ".$PriceFilterUpTo." )";
			}
			
		/*** End HERE ***/	
			
			$this->db->select("*");
			$this->db->from('Product');
			$this->db->where($wherecon);
			//$this->db->where('proQuantity !=',0,FALSE);
               if($outofstock == 0 ){
				$this->db->where('proQuantity !=',0,FALSE);
			}         
		   
			if(!empty($pageNo) ){
             $this->db->order_by('pID','DESC');
            //$this->db->order_by('cId','ASC');
				$offset = 12*$pageNo;
				$limit = 8; 	
				$this->db->limit($limit,$offset);

			
			}else{
            $this->db->order_by('product_create_date','DESC');
				$this->db->limit(12,0); 
			}
		$query = $this->db->get();
			
			$rtnProData = $query->result();	


                         // pr($rtnProData);

			
			if(!empty($rtnProData)){
			
				foreach($rtnProData AS $key=>$proVal){
					
					$mainImageData	= $this->GetActiveProductImg($rtnProData[$key]->pId);
					
					if(!empty($mainImageData)){
						$rtnProData[$key]->MainImageName	=	$mainImageData['productImage'] ;
						$rtnProData[$key]->MainImagePath	=	$mainImageData['product_imagePath'] ;
						}else{
						$rtnProData[$key]->MainImageName	= "";
						$rtnProData[$key]->MainImagePath	= "";
					}
					
					//Wishlist product of logged in user
					if (!empty($this->session->has_userdata('is_customer'))){
						
						$rtnProData[$key]->isWishlist	=	$this->IsProductInWishlist( $rtnProData[$key]->pId, $GLOBALS['curentuserID'] ) ;
					
					}else{
						$rtnProData[$key]->isWishlist	= "";
					}
					
					
				}
		
				return $rtnProData;
			
			}else{
				return $rtnProData;
			}
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
				
/*****************************************************************************
*	Description : '@GetActiveProductImg' is used to Get Product based on  passed id
*	Developer   : Er.Parwinder Singh
*	DOC			: 20-April-2017		
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
*	Description : '@IsProductInWishlist' get wish-list product
*	Developer   : PuneetSingh
*	DOC			: 14-April-2017		
******************************************************************************/	
		public function IsProductInWishlist($pid, $uid)
		{
			$this->db->select('*');
			$this->db->from('CustomerWishlist');
			$whereCon = ("`wish_pId` = ".$pid." AND `wish_uid` = ".$uid."  ");
			$this->db->where($whereCon);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0] ;
				}else{
				return false ;
			}
			
		}
		
		
		/**********************************************************************
			*	Description : Function use for Cancel order
			*	Author 		: Harish Chander	 
			*	Date		: 16 May 2017
		**********************************************************************/
		
		public function UpdateCancelorder($orderid,$curentuserID,$cancelorderre)
		{
			
			
			
		            $this->db->set('cancelReason',$cancelorderre);
					$this->db->set('is_cancel_request','1');
					
					$this->db->where('order_uid',$curentuserID);
					$this->db->where('o_id', $orderid);
					
					$cancelOrder = $this->db->update('UserOrders');
				 if($cancelOrder){	
			    echo json_encode(array('success' => '1', 'msg' => 'Cancel Order Request submit'));		
				}	
					 
			
		}
		
		public function is_outofstock_products_display(){

			$this->db->select('*');
			$this->db->from('SiteOptions');
			$whereCon = ("`optionKey` = 'is_display_outofstock_products' AND `optionType` = 'productSettings' ");
			$this->db->where($whereCon);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0]['optionValue'] ;
			}else{
				return false ;
			}



		}
		
		
		
		
	}
