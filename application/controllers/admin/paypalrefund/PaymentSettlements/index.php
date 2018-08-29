<?php
require_once('../PPBootStrap.php');
$transactionID_err = "";
if (isset($_POST['transID'])) {
    /*
     * The GetTransactionDetails API operation obtains information about a specific transaction.
     */
    $transactionDetails = new GetTransactionDetailsRequestType();
    /*
     * Unique identifier of a transaction.
     */
    $transactionDetails->TransactionID = $_POST['transID'];

    $request = new GetTransactionDetailsReq();
    $request->GetTransactionDetailsRequest = $transactionDetails;

    /*
     * 	 ## Creating service wrapper object
      Creating service wrapper object to make API call and loading
      Configuration::getAcctAndConfig() returns array that contains credential and config parameters
     */
    $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
    try {
        /* wrap API method calls on the service object with a try catch */
        $transDetailsResponse = $paypalService->GetTransactionDetails($request);
		
		print_r($transDetailsResponse);
    } catch (Exception $ex) {
        include_once("../Error.php");
        exit;
    }
    if ($transDetailsResponse->Ack == 'Failure') {
        $transactionID_err = 'TransactionID is not valid.';
    }
}
?>
<html>
    <head>
        <title>Paypal Settlements and Refunds in PHP</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/popup-style.css" />
        <link rel="stylesheet" type="text/css" href="css/global.css">
        <link rel="stylesheet" type="text/css" href="css/loadding.css">
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
        <div id = "main">
            <h1>Paypal Settlements and Refunds in PHP</h1>
            <div id = "container">
                <h2>Refund to the PayPal Account Holder Associated With a Transaction.</h2>
                <hr/>
                <div class="fg-row">
                    <form action="index.php" method="POST" id="myform" >
                        <div class="col-md-10 nopadding">
                            <label class="block fg-label">TransactionID *  (Get Transaction ID via :  <a target="blank" href="http://www.formget.com/tutorial/paypal_simple_integration/payments.php">PayPal Integration in PHP Using PDO.</a>)</label>
                            <input class="fg-fw text fg-input" placeholder="" type="text" onclick="" name="transID">
                            <p class="fg-help red"><?php echo $transactionID_err; ?></p>
                        </div>
                        <div class="col-md-2 nopadding">
                            <div style="margin-left: 5%;    margin-top: 14%;">
                                <input type="submit" value="Get Detail" id="submit" name="submit">
                            </div>
                        </div>
                    </form>
                    <div class="fg-clear"></div>
                </div>
                <?php
                if (isset($transDetailsResponse)) {
                    if ($transDetailsResponse->Ack == 'Success') {
                        $currency_value = $transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->currencyID;
                        ?>
                        <div class="fg-row">
                            <div class="col-md-12 nopadding">
                                <table id="results" >
                                    <thead>
                                        <tr class="head">
                                            <th colspan="2">Payer Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row-data unread_new">
                                            <td>Payer Name</td>
                                            <td><?php
                                                echo $transDetailsResponse->PaymentTransactionDetails->PayerInfo->PayerName->FirstName;
                                                echo ' ';
                                                echo $transDetailsResponse->PaymentTransactionDetails->PayerInfo->PayerName->LastName;
                                                ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>Payer Email-ID</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PayerInfo->Payer; ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>City Name</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PayerInfo->Address->CityName; ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>Country</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PayerInfo->Address->Country; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="fg-clear"></div>
                            <div class="col-md-12 nopadding">
                                <table id="results" >
                                    <thead>
                                        <tr class="head">
                                            <th colspan="2">Product Information</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row-data unread_new">
                                            <td>Product Name</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PaymentItemInfo->PaymentItem[0]->Name; ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>Quantity</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PaymentItemInfo->PaymentItem[0]->Quantity; ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>GrossAmount</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->value; ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>currency Type</td>
                                            <td><?php echo $transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->currencyID; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 nopadding">
                            <form action="refund-process.php" method="POST">
                                <table id="results" >
                                    <thead>
                                        <tr class="head">
                                            <th>Refund Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row-data unread_new">
                                            <td>
                                                <div class="fg-row">

                                                </div>
                                                <div class="fg-row" style="  margin-right: 3%;">
                                                    <div class="col-md-4 nopadding">
                                                        <label class="block fg-label">Refund Type</label>
                                                        <select class="fg-select fg-fw" name="refundType" id="refundType">
                                                            <option value="Full">Full Amount</option>
                                                            <option value="Partial">Partial Amount</option>
                                                        </select>
                                                        <p class="fg-help"></p>
                                                    </div>
                                                    <div class="col-md-4 nopadding">
                                                        <div style="margin-left: 5%;">
                                                            <input type="hidden" value="<?php echo $_POST['transID']; ?>" name="transID">
                                                            <label class="block fg-label">Amount</label>
                                                            <input class="fg-fw text fg-input" placeholder="" name="amt" type="number" step=".1" id="amt"  value="" readonly="true">
                                                            <p class="fg-help"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 nopadding">
                                                        <div style="margin-left: 5%;">
                                                            <input type="hidden" value="<?php echo $currency_value; ?>" name="currencyID">
                                                            <label class="block fg-label">Currency Code</label>
                                                            <select class="fg-select fg-fw" disabled="true">
                                                                <option value="USD/$" title="$" <?php echo $currency_value == 'USD' ? 'selected' : ''; ?>>USD</option>
                                                                <option value="AUD/$" title="$" <?php echo $currency_value == 'AUD' ? 'selected' : ''; ?>>AUD</option>
                                                                <option value="BRL/R$" title="R$" <?php echo $currency_value == 'BRL' ? 'selected' : ''; ?>>BRL</option>
                                                                <option value="GBP/£" title="£" <?php echo $currency_value == 'GBP' ? 'selected' : ''; ?>>GBP</option>
                                                                <option value="CAD/$" title="$" <?php echo $currency_value == 'CAD' ? 'selected' : ''; ?>>CAD</option>
                                                                <option value="CZK/" title=""<?php echo $currency_value == 'CZK' ? 'selected' : ''; ?>>CZK</option>
                                                                <option value="DKK/" title=""<?php echo $currency_value == 'DKK' ? 'selected' : ''; ?>>DKK</option>
                                                                <option value="EUR/€" title="€"<?php echo $currency_value == 'EUR' ? 'selected' : ''; ?>>EUR</option>
                                                                <option value="HKD/$" title="$"<?php echo $currency_value == 'HKD' ? 'selected' : ''; ?>>HKD</option>
                                                                <option value="HUF/" title=""<?php echo $currency_value == 'HUF' ? 'selected' : ''; ?>>HUF</option>
                                                                <option value="ILS/₪" title="₪"<?php echo $currency_value == 'ILS' ? 'selected' : ''; ?>>ILS</option>
                                                                <option value="JPY/¥" title="¥"<?php echo $currency_value == 'JPY' ? 'selected' : ''; ?>>JPY</option>
                                                                <option value="MXN/$" title="$"<?php echo $currency_value == 'MXN' ? 'selected' : ''; ?>>MXN</option>
                                                                <option value="TWD/NT$" title="NT$"<?php echo $currency_value == 'TWD' ? 'selected' : ''; ?>>TWD</option>
                                                                <option value="NZD/$" title="$"<?php echo $currency_value == 'NZD' ? 'selected' : ''; ?>>NZD</option>
                                                                <option value="NOK/" title=""<?php echo $currency_value == 'NOK' ? 'selected' : ''; ?>>NOK</option>
                                                                <option value="PHP/P" title="P"<?php echo $currency_value == 'PHP' ? 'selected' : ''; ?>>PHP</option>
                                                                <option value="PLN/" title=""<?php echo $currency_value == 'PLN' ? 'selected' : ''; ?>>PLN</option>
                                                                <option value="RUB/" title=""<?php echo $currency_value == 'RUB' ? 'selected' : ''; ?>>RUB</option>
                                                                <option value="SGD/$" title="$"<?php echo $currency_value == 'SGD' ? 'selected' : ''; ?>>SGD</option>
                                                                <option value="SEK/" title=""<?php echo $currency_value == 'SEK' ? 'selected' : ''; ?>>SEK</option>
                                                                <option value="CHF/" title=""<?php echo $currency_value == 'CHF' ? 'selected' : ''; ?>>CHF</option>
                                                                <option value="THB/฿" title="฿"<?php echo $currency_value == 'THB' ? 'selected' : ''; ?>>THB</option>
                                                            </select>
                                                            <p class="fg-help"></p>
                                                        </div>
                                                    </div>
                                                    <div class="fg-clear"></div>
                                                </div>
                                                <div class="fg-row" style="  margin-right: 3%;">
                                                    <label class="block fg-label">Note</label>
                                                    <textarea class="fg-textarea fg-fw last" rows="6" name="memo"></textarea>
                                                    <p class="fg-help"></p>
                                                    <div class="fg-clear"></div>
                                                </div>
                                                <div class="fg-row" style="  margin-right: 3%;">
                                                    <input type="hidden" name="retryUntil" value="">
                                                    <input type="hidden" name="refundSource" value="any">   
                                                    <input type="submit" value="Refund" name="RefundBtn" id="submit">
                                                    <div class="fg-clear"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <img id="paypal_logo" src="images/secure-paypal-logo.jpg">
        </div>
        <div id="pop2" class="simplePopup">
            <div id="loader">
                <div id="circularG">
                    <div id="circularG_1" class="circularG">
                    </div>
                    <div id="circularG_2" class="circularG">
                    </div>
                    <div id="circularG_3" class="circularG">
                    </div>
                    <div id="circularG_4" class="circularG">
                    </div>
                    <div id="circularG_5" class="circularG">
                    </div>
                    <div id="circularG_6" class="circularG">
                    </div>
                    <div id="circularG_7" class="circularG">
                    </div>
                    <div id="circularG_8" class="circularG">
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.simplePopup.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('input#amt').val('<?php
                if (!empty($transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->value)) {
                    echo $transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->value;
                }
                ?>');
                $('input#amt').css({'background-color': '#F1F1F1'});
                $('input#submit').click(function() {
                    $('#pop2').simplePopup();
                });
                $('#refundType').on('change', function() {
                    if (this.value == 'Full') {
                        $('input#amt').css({'background-color': '#F1F1F1'});
                        $('input#amt').val('<?php
                if (!empty($transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->value)) {
                    echo $transDetailsResponse->PaymentTransactionDetails->PaymentInfo->GrossAmount->value;
                }
                ?>');
                        $('input#amt').prop("readonly", true);
                    } else if (this.value == 'Partial') {
                        $('input#amt').css({'background-color': 'white'});
                        $('input#amt').prop("readonly", false);
                    }
                });
            });
        </script>
    </body>
</html>