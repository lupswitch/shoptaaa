<?php
   $apiContext = new ApiContext(new OAuthTokenCredential(
            "<AZvAStit0v0D6SZI-87z_Bh7AW6Y9KkI0hx6eQi5rcC7VwhJo6hOsfuwhPuicUB_5tW0H_Y0jg1o77TP>", "<EIncImuWsX21w6AyqbSIK7zD4UM4xlpT-xba_Fjw3-10MDhT8UXIFFmNfDZV6GG3ryZVpQ7796ZuCi3D>")
    );
    $payments = Payment::get("PAY-7BE79323KP901421XLEN72QY", $apiContext);
    $payments->getTransactions();
    $obj = $payments->toJSON();//I wanted to look into the object
    $paypal_obj = json_decode($obj);//I wanted to look into the object
	echo "<pre>";
	print_r($paypal_obj);
	echo "</pre>";
	
    $transaction_id = $paypal_obj->transactions[0]->related_resources[0]->sale->id;
    $this->refund($transaction_id);//Call your custom refund method

?>

