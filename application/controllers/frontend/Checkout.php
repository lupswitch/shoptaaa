<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {
	
	public $orderID;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart','URL','form','session');
		$this->load->model('frontend/CheckoutModel');
		$this->load->model('frontend/MyOrdersModel');
		$this->load->model('frontend/UsersModel');
		$this->load->model('frontend/ProductFrontendModel');
		// Get Current user ID for cart items
		if($this->session->has_userdata('is_customer'))
		{
			$GLOBALS['custmerId'] = $this->session->userdata['is_customer']['user_id'];
			$GLOBALS['CurrentuserID'] = $this->session->userdata['is_customer']['user_id'];
			$userStatus = $this->UsersModel->GetUserStatus($GLOBALS['CurrentuserID']);
			if(empty($userStatus))
			{
				redirect('frontend/Auth/Logout');
			}
		}
	}
	
	
/****************************************************************************
	Description		:	Function use for Create confirm order
	Developer		:	Manish Kumar Pathak
	Doc				:	2/may/2017
****************************************************************************/

	public function index()
	{
		$pagedata = array();
		/*##################################
		# Check cart items is empty or not #
		##################################*/
		if (!$this->cart->contents())
		{
			$shop_url = base_url('products');
			$this->session->set_flashdata('verify_msg','<div class="alert-danger alert-dismissable"> <strong> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </strong>You have no item in cart, <a href="'.$shop_url .'">click here to continue shopping</a> !</div>');
		}
		/*############################
		# check is user login or not #
		############################*/
		if($this->session->has_userdata('is_customer'))
		{
			//Get current user cart items 
			$pagedata['cartData'] = $this->CheckoutModel->FetchUser_CartData($GLOBALS['custmerId']);
			/* check point to check is cart products have in stock or not */
			$OutofStockCheckPoint 	=  unserialize($pagedata['cartData']['cartValues']);
			$rtnVal = "";
			//pr($OutofStockCheckPoint);
			foreach($OutofStockCheckPoint as $val)
			{
				$checkPoint	= $this->ProductOutOfStockCheckPoint($val['id'],$val['qty']);
				//$totalItem = ($val['qty']);
				if($checkPoint === false)
				{
					redirect('/cart/error-outofstock');
				}
			}
			/*********** end Here ***********/
			//Get all countries 
			$pagedata['country'] = $this->UsersModel->GetAllCountry();
			// Get current user data
			$pagedata['userdata'] = $this->CheckoutModel->GetUserDetail($GLOBALS['custmerId']);
			// Get My address data
			$pagedata['MyBillingAddress'] = $this->CheckoutModel->GetMyAddress();
			//Generate order
			if(isset($_POST['checoutOrder']))
			{
				//pr($_POST); die;
				//Billing address
				$this->form_validation->set_rules('billingAddress[firstname]', 'First name', 'trim|required');
				$this->form_validation->set_rules('billingAddress[address]', 'Address', 'trim|required');
				$this->form_validation->set_rules('billingAddress[country]', 'Country', 'trim|required');
				$this->form_validation->set_rules('billingAddress[state]', 'State', 'trim|required');
				$this->form_validation->set_rules('billingAddress[email]', 'Email', 'trim|required');
				$this->form_validation->set_rules('billingAddress[lastname]', 'Last name', 'trim|required');
				$this->form_validation->set_rules('billingAddress[town_city]', 'Town City', 'trim|required');
				$this->form_validation->set_rules('billingAddress[postcode]', 'Postcode', 'trim|required|numeric');
				$this->form_validation->set_rules('billingAddress[phone]', 'Phone', 'trim|required|numeric');
				//Shipping address
				$this->form_validation->set_rules('shippingAddress[firstname]', 'First name', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[address]', 'Address', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[country]', 'Country', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[state]', 'State', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[email]', 'Email', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[lastname]', 'Last name', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[town_city]', 'Town City', 'trim|required');
				$this->form_validation->set_rules('shippingAddress[postcode]', 'Postcode', 'trim|required|numeric');
				$this->form_validation->set_rules('shippingAddress[phone]', 'Phone', 'trim|required|numeric');
				if ($this->form_validation->run() == True)
				{
					$shippingData	=  serialize($_POST['shippingAddress']);
					$billingData	=  serialize($_POST['billingAddress']);
					$cartvalue 		=  $pagedata['cartData']['cartValues'];
					$cartQuantity 	=  unserialize($pagedata['cartData']['cartValues']);
					$totalItem = 0;
					foreach($cartQuantity as $qty)
					{
						$totalItem = ($totalItem+$qty['qty']);
					}
					//Order Data
					$OrderArray = array(
					'order_uid' 			=> $GLOBALS['custmerId'],
					'orderStatus' 			=> 'pending',
					'purchasedTotal_item'	=> $totalItem,
					'totalPrice'			=> $pagedata['cartData']['cart_TotalPrice'],
					'transactionId' 		=> 'paypal',
					'shippingAddress' 		=> $shippingData,
					'billingAddress' 		=> $billingData,
					'orderAt'				=> date('Y-m-d H:i:s'),
					'oderDetails'			=> $cartvalue,
					);
					//create confirm order
					$returnOrderId = $this->CheckoutModel->GenerateOrder($OrderArray);
					if(!empty($returnOrderId))
					{
						//$this->orderID = $returnOrderId ;
						$_SESSION['paypalorderid'] = $returnOrderId ;
						//MyAddress Data
						$this->is_NeedToAddMyAddress($_POST['billingAddress']);
						$this->Payment_Method_PayPal();
						//Cart session destroy
						//	$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-success text-center"> Your Order successfully Confimed. </div>');
					}
					else
					{
						$this->session->set_flashdata('verify_msg','<div id="request" class="alert alert-danger text-center">Not able to Confirmed your order!</div>');
					}
				}
			}
		}
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/checkout_view',$pagedata);
		$this->load->view('frontend/templates/footer');
	}
/* <<<<<<<<<<< END HERE >>>>>>>>>>>>> */
	public function is_NeedToAddMyAddress($AddressData)
	{
		$firstname	= $AddressData['firstname'];
		$lastname	= $AddressData['lastname'];
		$address	= $AddressData['address'];
		$phone	 	= $AddressData['phone'];
		$city	 	= $AddressData['town_city'];
		$State	 	= $AddressData['state'];
		$Country 	= $AddressData['country'];
		$Zip 		= $AddressData['postcode'];
		$BillingArray = array(
		'addr_uid' 				=> $GLOBALS['custmerId'],
		'firstName' 			=> $firstname,
		'lastName'				=> $lastname,
		'address'				=> $address,
		'PhoneNumber' 			=> $phone,
		'City' 					=> $city,
		'State' 				=> $State,
		'Country'				=> $Country ,
		'Zip'					=> $Zip,
		); 
		$this->CheckoutModel->UpdateMyAddress($BillingArray);
	}
	function Payment_Method_PayPal()
	{
		PayPal_Config();// func call to Get Paypal config values
		include_once("paypalexpress/functions.php");
		include_once("paypalexpress/paypal.class.php");
		$paypal= new MyPayPal();
		//Post Data received from product list page.
		if(_GET('payment')=='paypal')
		{
			//-------------------- prepare products -------------------------
			//Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
			//Please Note : People can manipulate hidden field amounts in form,
			//In practical world you must fetch actual price from database using item id. Eg: 
			//$products[0]['ItemPrice'] = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
			$products = [];
			// set an item via POST request
			$index = 0;
			foreach($this->cart->contents() as $cart )
			{
				$products[$index]['ItemName'] =  $cart['name']; //Item Name
				$products[$index]['ItemPrice'] = $cart['price']; //Item Price
				$products[$index]['ItemNumber'] = $cart['id']; //Item Number
				// $products[$index]['ItemDesc']   = $cart['ItemDesc'];
				$products[$index]['ItemQty']	= $cart['qty']; // Item Quantity	
				$index++;
			}
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
	}
	function Thanks()
	{
		$pagedata = array();
		//	pr($_GET);
		PayPal_Config();// Get Paypal config values
		include_once("paypalexpress/functions.php");
		include_once("paypalexpress/paypal.class.php");	
		$paypal= new MyPayPal();
		if(_GET('token')!=''&&_GET('PayerID')!='')
		{
			//------------------DoExpressCheckoutPayment-------------------	
			//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
			//we will be using these two variables to execute the "DoExpressCheckoutPayment"
			//Note: we haven't received any payment yet.
			$rtnPaymentData = 	$paypal->DoExpressCheckoutPayment();
			$ShoptaOrderID = $_SESSION['paypalorderid'];
			$returnData = $this->CheckoutModel->UpdatePaymentTransectionId($_SESSION['paypalorderid'], $rtnPaymentData);
			$rtnDataOrder['singalorderdata'] = $this->MyOrdersModel->Fetch_SingleOrder($ShoptaOrderID);
			$userdata = $this->MyOrdersModel->User_Details();
			$signleorderemail = $this->load->view('frontend/templates/sub_template/emails_template/email_order_detail_template',$rtnDataOrder,true);
			$sendto = $userdata['email'];
			$subject ="Hello Order Generate Test Email ";
			SendEmails($sendto , $subject, $signleorderemail , true);
			/***************************************code for update Inventory***************************/
			$cartproducts =	unserialize($rtnDataOrder['singalorderdata']['oderDetails']);
			if(is_array($cartproducts))
			{
				foreach( $cartproducts as $ProVal)
				{
					$this->UpdateProductInventory($ProVal['id'],$ProVal['qty']);
				}  
			}
			/*************************************** end here ***************************/
			$pagedata['paypalDetails'] = 	$rtnPaymentData;
			$pagedata['payment_status'] = "sucess";
			unset($_SESSION['paypalorderid']);
		}
		else
		{
			//order form
			$rtnPaymentData = 	$paypal->DoExpressCheckoutPayment();
			$pagedata['payment_status'] = "canceled";
		}
		//pr($pagedata);
		//die('pagedata');
		$this->load->view('frontend/templates/header');
		$this->load->view('frontend/payment_success_order_page_view',$pagedata);
		$this->load->view('frontend/templates/footer');
		$this->cart->destroy();
		//redirect('front/Shopping/Thanks_page');
		//header("Refresh: 100; URL=http://a1professionals.net/shopta_app/");
	}
	function sucess_treansection()
	{
		PayPal_Config();// Get Paypal config values
		include_once("paypalexpress/functions.php");
		include_once("paypalexpress/paypal.class.php");	
		$paypal= new MyPayPal();
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
		print_r($data);
		die('------');
//		$this->db->insert('zl_orders',$data);
		redirect('front/Shopping/Thanks_page');
	}
	function Cancel_Page()
	{
		PayPal_Config();// Get Paypal config values
		include_once("paypalexpress/functions.php");
		include_once("paypalexpress/paypal.class.php");	
		$paypal= new MyPayPal();
		$pagedata['payment_status'] = "canceled";
		echo "<pre>";
		print_r($_POST);
		print_r($_GET);
		die('cancel Page');
	}
	public function UpdateProductInventory($pid,$proqty) 
	{
		return  $this->CheckoutModel->UpdateInventoryProduct($pid,$proqty);
	
	}
	
	/****************************************************************************
		Description		:	@ProductOutOfStockCheckPoint use check is product is in stock or not
		Developer	:	Manish Kumar Pathak
		Doc				:	21/June/2017
	****************************************************************************/
	
	public function ProductOutOfStockCheckPoint($proId, $proUserAddedQty )
	{
		$isGallery ='no';
		$RtnProductData = $this->ProductFrontendModel->GetSingleProduct($proId, $isGallery);
		//pr($RtnProductData);
		if(  $proUserAddedQty >  $RtnProductData->proQuantity)
		{
			return false;
		}
	}
}			