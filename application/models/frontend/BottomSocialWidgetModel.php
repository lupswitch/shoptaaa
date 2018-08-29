<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class BottomSocialWidgetModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for get social all links 
			Developer		:	Puneet Singh
			Doc				:	07/April/2017
		****************************************************************************/
		
		public function GetSocialLinksWidget(){
			
			$this->db->select('*');
			$this->db->from('SiteOptions');
			$this->db->Where('optionType','socialSetting');
			$query =$this->db->get();
			return $query->result();
					
		}	
			
		
	}		