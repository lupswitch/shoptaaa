<?php

  //start session in all pages
  if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
  //if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

	// sandbox or live
	define('PPL_MODE', 'sandbox');

	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'userName');
		define('PPL_API_PASSWORD', 'password');
		define('PPL_API_SIGNATURE', 'SIGNATURE');
	}
	else{
		define('PPL_API_USER', 'userName');
		define('PPL_API_PASSWORD', 'password');
		define('PPL_API_SIGNATURE', 'SIGNATURE');
	}
	
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', '');
	
	define('PPL_RETURN_URL', 'http://yourServerName/ProjectName/Paypal-Express-Checkout-Example-master/process.php');
	define('PPL_CANCEL_URL', 'http://http://yourServerName/ProjectName/Paypal-Express-Checkout-Example-master/cancel_url.php');

	define('PPL_CURRENCY_CODE', 'EUR');
