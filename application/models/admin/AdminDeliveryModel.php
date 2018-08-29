<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminDeliveryModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get All Delivery Orders
			Developer	:	Manish Kumar Pathak
			Doc				:	25/April/2017
		****************************************************************************/
		public function GetAllDeliveryOrders()
		{
			
			$this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->where('orderStatus','pending');
			$this->db->or_where('orderStatus','processing');
			$this->db->order_by('orderAt','DESC');
			
			$query = $this->db->get();  
			return $query->result(); 
			
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for update Delivery Orders
			Developer	:	Manish Kumar Pathak
			Doc				:	25/April/2017
		****************************************************************************/
		public function UpdateDeliveryOrders($data)
		{
			$this->db->where('o_id',$data['o_id']);
			return $this->db->update('UserOrders',$data);
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get delivery boy
			Developer	:	Manish Kumar Pathak
			Doc				:	25/April/2017
		****************************************************************************/
		public function GetDeliveryboys()
		{
			
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('userType','deliveryboy');
			$this->db->where('is_active','1');
			$query =$this->db->get();
			return $query->result();
			
		}
		
		
		
		/****************************************************************************
			* Description	: 	Function is use Assign Deivery boy
			* Developer	:	Manish Kumar Pathak
			* Date			:	25-April-2017
		****************************************************************************/
		
		public function AssignDeliveryBoys($data)
		{					
			
			$this->db->where('o_id',$data['o_id']);
			return	$this->db->update('UserOrders',$data);
			
		}
		
	}			