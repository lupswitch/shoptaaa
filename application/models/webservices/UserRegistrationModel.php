<?php
class UserRegistrationModel extends CI_Model

	{
	function __construct()
		{
			parent::__construct();
			$this->load->model('webservices/CommonFormate');		
		}
	function registration($data)
		{
			
			$firstName = $data['firstName'];
			$userName = $data['userName'];
			$email = $data['email'];
			$password = $data['password'];
			$userType = $data['userType'];
			$profileImage = $data['profileImage'];
			$deviceType = $data['deviceType'];
			$deviceId = $data['deviceId'];
			if(!empty($profileImage))
			{
				$profileImage = $profileImage;				
			}
			else
			{
				$profileImage= base_url()."uploads/main/noimage.png";
			}

			
			$this->db->insert('Registration', array(
				'firstName'=>$firstName,
				'userName'=>$userName,
				'email'=>$email,
				'password'=>$password,
				'userType'=>$userType,
				'profileImage'=>$profileImage,
				'deviceType'=>$deviceType,
				'deviceId'=>$deviceId
				));
			$lastId = $this->db->insert_id();
			$this->db->select('*');
			$this->db->from('Registration');
			$this->db->where('user_id', $lastId);
			$query = $this->db->get();
			return $query->result_array();
		}

	function clientStaffLogin($data)
		{
		$email = $data['email'];
		$password = md5(md5($data['password']));
		$deviceType = $data['deviceType'];
		$deviceId = $data['deviceId'];

		// $this->db->set('deviceType', $deviceType);
		// $this->db->set('is_active', '1');
		// $this->db->set('deviceId', $deviceId);

		$this->db->where("(email = '$email' OR userName= '$email')");
		$this->db->update('Registration', array(
			'deviceType' => $deviceType,
			'is_active' => '1',
			'deviceId' => $deviceId
		));
		$this->db->select('*');
		$this->db->from('Registration');
		$this->db->where("(Registration.email = '$email' OR Registration.userName= '$email')");
		$this->db->where('password', $password);
		$this->db->where('userType !=', 'admin');
		$query = $this->db->get();
		return $query->result_array();
		}

	function clientStaffLogOut($data)
		{
		$this->db->set('is_active', '0');
		$this->db->where('UserId', $data['UserId']);
		$this->db->update('Registration');
		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows)
			{
			return "Update";
			}
		  else
			{
			return "Not";
			}
		}

	function userMyAddress($data)
		{
		$user_id = $data['addr_uid'];
		$firstName = $data['firstName'];
		$lastName = $data['lastName'];
		$address = $data['address'];
		$PhoneNumber = $data['PhoneNumber'];
		$city = $data['city'];
		$state = $data['state'];
		$country = $data['country'];
		$zip = $data['zip'];
		$userMyAddress = $this->CommonFormate->getMyaddress($user_id);
		if (!empty($userMyAddress))
			{
			$this->db->where('addr_uid', $user_id);
			$this->db->update('MyAddress', array(
				'firstName' => $firstName,
				'lastName' => $lastName,
				'address' => $address,
				'PhoneNumber' => $PhoneNumber,
				'city' => $city,
				'state' => $state,
				'country' => $country,
				'zip' => $zip
			));
			return "Update";
			}
		  else
			{
			$this->db->insert('MyAddress', $data);
			return "Insert";
			}
		}

	function getMyAddress($data)
		{
		$user_id = $data['user_id'];
		$this->db->select('*');
		$this->db->from('MyAddress');
		$this->db->where('addr_uid', $user_id);
		$query = $this->db->get();
		$myData = $query->result_array();
		if (!empty($myData))
			{
			return $myData;
			}
		  else
			{
			return "Not";
			}
		}

	function forgotPassword($Email, $code)
		{
		$this->db->set('OTP', $code);
		$this->db->where('email', $Email);
		$this->db->update('Registration');
		$afftectedRows = $this->db->affected_rows();
		if ($afftectedRows > 0)
			{
			return $afftectedRows;
			}
		  else
			{
			return False;
			}
		}

	function resetPassword($data)
		{
		$email = $data['email'];
		$OTP = $data['OTP'];
		$password = md5(md5($data['password']));
	//	$password = $data['password'];
		$EmailData = $this->CommonFormate->getData($email, $OTP);
		if (!empty($EmailData))
			{
			$this->db->set('OTP', "");
			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('Registration');
			return "Update";
			}
		  else
			{
			return "Not";
			}
		}

	function passwordChange($data)
		{
		$email = $data['email'];
		//$oldpassword = $data['oldpassword'];
		//$password 	 = $data['password'];
		$password 		= md5(md5($data['password']));
		$oldpassword    = md5(md5($data['oldpassword']));
		
		$this->db->select('*');
		$this->db->from('Registration');
		$this->db->where('email', $email);
		$this->db->where('password', $oldpassword);
		$query = $this->db->get();
		$userData = $query->result_array();
		if (!empty($userData))
			{
			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('Registration');
			return "Update";
			}
		else
			{
			return "Not";
			}
		}

	function getDileveryBoyJobs($data)
		{
		$UserId = $data['UserId'];
		$this->db->select('*');
		$this->db->from('UserOrders');
		$this->db->where('deleveryBoyId', $UserId);
		$this->db->order_by("o_id", "desc");
		$query = $this->db->get();
		$productData = $query->result_array();
		foreach($productData as $product)
			{
			$userData = $this->CommonFormate->getUserData2($product['user_id']);
			$shippingAddress = unserialize($product['shippingAddress']);

			$shippingAddress = $shippingAddress['address'] . " , " . $shippingAddress['town_city'] . " , " . $shippingAddress['state'] . " , " . $shippingAddress['country'] . " , " . $shippingAddress['postcode'] . " , " . $shippingAddress['phone'];
			$billingAddress = unserialize($product['billingAddress']);

			$billingAddress = $billingAddress['address'] . " , " . $billingAddress['town_city'] . " , " . $billingAddress['state'] . " , " . $billingAddress['country'] . " , " . $billingAddress['postcode'] . " , " . $billingAddress['phone'];
			$cartValues = unserialize($product['oderDetails']);
			if ($product)
				{
				$product['oderDetails'] =  ReverseSpinAppCartArray($cartValues);
				$product['shippingAddress'] = $shippingAddress;
				$product['billingAddress'] = $billingAddress;
				}

			if ($product['user_id'] == $userData[0]['user_id'])
				{
				$productData = array_merge($product, $userData[0]);
				}

			$realData[] = $product;
			}

		if (!empty($realData))
			{
			return $realData;
			}
		else
			{
			return "Not";
			}
		}

	function profileUpdate($data)
		{
			$UserId = $data['UserId'];
			$firstName = $data['firstName'];
			$phoneNumber = $data['phoneNumber'];
			$profileImage = $data['profileImage'];
			$userData = $this->CommonFormate->getUserData($UserId);
			if ($profileImage == "uploads/main/noimage.png")
				{
				$profileImage = $userData[0]['profileImage'];
				}
			else
				{
				$profileImage = $profileImage;
				}

			if (!empty($userData))
				{
					$this->db->where('user_id', $UserId);
					$this->db->update('Registration', array(
						'firstName' => $firstName,
						'phoneNumber' => $phoneNumber,
						'is_active' => '1',
						'profileImage' => $profileImage
					));
					$this->db->select('*');
					$this->db->from('Registration');
					$this->db->where('user_id', $UserId);
					$query = $this->db->get();
					return $query->result_array();
				}
			else
				{
				return "Not";
				}
		}
	function updateCurrentLocationOrder($data)
    	{

    	   
    	    $OrderId     	= $data['o_id'];
    	    $updatedLat 	= $data['updatedLat'];
    	    $updatedLong 	= $data['updatedLong'];
    	    $deleveryBoyId 	= $data['deleveryBoyId'];
    	    
    	    $this->db->select('*');
			$this->db->from('UserOrders');
			$this->db->where('o_id', $OrderId);
			$this->db->where('deleveryBoyId', $deleveryBoyId);
			$query = $this->db->get();
			$o_data = $query->result_array();

			if(!empty($o_data))
			{
			    $updateArry = array(
								'updatedLat' => $updatedLat,
								'updatedLong' => $updatedLong
							 );
				$this->db->where('o_id', $OrderId);
				$this->db->where('deleveryBoyId', $deleveryBoyId);
				$this->db->update('UserOrders', $updateArry);
				return true;
			   
			}
			else
			{
			    
			    return false;
			}
    	}
    function trackDileveryBoy($data)
    {
    	$user_id = $data['user_id'];
    	$o_id    = $data['o_id'];
    	
    	$orderData = $this->CommonFormate->getOrderWithCustomerID($user_id,$o_id);
    	if(!empty($orderData))
    	{
    		$orData = $this->CommonFormate->getOrderWithCustomerID($user_id,$o_id);
    		$array = [];
    		foreach ($orData as $oData) {
					
    			$shippingAddress = unserialize($oData['shippingAddress']);
    			$shippingLat 	 = $oData['shippingLat'];
    			$shippingLong 	 = $oData['shippingLong'];

    			$billingAddress  = unserialize($oData['billingAddress']);
    			$billingLat 	 = $oData['billingLat'];
    			$billingLong 	 = $oData['billingLong'];

    			$currentLat 	 = $oData['currentLat'];
    			$currentLong 	 = $oData['currentLong']; 

    			$updatedLat 	 = $oData['updatedLat'];
    			$updatedLong 	 = $oData['updatedLong'];

    			$array['shippingAddress']   =  	$shippingAddress = $shippingAddress['address'] . "," . $shippingAddress['town_city'] .						 "," . $shippingAddress['state'] . "," . $shippingAddress['country'] . "," . $shippingAddress['postcode'] . "," . $shippingAddress['phone'];
    			$array['destinationLat']	  = $shippingLat;
    			$array['destinationLong']	  = $shippingLong;
    			$array['destinationLong']	  = $shippingLong;

    			$array['billingAddress']	  = 
												$billingAddress = $billingAddress['address'] . "," . $billingAddress['town_city'] . "," . $billingAddress['state'] . "," . $billingAddress['country'] . "," . $billingAddress['postcode'] . "," . $billingAddress['phone'];

    			$array['billingLat']	  	  = $billingLat;
    			$array['billingLong']	  	  = $billingLong;

    			$array['sourceLat']	  	  = $currentLat;
    			$array['sourceLong']	  = $currentLong;

    			$array['updatedLat']	  	  = $updatedLat;
    			$array['updatedLong']	  	  = $updatedLong;



    		}
    			return $array;

    	}
    	else
    	{
    		return false;
    	}
    }

	function getQuotes($data)
		{
			$this->db->select('*');
			$this->db->from('Quotes q');
			$this->db->JOIN('Registration r', 'q.UsersId = r.UserId');
			$this->db->JOIN('ClientsJob cj', 'q.JobsId = cj.JobId');
			$this->db->where('q.UsersId', $data['UserId']);
			$query = $this->db->get();
			return $query->result_array();
		}

	function getQuotesNotification($data)
		{
			$this->db->select('*');
			$this->db->from('QuotesNotification');
			$this->db->where('UsersId', $data['UserId']);
			$query = $this->db->get();
			return $query->result_array();
		}
		  


	function deliveryBoyTracking($data)
		{
			//echo "<pre>";print_r($data);die;
			$user_id = $data['user_id'];
			$o_id = $data['o_id'];
			$orderStatus = $data['orderStatus'];
			$currentLat = $data["currentLat"];
			$currentLong = $data['currentLong'];
			
			$checkOrder = $this->CommonFormate->getOrderWithDeleveryBoy($user_id, $o_id);
			$userData = $this->CommonFormate->getUserData($checkOrder[0]['order_uid']);		
			
			if (!empty($checkOrder))
				{
					if ($orderStatus == "ongoing")
						{
							$this->db->where('deleveryBoyId', $user_id);
							$this->db->where('o_id', $o_id);
							$this->db->update('UserOrders', array(
								'orderStatus' => $orderStatus,
								'currentLat'=>$currentLat,
								'currentLong'=>$currentLong
							));
							$message = "Your order has been shipped. Will arrive shortly at your shipping Address.";
							if ($userData[0]['deviceType'] == '1')
								{
									$this->PushnotificationModel->send_gcm($userData[0]['deviceId'], $message);
								}
							  else
								{
									//$this->PushnotificationModel->send_notifications($userData[0]['deviceId'], $message);
								}
							return "Update";
						}
					  else
						{
							$this->db->where('deleveryBoyId', $user_id);
							$this->db->where('o_id', $o_id);
							$this->db->update('UserOrders', array(
								'orderStatus' => $orderStatus
							));
							$message = "Your order has been delivered at your shipping Address. Thank you for choosing us.";
							if ($userData[0]['deviceType'] == '1')
								{
									$this->PushnotificationModel->send_gcm($userData[0]['deviceId'], $message);
								}
							  else
								{
									//$this->PushnotificationModel->send_notifications($userData[0]['deviceId'], $message);
								}
							return "Update";
						}
				}
			  else
				{
				return "Not";
				}
		}
	function orderCancellation($data)
		{
			$user_id = $data['user_id'];
			$o_id = $data['o_id'];
			$orderStatus = $data['orderStatus'];
			$cancelReason = $data['cancelReason'];
			$this->db->select('*');
			$this->db->from('UserOrders');
			$this->db->where('order_uid', $user_id);
			$this->db->where('o_id', $o_id);
			$query = $this->db->get();
			$oderData = $query->result_array();
			if (!empty($oderData))
				{
				$this->db->where('order_uid', $user_id);
				$this->db->where('o_id', $o_id);
				$this->db->update('UserOrders', array(
					'orderStatus' => $orderStatus,
					'cancelReason' => $cancelReason
				));
				return "Update";
				}
			  else
				{
				return "Not";
				}
		}
	}

?>