<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ProductFrontendModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
			
			if ($this->session->has_userdata('is_customer')) 
			{
				$GLOBALS['curentuserID'] = $this->session->userdata['is_customer']['user_id'];
			}
		}
		
		/*****************************************************************************
			*	Description : '@getNewProducts' is used to fetch all Products
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 04-April-2017	
		******************************************************************************/	
		
		public function getAllProductsList($limit=""){
			$outofstock = $this->is_outofstock_products_display();
			
			$this->db->select("*");
			$this->db->from('Product');
			
			$this->db->where('pro_isActive','1');
			//$this->db->where('proQuantity !=',0,FALSE);

           if($outofstock == 0 ){
				$this->db->where('proQuantity !=',0,FALSE);
			}
            $this->db->order_by('product_create_date','DESC');
				
			if(!empty($limit)){ /* set limit */
				$this->db->limit($limit);
			}
			
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
				
				//Wishlist product of logged in user
					if (!empty($this->session->has_userdata('is_customer'))){
						
						$rtnStaffData[$key]->isWishlist	=	$this->IsProductInWishlist( $rtnStaffData[$key]->pId, $GLOBALS['curentuserID'] ) ;
					
					}else{
						$rtnStaffData[$key]->isWishlist	= "";
					}
				
			}
			
			return $rtnStaffData;
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		/*****************************************************************************
			*	Description : '@getNewProducts' is used to fetch New Products
			*	Developer   : Puneet Singh
			*	DOC			: 04-April-2017	
		******************************************************************************/	
		
		public function getNewProductsHome(){
			
			$outofstock = $this->is_outofstock_products_display();
			$this->db->select("*");
			$this->db->from('Product');
			
			$this->db->where('pro_isActive','1');
			$this->db->where('pro_isNewArrivals','1');
            if($outofstock == 0 ){
				$this->db->where('proQuantity !=',0,FALSE);
			}    

			//$this->db->where('proQuantity !=',0,FALSE);
			$this->db->order_by('product_create_date','DESC');
			$this->db->limit(10);
			$query = $this->db->get(); 
			
			$rtnStaffData = $query->result();	
			
			if(!empty($rtnStaffData)){
			
				foreach($rtnStaffData AS $key=>$proVal){
					
					$mainImageData	= $this->GetActiveProductImg($rtnStaffData[$key]->pId);
					
					if(!empty($mainImageData)){
						$rtnStaffData[$key]->MainImage	=	$mainImageData['productImage'] ;
						}else{
						$rtnStaffData[$key]->MainImage	= "";
					}
					
					//Wishlist product of logged in user
					if (!empty($this->session->has_userdata('is_customer')))
					{
						$rtnStaffData[$key]->isWishlist	=	$this->IsProductInWishlist( $rtnStaffData[$key]->pId, $GLOBALS['curentuserID'] ) ;
					}
					else
					{
						$rtnStaffData[$key]->isWishlist	= "";
					}
					
				}
				
				return $rtnStaffData;
			
			}else{
				return $rtnStaffData;
			}
			
			
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : '@getNewProducts' is used to fetch New Products
			*	Developer   : Puneet Singh
			*	DOC			: 04-April-2017	
		******************************************************************************/	
		
		public function getFeaturedProductsHome(){
			$outofstock = $this->is_outofstock_products_display();
			$this->db->select("*");
			$this->db->from('Product');
			$this->db->where('pro_isActive','1');
			$this->db->where('pro_isFeature','1');
			//$this->db->where('proQuantity !=',0,FALSE);
            if($outofstock == 0 ){
				$this->db->where('proQuantity !=',0,FALSE);
			}    
            $this->db->order_by('product_create_date','DESC');
			$this->db->limit(10);
			$query = $this->db->get();
			
			$rtnStaffData = $query->result();	
		
			
			foreach($rtnStaffData AS $key=>$proVal){
				
				$mainImageData	= $this->GetActiveProductImg($rtnStaffData[$key]->pId);
				
				if(!empty($mainImageData)){
					$rtnStaffData[$key]->MainImage	=	$mainImageData['productImage'] ;
					}else{
					$rtnStaffData[$key]->MainImage	= "";
				}
				
				//Wishlist product of logged in user
				if (!empty($this->session->has_userdata('is_customer')))
				{
					$rtnStaffData[$key]->isWishlist	=	$this->IsProductInWishlist( $rtnStaffData[$key]->pId, $GLOBALS['curentuserID'] ) ;
				}
				else
				{
					$rtnStaffData[$key]->isWishlist	= "";
				}
				
			}
			
			return $rtnStaffData;
			
			
			
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
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
			*	Description : '@GetSingleProduct' all data of single product
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 14-April-2017		
		******************************************************************************/	
		
		function GetSingleProduct($slugId, $isGallery ='yes'){
			$this->db->select("*");
			$this->db->from('Product');
			
			$whereCon = "( `pro_isActive` = '1' AND ( `pro_slug` = '".$slugId."' OR  `pId`= '".$slugId."' ))";
			
			$this->db->where($whereCon);
			$query = $this->db->get();
			$rtnProData = $query->result();	
			
			
			
			if(!empty($rtnProData)){
				$rtnProData = $rtnProData[0];
				
				
				$rtnProData->CatName = $this->GetAssignedCategoryName($rtnProData->pId);
				
				
				// Get Main Image of product
				
				$mainImageData	= $this->GetActiveProductImg($rtnProData->pId);
				
				if(!empty($mainImageData)){
					$rtnProData->MainImageName	=	$mainImageData['productImage'] ;
					$rtnProData->MainImagePath	=	$mainImageData['product_imagePath'] ;
					
					}else{
					$rtnProData->MainImageName	= "";
					$rtnProData->MainImagePath	= "";
				}
				
				//get Product Gallery Images
				
				if($isGallery =="yes"){
				
					$GalleryData = $this->Product_GalleryImages($rtnProData->pId);
					
					if(!empty($GalleryData)){
						
						$rtnProData->GalleryImages	=	$GalleryData;
						}else{
						$rtnProData->GalleryImages	=	"";
					}
				}
				//Wishlist product of logged in user
				if (!empty($this->session->has_userdata('is_customer')))
				{
					$rtnProData->isWishlist	=	$this->IsProductInWishlist( $rtnProData->pId, $GLOBALS['curentuserID'] ) ;
				}
				else
				{
					$rtnProData->isWishlist	= "";
				}
				
			}
			
			return $rtnProData;
		}	
		
		
		/*****************************************************************************
			*	Description : 'Product_GalleryImages' all data of gallery images
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 14-April-2017		
		******************************************************************************/	
		public function Product_GalleryImages($proId){
			
			$this->db->select('*');
			$this->db->from('ProductImage');
			$whereCon = (" `p_id`=".$proId." AND `is_main_img` ='0' ");
			$this->db->where($whereCon);
			$query = $this->db->get();
			return	$rtnData = $query->result_array();
			
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
	/*****************************************************************************
	*	Description : '@IsProductInWishlist' get wish-list product
	*	Developer   : PuneetSingh
	*	DOC			: 14-April-2017		
	******************************************************************************/	
		public function GetAssignedCategoryName($cid){
		
			$this->db->select('`categaryName`');
			$this->db->from('Categary');
			$this->db->where('c_id',$cid);
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0]['categaryName'] ;
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
		public function get_zero_quanitity_pro()

		{

         $this->db->select("*");
		 $this->db->from('Product');
         $this->db->where('proQuantity <=',0,FALSE);
         $query = $this->db->get();
		 $rtnData = $query->result_array();
         if(!empty( $rtnData)){

         	return  $rtnData;
         }
         else
         {

         	return false;
         }

                
		}

		
		
	}						