<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
<body style="background-color:#F4F4F4 font-family: 'Open Sans', sans-serif;">
<table style="width: 600px; margin: 0px auto; background-color: rgb(250, 250, 250); padding: 7px 10px; border: 1px solid rgb(247, 247, 247);" cellspacing="0" cellpadding="10">
			<tbody>
				<tr>
					<td style="padding:0px;text-align:left;float:left;">
						<a href="https://memplans.com.au" style="text-decoration:none;">
							<img src="http://a1professionals.net/shopta_app/uploads/main/Logo2017-04-12_12:45:41-X2mGs.png" alt="india-mart" class="kad-standard-logo" style="width: 178px;">
						</a>
					</td>
					<td style="padding:0px;color:#206ec7;font-size:18px;font-family:Calibri,arial;text-align:right;">
					<a href="#" style="text-decoration: none;">
						<p style="text-decoration: none; font-weight: bold; font-size: 16px; color: #54A9EA;">Go TO Home &gt;&gt;</p>
						</a>
					</td>
				</tr>
			</tbody>
	<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250); padding-left: 5px;  padding-bottom:10px;">
 	<tbody>
	  <tr>
	<td>
	
<h2 style="font-family: &quot;Open Sans&quot;,sans-serif; font-size: 17px; text-align: left; padding-left: 9px; padding-top: 24px; padding-bottom: 14px; text-transform: uppercase;">Order  #<?php  
	echo $singalorderdata['order_id'];?>
	Details</h2>
</td>
  </tr>
	<tr>
	<td>
<table class="full" style="border-collapse: collapse; font-family: &quot;Open Sans&quot;,sans-serif; background: rgb(236, 240, 245) none repeat scroll 0% 0%; font-size: 13px; margin-right: 0px;" width="99%" cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
	<td style="width: 116px;">
	<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left; border-bottom: 2px solid;">General Details</h2>
	<div style=" min-height: 159px;
    padding: 0 10px 10px;" class="odr-details">
	<h3 style="margin-top: 0px; margin-bottom: 6px;">Order Date</h3>
	<span>
		
		<?php
		$orderdate  = $singalorderdata['orderAt']; 
													
													
													 
						   
						  echo  date("F d, Y", strtotime($orderdate));
							   
		?>
		</span>
	<h3 style="margin-top: 8px; padding-bottom: 0px; margin-bottom: 6px;>Order Status</h3>
	<span class="pending"><?php echo $singalorderdata['orderStatus']; ?></span>
	 <h3 style="margin-top: 6px; margin-bottom: 2px;">Delivery Boy</h3>
       <span>  N/A</span>

	
	</div>
	</td>
		</tr>
	  </table>
</tbody>
		</table>
		<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250); padding-left: 5px;  padding-bottom:10px;">
 	<tbody>
	  <tr>
	<td>
</td>
  </tr>
	<tr>
	<td>

	<table class="full" style="border-collapse: collapse; font-family: &quot;Open Sans&quot;,sans-serif; background: rgb(236, 240, 245) none repeat scroll 0% 0%; font-size: 13px; margin-right: 0px;" width="99%" cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
	<td style="width: 116px;">
	<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left; border-bottom: 2px solid;">Account Information</h2>
	<div style=" min-height: 159px;
    padding: 0 10px 10px;" class="odr-details">
	<h3 style="margin-top: 0px; margin-bottom: 6px;">Customer Name</h3>
	<span>Parry2  Developer1</span>
	<h3  style="margin-top: 8px; padding-bottom: 0px; margin-bottom: 6px;">Email</h3>
	<span>parwinder.singh@a1professionals.info</span>

	
	</div>
	</td>
		</tr>
	  </table>
	  
	
		
		</tbody>
		</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
		<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250); padding-left: 5px;  padding-bottom: 28px;">
 	<tbody>
	  <tr>
	<td>
</td>
  </tr>
	<tr>
	<td>
<table class="full" style="border-collapse: collapse; margin-right: 18px; font-family: &quot;Open Sans&quot;,sans-serif; background: rgb(236, 240, 245) none repeat scroll 0% 0%; font-size: 13px;" width="99%" cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
	<td style="width: 116px;">
	<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left; border-bottom: 2px solid;">Billing Details</h2>
	<?php $billingAddress = unserialize($singalorderdata['billingAddress']);
	$shippingAddress = unserialize($singalorderdata['shippingAddress']);
	
	$oderDetails = unserialize($singalorderdata['oderDetails']);
	
	
		
		?>
	
	
	
		<div style=" min-height: 284px;
    padding: 0 10px 10px;" class="odr-details">
	<h3 style="margin-top: 0px; margin-bottom: 6px;">Address</h3>
	<span>#<?php echo $billingAddress['address'];?>, <?php echo $billingAddress['country'];?>, <?php echo $billingAddress['state'];?>, Appartment: <?php echo $billingAddress['apartment'];?>, <?php echo $billingAddress['town_city'];?>-<?php echo $billingAddress['postcode'];?> </span>
	<h3  style="margin-top: 8px; padding-bottom: 0px; margin-bottom: 6px;">Email</h3>
	<span><?php echo $billingAddress['email']; ?></span>
	<h3  style="margin-top: 8px; padding-bottom: 0px; margin-bottom: 6px;">First Name</h3>
	<span><?php echo $billingAddress['firstname']; ?></span>
	<h3  style="margin-top: 8px; padding-bottom: 0px; margin-bottom: 6px;">Last Name</h3>
	<span><?php echo $billingAddress['lastname']; ?></span>
	<h3  style="margin-top: 8px; padding-bottom: 0px; margin-bottom: 6px;">Phone Number</h3>
	<span><?php echo $billingAddress['phone']; ?></span>

	
	</div>
	</td>
		</tr>
	  </table>


	  
	</td>
		</tr>
		
		</tbody>
		</table>
		
		<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250); padding-left: 5px;  padding-bottom: 28px;">
 	<tbody>
	  <tr>
	<td>
</td>
  </tr>
	<tr>
	<td>


	<table class="full" style=" background: rgb(236, 240, 245) none repeat scroll 0 0; font-family: &quot;Open Sans&quot;,sans-serif; border-collapse:collapse; font-size: 13px; mso-table-lspace:0pt; margin-right: 18px; mso-table-rspace:0pt;" width="99%" cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
	<td style="width: 116px;">
	<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left; border-bottom: 2px solid;">Shipping Details</h2>
	<div style=" min-height: 72px;
    padding: 0 10px 10px;" class="odr-details">
	<h3 style="margin-top: 0px; margin-bottom: 6px;">Address</h3>
	<span>#<?php echo $shippingAddress['address'];?>, <?php echo $shippingAddress['country'];?>, <?php echo $shippingAddress['state'];?>, <?php echo $shippingAddress['town_city'];?>-<?php echo $shippingAddress['postcode'];?>  </span>
	

	
	</div>
	</td>
		</tr>
	  </table>
	  
	</td>
		</tr>
		
		</tbody>
		</table>
		
		
		
		
		
		
		
	<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250);  padding-bottom: 28px;">
 	<tbody>
	  <tr>
	<td>
</td>
  </tr>
	<tr>
	<td style=" background: rgb(236, 240, 245) none repeat scroll 0 0;">
<table class="full" style="border-collapse: collapse; font-family: &quot;Open Sans&quot;,sans-serif; background: rgb(236, 240, 245) none repeat scroll 0% 0%; font-size: 13px;padding-left: 0px; margin-right: 0px;" width="600px"  cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left;font-family: &quot;Open Sans&quot;,sans-serif; border-bottom: 2px solid;">Product Details</h2>
		
		</tr>
		    <tr>
	<td style=" background: rgb(236, 240, 245) none repeat scroll 0 0;">
		<tr>
		<th style=" border: 1px solid rgb(221, 221, 221);padding: 8px;">Sr.</th>
		<th  style=" border: 1px solid rgb(221, 221, 221);padding: 8px;">Product</th>
		<th  style=" border: 1px solid rgb(221, 221, 221);padding: 8px;">Purchased</th>
		<th  style=" border: 1px solid rgb(221, 221, 221);padding: 8px;">Subtotal</th>
		</tr>
		<?php 
		$sno =1;
		foreach($oderDetails as $productdata){ 
			
			?>
		
		
		<tr>
		<td style="   border: 1px solid rgb(221, 221, 221);padding: 10px;text-align: center;"><?php echo $sno;?></td>
		<td style="   border: 1px solid rgb(221, 221, 221);padding: 10px;text-align: center;"><?php echo $productdata['name'];?></td>
		<td style="   border: 1px solid rgb(221, 221, 221);padding: 10px;text-align: center;"><?php  echo $productdata['qty'];?></td>
		<td style="   border: 1px solid rgb(221, 221, 221);padding: 10px;text-align: center;">$<?php  echo $productdata['subtotal'];?></td>
		</tr>
		
		<?php 
			$sno++;
			} ?>
	</td>
		</tr>
	  </table>

	
	  
	
		
		</tbody>
		</table>
		<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250); padding-left: 5px; padding-bottom: 10px;">
 	<tbody>
	  <tr>
	<td>
</td>
  </tr>
	<tr>
	<td>
<table class="full" style="border-collapse: collapse; margin-right: 18px; font-family: &quot;Open Sans&quot;,sans-serif; background: rgb(236, 240, 245) none repeat scroll 0% 0%; font-size: 13px;" width="99%" cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
	<td style="width: 116px;">
<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left; border-bottom: 2px solid;">Payment Methods</h2>
	<div style=" min-height: 96px;
    padding: 0 10px 10px;" class="odr-details">
	<img src="https://adminlte.io/themes/AdminLTE/dist/img/credit/paypal2.png">
<p class="text-muted well well-sm no-shadow" style="margin-top: 10px; background: rgb(245, 245, 245) none repeat scroll 0% 0%; border: 2px solid rgb(221, 221, 221); padding: 8px;">
										Paypal									</p>
	

	
	</div>
	</td>
		</tr>
	  </table>


	  </table>
	  
	
		
		</tbody>
		</table>
		<table style="max-width: 600px; min-width: 600px; margin: 0px auto; text-align: left; background-color: rgb(250, 250, 250); padding-left: 5px; padding-bottom: 10px;">
 	<tbody>
	  <tr>
	<td>
</td>
  </tr>
	<tr>
	<td>


	<table class="full" style=" background: rgb(236, 240, 245) none repeat scroll 0 0; font-family: &quot;Open Sans&quot;,sans-serif; border-collapse:collapse; font-size: 13px; mso-table-lspace:0pt; margin-right: 18px; mso-table-rspace:0pt;" width="99%" cellspacing="0" cellpadding="0" border="0" align="left">
    <tr>
	<td style="width: 116px;">
	<h2 style="padding: 8px; background: transparent none repeat scroll 0% 0%; color: rgb(39, 0, 0); font-size: 21px; font-weight: bold; text-align: left; border-bottom: 2px solid;">Order Totals</h2>
	<div style=" min-height: 81px;
    padding: 0 10px 10px;" class="odr-details">
	<table class="table"  style="width: 100%;">
											<tbody>
												<tr>
													<th  style="width:50%; text-align: left;">Subtotal:</th>
													<td>$<?php echo $singalorderdata['totalPrice'];?></td>
												</tr>
												<tr>
													<th style="width:50%; text-align: left;">Total:</th>
													<td>$<?php echo $singalorderdata['totalPrice'];?></td>
												</tr>
											</tbody></table>

	
	</div>
	</td>
		</tr>
	  </table>
	  
	
		
		</tbody>
		</table>

   <table style="max-width: 600px; min-width: 600px; margin: 0px auto 0px; background: rgb(60, 60, 60) none repeat scroll 0 0; text-align: center; padding: 11px 0px;">
  <tr>
				<td style="padding: 7px 0px; width: 600px;">
					<p style="font-family: &quot;Open Sans&quot;,sans-serif; color: rgb(255, 255, 255);">Copyright @ 2017 Shopta Store. All Rights Reserved. by store..</p>
					</td>	
					</tr>
					 </table>
					 					</table>
  
	
