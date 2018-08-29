<?php
// # GetPaymentSample
// This sample code demonstrate how you can
// retrieve a list of all Payment resources
// you've created using the Payments API.
// ### Retrieve payment
// Retrieve the payment object by calling the
// static `get` method
// on the Payment class by passing a valid
// Payment ID
// (See bootstrap.php for more on `ApiContext`)

require __DIR__ . '/bootstrap.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\CreditCard;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Transaction;
use PayPal\Api\Refund;
use PayPal\Api\Sale;

/* get CI instance and load model direct */
$CI =& get_instance();
if (isset($_POST['submit'])) {
    $paymentId = $_POST['paymentId'];
    try {
        $payment['jsondata'] = Payment::get($paymentId, $apiContext);
        //$obj = json_decode($payment); // $obj contains the All Transaction Information.Some of them,I have displayed Below. 
       $pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);
       $CI->load->view('admin/share-template/header', $pageHeader);
        $CI->load->view('admin/admin_order_paymentrefundforapp_view',$payment);
        $CI->load->view('admin/share-template/footer');
    } catch (Exception $ex) {
        $payment = 'Not Valid';
    }  
}


if (isset($_POST['RefundBtn'])) {
    $paymentId = $_POST['paymentId'];
    try {
        $payments = Payment::get($paymentId, $apiContext);
    ///    $obj = json_decode($payment); // $obj contains the All Transaction Information.Some of them,I have displayed Below. 
    
    $obj = $payments->toJSON();//I wanted to look into the object
        $paypal_obj = json_decode($obj);//I wanted to look into the object
        $transaction_id = $paypal_obj->transactions[0]->related_resources[0]->sale->id;
         $amtss =$paypal_obj->transactions[0]->amount->total;
         
         $amt = new Amount();
          $amt->setTotal($amtss)->setCurrency('USD');
            
            $refund = new Refund();
            $refund->setAmount($amt);
         
         
         
         
        $sale = new Sale();
        $sale->setId($transaction_id);
        
    $refundedSale['refunddata'] = $sale->refund($refund, $apiContext);
       // print_r($refundedSale);
        $pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);   
			
	  //$CI->load->model('users');
      //$CI->load->model('Founder_group_page_model');	
        $CI->AdminPaymentRefundModel->UpdateOrderStatusForApp($paymentId);
        $CI->load->view('admin/share-template/header', $pageHeader);
        $CI->load->view('admin/admin_order_paymentrefundsucessforapp_view',$refundedSale);
        $CI->load->view('admin/share-template/footer');   
       
    } catch (Exception $ex) {
        
        
         $pageHeader = 	array(  'pagetitle' => 'Order',
			'slug'=>'order-listing',
			'font_icon'=>'shopping-basket',
			);  
        
        $refundedSale['refunddata'] = array('paymentstatus'=>'Payment not valid');
        
         $CI->load->view('admin/share-template/header', $pageHeader);
        $CI->load->view('admin/admin_order_paymentrefundsucessforapp_view',$refundedSale);
        $CI->load->view('admin/share-template/footer');  
    } 
}











?>

