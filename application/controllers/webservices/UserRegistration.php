<?php

defined('BASEPATH') OR exit('No direct script access allowed');
		/**
		* Index Page for this controller.
		* Maps to the following URL
		* 		http://example.com/index.php/welcome
		*	- or -
		* 		http://example.com/index.php/welcome/index
		*	- or -
		* Since this controller is set as the default controller in
		* config/routes.php, it's displayed at http://example.com/
		*
		* So any other public methods not prefixed with an underscore will
		* map to /webservices/UserRegistration/<method_name>
		*/
class UserRegistration extends CI_Controller
	{
		function __construct()
			{
				parent::__construct();
				$this->load->model('webservices/UserRegistrationModel');
					$this->load->model('webservices/CommonFormate');
				error_reporting(0);
			}
		function index()
			{
				echo "Hello Shopta_App";
			}
		function clientRegistration()    
			{
				$this->form_validation->set_rules('Email', 'Email', 'required|is_unique[Registration.email]');
				$this->form_validation->set_rules('UserName', 'UserName', 'required|is_unique[Registration.userName]');
				if ($this->form_validation->run() == FALSE)
					{
						$error 			= 	strip_tags(validation_errors());
						$result 		= 	array(
												'code' 		=> '200',
												'message' 	=> $error
											);
						print_r(json_encode($result));
					} 
				  else
					{
						//$profileImage=  base_url()."uploads/main/noimage.png";
						
						$data = array(
							'firstName' 	=> $this->input->post('FirstName') ,
							'userName' 		=> $this->input->post('UserName') ,
							'email' 		=> $this->input->post('Email') ,
							'password' 		=> md5(md5($this->input->post('Password'))),
							'userType' 		=> 'User',
							//'profileImage' 	=> base_url()."uploads/main/noimage.png",
							'profileImage' 	=> $this->input->post('ProfileImagePath'),
							'deviceType' 	=> $this->input->post('DeviceType') ,
							'deviceId' 		=> $this->input->post('DeviceId')
						);
						$query = $this->UserRegistrationModel->registration($data);
						if ($query)
							{
								$result = array(
									'code' => '201',
									'status' => 'success',
									'message' => "Registration Successfully."
								);
								$data = array_merge($result, $query[0]);
								print_r(json_encode($data));
							}
						  else
							{
								$result = array(
									'code' => '200',
									'status' => 'failure',
									'message' => "Email Already exists"
								);
								print_r(json_encode($result));
							}
					}
			}
		function userLogin()
			{
				$data = array(
					'email' 	 => $this->input->post('Email') ,
					'password' 	 => $this->input->post('Password') ,
					'deviceType' => $this->input->post('DeviceType') ,
					'deviceId' 	 => $this->input->post('DeviceId')
				);
				$query = $this->UserRegistrationModel->clientStaffLogin($data);
				if ($query)
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Login Successfully."
						);
						$data = array_merge($result, $query[0]);
						print_r(json_encode($data));
					}
				  else
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Please enter correct email or password."
						);
						print_r(json_encode($result));
					}
			}
		function viewProfile() // 8 june
		{
			$data = array(
					'user_id' => $this->input->post('user_id')
				);
				$query = $this->CommonFormate->getUserData($data['user_id']);
				if ($query)
					{
						$result = array(
							'code' 		=> '201',
							'status' 	=> 'success',
							'message' 	=> "Profile view  Successful."
						);
						$data = array_merge($result, $query[0]);
						print_r(json_encode($data));
					}
				  else
					{
						$result = array(
							'code' 		=> '200',
							'status' 	=> 'failure',
							'message' 	=> "Invalid! user id ."
						);
						print_r(json_encode($result));
					}
				
		}
		function userMyAddress()
			{
				$data = array(
					'addr_uid' => $this->input->post('UserId') ,
					'firstName' => $this->input->post('FirstName') ,
					'lastName' => $this->input->post('LastName') ,
					'address' => $this->input->post('Address') ,
					'PhoneNumber' => $this->input->post('PhoneNumber') ,
					'city' => $this->input->post('City') ,
					'state' => $this->input->post('State') ,
					'country' => $this->input->post('Country') ,
					'zip' => $this->input->post('Zip')
				);
				$query = $this->UserRegistrationModel->userMyAddress($data);
				if ($query == "Insert")
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Address insert Successful."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Address Updated Successful."
						);
						print_r(json_encode($result));
					}
			}
		function getMyAddress()
			{
				$data = array(
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->UserRegistrationModel->getMyAddress($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Address not found."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Address found Successful."
						);
						$dd = array_merge($result, $query[0]);
						print_r(json_encode($dd));
					}
			}
		function forgotPassword()
			{
				$Email = $this->input->post('Email');
				$acceptableChars = "0123456789";
				$randomCode = "";
				for ($i = 0; $i < 6; $i++)
					{
						$randomCode.= substr($acceptableChars, rand(0, strlen($acceptableChars) - 1) , 1);
					}
				$code = $randomCode;
				$query = $this->UserRegistrationModel->forgotPassword($Email, $code);
				if (empty($query))
					{
						$result = array(
							'code' => '200',
							'message' => 'No User Found with This Email.'
						);
						print_r(json_encode($result));
					}
				  else
					{
						$AppName = "testsharma067@gmail.com";
						$body = '
								<html>
									<body style="background-color:#F4F4F4;">
									  <table style="max-width:500px;min-width:500px;margin:0 auto;background-color:#fff;text-align:center;">
									     <tr>
									        <td style="color:#696969;font-family:open sans;font-size:14px;padding:7px 0;text-align:left;
									           padding-left:20px;padding-right:20px;padding-top:40px;">
									        </td>
									     </tr>
									     <tr>
									        <td style="color:#696969;font-family:open sans;font-size:14px;padding:7px 0;
									           text-align:left;padding-left:20px;padding-right:20px;line-height:24px;">
									          You have requested the new password. Please enter the following OTP to reset your  password :' . $code . '
									        </td>
									     </tr>
									     <!--tr>
									        <td style="color:#696969;font-family:open sans;font-size:14px;padding:30px 0;
									           text-align:left;padding-left:20px;padding-right:20px;">
									           Please use this password for login:' . $code . '
									        </td>
									     </tr-->
									     <tr>
									        <td style="color:#696969;font-family:open sans;font-size:14px;padding:0;
									           text-align:left;padding-left:20px;padding-right:20px;">
									           Regards
									        </td>
									     </tr>
									     <tr>
									        <td style="color:#23A8E0;font-family:open sans;font-size:14px;padding:0;
									           text-align:left;padding-left:20px;padding-right:20px;padding-bottom:40px;">
									           Shopta App
									        </td>
									     </tr>
									  </table>
									</body>
									</html>
									';
						// >>>>>>>>>>>>>>Sending Mail <<<<<<<<<<<<
						$config['protocol'] = 'sendmail';
						$config['charset'] = 'iso-8859-1';
						$config['wordwrap'] = TRUE;
						$this->email->set_mailtype("html");
						$this->email->initialize($config);
						$this->email->from($AppName);
						$this->email->to($Email);
						$this->email->subject('Reset Password');
						$this->email->message($body);
						$mail = $this->email->send();
						if ($mail)
							{
								if ($query > 0)
									{
										$result = array(
											'code' => '201',
											'status' => 'success',
											'message' => "Email sent successfully",
											'OTPCode' => $code
										);
										print_r(json_encode($result));
									}
								  else
									{
										$result = array(
											'code' => '200',
											'status' => 'failure',
											'message' => 'No User Found with This Email Id.'
										);
										print_r(json_encode($result));
									}
							}
						  else
							{
								$result = array(
									'code' => '200',
									'status' => 'failure',
									'message' => 'Error in sending Email.'
								);
								print_r(json_encode($result));
							}
					}
			}
		function resetPassword()
			{
				$data = array(
					'email' => $this->input->post('Email') ,
					'OTP' => $this->input->post('OTPCode') ,
					'password' => $this->input->post('NewPassword')
				);
				$query = $this->UserRegistrationModel->resetPassword($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Code not matched"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Password Reset Successfully."
						);
						print_r(json_encode($result));
					}
			}
		function changePassword()
			{
				$data = array(
					'email' => $this->input->post('Email') ,
					'oldpassword' => $this->input->post('OldPassword') ,
					'password' => $this->input->post('NewPassword')
				);
				$query = $this->UserRegistrationModel->passwordChange($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Your old password don't matched"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Password Change Successfully."
						);
						print_r(json_encode($result));
					}
			}
		function profileUpdate()
			{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = '*';
				$config['max_size'] = '0';
				$config['max_width'] = '10000';
				$config['max_height'] = '10000';
				$this->upload->initialize($config);
				$this->upload->do_upload('ProfileImage', $config);
				$upload_data = $this->upload->data();
				if ($upload_data['client_name'])
					{
						$profileImage = base_url().'uploads/' . $upload_data['file_name'];
					}
				  else
					{
						$profileImage = base_url()."uploads/main/noimage.png";
					}
				$data = array(
					'UserId' => $this->input->post('UserId') ,
					'firstName' => $this->input->post('FirstName') ,
					'phoneNumber' => $this->input->post('PhoneNumber') ,
					'profileImage' => $profileImage
				);
				$query = $this->UserRegistrationModel->profileUpdate($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "User Not found."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Profile Updated Successfully",
						);
						$data = array_merge($result, $query[0]);
						print_r(json_encode($data));
					}
			}
		function getDileveryBoyJobs()
			{
				$data = array(
					'UserId' => $this->input->post('UserId') ,
				);
				$query = $this->UserRegistrationModel->getDileveryBoyJobs($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Job not found"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Job found Successfully.",
							'data' => $query
						);
						print_r(json_encode($result));
					}
			}
		function deliveryBoyTracking()
			{
				$data = array(
					'user_id' 		=> $this->input->post('UserId') ,
					'o_id' 			=> $this->input->post('OrderId') ,
					'currentLat' 	=> $this->input->post('CurrentLat') ,
					'currentLong' 	=> $this->input->post('CurrentLong') ,
					'orderStatus' 	=> $this->input->post('OrderStatus')
				);
				$query = $this->UserRegistrationModel->deliveryBoyTracking($data);
				if ($query == "Not")
					{
						$result 		= array(
							'code' 		=> '200',
							'status' 	=> 'failure',
							'message' 	=> "Job not found"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result 		= array(
							'code' 		=> '201',
							'status' 	=> 'success',
							'message' 	=> "Job update Successfully."
						);
						print_r(json_encode($result));
					}
			}
			function updateCurrentLocationOrder()
			{
				$data = array(
					'o_id' 			=> $this->input->post('OrderId') ,
					'deleveryBoyId' => $this->input->post('deleveryBoyId') ,
					'updatedLat' 	=> $this->input->post('updatedLat') ,
					'updatedLong' 	=> $this->input->post('updatedLong')
				);
				$query = $this->UserRegistrationModel->updateCurrentLocationOrder($data);
				if ($query)
					{
						$result 		= array(
							'code' 		=> '201',
							'status' 	=> 'success',
							'message' 	=> "Lat Long Updated Successfully"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result 		= array(
							'code' 		=> '200',
							'status' 	=> 'failure',
							'message' 	=> "Order id OR Delevery boy id invalid ."
						);
						print_r(json_encode($result));
					}
			}
		function trackDileveryBoy()
		{
			$data = array(
				'user_id' 		=> $this->input->post('UserId') ,  //buyer id
				'o_id' 			=> $this->input->post('OrderId') ,
			);
			$query = $this->UserRegistrationModel->trackDileveryBoy($data);
			if ($query)
			{
				$result 		= array(
					'code' 		=> '201',
					'status' 	=> 'success',
					'message' 	=> "Location got Successfully",
				
					);
				$data = array_merge($result, $query);
				print_r(json_encode($data));
			}
			 else
			{
				$result 		= array(
					'code' 		=> '200',
					'status' 	=> 'failure',
					'message' 	=> "Order id invalid OR Delevery boy id."
					);
				print_r(json_encode($result));
			}

		}
		function orderCancellation()
			{
				$data = array(
					'user_id' 		=> $this->input->post('UserId') ,
					'o_id' 			=> $this->input->post('OrderId') ,
					'orderStatus' 	=> $this->input->post('OrderStatus') ,
					'cancelReason' 	=> $this->input->post('cancelReasonText')
				);
				$query = $this->UserRegistrationModel->orderCancellation($data);
				if ($query == "Not")
					{
						$result 		= array(
							'code' 		=> '200',
							'status' 	=> 'failure',
							'message' 	=> "Order not found"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result 		= array(
							'code' 		=> '201',
							'status' 	=> 'success',
							'message' 	=> "Order Cancel Successfully."
						);
						print_r(json_encode($result));
					}
			}
		
	
		
		function LogOut()
			{
				$data = array(
					'UserId' => $this->input->post('UserId') ,
				);
				$query = $this->UserRegistrationModel->clientStaffLogOut($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Login First for LogOut"
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "LogOut Successfully."
						);
						print_r(json_encode($result));
					}
			}
	}
?>