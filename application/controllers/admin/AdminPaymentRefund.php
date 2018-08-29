<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	    
	class AdminPaymentRefund extends MY_Controller {
		
		public function  __construct(){
			
			parent:: __construct();
			
			$this->load->helper(array('form','url','text'));
			$this->load->library(array('session','form_validation'));
			
			$this->load->model('admin/AdminPaymentRefundModel');
			
			if (!$this->session->has_userdata('is_admin')) {
				redirect('admin/dashboard');
			}	
			
		}
		
		/**************************************************************************************************
		
		    This function for website
		
		*************************************************************************************************/
		
		public function PaypalRefund($orderId){
		   
		   
		   $pagedata['paypalrefundData'] = $this->AdminPaymentRefundModel->PaypalRefund($orderId);
		   $pagedata['currentorderid'] = $orderId;
		   
		   $pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
			
			
			if(isset($_POST['submit'])){
				
				$pagedata['transDetailsResponse']= $this->ActionPaypalRefund();
				
			}
			
			if(isset($_POST['RefundBtn']))
			{
				$pagedata['refundResponse']= $this->RefundLastStep();
				
			 }
			
			
			
			$this->load->view('admin/share-template/header', $pageHeader);
			$this->load->view('admin/admin_order_paymentrefund_view',$pagedata);
			$this->load->view('admin/share-template/footer');
				
				
		}
	
		/**************************************************************************************************
		
		    This function for App
		
		*************************************************************************************************/
		
		public function PaypalRefundForApp($orderId){
		   
		   
		   $pagedata['paypalrefundData'] = $this->AdminPaymentRefundModel->PaypalRefundForApp($orderId);
		   $pagedata['currentorderid'] = $orderId;
		   
		   $pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
			
			
			if(isset($_POST['submit'])){
				
				$pagedata['transDetailsResponse']= $this->ActionPaypalRefundForApp();
				
			}
			elseif (isset($_POST['RefundBtn']))
			{
				$pagedata['refundResponse']= $this->RefundLastStepForApp();
				
			 }
			
			
			else{
		 $this->load->view('admin/share-template/header', $pageHeader);
		 $this->load->view('admin/admin_order_paymentrefundforapp_view',$pagedata);
		 $this->load->view('admin/share-template/footer');
				
			}		
		}
	
	
	
	
	
	
	
	
	
	
	/**************************************************************************************************************
	  function "this function is used for get buyer details"
	
	    
	*************************************************************************************************************/
	   public function ActionPaypalRefund()	 
	   {
		   require_once('paypalrefund/PPBootStrap.php');
           $transactionID_err = "";
           if (isset($_POST['transID'])) {
				/*
			   * The GetTransactionDetails API operation obtains information about a specific transaction.
				*/
				$transactionDetails = new GetTransactionDetailsRequestType();
				/*
				* Unique identifier of a transaction.
				*/
				$transactionDetails->TransactionID = $_POST['transID'];
				$request = new GetTransactionDetailsReq();
				$request->GetTransactionDetailsRequest = $transactionDetails;
				$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
			try {
				/* wrap API method calls on the service object with a try catch */
				$transDetailsResponse = $paypalService->GetTransactionDetails($request);
				
				//pr($transDetailsResponse);
				
				} 

			catch (Exception $ex) 
			   {
				include_once("paypalrefund/Error.php");
				exit;
			   }
			if ($transDetailsResponse->Ack == 'Failure') 
			   {
				//$transactionID_err = 'TransactionID is not valid.';
				return $transDetailsResponse;;
			   }
			if ($transDetailsResponse->Ack == 'Success')
				{
				
				return $transDetailsResponse;
				}
			
			
			}

		 
 }
	   
	 /**************************************************************************************************************
	   Send Payment for Refund
	 **************************************************************************************************************/
	   
	   public function RefundLastStep()
	   
	   {
	      	   
	    require_once('paypalrefund/PPBootStrap.php');
		$refundReqest = new RefundTransactionRequestType();

        if ($_REQUEST['amt'] != "" && strtoupper($_POST['refundType']) != "FULL") 
	    {
        $refundReqest->Amount = new BasicAmountType($_REQUEST['currencyID'], $_REQUEST['amt']);
		}
		$refundReqest->RefundType = $_REQUEST['refundType'];
		$refundReqest->TransactionID = $_REQUEST['transID'];
		$refundReqest->RefundSource = $_REQUEST['refundSource'];
		$refundReqest->Memo = $_REQUEST['memo'];
			/*
					 * 
					  (Optional) Maximum time until you must retry the refund.
					 */
					$refundReqest->RetryUntil = $_REQUEST['retryUntil'];

					$refundReq = new RefundTransactionReq();
					$refundReq->RefundTransactionRequest = $refundReqest;

					/*
					 * 	 ## Creating service wrapper object
					  Creating service wrapper object to make API call and loading
					  Configuration::getAcctAndConfig() returns array that contains credential and config parameters
					 */
					$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
					try {
						/* wrap API method calls on the service object with a try catch */
						$refundResponse = $paypalService->RefundTransaction($refundReq);
					} catch (Exception $ex) {
						include_once("paypalrefund/Error.php");
						exit;
					}
					if (isset($refundResponse)) {
						
						
					$this->AdminPaymentRefundModel->UpdateOrderStatus($_POST['orderid']);
					return $refundResponse;
						
						
					}
				}
	/**************************************************************************************************
	
	This function used for app
	
	*************************************************************************************************/
	
	public function ActionPaypalRefundForApp()
	{
	    
	  require_once APPPATH.'third_party/paypal-transaction-detail/index.php';
	  
        // echo "test";
       //pr($jsondata);
	    
	    
	}
	
	public function RefundLastStepForApp()
	{
	    
	  require_once APPPATH.'third_party/paypal-transaction-detail/index.php';  
	}
		
	   
	}
