<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class PaypalController extends CI_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->model('admin/Paypal_express');
		}
		public function index()
		{		
			
			include_once("config.php");
			$this->load->view('front/paypalexpress');
			
		}
		function config()
		{
			
			
			//start session in all pages
			if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
			//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above
			
			// sandbox or live
			$details = $this->Paypal_express->api_details();
			
			//mode of paypal..
			$mode_pay = $details->PPL_API_mode;
			
			define('PPL_MODE', $mode_pay);
			
			if(PPL_MODE== $mode_pay){
				
				
				/**api details from admin side**/
				
				
				define('PPL_API_USER', $details->PPL_API_USER);
				define('PPL_API_PASSWORD', $details->PPL_API_PASSWORD);
				define('PPL_API_SIGNATURE',$details->PPL_API_SIGNATURE);
			}
			else{
				
				define('PPL_API_USER', $details->PPL_API_USER);
				define('PPL_API_PASSWORD', $details->PPL_API_PASSWORD);
				define('PPL_API_SIGNATURE',$details->PPL_API_SIGNATURE);
			}
			$number_var = count($this->cart->contents());
			define('PPL_LANG', 'EN');
			
			define('PPL_LOGO_IMG', base_url('/asset/front/images/logo.png'));
			
			define('PPL_RETURN_URL', base_url('front/paypalexpress/PaypalController/process?number_of_val='.$number_var));
			define('PPL_CANCEL_URL', 'http://localhost/paypal/cancel_url.php');
			
			define('PPL_CURRENCY_CODE', 'USD');
		}
		function process()
		{
			
			//include_once("config.php");
			/**inslizing the config file..**/
			if(isset($_POST["user_name"]))
			{
				$this->form_validation->set_rules('user_name', 'user_name', 'required');
				$this->form_validation->set_rules('user_email', 'user_email', 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					
					if(!$this->session->userdata("front_user_session"))
					{
						$this->session->set_flashdata("please_log_in","Please Log in or fill your email and name.");
						
						if(!isset($_SESSION['user_infomation']))
						{
							redirect('cart');
						}
						
					}
				}
				else
				{	
					
					$user_infomation = array(
					'user_name' => $this->input->post("user_name"),
					'user_email' =>$this->input->post("user_email")
					
					);
					
					$this->session->set_userdata("user_infomation",$user_infomation);
					
				}
			}
			
			
			
			
			$this->config();
			include_once("functions.php");
			include_once("paypal.class.php");
			
			$paypal= new MyPayPal();
			//Post Data received from product list page.
			
			if(_GET('paypal')=='checkout'){
				//-------------------- prepare products -------------------------
				
				//Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
				
				//Please Note : People can manipulate hidden field amounts in form,
				//In practical world you must fetch actual price from database using item id. Eg: 
				//$products[0]['ItemPrice'] = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
				
				$products = [];
				
				
				// set an item via POST request
				/*
					$products[0]['ItemName'] = _POST('itemname'); //Item Name
					$products[0]['ItemPrice'] = _POST('itemprice'); //Item Price
					$products[0]['ItemNumber'] = _POST('itemnumber'); //Item Number
					$products[0]['ItemDesc'] = _POST('itemdesc'); //Item Number
					$products[0]['ItemQty']	= _POST('itemQty'); // Item Quantity
				*/
				
				$index = 0;
				foreach($this->cart->contents() as $cart )
				{
					
					
					$products[$index]['ItemName'] =  $cart['name']; //Item Name
					$products[$index]['ItemPrice'] = $cart['price']; //Item Price
					$products[$index]['ItemNumber'] = $cart['id']; //Item Number
					$products[$index]['ItemDesc']   = $cart['ItemDesc'];
					$products[$index]['ItemQty']	= $cart['qty']; // Item Quantity	
					$index++;
				}
				
				/*
					
					// set a second item
					
					$products[1]['ItemName'] = 'my item 2'; //Item Name
					$products[1]['ItemPrice'] = 10; //Item Price
					$products[1]['ItemNumber'] = 'xxx2'; //Item Number
					$products[1]['ItemDesc'] = 'good item 2'; //Item Number
					$products[1]['ItemQty']	= 3; // Item Quantity
				*/		
				
				//-------------------- prepare charges -------------------------
				
				$charges = [];
				
				//Other important variables like tax, shipping cost
				$charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order. 
				$charges['HandalingCost'] = 0;  //Handling cost for this order.
				$charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
				$charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
				$charges['ShippinCost'] = 0; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
				
				//------------------SetExpressCheckOut-------------------
				
				//We need to execute the "SetExpressCheckOut" method to obtain paypal token
				
				$paypal->SetExpressCheckOut($products, $charges);		
			}
			elseif(_GET('token')!=''&&_GET('PayerID')!=''){
				
				//------------------DoExpressCheckoutPayment-------------------		
				
				//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
				//we will be using these two variables to execute the "DoExpressCheckoutPayment"
				//Note: we haven't received any payment yet.
				
				$paypal->DoExpressCheckoutPayment();
			}
			else{
				
				//order form
				
				
			}
			
		}
		
		function Return_Page()
		{
			echo "<pre>";
			print_r($_POST);
			print_r($_GET);
			die;
			$data = array(
			'zl_order_by_user_id' => $this->input->get('uid'),
			'zl_order_by_email' => $this->input->get('email'),
			'zl_order_by_username' => $this->input->get('un'),
			'al_total_payment' => $this->input->post('payment_gross'),
			'zl_trans_id' => $this->input->post('txn_id'),
			'date' => date('Y-m-d')	    
			);
			$this->db->insert('zl_orders',$data);
			redirect('front/Shopping/Thanks_page');
		}
		function sucess_treansection()
		{
			/***inserting data in the table.
				***	This data is comming from paypal.class.php file....
			**/
			$data = array(
			'zl_order_by_user_id' => $this->input->get('uid'),
			'zl_order_by_username' => $this->input->get('un'),
			'al_total_payment' => $this->input->get('payment_gross'),
			'zl_trans_id' => $this->input->get('txn_id'),
			'date' => date('Y-m-d')	    
			);
			$this->db->insert('zl_orders',$data);
			redirect('front/Shopping/Thanks_page');
			
		}
		function distroy_session()
		{
			echo "<pre>";
			print_r($_SESSION);
			$this->session->unset_userdata('user_infomation');
		}
	}
	
	
	
