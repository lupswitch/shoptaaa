<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminPaymentRefundModel extends CI_Model {
		
		function __construct(){
			// Call the Model constructor
			parent::__construct();
		}
		/*********************************Refund for website****************************/
		public function PaypalRefund($oid)
		{
		    $this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->where('o_id', $oid);
			$this->db->where('order_device_mode','website');
			$query = $this->db->get();
			$rtnStaffData = $query->result_array();
			return $rtnStaffData[0];
		}	
		
		/*********************************Refund for app********************************************/
		public function PaypalRefundForApp($oid)
		{
		    $this->db->select("*");
			$this->db->from('UserOrders');
			$this->db->where('o_id', $oid);
			$this->db->where('order_device_mode','app');
			$query = $this->db->get();
			$rtnStaffData = $query->result_array();
			return $rtnStaffData[0];
		}	
		public function UpdateOrderStatus($orderid)
	    {
			$this->db->where('o_id', $orderid);
			$this->db->update('UserOrders', array('orderStatus' => 'refund'));
			return true;
		}
	  
	   public function UpdateOrderStatusForApp($transactionId )
	     {
	      
	        $this->db->where('transactionId', $transactionId);
			$this->db->update('UserOrders', array('orderStatus' => 'refund'));
			return true;
	     }
	  
}