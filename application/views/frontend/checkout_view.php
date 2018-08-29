

<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Checkout</li>
		</ol>
	</div>
</div>

<section class="checkout dis">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section2-headeing">
					<h2>Checkout</h2>
				</div>	
			</div>
		</div>
	</div>
</section>

<!-- Login -->	
<?php 
	
	if (empty($this->cart->contents() )){ ?>
	
	<section class="chk-box">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="cart_messages" id="CartMessages"><?php echo $this->session->flashdata('verify_msg'); ?></div>
				</div>
			</div>
		</div>
	</section>
	
	<?php }
	else if(empty($this->session->has_userdata('is_customer'))) {
	?>
	
	<div class="account-det">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="acc">
						<span>!</span>
						<p>Returning customer?<a id="loginformlink" href="javascript:void(0);"><b style="color:#54a9ea;"> Click here to login</b></a></p>
					</div>
				</div>	
			</div>
		</div>
	</div>	
	<!-- End Login -->	
	
	<!-- Register -->	
	<div class="account-det">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="acc">
						<span>!</span>
						<p>Not have an account?<a id="registerformlink" href="javascript:void(0);"><b style="color:#54a9ea;"> Click here to Create Account</b></a></p>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<!-- End Register -->	
	
	<?php } else { ?>
	
	
	
	<?php //pr($userdata); ?>
	<!-- Form of checkout Page --->
	<section class="chk-box">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!---Notify ------->
					<div class="col-md-10 msg_notify">
					<?php echo $this->session->flashdata('verify_msg'); ?>
					</div>
					
					<!-- BILLING DETAILS -->		
					<div class="form-section">
						<div class="hd-fm">
							<h3>Billing Details</h3>
						</div>
						<?php //pr($MyBillingAddress); ?>
						<div class="fm-fields">
							<!-- filds-left -->
							<div class="col-md-6 filds-left">
								<form id="confirmCheckolt" action="<?php echo base_url('checkout?payment=paypal'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
									<div class="form-group">
										<label for="exampleInputEmail1">First Name<span>*</span></label>
										<input type="text"  name="billingAddress[firstname]" class="form-control" id="billingAddress_firstname" placeholder="" value="<?php echo $MyBillingAddress['firstName']; ?>"
										<span class="text-danger"><?php echo form_error("billingAddress[firstname]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputAddress">Address<span>*</span></label>
										<input type="text" name="billingAddress[address]" class="form-control" id="billingAddress_address" placeholder="Street address" value="<?php echo $MyBillingAddress['address']; ?>">
										<span class="text-danger"><?php echo form_error("billingAddress[address]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputAddress">Country<span>*</span></label>
										<select class="form-control" id="billingAddress_country" name="billingAddress[country]">
											<option>-- Please Select --</option>	
                                <?php foreach($country as $singlecountry) { ?>
                                       
                                   <option value="<?php echo $singlecountry['name'];?>" <?php if($MyBillingAddress['Country'] == $singlecountry['name']) { echo "selected"; } ?>><?php echo $singlecountry['name']; ?></option>
                                       
                                  <?php }    ?>    										  	
																											
											
													</select>
										<span class="text-danger"><?php echo form_error("billingAddress[country]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputdistt">State<span>*</span></label>
										<input type="text" class="form-control" id="billingAddress_state" placeholder="" name="billingAddress[state]" value="<?php echo $MyBillingAddress['State']; ?>">
										<span class="text-danger"><?php echo form_error("billingAddress[state]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputEmail1">Email address<span>*</span></label>
										<input type="email" class="form-control" id="billingAddress_email" name="billingAddress[email]" placeholder="" value="<?php echo $userdata['email']; ?>">
										<span class="text-danger"><?php echo form_error("billingAddress[email]"); ?></span>
									</div>
									
								
							</div>
							<!-- End filds-left -->	
							
							<!-- filds-right -->	
							<div class="col-md-6 filds-right">
							
									<div class="form-group">
										<label for="exampleInputLast Name">Last Name<span>*</span></label>
										<input type="text" class="form-control" id="billingAddress_lastname" name="billingAddress[lastname]" placeholder="" value="<?php echo $MyBillingAddress['lastName']; ?>">
										<span class="text-danger"><?php echo form_error("billingAddress[lastname]"); ?></span>
									</div>
									
									<div class="form-group apart" id="">
										<label for="exampleInput"></label>
										<input type="text" class="form-control" id="billingAddress_apartment" name="billingAddress[apartment]" placeholder="Apartment, suite, unit etc. (optional)" value="">
										<span class="text-danger"><?php echo form_error("billingAddress[apartment]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputLast Name">Town/City<span>*</span></label>
										<input type="text" class="form-control" id="billingAddress_town_city" name="billingAddress[town_city]" placeholder="" value="<?php echo $MyBillingAddress['City']; ?>">
										<span class="text-danger"><?php echo form_error("billingAddress[town_city]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputLast Name">Postcode<span>*</span></label>
										<input type="text" class="form-control" id="billingAddress_postcode" name="billingAddress[postcode]" placeholder="" value="<?php echo $MyBillingAddress['Zip']; ?>">
										<span class="text-danger"><?php echo form_error("billingAddress[postcode]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputLast Name">Phone<span>*</span></label>
										<input type="text" class="form-control" id="billingAddress_phone" name="billingAddress[phone]"placeholder="" value="<?php echo $MyBillingAddress['PhoneNumber']; ?>" >
										<span class="text-danger"><?php echo form_error("billingAddress[phone]"); ?></span>
									</div>
									
							</div>
							
							<!-- End filds-right -->
							
						</div>
						<div class="clearfix"></div>
					</div>
					
					<!-- End BILLING DETAILS --->
					
					
					<!-- Shipping DETAILS -->		
					<div class="form-section">
						<div class="hd-fm">
							<h3>Shipping Detail</h3>
							<div class="chk-add">
								<span>
									<input type="checkbox" id="inputOne"/>
									<label for="inputOne"></label>
								</span>
								<p>Same As Billing address</p>
							</div>
						</div>
						<div class="fm-fields">
							<!-- filds-left -->
							<div class="col-md-6 filds-left">
							
									<div class="form-group">
										<label for="exampleInputEmail1">First Name<span>*</span></label>
										<input type="name" class="form-control" name="shippingAddress[firstname]" id="shippingAddress_firstname" placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[firstname]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputAddress">Address<span>*</span></label>
										<input type="address" class="form-control" id="shippingAddress_address" name="shippingAddress[address]" placeholder="Street address" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[address]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputAddress">Country<span>*</span></label>
										<select class="form-control" id="shippingAddress_country" name="shippingAddress[country]">
											<option>-- Please Select --</option>	
											 <?php foreach($country as $singlecountry) { ?>
                                       
                                   <option value="<?php echo $singlecountry['name'];?>" <?php if($MyBillingAddress['Country'] == $singlecountry['name']) { echo "selected"; } ?>><?php echo $singlecountry['name']; ?></option>
                                       
                                  <?php }    ?>   
										</select>
										<span class="text-danger"><?php echo form_error("shippingAddress[country]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputdistt">State<span>*</span></label>
										<input type="text" class="form-control" id="shippingAddress_state" name="shippingAddress[state]" placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[state]"); ?></span>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Email address<span>*</span></label>
										<input type="email" class="form-control" id="shippingAddress_email" name="shippingAddress[email]" placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[email]"); ?></span>
									</div>
							
							</div>
							<!-- End filds-left -->	
							
							<!-- filds-right -->	
							<div class="col-md-6 filds-right">
							
									<div class="form-group">
										<label for="exampleInputLast Name">Last Name<span>*</span></label>
										<input type="text" class="form-control" id="shippingAddress_lastname" name="shippingAddress[lastname]" placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[lastname]"); ?></span>
									</div>
									
									<div class="form-group apart" id="">
										<label for="exampleInput"></label>
										<input type="text" class="form-control" id="shippingAddress_appartment" name="shippingAddress[appartment]" placeholder="Apartment, suite, unit etc. (optional)" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[appartment]"); ?></span>
									</div>
									
									<div class="form-group">
										<label for="exampleInputLast Name">Town/City<span>*</span></label>
										<input type="text" class="form-control" id="shippingAddress_town_city" name="shippingAddress[town_city]"placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[town_city]"); ?></span>
									</div>
									<div class="form-group">
										<label for="exampleInputLast Name">Postcode<span>*</span></label>
										<input type="text" class="form-control" id="shippingAddress_postcode" name="shippingAddress[postcode]"placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[postcode]"); ?></span>
									</div>
									<div class="form-group">
										<label for="exampleInputLast Name">Phone<span>*</span></label>
										<input type="text" class="form-control" id="shippingAddress_phone" name="shippingAddress[phone]" placeholder="" value="">
										<span class="text-danger"><?php echo form_error("shippingAddress[phone]"); ?></span>
									</div>
								
							</div>
							
							<!-- End filds-right -->
							
						</div>
						<div class="clearfix"></div>
					</div>	
					
					<!-- End Shipping DETAILS --->
				</div>
			</div>
		</div>	
	</section>
	
	
	<!-- Order DETAILS --->
	<section class="order">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="hd-fm">
						<h3>Review Order</h3>
					</div>
					<div class="col-xs-6 order-list">
						<div class="row">
							<ul class="odd-lst">
								<li class="bot-b">
									<h3 class="o-left">Total</h3> 
									<h3 class="o-right">$<?php if(!empty($cartData['cart_TotalPrice'])) { echo $cartData['cart_TotalPrice']; } else { echo "<i>Invalid Data!</i>"; } ?></h3>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<h3 class="o-left">Order Summery</h3> 
									<h3 class="o-right"></h3>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="o-left">Price</p> 
									<p class="o-right">$<?php if(!empty($cartData['cart_TotalPrice'])) { echo $cartData['cart_TotalPrice']; } else { echo "<i>Invalid Data!</i>"; } ?></p>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="o-left">Handling Charges</p> 
									<p class="o-right">Free</p>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="o-left">VAT/CST</p> 
									<p class="o-right">Free</p>
									<div class="clearfix"></div>
								</li>
								<li class="top-b">
									<p class="o-left">TOTAL</p> 
									<p class="o-right">$<?php if(!empty($cartData['cart_TotalPrice'])) { echo $cartData['cart_TotalPrice']; } else { echo "<i>Invalid Data!</i>";} ?></p>
									<div class="clearfix"></div>
								</li>
								<li class="bb">
									<p class="part">*Part of the taxes payable to the government</p>
								</li>
								
							</ul>	
							
							
							
						</div>
					</div>	
				</div>
			</div>
		</div>	
	</section>
	
	<!-- End Order DETAILS --->	
	
	<!-- Payment Method -->
	<section class="Payment-method">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="hd-fm">
						<!--<h3>Select Payment Method</h3>
						<div class="pay-div">
							<div class="chk-add second-bx">
								<span>
									<input type="checkbox" id="inputTwo"/>
									<label for="inputTwo"></label>
								</span>
								<p class="cash">Cash On Delivery</p>
							</div>
							
							
							<div id="dvPassport" class="payment-bx" style="display: none">
								<p>Secure Payment With Credit / Debit / Netbanking</p>
							</div>
						
							
							<div class="chk-add">
								<span>
									<input type="checkbox" id="inputThree"/>
									<label for="inputThree"></label>
								</span>
								<p class="cash">Credit Card / Debit Card / Netbanking</p>
							</div>
							
							<div id="dvPassdv" class="payment-bx" style="display: none">
								<p>Secure Payment With Credit / Debit / Netbanking</p>
							</div>
							
						</div>-->
					</div>
					
					<div class="button-a">
						 <button type="submit" id="checoutOrder" name="checoutOrder" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-pill-paypal-60px.png" alt="PayPal"> Pay By Paypal</button>
					</div>
					
				</div>
			</div>
		</div>
		</form>
	</section>		
	<!-- End Payment Method -->
<?php } ?>
<script>
	
	jQuery('#loginformlink').click(function(){
		jQuery('#login_signup').trigger('click');
		jQuery('#login-form-link').trigger('click');
	});
	
	jQuery('#registerformlink').click(function(){
		jQuery('#login_signup').trigger('click');
		jQuery('#register-form-link').trigger('click');
	});
	
	
</script>

<script>
	jQuery("#inputOne").on("click",function(){
		if(jQuery(this).is(":checked")){
			
			var Billing_fname = jQuery('#billingAddress_firstname').val();
			jQuery('#shippingAddress_firstname').val(Billing_fname);
			
			var Billing_lname = jQuery('#billingAddress_lastname').val();
			jQuery('#shippingAddress_lastname').val(Billing_lname);
			
			var Billing_add = jQuery('#billingAddress_address').val();
			jQuery('#shippingAddress_address').val(Billing_add);
			
			var Billing_appart = jQuery('#billingAddress_apartment').val();
			jQuery('#shippingAddress_appartment').val(Billing_appart);
			
			var Billing_country = jQuery('#billingAddress_country').val();
			jQuery('#shippingAddress_country').val(Billing_country);
			
			var Billing_city = jQuery('#billingAddress_town_city').val();
			jQuery('#shippingAddress_town_city').val(Billing_city);
			
			var Billing_state = jQuery('#billingAddress_state').val();
			jQuery('#shippingAddress_state').val(Billing_state);
			
			var Billing_post = jQuery('#billingAddress_postcode').val();
			jQuery('#shippingAddress_postcode').val(Billing_post);
			
			var Billing_email = jQuery('#billingAddress_email').val();
			jQuery('#shippingAddress_email').val(Billing_email);
			
			var Billing_phone = jQuery('#billingAddress_phone').val();
			jQuery('#shippingAddress_phone').val(Billing_phone);
		}
		else if(jQuery(this).is(":unchecked")){
		
			var blank = '';
			jQuery('#shippingAddress_firstname').val(blank);
			
			jQuery('#shippingAddress_lastname').val(blank);
			
			jQuery('#shippingAddress_address').val(blank);
			
			jQuery('#shippingAddress_appartment').val(blank);
			
			jQuery('#shippingAddress_country').val(blank);
			
			jQuery('#shippingAddress_town_city').val(blank);
			
			jQuery('#shippingAddress_state').val(blank);
			
			jQuery('#shippingAddress_postcode').val(blank);
			
			jQuery('#shippingAddress_email').val(blank);
			
			jQuery('#shippingAddress_phone').val(blank);
			
		}
		
	});
	
</script>