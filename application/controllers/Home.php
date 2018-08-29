<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home extends MY_Controller {
		
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
	* Developer		:	PS
	* Date			:	03-April-2017
	****************************************************************************/
	
		public function index()
		{
			//Get New Product data on Home page 
			$data['newproduct'] = $this->ProductFrontendModel->getNewProductsHome();
			
			//Get Featured Product data on Home page 
			$data['featureproduct'] = $this->ProductFrontendModel->getFeaturedProductsHome();
			
			//Get Product Category data on Home page
			$data['procategory'] = $this->CategoryModel->getSelectedParentCategory();
			
			//Get Rev-Slides data on Home page
			$data['revslides'] = $this->RevsliderModel->GetAllRevSlide();
			
			//Get Brands logo on Home page
			$data['Brandslogo'] = $this->AdminBrandModel->GetAllBrand();
			
			//Get About-us data on home page
			$data['AboutData'] = $this->AdminPageModel->GetsAboutUsPage();
			
			$data['GridOption']	= $this->SiteSettingsModel->GetOptionData('SiteGridOption');
			
			$this->load->view('frontend/templates/header', $data);
			$this->load->view('frontend/home', $data);
			$this->load->view('frontend/templates/footer');
			
		} 
		

		
	}
	
	