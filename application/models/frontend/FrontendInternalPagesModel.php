<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class FrontendInternalPagesModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get internal Pages
			Developer		:	Puneet Singh
			Doc				:	06/April/2017
		****************************************************************************/
		public function GetInternalPage($slug)
		{
			$this->db->select('*');
			$this->db->from('InternalPages');
			$this->db->where('pageSlug',$slug);
			$query =$this->db->get();
			return $query->result();
			
		}
		
	}		