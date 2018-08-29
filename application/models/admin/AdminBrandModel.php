	<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class AdminBrandModel extends CI_Model {

	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}


	/*****************************************************************************
	*	Description : '@CreateNewBrand' is used Add new Products
	*	Developer	:	Manish Kumar Pathak
	*	DOC			: 04-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function CreateNewBrand($NewBrandData){
		return $RetnNewCat = $this->db->insert('Brands', $NewBrandData);
		//$Userlastid = $this->db->insert_id();
	}	

	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	/*****************************************************************************
	*	Description : `@GetAllBrand` is used Fetch all Categories. 
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 29-March-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function GetAllBrand(){
			
		$this->db->select("*");
			$this->db->from('Brands');
			$this->db->order_by('Brand_create_date','DESC');
		$query = $this->db->get();
		
		return $rtnCatData = $query->result();	
			
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */


	/*****************************************************************************
	*	Description : '@Count_ParentBrand' Count all record of table "Brands" in database.
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 04-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function Count_ParentBrand() {
		$this->db->select("*");
			$this->db->where('parentBrand','0');
		return $this->db->count_all("Brands");
	}

	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	/*****************************************************************************
	*	Description : `@GetAllParentBrands` is used Fetch all Main Brands. 
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 05-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function GetAllParentBrands($limit="", $start=""){
			
		$this->db->select("*");
			$this->db->from('Brands');
			$where = " `parentBrand` IS NULL ";
			$this->db->where($where);
			$this->db->order_by('Brand_create_date','DESC');
		/*	$this->db->limit($limit, $start); */
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
		
			$rtnCatData = $query->result();	
			
				foreach($rtnCatData as $key=> $BrandVal){
					$rtnCatData[$key]->count_subBrand = $this->CountSubBrand_CurrentParentBrand($BrandVal->BrandId); /* get counts */
					$rtnCatData[$key]->subBrand_list = $this->FetchAll_SubBrands($BrandVal->BrandId); /* get all SUB Brand*/
				}
			return $rtnCatData;
		}
		return false;
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */



	/*****************************************************************************
	*	Description : `@GetAllParentBrands` is used Fetch all Main Brands. 
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 05-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function GetActiveParentBrands($limit="", $start=""){
			
		$this->db->select("*");
			$this->db->from('Brands');
			$where = " `parentBrand` IS NULL ";
			$this->db->where($where);
			
			$this->db->where('is_brand_active','1');
			$this->db->order_by('Brand_create_date','DESC');
		/*	$this->db->limit($limit, $start); */
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
		
			$rtnCatData = $query->result();	
			
				foreach($rtnCatData as $key=> $BrandVal){
					$rtnCatData[$key]->count_subBrand = $this->CountActiveSubBrand_CurrentParentBrand($BrandVal->BrandId); /* get counts */
					$rtnCatData[$key]->subBrand_list = $this->FetchActive_SubBrands($BrandVal->BrandId); /* get all SUB Brand*/
				}
			return $rtnCatData;
		}
		return false;
	}	




	public function CountActiveSubBrand_CurrentParentBrand($bid){
		
		$this->db->select("Count(*) as SubBrand_count");
		$this->db->from('Brands');
		$this->db->where('parentBrand',$bid);
		$this->db->where('is_brand_active','1');
		$query = $this->db->get();
		
		$rtnCatData = $query->result_array();	
		
		if(!empty($rtnCatData)){
			return $rtnCatData[0]['SubBrand_count'];
		}else{
			return '0';
		}
		
	}
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	public function CountSubBrand_CurrentParentBrand($bid){
		
		$this->db->select("Count(*) as SubBrand_count");
		$this->db->from('Brands');
		$this->db->where('parentBrand',$bid);
		$query = $this->db->get();
		
		$rtnCatData = $query->result_array();	
		
		if(!empty($rtnCatData)){
			return $rtnCatData[0]['SubBrand_count'];
		}else{
			return '0';
		}
		
	}
	/*****************************************************************************
	*	Description : '@FetchAll_SubBrands' is used get all sub Brand of parent Brand based on id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 5th-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function FetchAll_SubBrands($bid){
		
		$this->db->select("*");
			$this->db->from('Brands');
			$this->db->where('parentBrand',$bid);
			$this->db->order_by('Brand_create_date','DESC');
		$query = $this->db->get();
		
		$rtnCatData = $query->result();	
			
			foreach($rtnCatData as $key=> $BVal){
				$rtnCatData[$key]->count_subBrand = $this->CountSubBrand_CurrentParentBrand($BVal->BrandId);
			}
		
		return $rtnCatData;
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	/*****************************************************************************
	*	Description : '@FetchAll_SubBrands' is used get active sub Brand of parent Brand based on id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 5th-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function FetchActive_SubBrands($bid){
		
		$this->db->select("*");
			$this->db->from('Brands');
			$this->db->where('parentBrand',$bid);
			$this->db->where('is_brand_active','1');
			$this->db->order_by('Brand_create_date','DESC');
		$query = $this->db->get();
		
		$rtnCatData = $query->result();	
			
			foreach($rtnCatData as $key=> $BVal){
				$rtnCatData[$key]->count_subBrand = $this->CountSubBrand_CurrentParentBrand($BVal->BrandId);
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

	public function DeleteBrand($cid){
		$this->db->where('BrandId',$cid);
		return	$query = $this->db->delete('Brands'); 
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */

	/*****************************************************************************
	*	Description : '@GetSingleBrand' is @return single Brand record based on Id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 05th-April-2017
	*	DOM			: --------		
	******************************************************************************/	


	public function GetSingleBrand($cid){
		$this->db->select("*");
			$this->db->from('Brands');
			$this->db->where('BrandId',$cid);
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
	*	Description : '@UpdateBrand' is used to Update Brand based on  passed id
	*	Developer   : Er.Parwinder Singh
	*	DOC			: 05-April-2017
	*	DOM			: --------		
	******************************************************************************/	

	public function UpdateBrand($cid, $BrandData){
			$this->db->where('BrandId',$cid);
		return	$rntData	=	$this->db->update('Brands',$BrandData);
	}	
	/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */







	}	