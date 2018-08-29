<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminOrders extends CI_Controller {
		
		public function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			
			$this->load->model('admin/AdminOrderModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('admin/dashboard');
			}	
			
		}	
		
		/****************************************************************************
			Description		:	Function use for View all orders
			Developer	:	Manish Kumar Pathak
			Doc				:	26/April/2017
		****************************************************************************/
		
		public function index()
		{
			$pageHeader = 	array(  'pagetitle' => 'Orders',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
			
			//  Get All orders data //
			$data['orderData'] = $this->AdminOrderModel->GetAllOrders();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_orders_listing_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for view single Page order
			Developer	:	Manish Kumar Pathak
			Doc				:	26/April/2017
		****************************************************************************/
		
		public function GetSingleOrder($oid)
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
			
			//  Get single orders data //
			$data['singleOrderData'] = $this->AdminOrderModel->GetSingleOrder($oid);
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_single_orders_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Cancel Order Page
			Developer	:	Manish Kumar Pathak
			Doc				:	17/May/2017
		****************************************************************************/
		
		public function AdminCancelOrders()
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
			
			//  Get single orders data //
			$data['cancelOrderData'] = $this->AdminOrderModel->GetAllCancelOrders();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_cancel_orders_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
	
		/****************************************************************************
			Description		:	Function use for view single Page order
			Developer	:	Manish Kumar Pathak
			Doc				:	26/April/2017
		****************************************************************************/
		
		public function GetSingleCancelOrder($oid)
		{
			
			$pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
			
			//  Get single orders data //
			$data['singleCancelOrderData'] = $this->AdminOrderModel->GetSingleCancelOrder($oid);
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_single_cancel_orders_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}	
		
		
	}				