<?php
/********************************************************************
*	@Description : @ProductModel is used to process the array in loop
*	@Developer	 : Er.Manish Kumar Pathak
*	@param		 : Array
*	@Doc		 : 11-May-2017
*	@return		 : Data in New Array
********************************************************************/
class ProductModel extends CI_Model
	{
		function __construct()
			{
				parent::__construct();
				$this->load->model('webservices/CommonFormate');
			}
		function getAllProduct($data)
			{
				$catid 			= $data['catid'];
				$user_id 		= $data['user_id'];

				$this->db->select('*');
				$this->db->from('Product p');
				$this->db->JOIN('Categary c', 'p.cId = c.c_id');
				$this->db->where('p.cId', $catid);
				$this->db->where('p.pro_isActive', "1");
				$this->db->where('c.is_cat_active', "1");
				$this->db->where('p.proQuantity !=', '0');
				$query 			= $this->db->get();
				$productData 	= $query->result_array();

				foreach($productData as $product)
					{
					$productImage 	= $this->CommonFormate->getproductImage($product['pId']);
					$faveriData 	= $this->CommonFormate->getfaveriteData($product['pId'], $user_id);
					if ($product['pId'] == $faveriData[0]['wish_pId'])
						{
							$product['is_Fav'] 	= 'True';
						}
					  else
						{
							$product['is_Fav'] 	= 'False';
						}

					if ($product['pId'] == $productImage[0]['p_id'])
						{
							$product['productImage'] 	= $productImage;
						}
					  else
						{
							$product['productImage'] 	= [];
						}
					$realData[] 	= $product;
					}
				return $realData;
			}
		function productSearch($data)
			{
			$searchtext = $data['searchtext'];
			$user_id = $data['user_id'];
			if (!empty($searchtext))
				{
					$this->db->select('*');
					$this->db->from('Product p');
					$this->db->JOIN('Categary c', 'p.cId = c.c_id');
					$this->db->like('p.productName', $searchtext);

					$this->db->where('p.pro_isActive', "1");
					$this->db->where('p.proQuantity !=', '0');
					$this->db->where('c.is_cat_active', "1");

					$query 			= $this->db->get();
					$productData 	= $query->result_array();
					if (!empty($productData))
						{
							foreach($productData as $product)
								{
									$productImage 	= $this->CommonFormate->getproductImage($product['pId']);
									$faveriData 	= $this->CommonFormate->getfaveriteData($product['pId'], $user_id);
									if ($product['pId'] == $faveriData[0]['prod_id'])
										{
											$product['is_Fav'] = 'True';
										}
									  else
										{
											$product['is_Fav'] = 'False';
										}
									if ($product['pId'] == $productImage[0]['p_id'])
										{
											$product['productImage'] = $productImage;
										}
									  else
										{
											$product['productImage'] = [];
										}
									$realData[] = $product;
								}
							return $realData;
						}
					  else
						{
							return "Not";
						}
				}
			  else
				{
					return "Not";
				}
			}
		function getNewProduct($data)
			{
			
				$user_id 		= $data['user_id'];
				$this->db->select('*');
				$this->db->from('Product p');
				$this->db->JOIN('Categary c', 'p.cId = c.c_id');
			
				$this->db->where('p.pro_isNewArrivals', '1');
				$this->db->where('p.pro_isActive', "1");
				$this->db->where('p.proQuantity !=', '0');
				$this->db->where('c.is_cat_active', "1");	

				$query 			= $this->db->get();
				$productData 	= $query->result_array();
				foreach($productData as $product)
					{
					$productImage 	= $this->CommonFormate->getproductImage($product['pId']);
					$faveriData 	= $this->CommonFormate->getfaveriteData($product['pId'], $user_id);
					if ($product['pId'] == $faveriData[0]['wish_pId'])
						{
							$product['is_Fav'] 	= 'True';
						}
					  else
						{
							$product['is_Fav'] 	= 'False';
						}

					if ($product['pId'] == $productImage[0]['p_id'])
						{
							$product['productImage'] 	= $productImage;
						}
					  else
						{
							$product['productImage'] 	= [];
						}
					$realData[] 	= $product;
					}
				return $realData;

			}
		function productFilter($data)
			{
				$catid 		= $data['catid'];
				$user_id 	= $data['user_id'];
				$price_min 	= $data['price_min'];
				$price_max 	= $data['price_max'];
				$query = $this->db->query("SELECT * FROM Product WHERE (productPrice > " . $price_min . " AND productPrice <= " . $price_max . " AND pro_isActive = 1 AND proQuantity != 0) AND cId=".$catid ."");
				$dataProduct = $query->result_array();
				foreach($dataProduct as $product)
					{
						$category 		= $this->CommonFormate->getCategory($product['cId']);
						$productImage 	= $this->CommonFormate->getproductImage($product['pId']);
						$faveriData 	= $this->CommonFormate->getfaveriteData($product['pId'], $user_id);
						//print_r($faveriData);
						if ($product['cId'] == $category[0]['c_id'])
							{
								$product 	= array_merge($product, $category[0]);
							}
						if ($product['pId'] == $faveriData[0]['wish_pId'])
							{
								$product['is_Fav'] 	= 'True';
							}
						  else
							{
								$product['is_Fav'] 	= 'False';
							}
						if ($product['pId'] == $productImage[0]['p_id'])
							{
								$product['productImage'] 	= $productImage;
							}
						  else
							{
								$product['productImage'] 	= [];
							}
						$realData[] 	= $product;
					}
				return $realData;
			}
		function userCartProduct($data)
			{
				$user_id 				= $data['user_id'];
				$product_data 			= $data['productData'];
				$totalCartPrice 		= $data['TotalPrice'];

				$Decode_product_data 	= json_decode($product_data,true);
				if(!empty($Decode_product_data))
				{

					/* convert cart format with Website */
					$product_data 			=	SpinAppCartArray($Decode_product_data);	
					/* convert cart format with Website */
					$product 				= serialize($product_data);
					//$totalCartPrice 		= 10501 + 1;
					$userData = $this->CommonFormate->getUserData($user_id);
					$cartData = $this->CommonFormate->getcartDataofDevice($user_id);
					if (!empty($cartData))
					{
						$update_cart = array(
							'cartValues' 		=> $product,
							'cart_TotalPrice' 	=> $totalCartPrice
						);
						$this->db->where('cart_uid', $user_id);
						$this->db->update('UsersCart', $update_cart);
						return "cartUpdate";
					}
					else
					{
						$insert_cart = array(
							'cart_uid' 			=> $user_id,
							'cartValues' 		=> $product,
							'cart_TotalPrice' 	=> $totalCartPrice
						);
						$this->db->insert('UsersCart', $insert_cart);
						$lastId = $this->db->insert_id();
						return "upload";
					}
				}
			
				else
				{
					
				
					$this->db->where('cart_uid', $user_id); // 5 june 2017
					$this->db->delete('UsersCart');
					return "not";	
				}
				
			}
		function getUserCartProduct($data)
			{
				$user_id = $data['user_id'];
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('cart_uid', $user_id);
				$query = $this->db->get();
				$productData = $query->result_array();
				foreach($productData as $product)
					{
						$cartValues = $product['cartValues'];
						$cartValues = unserialize($cartValues);
						if ($product['cartValues'])
							{
								$product['cartValues'] = ReverseSpinAppCartArray($cartValues);
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
	
		function userOrder($data)
			{
				$user_id 		= $data['user_id'];
				$oderDetails 	= $data['oderDetails'];
				$ModifiedOderDetails = json_decode($oderDetails, true);	
				if(!empty($ModifiedOderDetails))
				{
					/* convert cart format with Website */
					$oderDetails 	=   SpinAppCartArray($ModifiedOderDetails);
					/* convert cart format with Website */
					$product 		= serialize($oderDetails);
					$totalPrice 	= $data['totalPrice'];
					$shippingAddress= serialize(json_decode($data['shippingAddress'], true));
					$billingAddress = serialize(json_decode($data['billingAddress'], true));
					$transactionId 	= $data['transactionId'];
					$shippingLat 	= $data['shippingLat'];
					$shippingLong 	= $data['shippingLong'];
					$billingLat 	= $data['billingLat'];
					$billingLong 	= $data['billingLong'];
					$this->db->insert('UserOrders', array(
									'order_uid' 	    => $user_id,					
									'oderDetails' 	    => $product,
									'transactionId'     => $transactionId,
									'totalPrice' 	    => $totalPrice,
									'shippingLat' 	    => $shippingLat,
									'shippingLong' 	    => $shippingLong,
									'billingLat' 		=> $billingLat,
									'billingLong' 		=> $billingLong,					
									'shippingAddress' 	=> $shippingAddress,
									'billingAddress' 	=> $billingAddress
								));
					$lastId = $this->db->insert_id();
					$CustomOrder_id = OD . strtotime(date('Y-m-d H:m:i')) . SA . $lastId;
					$this->db->set('order_id', $CustomOrder_id);
					$this->db->where('o_id', $lastId);
					$this->db->update('UserOrders');

					/* UsersCart */
					$this->db->where('cart_uid', $user_id);
					$this->db->delete('UsersCart');
					/* UserOrders */

					$this->db->select('*');
					$this->db->from('UserOrders');
					$this->db->where('o_id', $lastId);
					$query = $this->db->get();
					$productData = $query->result_array();
					foreach($productData as $product)
						{
							$cartValues 	 = unserialize($product['oderDetails']);
							$shippingAddress = unserialize($product['shippingAddress']);
							$shippingAddress = $shippingAddress['address'] . "," . $shippingAddress['town_city'] . "," . $shippingAddress['state'] . "," . $shippingAddress['country'] . "," . $shippingAddress['postcode'] . "," . $shippingAddress['phone'];
							$billingAddress  = unserialize($product['billingAddress']);
							$billingAddress  = $billingAddress['address'] . "," . $billingAddress['town_city'] . "," . $billingAddress['state'] . "," . $billingAddress['country'] . "," . $billingAddress['postcode'] . "," . $billingAddress['phone'];

							if ($product['oderDetails'])
								{
								$product['oderDetails']     = ReverseSpinAppCartArray($cartValues);
								$product['shippingAddress'] = $shippingAddress;
								$product['billingAddress']  = $billingAddress;
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
				else
				{
						return "Not";
				}
			}
		function getUserOrder($data)
			{
				$this->db->select('*');
				$this->db->from('UserOrders');
				$this->db->where('order_uid', $data['user_id']);
				$this->db->order_by('o_id', 'DESC');
				$query = $this->db->get();
				$productData = $query->result_array();
				foreach($productData as $product)
					{
						$shippingAddress = unserialize($product['shippingAddress']);
						$shippingAddress = $shippingAddress['address'] . " , " . $shippingAddress['town_city'] . " , " . $shippingAddress['state'] . " , " . $shippingAddress['country'] . " , " . $shippingAddress['postcode'] . " , " . $shippingAddress['phone'];
						$billingAddress = unserialize($product['billingAddress']);
						$billingAddress = $billingAddress['address'] . " , " . $billingAddress['town_city'] . " , " . $billingAddress['state'] . " , " . $billingAddress['country'] . " , " . $billingAddress['postcode'] . " , " . $billingAddress['phone'];
						$cartValues = unserialize($product['oderDetails']);
						if ($product)
							{
								$product['oderDetails'] = ReverseSpinAppCartArray($cartValues);
								$product['shippingAddress'] = $shippingAddress;
								$product['billingAddress'] = $billingAddress;
							}
						if ($product['orderStatus'] == 'cancel')
							{
								$product['isRefundRequest'] = 'True';
							}
						  else
							{
								$product['isRefundRequest'] = 'False';
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
		function updateOrderCurrentLocation($data)
			{
				$o_id 		= $data['o_id'];
				$currentLat = $data['currentLat'];
				$currentLong= $data['currentLong'];
				$this->db->select('*');
				$this->db->from('UserOrders');
				$this->db->where('o_id', $o_id);
				$query = $this->db->get();
				$productData = $query->result_array();
				if (!empty($productData))
					{
						$this->db->where('o_id', $o_id);
						$this->db->update('UserOrders',
															array(
															'currentLat'  => $currentLat,
															'currentLong' => $currentLong
															));
						$this->db->select('shippingAddress, shippingLat, shippingLong, billingAddress, billingLat, billingLong, currentLat, currentLong');
						$this->db->from('UserOrders');
						$this->db->where('o_id', $o_id);
						$query = $this->db->get();
						return $query->result_array();
					}
				  else
					{
						return "Not";
					}
			}
		function getProduct($data)
			{
				$proid = $data['proid'];
				$user_id = $data['user_id'];
				$this->db->select('*');
				$this->db->from('Product p');
				$this->db->JOIN('Categary c', 'p.cId = c.c_id');

				$this->db->where('p.pro_isActive', "1");
				$this->db->where('p.proQuantity !=', '0');
				$this->db->where('c.is_cat_active', "1");
				

				$this->db->where('p.pId', $proid);
				$query = $this->db->get();
				$productData = $query->result_array();
				foreach($productData as $product)
					{
						$productImage = $this->CommonFormate->getproductImage($product['pId']);
						$faveriData = $this->CommonFormate->getfaveriteData($product['pId'], $user_id);
						if ($product['pId'] == $faveriData[0]['wish_pId'])
							{
								$product['is_Fav'] = 'True';
							}
						  else
							{
								$product['is_Fav'] = 'False';
							}

						if ($product['pId'] == $productImage[0]['p_id'])
							{
								$product['productImage'] = $productImage;
							}
						  else
							{
								$product['productImage'] = [];
							}
						$realData[] = $product;
					}
				return $realData;
			}
		function removeProductFromCart($data)
			{
				$user_id 	= $data['user_id'];
				$cartId 	= $data['cartId'];
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('userId', $user_id);
				$this->db->where('cartId', $cartId);
				$query = $this->db->get();
				$UsersCartData = $query->result_array();
				if (!empty($UsersCartData))
					{
						$this->db->where('cartId', $cartId);
						$this->db->where('userId', $user_id);
						$this->db->delete('UsersCart');
						return "Del";
					}
				  else
					{
						return "Not";
					}
			}
		function removeProductFromwishlist($data)
			{
				$user_id = $data['user_id'];
				$prod_id = $data['prod_id'];
				$this->db->select('*');
				$this->db->from('FavouriteProduct');
				$this->db->where('usersId', $user_id);
				$this->db->where('prod_id', $prod_id);
				$query = $this->db->get();
				$UsersWishlistData = $query->result_array();
				if (!empty($UsersWishlistData))
					{
						$this->db->where('prod_id', $prod_id);
						$this->db->where('usersId', $user_id);
						$this->db->delete('FavouriteProduct');
						return "Del";
					}
				  else
					{
						return "Not";
					}
			}
		function cartProductUpdate($data)
			{
				$cartId 	= $data['cartId'];
				$quantity 	= $data['quantity'];
				$this->db->select('*');
				$this->db->from('UsersCart');
				$this->db->where('cartId', $cartId);
				$query 		= $this->db->get();
				$UsersCartData = $query->result_array();
				if (!empty($UsersCartData))
					{
						$this->db->where('cartId', $cartId);
						$this->db->update('UsersCart', array(
							'pro_quality' => $quantity
						));
						return "cartUpdate";
					}
				  else
					{
						return "Not";
					}
			}
		function productFavourite($data)
			{
				$proid 		= $data['wish_pId'];
				$user_id 	= $data['wish_uid'];

				$userData 	= $this->CommonFormate->getUserData($user_id);
				$productData= $this->CommonFormate->getProductData($proid);
				
				if (!empty($userData))
					{
						if (!empty($productData))
							{
								$favData = $this->CommonFormate->getFavData($proid, $user_id);
								if (!empty($favData))
									{
										$this->db->where('wish_pId', $proid);
										$this->db->where('wish_uid', $user_id);
										$this->db->delete('CustomerWishlist');
										return "Del";
									}
								  else
									{
										$where = array(
											'wish_pId' => $proid,
											'wish_uid' => $user_id,
											'wish_created' => date('Y-m-d H:i:s')
										);
										$this->db->insert('CustomerWishlist', $where);
										return "Fav";
									}
							}
						  else
							{
								return "Product";
							}
					}
				  else
					{
						return "User";
					}
			}
		function getFavouriteProduct($data)
			{
				$user_id = $data['user_id'];
				$this->db->select('*');
				$this->db->from('CustomerWishlist');
				$this->db->where('wish_uid', $user_id);
				$query 	 = $this->db->get();
				$productData = $query->result_array();
				if (!empty($productData))
					{
						foreach($productData as $favProduct)
							{
								$producData = $this->CommonFormate->getProductDatawithImage($favProduct['wish_pId']);
								if ($favProduct['wish_pId'] == $producData[0]['pId'])
									{
										$favProduct = array_merge($favProduct, $producData[0]);
									}

								$realData[] = $favProduct;
							}
						return $realData;
					}
				  else
					{
					return "Not";
					}
			}
	}
?>