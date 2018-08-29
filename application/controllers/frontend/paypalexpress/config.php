<?php
	
	//start session in all pages
	if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
	//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above
	
	// sandbox or live
	define('PPL_MODE', 'sandbox');
	
	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'parwinder.singh_api1.a1professionals.info');
		define('PPL_API_PASSWORD', 'MFMDFEEE9KGXXZQF');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AUNG-F7Mbr8SGYKa0YwBurBuZ7rQ');
	}
	else{
		define('PPL_API_USER', 'parwinder.singh_api1.a1professionals.info');
		define('PPL_API_PASSWORD', 'MFMDFEEE9KGXXZQF');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AUNG-F7Mbr8SGYKa0YwBurBuZ7rQ');
	}
	
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', base_url('/asset/front/images/logo.png'));
	define('PPL_RETURN_URL', base_url('Billing/Return_Page?number_of_val='.$number_var));
	define('PPL_RETURN_URL', base_url('Billing/Return_Page'));
	/*define('PPL_CANCEL_URL', 'http://ci_shopping_cart/paypal/cancel_url.php');*/
	define('PPL_CANCEL_URL',  base_url('Billing/Cancel_Page'));
	
	define('PPL_CURRENCY_CODE', 'USD');
