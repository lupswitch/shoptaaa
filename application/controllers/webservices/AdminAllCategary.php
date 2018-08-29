<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminAllCategary extends CI_Controller
	{
		function __construct()
			{
				parent::__construct();
				$this->load->model('webservices/AdminAllCategaryModel');
				error_reporting(0);
			}
		function index()
			{
				echo "Hello Manish";
			}
		function getAllCategary()
			{
				$query 					= $this->AdminAllCategaryModel->getAllCategary();				
				if ($query)
					{
						$result 		= array(
							'code'		=> '201',
							'status'	=>'success',
							'message' 	=> "Categary found Successfully.",
							'data' 		=> $query
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result 		= array(
							'code' 		=> '200',
							'status'	=>'failure',
							'message' 	=> "Categary not found."
						);
						print_r(json_encode($result));
					}
			}
	}
?>