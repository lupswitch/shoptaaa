<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Delivery extends CI_Controller 
	{
		
		public function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			$this->load->model('admin/AdminDeliveryModel');
			$this->load->model('webservices/CommonFormate');
		
			if (!$this->session->has_userdata('is_admin')) 
			{
				redirect('admin/dashboard');
			}	
			
		}	
		
		/****************************************************************************
			Description		:	Function use for View order delivery listing
			Developer	:	Manish Kumar Pathak
			Doc				:	25/April/2017
		****************************************************************************/
		
		public function index()
		{
			$pageHeader = 	array(  
									'pagetitle' => 'Delivery',
									'slug'=>'delivery',
									'font_icon'=>'truck',
								);
			
			// Get all order data //
			$data['orderdata'] = $this->AdminDeliveryModel->GetAllDeliveryOrders();
			
			// Get all user data //
			$data['userData'] = $this->AdminDeliveryModel->GetDeliveryboys();
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_delivery_view', $data);
			$this->load->view('admin/share-template/footer');
			
		}
		
		
		/****************************************************************************
			Description		:	Function use for Assign delivery boy
			Developer	:	Manish Kumar Pathak
			Doc				:	25/April/2017
		****************************************************************************/
		
		public function AssignDeliveryBoy()
		{
			
			if(isset($_POST['RequestMethod']) && $_POST['RequestMethod'] == 'AssignDeliveryBoy')
			{
				//$this->CommonFormate->pushNotificationForAssignJob($data['deleveryBoyId'], $data['o_id']);
				$data = array(
								'deleveryBoyId' => $_POST['DeliveryBoy'],
								'o_id'			=> $_POST['orderid'],
								'orderStatus'   => 'processing',
							);

				$assign = $this->AdminDeliveryModel->AssignDeliveryBoys($data);

				/*Push Notification */
				$this->CommonFormate->pushNotificationForAssignJob($data['deleveryBoyId'],$data['o_id']);
				/*Push Notification */
				
				if($assign == TRUE)
				{
					echo json_encode( array('success' => '1', 'rtnData' => $data, 'msg' => 'Successfully updated'));
				}
				else
				{
					echo json_encode( array('success' => '0','msg' => 'Not updated, Please try again !'));
				}
				
			}  
			
				
		}
		
		
	}				