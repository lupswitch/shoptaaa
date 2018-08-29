<?php
require_once('../PPBootStrap.php');
/*
 * The RefundTransaction API operation issues a refund to the PayPal account holder associated with a transaction. 
  This sample code uses Merchant PHP SDK to make API call
 */
$refundReqest = new RefundTransactionRequestType();

/*
 * 	 Type of refund you are making. It is one of the following values:

 * `Full` - Full refund (default).
 * `Partial` - Partial refund.
 * `ExternalDispute` - External dispute. (Value available since
  version
  82.0)
 * `Other` - Other type of refund. (Value available since version
  82.0)
 */
if ($_REQUEST['amt'] != "" && strtoupper($_POST['refundType']) != "FULL") {
    /*
     * 		 `Refund amount`, which contains

     * `Currency Code`
     * `Amount`
      The amount is required if RefundType is Partial.
      `Note:
      If RefundType is Full, do not set the amount.`
     */
    $refundReqest->Amount = new BasicAmountType($_REQUEST['currencyID'], $_REQUEST['amt']);
}
$refundReqest->RefundType = $_REQUEST['refundType'];

/*
 *  Either the `transaction ID` or the `payer ID` must be specified.
  PayerID is unique encrypted merchant identification number
  For setting `payerId`,
  `refundTransactionRequest.setPayerID("A9BVYX8XCR9ZQ");`

  Unique identifier of the transaction to be refunded.
 */
$refundReqest->TransactionID = $_REQUEST['transID'];
$refundReqest->RefundSource = $_REQUEST['refundSource'];
$refundReqest->Memo = $_REQUEST['memo'];
/*
 * 
  (Optional) Maximum time until you must retry the refund.
 */
$refundReqest->RetryUntil = $_REQUEST['retryUntil'];

$refundReq = new RefundTransactionReq();
$refundReq->RefundTransactionRequest = $refundReqest;

/*
 * 	 ## Creating service wrapper object
  Creating service wrapper object to make API call and loading
  Configuration::getAcctAndConfig() returns array that contains credential and config parameters
 */
$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
try {
    /* wrap API method calls on the service object with a try catch */
    $refundResponse = $paypalService->RefundTransaction($refundReq);
} catch (Exception $ex) {
    include_once("../Error.php");
    exit;
}
if (isset($refundResponse)) {
    ?>
    <html>
        <head>
            <title>Paypal Settlements and Refunds in PHP</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <meta name="robots" content="noindex, nofollow">
            <script type="text/javascript">
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-43981329-1']);
                _gaq.push(['_trackPageview']);
                (function() {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
            </script>
        </head>
        <body>

            <div id="main">
                <div class="success_main_heading"> 
                    <h1>Paypal Settlements and Refunds in PHP</h1>
                </div>
                <div id="return">
                    <h2>Refund Status</h2>
                    <hr/>

                    <?php
                    //Rechecking the product price and currency details
                    if ($refundResponse->Ack == 'Success') {
                        echo "<h3 id='success'>Refund Successful</h3>";
                        echo "<P>Gross Refund Amount - " . $refundResponse->GrossRefundAmount->value . " (" . $refundResponse->GrossRefundAmount->currencyID . ")</P>";
                        echo "<P>Refund Transaction ID - " . $refundResponse->RefundTransactionID . "</P>";

                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back </a></div>";
                    } else {
                        echo "<h3 id='fail'>Refund - Failed</h3>";
                        echo "<P>Error Message -" . $refundResponse->Errors[0]->LongMessage. "</P>";
                        echo "<div class='back_btn'><a  href='index.php' id= 'btn'><< Back </a></div>";
                    }
                    ?>
                </div>

                <!-- Right side div -->
                <div class="fr"id="formget">
                    <a href=http://www.formget.com/app><img style="margin-left: 12%;" src="images/formget.jpg" alt="Online Form Builder"/></a>
                </div>
            </div>
        </body>
    </html>
        <?php
}

