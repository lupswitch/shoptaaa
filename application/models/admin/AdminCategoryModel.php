	<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class AdminCategoryModel extends CI_Model {

		function __construct()
		{
			// Call the Model constructor
			parent::__construct();
		}
		

	/*****************************************************************************
	*	Description : '@CreateNewProduct' is used Add new Products
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 28-March-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		public function CreateNewCategory($NewCatData){
			return $RetnNewCat = $this->db->insert('Categary', $NewCatData);
			//$Userlastid = $this->db->insert_id();
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
			
			return $rtnCatData = $query->result();	
				
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
		
	/*****************************************************************************
	*	Description : '@Count_ParentCategories' Count all record of table "Categary" in database.
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 04-April-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		public function Count_ParentCategories() {
			$this->db->select("*");
				$this->db->where('parent_cat','0');
			return $this->db->count_all("Categary");
		}

	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
	/*****************************************************************************
	*	Description : `@GetAllCategories` is used Fetch all Categories. 
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 29-March-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		
		public function GetAllParentCategories($limit="", $start=""){
				
			$this->db->select("*");
				$this->db->from('Categary');
				$this->db->where('parent_cat','0');
				
				
				$this->db->order_by('cat_create_date','DESC');
			/*	$this->db->limit($limit, $start); */
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
			
				$rtnCatData = $query->result();	
					foreach($rtnCatData as $key=> $catVal){
						$rtnCatData[$key]->count_subCat = $this->CountSubCat_CurrentParentCategory($catVal->c_id); /* get counts */
						$rtnCatData[$key]->subCat_list = $this->FetchAll_SubCategories($catVal->c_id); /* get allsun cat*/
					}
				return $rtnCatData;
			}
			return false;
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */



	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
		
	/*****************************************************************************
	*	Description : `@GetAllCategories` is used Fetch active Categories. 
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 29-March-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		
		public function GetActiveParentCategories($limit="", $start=""){
				
			$this->db->select("*");
				$this->db->from('Categary');
				$this->db->where('parent_cat','0');
				
				$this->db->where('is_cat_active','1');
				$this->db->order_by('cat_create_date','DESC');
			/*	$this->db->limit($limit, $start); */
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
			
				$rtnCatData = $query->result();	
					foreach($rtnCatData as $key=> $catVal){
						$rtnCatData[$key]->count_subCat = $this->CountActiveSubCat_CurrentParentCategory($catVal->c_id); /* get counts */
						$rtnCatData[$key]->subCat_list = $this->FetchActive_SubCategories($catVal->c_id); /* get allsun cat*/
					}
				return $rtnCatData;
			}
			return false;
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */











		
		public function CountSubCat_CurrentParentCategory($cid){
			
			$this->db->select("Count(*) as SubCat_count");
				$this->db->from('Categary');
				$this->db->where('parent_cat',$cid);
			$query = $this->db->get();
			
			$rtnCatData = $query->result_array();	
			
			if(!empty($rtnCatData)){
				return $rtnCatData[0]['SubCat_count'];
			}else{
				return '0';
			}
			
		}


	/***********************************************************************/


	public function CountActiveSubCat_CurrentParentCategory($cid){
			
			$this->db->select("Count(*) as SubCat_count");
				$this->db->from('Categary');
				$this->db->where('parent_cat',$cid);
				$this->db->where('is_cat_active','1');
			$query = $this->db->get();
			
			$rtnCatData = $query->result_array();	
			
			if(!empty($rtnCatData)){
				return $rtnCatData[0]['SubCat_count'];
			}else{
				return '0';
			}
			
		}




		
	/*****************************************************************************
	*	Description : '@FetchAll_SubCategories' is used get all sub categories of parent cat based on id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 4th-April-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		public function FetchAll_SubCategories($cid){
			
			$this->db->select("*");
				$this->db->from('Categary');
				$this->db->where('parent_cat',$cid);
				$this->db->order_by('cat_create_date','DESC');
			$query = $this->db->get();
			
			$rtnCatData = $query->result();	
				
				foreach($rtnCatData as $key=> $catVal){
					$rtnCatData[$key]->count_subCat = $this->CountSubCat_CurrentParentCategory($catVal->c_id);
				}
			
			return $rtnCatData;
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	/*****************************************************************************
	*	Description : '@FetchAll_SubCategories' is used get Active sub categories of parent cat based on id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 4th-April-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		public function FetchActive_SubCategories($cid){
			
				$this->db->select("*");
				$this->db->from('Categary');
				$this->db->where('parent_cat',$cid);
				$this->db->where('is_cat_active','1');
				$this->db->order_by('cat_create_date','DESC');
				$query = $this->db->get();
			
			$rtnCatData = $query->result();	
				
				foreach($rtnCatData as $key=> $catVal){
					$rtnCatData[$key]->count_subCat = $this->CountSubCat_CurrentParentCategory($catVal->c_id);
				}
			
			return $rtnCatData;
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */





	/*****************************************************************************
	*	Description : '@DeleteCategory' is used Delete a Single record 
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 28-March-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		public function DeleteCategory($cid){
			$this->db->where('c_id',$cid);
			return	$query = $this->db->delete('Categary'); 
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	/*****************************************************************************
	*	Description : '@GetSingleCategory' is @return single cat record based on Id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 29-March-2017
	*	DOM			: --------		
	******************************************************************************/	

		
		public function GetSingleCategory($cid){
			$this->db->select("*");
				$this->db->from('Categary');
				$this->db->where('c_id',$cid);
			$query = $this->db->get();
			$rtnCatData = $query->result();
			
			if(!empty($rtnCatData)){
				return $rtnCatData[0];
			}else{
				return $rtnCatData;
			}
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */


	/*****************************************************************************
	*	Description : '@UpdateCategory' is used to Update Category based on  passed id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 29-March-2017
	*	DOM			: --------		
	******************************************************************************/	
		
		public function UpdateCategory($cid, $CatData){
					$this->db->where('c_id',$cid);
			return	$rntData	=	$this->db->update('Categary',$CatData);
			
		}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */


		
		
		
		
		
	}	