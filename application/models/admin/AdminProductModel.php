<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminProductModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/*****************************************************************************
			*	Description : '@getAllProducts' Count all record of table "contact_info" in database.
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 04-April-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function Count_Products() {
			return $this->db->count_all("Product");
		}
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : '@getAllProducts' is used to fetch all Products
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		/* public function getAllProducts($limit, $start){ */
		public function getAllProducts(){
			
			$this->db->select("*");
			$this->db->from('Product');
			$this->db->order_by('pId','DESC');
			//$this->db->limit($limit, $start);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				$rtnStaffData = $query->result();	
				
				foreach($rtnStaffData AS $key=>$proVal){
					$mainImageData	= $this->GetActiveProductImg($rtnStaffData[$key]->pId);
					if(!empty($mainImageData)){
						$rtnStaffData[$key]->MainImage	=	$mainImageData['productImage'] ;
						}else{
						$rtnStaffData[$key]->MainImage	= "";
					}
				}
				
				return $rtnStaffData;
			}
			return false;
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		/*****************************************************************************
			*	Description : '@CreateNewProduct' is used Add new Products
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function CreateNewProduct($ProData, $ProImages="", $ProGalleryData ="")
		{
			
			$RetnNewPro = $this->db->insert('Product', $ProData);
			$ProId = $this->db->insert_id();
		
			if(!empty($ProId)){
				
				if(!empty($ProImages)){
					
					$ProImages['p_id'] = $ProId;
					$ProImages['is_main_img'] = '1';
					
					$this->SetNewProductMainImage($ProImages);	 /* new uploaded image */
					
				}

     /****************************************Gallery******************************************/

            if(!empty($ProGalleryData)){
				
				$ArryImg = array();
				
				foreach($ProGalleryData['Success'] AS $key => $Value){
					
					$ArryImg =  array(	
					'productImage'		=> $ProGalleryData['Success'][$key]['file_name'],
					'product_imagePath' =>'uploads/product_images/'.$ProGalleryData['Success'][$key]['file_name'],
					'is_main_img'	=> '0',
					'p_id'			=>	$ProId,	
					);
					$this->db->insert('ProductImage',$ArryImg);			
				}  
			}

				
				return true;
			}
			else
			{
				return false;
			}
			
		}	
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		/*****************************************************************************
			*	Description : `@GetAllCategories` is used Fetch all Categories. 
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function GetAllCategories(){
			
			$this->db->select("*");
			$this->db->from('Categary');
			$this->db->order_by('cat_create_date','DESC');
			$query = $this->db->get();
			
			return $rtnStaffData = $query->result();	
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		
		/*****************************************************************************
			*	Description : '@DeleteProduct' is used Delete a Single record 
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function DeleteProduct($pid){
			$this->db->where('pId',$pid);
			return	$query = $this->db->delete('Product'); 
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		/*****************************************************************************
			*	Description : '@GetSingleProduct' is used to Get Product based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function GetSingleProduct($pid){
			$this->db->select("*");
			$this->db->from('Product');
			$this->db->where('pId',$pid);
			$query = $this->db->get();
			$rtnProData = $query->result();
			//	pr($rtnProData);
			if(!empty($rtnProData)){
				$singleProData	= $rtnProData[0];
				
				
				/******
					* Get Product Main Image
				******/
				
				$getProMainDP	= $this->GetActiveProductImg($singleProData->pId); // get Pro Main DP 
				
				if(!empty($getProMainDP)){
					$singleProData->MainImage = $getProMainDP['productImage'];
					}else{
					$singleProData->MainImage = "";
				}
				
				/***  End Here ***/
				
				/******
					* Get Product Gallery Image
				******/
				
				$singleProData->GalleryImages	=	$this->Product_GalleryImages($singleProData->pId);
				
				/***  End Here ***/
				
				
				
				return $singleProData;
				}else{
				return $rtnProData;
			}
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
		/*****************************************************************************
			*	Description : '@UpdateProducts' is used to Update Product based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 29-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		public function UpdateProducts($pid, $ProData, $ProImages="", $ProGalleryData ="" ){
			

			if(!empty($ProImages)){
					
					$ProImages['p_id'] = $pid;
					$ProImages['is_main_img'] = '1';
				
					$this->SetNewProductMainImage($ProImages);	 /* new uploaded image */

			}
			
			/**** Add Product Gallery Images ****/
			
			if(!empty($ProGalleryData)){
				
				$ArryImg = array();
				
				foreach($ProGalleryData['Success'] AS $key => $Value){
					
					$ArryImg =  array(	
					'productImage'		=> $ProGalleryData['Success'][$key]['file_name'],
					'product_imagePath' =>'uploads/product_images/'.$ProGalleryData['Success'][$key]['file_name'],
					'is_main_img'	=> '0',
					'p_id'			=>	$pid,	
					);
					$this->db->insert('ProductImage',$ArryImg);			
				}  
			}
			
			$this->db->where('pId',$pid);
			return	$rntData	=	$this->db->update('Product',$ProData);
			
		}	
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		/*****************************************************************************
			*	Description : '@GetSingleProduct' is used to Get Product based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 28-March-2017
			*	DOM			: --------		
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
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	
		
		/*****************************************************************************
			*	Description : '@SetNewProductMainImage' is used to Get Product based on  passed id
			*	Developer   : Er.Parwinder Singh
			*	DOC			: 30-March-2017
			*	DOM			: --------		
		******************************************************************************/	
		
		
		
		public function SetNewProductMainImage($ImageData){
			
			$getOldSetImage = $this->GetActiveProductImg($ImageData['p_id']);
			
			if($getOldSetImage){
				$oldSetImageId = $getOldSetImage['id'];
				$disableAllProImages = array('is_main_img' =>'0');
				$this->db->where('p_id',$ImageData['p_id']);
				
					$this->db->update('ProductImage',$disableAllProImages);
				
				}else{
					$oldSetImageId = false;
				}
			
			
			$this->db->insert('ProductImage',$ImageData);
			$rtnNewDpId = $this->db->insert_id(); /* save new image into db and set current image */
			
			if($rtnNewDpId){
					return true;
			}else{
				
				$enableLastUserDps = array('is_main_img' =>'1');
				$this->db->where('id',$oldSetImageId);
				$this->db->update('ProductImage',$enableLastUserDps);
				
				$curntActDP	= $this->GetActiveProductImg($ImageData['p_id']);
				return true;
			}
			
		}
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */	
		
		
		public function Product_GalleryImages($proId){
			
			$this->db->select('*');
			$this->db->from('ProductImage');
			$whereCon = (" `p_id`=".$proId." AND `is_main_img` ='0' ");
			$this->db->where($whereCon);
			$query = $this->db->get();
			return	$rtnData = $query->result_array();
			
		}
		
		
		/*****************************************************************************
			*	Description : '@Delete Product Gallery images' 
			*	Developer   : Puneet Singh
			*	DOC			: 17-April-2017
			*	DOM			: --------		
		******************************************************************************/		
		public function DeleteGalleryImage($imgId)
		{
		
		 return $this->db->delete('ProductImage',array('imgId'=>$imgId));
		
		}
		
		
	}					
