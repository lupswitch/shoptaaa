<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminPageModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for Insert new page
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function CreateNewPage($NewPageData){
			
			return $RetnNewPro = $this->db->insert('InternalPages', $NewPageData);
			
		}	
		
		
		/****************************************************************************
			Description		:	Function use for get all Psges
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function GetAllPages()
		{
			$query = $this->db->get('InternalPages');  
			return $query->result(); 
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for Edit Page 
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function UpdatePage($data)
		{
			$this->db->where('pid',$data['pid']);
				return $this->db->update('InternalPages',$data);
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get selected Page
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function GetslectedPage($page)
		{
			$this->db->select('*');
			$this->db->from('InternalPages');
			$this->db->where('pid',$page);
			$query =$this->db->get();
			return $query->result();
			
		}
		
		/****************************************************************************
			Description		:	Function use for Delete selected page 
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		****************************************************************************/
		public function DeletePage($pid)
		{
			$this->db->where('pid',$pid);
			return	$query = $this->db->delete('InternalPages'); 
		}
		
		
		/**************************************************************************************
			Description		:	Function use for Get About-us page Data in Frontend home page
			Developer	:	Manish Kumar Pathak
			Doc				:	06/April/2017
		***************************************************************************************/
		public function GetsAboutUsPage()
		{
			$this->db->select('*');
			$this->db->from('InternalPages');
			$this->db->where('pageSlug','about-us');
			$this->db->where('is_page_active','1');
			$query =$this->db->get();
			return $query->result();
			
		}
	}		