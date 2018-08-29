<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

		$this->load->helper(array('form','url'));
		$this->load->library(array('session','form_validation','email','upload'));
	  
	  
        $this->load->model('admin/dashboard_model');
	/*	print_r($this->session->userdata()); */
		if(!$this->session->has_userdata('is_admin')) {
            redirect('admin');
        }
	}


	public function index()
	{
			$pageHeader = 	array(  'pagetitle' => 'Dashboard','font_icon'=>'dashboard');
			
		$pageHeader = 	array(  'pagetitle' => 'Dashboard',
								'slug'		=>'dashboard',
								'font_icon' =>'dashboard',
							);		
		/*	
        //    $this->data['count_groups']      = $this->dashboard_model->get_count_record('groups');
            $this->data['disk_totalspace']   = $this->dashboard_model->disk_totalspace(DIRECTORY_SEPARATOR);
            $this->data['disk_freespace']    = $this->dashboard_model->disk_freespace(DIRECTORY_SEPARATOR);
            $this->data['disk_usespace']     = $this->data['disk_totalspace'] - $this->data['disk_freespace'];
            $this->data['disk_usepercent']   = $this->dashboard_model->disk_usepercent(DIRECTORY_SEPARATOR, FALSE);
            $this->data['memory_usage']      = $this->dashboard_model->memory_usage();
            $this->data['memory_peak_usage'] = $this->dashboard_model->memory_peak_usage(TRUE);
            $this->data['memory_usepercent'] = $this->dashboard_model->memory_usepercent(TRUE, FALSE);
         */
			
			
			
			$this->data['GetAllUsers']		= $this->dashboard_model->GetAllUsers();
			$this->data['count_Customers']      = $this->dashboard_model->get_Total_Customers();
			$this->data['count_Product']      = $this->dashboard_model->get_Total_Products();
				
			
			$this->load->view("admin/share-template/header", $pageHeader);
			$this->load->view('admin/admin_dashboard_view' , $this->data);
			$this->load->view("admin/share-template/footer");
			
			
	
	}
	
	
	
	
	

}
