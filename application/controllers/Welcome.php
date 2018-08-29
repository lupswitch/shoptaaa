<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper(array('form','url'));
		$this->load->library(array('session','form_validation','email','upload','cart'));
		$appArry =  array(

						array( 
							'id' => '53',
							'name' => 'fanta',
							'price' => '10',
							'qty' => '4',
							'options' => '',
							'pro_SUK' => 'sku-005521',
							'pro_slug' => 'fanta',
							'pro_categaryName'=> 'Food',
							'pro_categaryId' => '2',
							'pro_brandId' => '8',
							'pro_image' => 'Pro-2017-05-04_07:59:14-GBujw69q4p.jpg',
							'isWishlist' =>'', 
						
						),
						array(
							'id' => '39',
							'name' => 'Lays',
							'price' => '1',
							'qty' => '1',
							'options' => '',
							'pro_SUK' => 'suk-100300',
							'pro_slug' => 'lays',
							'pro_categaryName'=> 'Food',
							'pro_categaryId' => '1',
							'pro_brandId' => '8',
							'pro_image' => 'Pro-2017-04-20_13:13:31-IvNwR1yYL6.jpeg',
							'isWishlist' => '',
						),
						array(
							'id' => '11',
							'name' => 'Pespi 500ml',
							'price' => '2',
							'qty' => '1',
							'options' => '',
							'pro_SUK' => 'SKU-12120245',
							'pro_slug' => 'pepsi-500ml',
							'pro_categaryName'=> 'Drinks',
							'pro_categaryId' => '2',
							'pro_brandId' => '8',
							'pro_image' => 'Pro-2017-04-24_06:45:58-UY5Hzu60rd.jpg',
							'isWishlist' => '',
							'rowid' => '54eff64ed96ec84c79ec5928f417082a',
							'subtotal' => '2',
						),
						
						array(
							"pro_id"=> "1",
							"pro_price"=> "text",
							"pro_description"=> "text",
							"pro_categaryName"=> "text",
							"pro_categaryId"=> "text",
							"pro_name"=> "text",
							"pro_SUK"=>"jkfdhdjk",
							"pro_slug"=>"dlkjfhgkd",
							"pro_image"=> "text",
							"pro_PruchaseQuantity"=> "10"
						),
				);
		
		$newModifiedArry =   SpinAppCartArray($appArry);
		pr($newModifiedArry);
		$this->load->view('welcome_message');
	}
}
