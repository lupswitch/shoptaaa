<?php



/*****************************************************************************
*	Description : Method is Used to set and get payment Configuration   
*	Developer   : Er.Parwinder Singh
*	DOC			: 05th-May-2017	
******************************************************************************/
if(!function_exists('PayPal_Config')){		

		function PayPal_Config($cartItemsCount=""){
			
			//start session in all pages
			if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
			//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above
			
			// sandbox or live
		//	$details = $this->Paypal_express->api_details();
			
			//mode of paypal..
		//	$mode_pay = $details->PPL_API_mode;
			
			//define('PPL_MODE', $mode_pay);
			
			
		//	include_once("config.php");
			define('PPL_MODE', 'sandbox');
			
			if(PPL_MODE== 'sandbox'){
			
				/**api details from admin side**/
				/* define('PPL_API_USER', 'parwinder.singh_api1.a1professionals.info');
		        define('PPL_API_PASSWORD', 'MFMDFEEE9KGXXZQF');
		        define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AUNG-F7Mbr8SGYKa0YwBurBuZ7rQ'); */
				define('PPL_API_USER', 'a1protester_api2.gmail.com');
		        define('PPL_API_PASSWORD', '5QP6REX8GNEJWF6B');
		        define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AZWjh95w35d1eKhkqyZPkR23PVwE');
				/*	
					define('PPL_API_USER', $details->PPL_API_USER);
					define('PPL_API_PASSWORD', $details->PPL_API_PASSWORD);
					define('PPL_API_SIGNATURE',$details->PPL_API_SIGNATURE);
				*/
			}
			else{
				define('PPL_API_USER', $details->PPL_API_USER);
				define('PPL_API_PASSWORD', $details->PPL_API_PASSWORD);
				define('PPL_API_SIGNATURE',$details->PPL_API_SIGNATURE);
			}
			
			
			
			if(empty($cartItemsCount =="")){
				$cartItemsCount = count($this->cart->contents());
			}
			
			
			define('PPL_LANG', 'EN');
			
			define('PPL_LOGO_IMG', base_url('/asset/front/images/logo.png'));
			
		//	define('PPL_RETURN_URL', base_url('front/paypalexpress/PaypalController/process?number_of_val='.$number_var));
			
		 define('PPL_RETURN_URL', base_url('conformation/success?number_of_val='.$cartItemsCount));
		/*define('PPL_CANCEL_URL', 'http://ci_shopping_cart/paypal/cancel_url.php');*/
		 define('PPL_CANCEL_URL',  base_url('conformation/cancel'));
	
			
			
			define('PPL_CURRENCY_CODE', 'USD');
		}
	
}

?>	