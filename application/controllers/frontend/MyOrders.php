<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class MyOrders extends MY_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('session','form_validation');
			$this->load->model('frontend/MyOrdersModel');
			
			if ($this->session->has_userdata('is_customer')) 
			{
				$GLOBALS['CurrentuserID'] = $this->session->userdata['is_customer']['user_id'];
			}
			/* else
			{
				//redirect('home');
			}
			 */
		}
		
		/****************************************************************************
		* Description	: 	@index is use for Get all orders Listing 
		* Developer	:	Manish Kumar Pathak
		* Date			:	15-May-2017
		****************************************************************************/
		
		public function index()
		{
		
			$pageData = array();
			
			if(!empty($this->session->has_userdata('is_customer'))){
			
			$pageData['Allorders'] = $this->MyOrdersModel->Fetch_allOrders($GLOBALS['CurrentuserID']);
			}
			
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/my_orders_view', $pageData);
			$this->load->view('frontend/templates/footer'); 
		}  
		
	 public function SingleOrderDetail($orderid='')
	 {
     if(!empty($orderid))
	 {
		 $pageData = array();
			
			if(!empty($this->session->has_userdata('is_customer'))){
			
			$pageData['singleorder'] = $this->MyOrdersModel->Fetch_SingleOrder($orderid);
			}
			
			 
	 }
	 else
	 {
		 
	      redirect('404');
  
		 
	 }
		 
	        $this->load->view('frontend/templates/header');
			$this->load->view('frontend/single_order_detail_view', $pageData);
			$this->load->view('frontend/templates/footer'); 	 	 
		 
    }

		
		
		
		
	}
