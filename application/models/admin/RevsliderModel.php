<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class RevsliderModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for Insert new Rev-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	04/April/2017
		****************************************************************************/
		public function CreateNewSlide($NewslideData){
			
			return $RetnNewPro = $this->db->insert('Revslider', $NewslideData);
			
		}	
		
		
		/****************************************************************************
			Description		:	Function use for get all Rev-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	04/April/2017
		****************************************************************************/
		public function GetAllRevSlide()
		{
			$query = $this->db->get('Revslider');  
			return $query->result(); 
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for Edit Rev-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	04/April/2017
		****************************************************************************/
		public function UpdateRevSlide($data)
		
		{
			$this->db->where('rid',$data['rid']);
				return $this->db->update('Revslider',$data);
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get selected Rev-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		public function GetslectedRevSlide($slide)
		
		{
			$this->db->select('*');
			$this->db->from('Revslider');
			$this->db->where('rid',$slide);
			$query =$this->db->get();
			return $query->result();
			
		}
		
		/****************************************************************************
			Description		:	Function use for Delete selected Rev-slide 
			Developer	:	Manish Kumar Pathak
			Doc				:	05/April/2017
		****************************************************************************/
		public function DeleteRevSlide($Rid){
			$this->db->where('rid',$Rid);
			return	$query = $this->db->delete('Revslider'); 
		}
		
	}		