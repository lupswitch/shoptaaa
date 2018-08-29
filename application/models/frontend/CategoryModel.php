<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class CategoryModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		/*************************************************************************************************
		*	Description : '@getSelectedParentCategory' is used to fetch category grid on home page
		*	Developer   : Er.Parwinder Singh
		*	DOC			: 14-April-2017	
		**************************************************************************************************/	
		
		public function getSelectedParentCategory(){
				
			
			$this->db->select('*');
			$this->db->from('Categary');
			$this->db->where('parent_cat','0');
			$this->db->where('is_cat_active','1');
			$query = $this->db->get();
			return $query->result();
		}
		
		/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

		
			
/*****************************************************************************
*	Description : `@GetAllParentCategories` is used Fetch all Categories. 
*	Developer   : Er.Parwinder Singh
*	DOC			: 29-March-2017
*	DOM			: --------		
******************************************************************************/	
	
	
	public function GetAllParentCategories($orderBy="" ,$limit="", $start=""){
			
		$this->db->select("*");
			$this->db->from('Categary');
			$this->db->where('parent_cat','0');
			$this->db->where('is_cat_active','1');
		/*	if(!empty($orderBy)){
				$orderBy = " ".$orderBy['orderBy']." = ".$orderBy['sort']. " ";
				
				$this->db->order_by( $orderBy );
			}
			*/
		 	$this->db->order_by('categaryName','ASC'); 
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
	
	public function CountSubCat_CurrentParentCategory($cid){
		
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
			$this->db->where('is_cat_active','1');
			$this->db->order_by('categaryName','ASC');
		$query = $this->db->get();
		
		$rtnCatData = $query->result();	
			
			foreach($rtnCatData as $key=> $catVal){
				$rtnCatData[$key]->count_subCat = $this->CountSubCat_CurrentParentCategory($catVal->c_id);
			}
		
		return $rtnCatData;
	}	
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

		
		
		
		
		
		
		
		
		
		
		
		
	}	