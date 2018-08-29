<?php
class CommonFormate extends CI_Model
	{
		function __construct()
			{
				parent::__construct();
				$this->load->model('webservices/PushnotificationModel');
			}
		function getproductImage($pId)
			{
				$this->db->select('*');
				$this->db->from('ProductImage');
				$this->db->where('p_id', $pId);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getSubCatagary($c_id)
			{
				$this->db->select('*');
				$this->db->from('Categary');
				$this->db->where('parent_cat', $c_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		
		function pushNotificationForAssignJob($DeliveryBoy,$orderid)
			{
				
				$this->db->select('*');
				$this->db->from('Registration');
				$this->db->where('user_id',$DeliveryBoy);
				$query = $this->db->get();
				$DeliveryBoyData = $query->result_array();
				
				if($DeliveryBoyData[0]['deviceType']=='1')
				{
					$message="Admin assign you job";
					$this->PushnotificationModel->send_gcm($DeliveryBoyData[0]['deviceId'], $message);
				}
				else
				{
					$message="Job Assign";
					$this->PushnotificationModel->send_notifications($DeliveryBoyData[0]['deviceId'], $message);
				}

				
				
			}
		function getData($email, $OTP)
			{
				$this->db->select('*');
				$this->db->from('Registration');
				$this->db->where('email', $email);
				$this->db->where('OTP', $OTP);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getMyaddress($user_id)
			{
				$this->db->select('*');
				$this->db->from('MyAddress');
				$this->db->where('addr_uid', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getCategory($cId)
			{
				$this->db->select('*');
				$this->db->from('Categary');
				$this->db->where('c_id', $cId);
				$this->db->where('is_cat_active', "1");
				$query = $this->db->get();
				return $query->result_array();
			}
		function getOrderWithDeleveryBoy($user_id,$o_id)
			{
				$this->db->select('*');
				$this->db->from('UserOrders');
				$this->db->where('deleveryBoyId', $user_id);
				$this->db->where('o_id', $o_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getOrderWithCustomerID($user_id,$o_id)
			{
				$this->db->select('shippingAddress,shippingLat,shippingLong,billingAddress,billingLat,billingLong,currentLat,currentLong,updatedLat,updatedLong');
				$this->db->from('UserOrders');
				$this->db->where('order_uid', $user_id);
				$this->db->where('o_id', $o_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getUserData($user_id)
			{
				$this->db->select('*');
				$this->db->from('Registration');
				$this->db->where('user_id', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getUserData2($user_id)
			{
				$this->db->select('user_id,firstName,lastName,profileImage');
				$this->db->from('Registration');
				$this->db->where('user_id', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getfaveriteData($pId, $user_id)
			{
				$this->db->select('*');
				$this->db->from('CustomerWishlist');
				$this->db->where('wish_pId', $pId);
				$this->db->where('wish_uid', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getcartData($product_id, $user_id)
			{
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('userId', $user_id);
				$this->db->where('productId', $product_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getcartDataofDevice($user_id)
			{
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('cart_uid', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getcartdateDeviceId($device_id)
			{
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('device_id', $device_id);
				$this->db->where('userId', '');
				$query = $this->db->get();
				return $query->result_array();
			}
		function getCartProduct($user_id)
			{
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('userId', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getProductData($proid)
			{
				$this->db->select('*');
				$this->db->from('Product p');
				$this->db->where('pId', $proid);
				$this->db->where('p.pro_isActive', "1");
				$this->db->where('p.proQuantity !=', '0');
				
				$query = $this->db->get();
				return $query->result_array();
			}
		function getProductQuantity($proid)
			{
				$this->db->select('proQuantity,pId');
				$this->db->from('Product p');
				$this->db->where('pId', $proid);
				$query = $this->db->get();
				return $query->result_array();
			}
		function getProductDatawithImage($productId)
			{
				$this->db->select('*');
				$this->db->from('Product p');
				$this->db->JOIN('Categary c', 'p.cId=c.c_id');
				$this->db->where('p.pId', $productId);
				$this->db->where('p.pro_isActive', "1");
				$this->db->where('p.proQuantity !=', '0');
				$this->db->where('c.is_cat_active', "1");
				$query = $this->db->get();
				$proData = $query->result_array();
				foreach($proData as $value)
					{
						$productImage = $this->getproductImage($value['pId']);
						if ($value['pId'] == $productImage[0]['p_id'])
							{
								$value['productImage'] = $productImage;
							}
						  else
							{
								$value['productImage'] = [];
							}
						$realData[] = $value;
					}
				return $realData;
			}
		function getFavData($proid, $user_id)
			{
				$this->db->select('*');
				$this->db->from('CustomerWishlist');
				$this->db->where('wish_pId', $proid);
				$this->db->where('wish_uid', $user_id);
				$query = $this->db->get();
				return $query->result_array();
			}
	}
?>