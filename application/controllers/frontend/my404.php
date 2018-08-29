<?php 
		defined('BASEPATH') OR exit('No direct script access allowed');
		
	class my404 extends MY_Controller 
	{
		public function __construct() 
		{
			parent::__construct(); 
		} 
		
		public function index() 
		{ 
			
			$this->output->set_status_header('404'); 
			
			$data['content'] = '
			<section id="fof" class="clear">
				<div class="hgroup">
				<h1><span><strong>4</strong></span><span><strong>0</strong></span><span><strong>4</strong></span></h1>
				<h2>Error ! <span>Page Not Found</span></h2>
				</div>
				<p>For Some Reason The Page You Requested Could Not Be Found On Our Server</p>
				<p><a href="javascript:history.go(-1)">&laquo; Go Back</a> / <a href="#">Go Home &raquo;</a></p>
			</section>';  
			
			$this->load->view('frontend/Error_404/my404_view',$data);
			
		} 
	} 
?> 