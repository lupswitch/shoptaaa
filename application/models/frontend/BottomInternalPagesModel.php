<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class BottomInternalPagesModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for get social all links 
			Developer		:	Puneet Singh
			Doc				:	07/April/2017
		****************************************************************************/
		
		public function GetBottomInternalPages(){
			
			$this->db->select('*');
			$this->db->from('InternalPages');
			$this->db->Where('is_page_active','1');
			$query =$this->db->get();
			return $query->result();
					
		}	
			
		
	}