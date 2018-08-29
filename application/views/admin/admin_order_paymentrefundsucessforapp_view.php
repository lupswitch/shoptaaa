<div style="min-height: 1181px;" class="content-wrapper">
 <section class="content">  <div class="admin_cont">
	   <div id="container">
	   		
            <div id="main">
               
                <div id="return">
                    <h2>Refund Status</h2>
                    <hr>

                    <h3 id="success">Refund Successful</h3><p>Gross Refund Amount - <?php echo $refunddata->amount->total; ?> (<?php echo $refunddata->amount->currency; ?>)</p><p>Refund Transaction ID - <?php   echo $refunddata->parent_payment; ?></p><div class="back_btn"><a id="btn" href="http://a1professionals.net/shopta_app/admin/request-cancel">&lt;&lt; Back </a></div>                </div>

            </div>
					
					            </div>   			</div>
            <img src="http://a1professionals.net/shopta_app/assets/admin/PayPalRefundPage/images/secure-paypal-logo.jpg" id="paypal_logo">
        
        <div class="simplePopup" id="pop2">
            <div id="loader">
                <div id="circularG">
                    <div class="circularG" id="circularG_1">
                    </div>
                    <div class="circularG" id="circularG_2">
                    </div>
                    <div class="circularG" id="circularG_3">
                    </div>
                    <div class="circularG" id="circularG_4">
                    </div>
                    <div class="circularG" id="circularG_5">
                    </div>
                    <div class="circularG" id="circularG_6">
                    </div>
                    <div class="circularG" id="circularG_7">
                    </div>
                    <div class="circularG" id="circularG_8">
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
		
