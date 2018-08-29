<?php
	defined('BASEPATH') OR exit('No direct script access allowed');	
	class Home extends MY_Controller 
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('session','form_validation');
			$this->load->model('frontend/ProductFrontendModel');
			$this->load->model('frontend/CategoryModel');
			$this->load->model('admin/RevsliderModel');
			$this->load->model('admin/AdminBrandModel');
			$this->load->model('admin/AdminPageModel');
			$this->load->model('admin/SiteSettingsModel');			
		}
		/****************************************************************************
		* Description	: 	Function is use for View Home page
		* Developer	:	Manish Kumar Pathak
		* Date			:	03-April-2017
		****************************************************************************/
		public function index()
		{
			$data = array();
			//Get New Product data on Home page 
			$data['newproduct'] = $this->ProductFrontendModel->getNewProducts();
			//Get Featured Product data on Home page 
			$data['featureproduct'] = $this->ProductFrontendModel->getFeaturedProducts();			
			//Get Product Category data on Home page
			$data['procategory'] = $this->CategoryModel->getSelectedParentCategory();
			//Get Rev-Slides data on Home page
			$data['revslides'] = $this->RevsliderModel->GetAllRevSlide();			
			//Get Brands logo on Home page
			$data['Brandslogo'] = $this->AdminBrandModel->GetAllBrand();			
			//Get About-us data on home page
			$data['AboutData'] = $this->AdminPageModel->GetsAboutUsPage();			
			// Get Facebook Redirect url :
			$data['redirect_url'] = $this->FacebookRedirect();
			$data['GridOption']	= $this->SiteSettingsModel->GetOptionData('SiteGridOption');			
			pr($data['GridOption']);			
			$this->load->view('frontend/templates/header', $data);
			$this->load->view('frontend/home', $data);
			$this->load->view('frontend/templates/footer');			
		}
		/****************************************************************************
		* Description	: 	Function is use for get facebook Redirect-url
		* Developer	:	Manish Kumar Pathak
		* Date			:	03-April-2017
		****************************************************************************/
		public function FacebookRedirect()
		{
			//Intiallize Autoload file
			include_once APPPATH."libraries/php-graph-sdk-5.0.0/src/Facebook/autoload.php";
			//Intiallize FAcebook Config file
			include_once APPPATH."libraries/php-graph-sdk-5.0.0/src/Facebook/Facebook.php";			
			// Intialize Facebook exception file
			include_once APPPATH."libraries/php-graph-sdk-5.0.0/src/Facebook/Exceptions/FacebookSDKException.php";			
			//Intialize Redirect helper file
			include_once APPPATH."libraries/php-graph-sdk-5.0.0/src/Facebook/Helpers/FacebookRedirectLoginHelper.php";			
			$appId = '1273278662769867';
			$appSecret = 'e24008f6b5ce6067adb655cf4c8cc4d7';
			$redirectUrl = 'http://a1professionals.net/shopta_app/facebooklogin';			
			$facebook = new Facebook\Facebook(array(
				'app_id'  => $appId,
				'app_secret' => $appSecret			
			));			
			$helper = $facebook->getRedirectLoginHelper();
			$fbuser = '';
			$data['authUrl'] = $helper->getLoginUrl('http://a1professionals.net/shopta_app/facebooklogin');			
			return $data['authUrl'];
		}		
	}	