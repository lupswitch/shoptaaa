<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminOrderModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get All Orders
			Developer	:	Manish Kumar Pathak
			Doc				:	26/April/2017
		****************************************************************************/
		public function GetAllOrders()
		{
			
			$this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->order_by('o_id','desc');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				$rtnStaffData = $query->result();
				
				foreach($rtnStaffData AS $key=>$proVal){
				
					$userData	= $this->GetUserDetail($rtnStaffData[$key]->deleveryBoyId);
					if(!empty($userData)){
						$rtnStaffData[$key]->userDetail	=	$userData['firstName'].' '.$userData['lastName'] ;
						}else{
						$rtnStaffData[$key]->userDetail	= "";
					}
				}
				
				return $rtnStaffData;
			}
			
			return false;
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Get particular user
			Developer	:	Manish Kumar Pathak
			Doc				:	26/April/2017
		****************************************************************************/
		public function GetUserDetail($uid)
		{
			
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('is_active', '1');
			$this->db->where('user_id', $uid);
			
			$query = $this->db->get();
			$rtnData = $query->result_array();
			
			if(!empty($rtnData)){
				return $rtnData[0];
				}else{
				return false;
			}
		
		}
		
		
		
		/****************************************************************************
			Description		:	Function use for Get single Orders
			Developer	:	Manish Kumar Pathak
			Doc				:	26/April/2017
		****************************************************************************/
		public function GetSingleOrder($oid)
		{
			
			$this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->where('o_id', $oid);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				
				$rtnStaffData = $query->result_array();
					$rtnStaffData = $rtnStaffData[0];
					
					$mainOrderData = array();
					
					$mainOrderData['orderDetail'] = $rtnStaffData;
					$DeliveryBoyData = $this->GetUserDetail($rtnStaffData['deleveryBoyId']);
					$mainOrderData['userData'] = $this->GetUserDetail($rtnStaffData['order_uid']);
					


					if(!empty($DeliveryBoyData)){
						$mainOrderData['DeliveryBoyData'] = $DeliveryBoyData ;
						}else{
						$mainOrderData['DeliveryBoyData']	= "";
					}  
					
					  
					
				return $mainOrderData;
			}
			
			return false;
			
		}
		
	
		/****************************************************************************
			Description		:	Function use for Get All Cancel Orders
			Developer	:	Manish Kumar Pathak
			Doc				:	17/May/2017
		****************************************************************************/
		public function GetAllCancelOrders()
		{
			$this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->where('is_cancel_request','1');
			$this->db->order_by('o_id','desc');
			$query = $this->db->get();
			$rtnStaffData = $query->result();
			return $rtnStaffData;
		}	
		/****************************************************************************
			Description		:	Function use for Get single Cancel Order
			Developer	:	Manish Kumar Pathak
			Doc				:	17/May/2017
		****************************************************************************/
		public function GetSingleCancelOrder($oid)
		{
			
			$this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->where('o_id', $oid);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) 
			{
				$rtnStaffData = $query->result_array();
				$rtnStaffData = $rtnStaffData[0];
				$mainOrderData = array();
				$mainOrderData['orderDetail'] = $rtnStaffData;
				$mainOrderData['userData'] = $this->GetUserDetail($rtnStaffData['order_uid']);
				if(!empty($rtnStaffData['deleveryBoyId']))
				{
					$mainOrderData['DeliveryBoyData'] = $DeliveryBoyData = $this->GetUserDetail($rtnStaffData['deleveryBoyId']);
				}
				else
				{
					$mainOrderData['DeliveryBoyData']	= "";
				} 
				// pr($mainOrderData);
				return $mainOrderData;
			}
			return false;
		}
		
		

	}		