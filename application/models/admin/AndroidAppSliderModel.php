<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AndroidAppSliderModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for get all App-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	04/April/2017
		****************************************************************************/
		public function GetAllAppSlide()
		{
			$query = $this->db->get('WelcomeImage');  
			return $query->result(); 
		}
		
		
		/****************************************************************************
			Description		:	Function use for Edit App-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	28/April/2017
		****************************************************************************/
		public function UpdateAppSlide($data)
		
		{
			$this->db->where('id',$data['id']);
				return $this->db->update('WelcomeImage',$data);
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get selected App-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	28/April/2017
		****************************************************************************/
		public function GetslectedAppSlide($slideID)
		
		{
			$this->db->select('*');
			$this->db->from('WelcomeImage');
			$this->db->where('id',$slideID);
			$query =$this->db->get();
			return $query->result();
			
		}
		
		
		
	}		