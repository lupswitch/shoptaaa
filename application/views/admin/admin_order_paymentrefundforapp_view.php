 <div class="content-wrapper" style="min-height: 1142px;">
 <section class="content">  <div class="admin_cont">
	   <div id="container">
	   
	   <?php
                if(empty($jsondata))
					
					{  ?>
					 <div class="fg-row">
                    <form action="<?php echo base_url('admin/paymentrefundforApp-view/').$currentorderid ; ?>" method="POST" id="myform" >
                        <div class="col-md-10 nopadding">
                            <label class="block fg-label">TransactionID</label>
                            <input class="fg-fw text fg-input" placeholder="" readonly type="text" value="<?php echo $paypalrefundData['transactionId']; ?>"  onclick="" name="paymentId">
                           
							
                        </div>
                        <div class="col-md-2 nopadding">
                            <div class="button_custom">
                                <input type="submit" value="Get Detail" id="submit" name="submit">
                            </div>
                        </div>
                    </form>
                    <div class="fg-clear"></div>
                </div>
				
					
					<?php } else {
					//pr($jsondata);
						
						 ?>	
					
	                  <div class="fg-row">
                  
                        <div class="col-md-10 nopadding">
                            <label class="block fg-label">TransactionID</label>
                            <input class="fg-fw text fg-input" placeholder="" readonly type="text" value="<?php echo $jsondata->id; ?>"  onclick="" name="paymentId">
                           
							
                        </div>
                       
                    
                    <div class="fg-clear"></div>
                </div>
	   
                <h2 class="custom_main_title">Refund to the PayPal Account Holder Associated With a Transaction.</h2>
                <hr/>
				
					
               
                <?php
				
					}
		
				  if (isset($jsondata)) {
				//pr($jsondata->transactions[0]->amount);
				  //echo $transactionID_err;
				  
          
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
                                                echo $jsondata->payer->payer_info->first_name;
                                                echo ' ';
                                                echo $jsondata->payer->payer_info->last_name;
                                                ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>Payer Email-ID</td>
                                            <td><?php echo $jsondata->payer->payer_info->email; ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>City Name</td>
                                            <td></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>Country</td>
                                            <td><?php echo  $jsondata->payer->payer_info->country_code;  ?></td>
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
                                            <td></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>Quantity</td>
                                            <td></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>GrossAmount</td>
                                            <td><?php echo  $jsondata->transactions[0]->amount->total;  ?></td>
                                        </tr>
                                        <tr class="row-data unread_new">
                                            <td>currency Type</td>
                                            <td><?php echo  $jsondata->transactions[0]->amount->currency;  ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 nopadding">
                           
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
                                                            <input type="hidden" value="<?php //echo $_POST['transID']; ?>" name="transID">
															<input type="hidden" value="<?php //echo $currentorderid;?>"
															name="orderid">
															
                                                            <label class="block fg-label">Amount</label>
                                                            <input class="fg-fw text fg-input" placeholder="" name="amt" type="number" step=".1" id="amt"  value="" readonly="true">
                                                            <p class="fg-help"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 nopadding">
                                                        <div style="margin-left: 5%;">
<?php $currency_value = $jsondata->transactions[0]->amount->currency; ?>
                                                            <input type="hidden" value="<?php echo $currency_value; ?>" name="currencyID">
                                                            <label class="block fg-label">Currency Code</label>
                                                            <select class="fg-select fg-fw" disabled="true">
                                                                 <option value="USD/$" title="$" <?php  echo $currency_value == 'USD' ? 'selected' : ''; ?>>USD</option>
                                                                <option value="AUD/$" title="$" <?php echo $currency_value == 'AUD' ? 'selected' : ''; ?>>AUD</option>
                                                                <option value="BRL/R$" title="R$" <?php echo $currency_value == 'BRL' ? 'selected' : ''; ?>>BRL</option>
                                                                <option value="GBP/£" title="£" <?php echo $currency_value == 'GBP' ? 'selected' : ''; ?>>GBP</option>
                                                                <option value="CAD/$" title="$" <?php echo $currency_value == 'CAD' ? 'selected' : ''; ?>>CAD</option>
                                                                <option value="CZK/" title=""<?php echo $currency_value == 'CZK' ? 'selected' : ''; ?>>CZK</option>
                                                                <option value="DKK/" title=""<?php echo $currency_value == 'DKK' ? 'selected' : ''; ?>>DKK</option>
                                                                <option value="EUR/€" title="€"<?php echo $currency_value == 'EUR' ? 'selected' : ''; ?>>EUR</option>
                                                                <option value="HKD/$" title="$"<?php echo $currency_value == 'HKD' ? 'selected' : ''; ?>>HKD</option>
                                                                <option value="HUF/" title=""<?php echo $currency_value == 'HUF' ? 'selected' : ''; ?>>HUF</option>
                                                                <option value="ILS/?" title="?"<?php echo $currency_value == 'ILS' ? 'selected' : ''; ?>>ILS</option>
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
                                                                <option value="THB/?" title="?"<?php echo $currency_value == 'THB' ? 'selected' : ' '; ?>>THB</option>
                                                   
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


<?php  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";   ?>
 <form action="<?php  echo  $actual_link; ?>" method="POST">

                                                     <input type="hidden" name="retryUntil" value="">
                                                    <input type="hidden" name="paymentId" value="<?php echo $jsondata->id; ?>">  
													
													
                                                    <input type="submit" value="Refund" name="RefundBtn" id="submit">
                                                    <div class="fg-clear"></div></form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                        </div>
                       
					 
					 <p class="fg-help red"><?php //if($transDetailsResponse->Errors !=""){ echo $transDetailsResponse->Errors[0]->LongMessage; } ?></p> 
					 
                <?php } 
                ?>
            </div>   			</div>
            <img id="paypal_logo" src="<?php echo base_url('/assets/admin/PayPalRefundPage/images/secure-paypal-logo.jpg');?>">
        
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
		
		</section>
		</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/admin/PayPalRefundPage/css/style.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/admin/PayPalRefundPage/css/popup-style.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/admin/PayPalRefundPage/css/global.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/admin/PayPalRefundPage/css/loadding.css');?>">	
  <script src="<?php echo base_url('/assets/admin/PayPalRefundPage/js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('/assets/admin/PayPalRefundPage/js/jquery.simplePopup.js');?>" type="text/javascript"></script>
        <script type="text/javascript">
           jQuery(document).ready(function() {
                 jQuery('input#amt').val('<?php
                if (!empty($jsondata->transactions[0]->amount->total)) {
                    echo $jsondata->transactions[0]->amount->total;
                }
                ?>');
                 jQuery('input#amt').css({'background-color': '#F1F1F1'});
                jQuery('input#submit').click(function() {
                     jQuery('#pop2').show();
                });
                 jQuery('#refundType').on('change', function() {
                    if (this.value == 'Full') {
                         jQuery('input#amt').css({'background-color': '#F1F1F1'});
                         jQuery('input#amt').val('<?php
                if (!empty($jsondata->transactions[0]->amount->total)) {
                    echo $jsondata->transactions[0]->amount->total;;
                }
                ?>');
                         jQuery('input#amt').prop("readonly", true);
                    } else if (this.value == 'Partial') {
                         jQuery('input#amt').css({'background-color': 'white'});
                         jQuery('input#amt').prop("readonly", false);
                    }
                });
            });
        </script>
		
