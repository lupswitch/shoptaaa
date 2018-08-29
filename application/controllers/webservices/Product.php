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
	* map to /webservices/Product/<method_name>
	*/
class Product extends CI_Controller
	{
		function __construct()
			{
				parent::__construct();
				$this->load->model('webservices/ProductModel');
				$this->load->model('webservices/CommonFormate');
				error_reporting(0);
			}
		function index()
			{
				echo "Hello Manish";
			}
		function getAllProduct()
			{
				$data = array(
					'catid' => $this->input->post('CategaryId') ,
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->ProductModel->getAllProduct($data);				
				if ($query)
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Get All Product Successfully.",							
							'data' => $query
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
			}
		function getProductDetails()
			{
				$data = array(
					'proid' => $this->input->post('ProductId') ,
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->ProductModel->getProduct($data);
				if ($query)
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product found Successfully.",							
							'data' => $query
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
			}
		function getNewProduct()
			{
				$data = array(
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->ProductModel->getNewProduct($data);
				if ($query)
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product found Successfully.",							
							'data' => $query
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
			}
		function productSearch()
			{
				$data = array(
					'searchtext' => $this->input->post('SearchText') ,
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->ProductModel->productSearch($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product found Successfully.",							
							'data' => $query
						);
						print_r(json_encode($result));
					}
			}
		function productFilter()
			{
				$data = array(
					'catid' => $this->input->post('CategaryId') ,
					'price_min' => $this->input->post('PriceMin') ,
					'price_max' => $this->input->post('PriceMax') ,
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->ProductModel->productFilter($data);
				if ($query)
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product found Successfully.",
							'data' => $query
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
			}
		function userCartProduct()
			{
				$data = array(
					'user_id' => $this->input->post('UserId') ,
					'productData' => $this->input->post('ProductData'),
					'TotalPrice' => $this->input->post('TotalPrice')
				);
				$query = $this->ProductModel->userCartProduct($data);
				if ($query == "User")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "User Not found."
						);
						print_r(json_encode($result));
					}
				else if ($query == "Product")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
				else if ($query == "not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "There is no Product in your cart."
						);
						print_r(json_encode($result));
					}
				else if ($query == "cartUpdate")
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Your Cart update Successfully."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => 'Product added Cart Successfully.'
						);
						print_r(json_encode($result));
					}
			}
		function getUserCartProduct()
			{
				$data = array(
					'user_id' => $this->input->post('UserId')
				);
				$query = $this->ProductModel->getUserCartProduct($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "cart product empty.",
							'data' => []
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "cart product found Successfully.",
							'data' => $query
						);
						print_r(json_encode($result));
					}
			}
		function removeProductFromCart()
			{
				$data = array(
					'user_id' => $this->input->post('UserId') ,
					'cartId' => $this->input->post('CartId')
				);
				$query = $this->ProductModel->removeProductFromCart($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Cart Item not found with this user."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Cart Product Deleted Successfully."
						);
						print_r(json_encode($result));
					}
			}
		function removeProductFromWishlist()
			{
				$data = array(
					'user_id' => $this->input->post('UserId') ,
					'prod_id' => $this->input->post('prod_id')
				);
				$query = $this->ProductModel->removeProductFromwishlist($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Wishlist Item not found with this user."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Wishlist Product Deleted Successfully."
						);
						print_r(json_encode($result));
					}
			}
		function cartProductUpdate()
			{
				$data = array(
					'cartId' => $this->input->post('CartId') ,
					'quantity' => $this->input->post('Quantity')
				);
				$query = $this->ProductModel->cartProductUpdate($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Cart Item not found with this user."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Cart Product Updated Successfully."
						);
						print_r(json_encode($result));
					}
			}
		function productFavourite()
			{
				$data = array(
					'wish_pId' => $this->input->post('ProductId') ,
					'wish_uid' => $this->input->post('UserId') ,
				);
				$query = $this->ProductModel->productFavourite($data);
				if ($query == "Fav")
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product Favourite Successfully.",
							'is_Fav'=>'True'
						);
						print_r(json_encode($result));
					}
				else if ($query == "Del")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product unfavourite Successfully.",
							'is_Fav'=>'False'
						);
						print_r(json_encode($result));
					}
				else if ($query == "Product")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "User Not found."
						);
						print_r(json_encode($result));
					}
			}
		function getFavouriteProduct()
			{
				$data = array(
					'user_id' => $this->input->post('UserId') ,
				);
				$query = $this->ProductModel->getFavouriteProduct($data);			
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "Product Not found."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product unfavourite Successfully.",
							'data' => $query
						);
						print_r(json_encode($result));
					}
			}
		function userOrder()
			{
				$data = array(
					'user_id' => $this->input->post('UserId') ,
					'oderDetails' => $this->input->post('ProductJson'),
					'totalPrice' => $this->input->post('TotalPrice'),
					'transactionId'=>$this->input->post('TransactionId'),
					'shippingAddress' => $this->input->post('ShippingAddress'),
					'shippingLat'  => $this->input->post('ShippingLat'),
					'shippingLong' => $this->input->post('ShippingLong'),
					'billingAddress' => $this->input->post('BillingAddress'),
					'billingLat' => $this->input->post('BillingLat'),
					'billingLong' => $this->input->post('BillingLong')
				);
				$query = $this->ProductModel->userOrder($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "error."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product Order Successfully."
						);
						$productData=array_merge($result,$query[0]);
						print_r(json_encode($productData));
					}
			}
		function getUserOrder()
			{
				$data = array(
					'user_id' => $this->input->post('UserId')				
				);
				$query = $this->ProductModel->getUserOrder($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "error."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product Order Successfully.",
							'data'=> $query
						);
						//$productData=array_merge($result,$query[0]);
						print_r(json_encode($result));
					}
			}
		function updateOrderCurrentLocation()
			{
				$data = array(
					'o_id' => $this->input->post('OrderrId'),				
					'currentLat' => $this->input->post('CurrentLat'),
					'currentLong' => $this->input->post('CurrentLong')
				);
				$query = $this->ProductModel->updateOrderCurrentLocation($data);
				if ($query == "Not")
					{
						$result = array(
							'code' => '200',
							'status' => 'failure',
							'message' => "error."
						);
						print_r(json_encode($result));
					}
				  else
					{
						$result = array(
							'code' => '201',
							'status' => 'success',
							'message' => "Product Order Successfully."
						);
						$productData=array_merge($result,$query[0]);
						print_r(json_encode($productData));
					}
			}
	}
?>