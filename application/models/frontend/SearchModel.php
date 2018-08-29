<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SearchModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
			
			if ($this->session->has_userdata('is_customer')) 
			{
				$GLOBALS['curentuserID'] = $this->session->userdata['is_customer']['user_id'];
			}
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for get social all links 
			Developer		:	Puneet Singh
			Doc				:	12/April/2017
		****************************************************************************/
		
		public function Keyword($keyword)
		{
			$outofstock = $this->is_outofstock_products_display();
			$this->db->select('*');
			$this->db->from('Product');
			$this->db->join('Categary', 'Categary.c_id = Product.cId','LEFT JOIN');
			$whereCon = " `Product`.`pro_isActive` = '1' AND ( `Product`.`productName` LIKE '%".$keyword."%' ESCAPE '!' OR `Product`.`productDescription` LIKE '%".$keyword."%' ESCAPE '!')  ";
			$this->db->where($whereCon);

		    if($outofstock == 0 ){
				$this->db->where('proQuantity !=',0,FALSE);
			}

			$this->db->distinct('Product.productName');
			$this->db->limit(10);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				$result = $query->result();
				foreach($result AS $key => $proVal){
					
					//GET PRODUCT IMAGE 
					$mainImageData	= $this->GetActiveProductImg($result[$key]->pId);
					if(!empty($mainImageData)){
						$result[$key]->MainImage	=	$mainImageData['productImage'] ;
						}else{
						$result[$key]->MainImage = "";
					}
					
					//Wishlist product of logged in user
					if (!empty($this->session->has_userdata('is_customer')))
					{
						$result[$key]->isWishlist	=	$this->IsProductInWishlist( $result[$key]->pId, $GLOBALS['curentuserID'] ) ;
					}
					else
					{
						$result[$key]->isWishlist	= "";
					}
					
				}
				return $result;
			}
			return false;
		}	
		
		
		
		/*****************************************************************************
			*	Description : '@GetSingleProduct' is used to Get Product based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 13-April-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		function GetActiveProductImg($pid){
			$this->db->select('*');
			$this->db->from('ProductImage');
			$whereCon = ("`p_id` = ".$pid." AND `is_main_img` ='1' ");
			$this->db->where($whereCon);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0];
				}else{
				return $rtnData;
			}	 
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