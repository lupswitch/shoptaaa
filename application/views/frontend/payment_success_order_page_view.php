
					
					<section class="order-div dis">
	  <div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section2-headeing">
				     
					<h2>Order Detail</h2>
					
					<?php if($payment_status == 'canceled'){
					
					?>
					<div class="paycon_messages"><div class="alert-success alert-dismissable"> 
					
					<p>Your payment has been canceled
						</p>
					
					</div></div>
					
					<?php
					
					}
					  elseif($payment_status == 'sucess') {  
					?>
					
					<!--p class="thank">Thank you. Your order has been received.</p-->
					<!--
					<h3>Pay Pal Transection ID : <?php //echo $paypalDetails['Paypal_trans_id']; ?> </h3>--->
					
				<div class="paycon_messages">
					<div class="alert-success alert-dismissable"> 
					
						<p>Your <?php echo $paypalDetails['msg']; ?> <b>$<?php  echo $paypalDetails['ammount'];?></b>
						and your Order number: <b><?php echo $paypalDetails['Paypal_trans_id']; ?></b> was
						successful.  </p>
					
					</div>
				</div>
				<p><a href="<?php echo base_url(); ?>" id="redirect_website">Redirect</a>  If you are not automatically redirected to website</p>
				</div>	
			</div>
		</div>
<?php
	
 }
 else
 {
	 
	 
	 }
	
	/*		
		<div class="res-tbl">
                <div id="no-more-tables">
                    <table class="col-md-12 table-striped table-condensed cf order">
                		<thead class="cf">
                			<tr>
        						<th class="numeric">ORDER NUMBER</th>
                				<th class="numeric">DATE</th>
                				<th class="numeric">TOTAL</th>
                				<th class="numeric">PAYMENT METHOD</th>
                			</tr>
                		</thead>
                		<tbody>
                			<tr>
        						<td data-title="ORDER NUMBER" class="numeric">1240</td>
                				<td data-title="DATE" class="numeric">March 21,2017</td>
                				<td data-title="TOTAL" class="numeric">$315</td>
                				<td data-title="PAYMENT METHOD" class="numeric">Online</td>
                			</tr>
            		</tbody>
            	</table>
            </div>
			<div class="clearfix"></div>
	</div>
<?php /*
	<div class="mearg-div">
		<div class="order-dtls">
			<ul class="det-o">
				<h3>Order details</h3>
				<li>
					<p class="det-left">Product</p>
					<p class="det-right">Total</p>
					<div class="clearfix"></div>
				</li>
				<li>
					<p class="det-left sep">Special Ittalian Food</p>
					<p class="det-right">$315</p>
					<div class="clearfix"></div>
				</li>
				<li>
					<p class="det-left">Subtotal</p>
					<p class="det-right">$315</p>
					<div class="clearfix"></div>
				</li>
				<li>
					<p class="det-left">Shipping</p>
					<p class="det-right">Free Shipping</p>
					<div class="clearfix"></div>
				</li>
				<li>
					<p class="det-left">Status</p>
					<p class="det-right">Shipped</p>
					<div class="clearfix"></div>
				</li>
				
			</ul>
		</div>
		
		<div class="address-b">
			<h3>Delivery Address</h3>
			<p>Mr ANURAG BANSAL</p><p>
			</p><p>#412 Kiala Road , Main Road DAV School , </p>
			<p>Near Verka Plant , Sector 115 ,  Delhi</p>
			<p>Pin Code: 150025</p>
			<p><b>Contact No</b>: 123-456-7890</p>
		</div>
		
		
		
		<div class="clearfix"></div>
	</div>
*/

?>	
	
	
	
	
	
	
		
	</div>
	
	
	</section>
	
<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "http://a1professionals.net/shopta_app/";
		
    }, 15000);

			</script>