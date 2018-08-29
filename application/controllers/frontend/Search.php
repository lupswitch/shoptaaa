<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Search extends MY_Controller {
		
		public function __construct() 
		{        
			parent::__construct();
			$this->load->helper(array('form','url'));
			$this->load->library('session','form_validation');
			$this->load->model('frontend/SearchModel');
			
		}
		
	/****************************************************************************
	* Description	: 	Function is use for search products
	* Developer		:	Puneet Singh
	* Date			:	12-April-2017
	****************************************************************************/
	 
		public function index($keyword)
		{
			$data['searchdata'] = $this->SearchModel->Keyword(urldecode($keyword));
			$searchkeyword = str_replace("%20"," ",$keyword);
			
			if(empty($data['searchdata']))
			{
				$data['title'] = "No Data found for : <span id='keyword_search_text'>".$searchkeyword."</span>";	
			}
			else
			{
				$data['title'] = "Result Found For : <span id='keyword_search_text'>".$searchkeyword."</span>";
			}
		
			$this->load->view('frontend/templates/header');
			$this->load->view('frontend/search_view', $data);
			$this->load->view('frontend/templates/footer'); 
		}  
			
		
	}
	