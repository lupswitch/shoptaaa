<!-- Breadcrumb --->
<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">My Orders</li>
		</ol>
	</div>
</div>

<!-- End Breadcrumb -->	


<section class="order-div dis">
	  <div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section2-headeing">
					<h2>My Orders</h2>
					<!--<p class="thank">Thank you. Your order has been received.</p>-->
				</div>	
			</div>
		</div>
		
		<?php 
				if(empty($this->session->has_userdata('is_customer'))) {
					
					
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
	
				<?php } else{ ?>
		
		
		<div class="order-details">
                    <div class="ord-dtls">
                		<ul class="ordr-del">
						
						
						<?php if(!empty($singleorder)) {
							
							//pr($singleorder);
							
						
				
						
						$orderdate = $singleorder['orderAt'];
						
					$addressdata = unserialize($singleorder['billingAddress']);
					
						
						 $your_date = date("F d, Y", strtotime($orderdate));
						?>
                			<li>
								<h2>Order Details</h2>
								<div class="dtls">
									<div class="odr-box">
										<p class="left">Order ID</p>
										<p class="right"><?php echo $singleorder['order_id']; ?></p>
										<div class="clearfix"></div>
									</div>
									<div class="odr-box">
										<p class="left">Order Date</p>
										<p class="right"><?php echo $your_date ; ?></p>
										<div class="clearfix"></div>
									</div>
									
									<div class="odr-box">
										<p class="left">Amount Paid</p>
										<p class="right"><span><i class="fa fa-usd" aria-hidden="true"></i></span><?php echo $singleorder['totalPrice']; ?></p>
										<div class="clearfix"></div>
									</div>
									<div class="odr-box">
										<p class="left">Payment TransactionId</p>
										<p class="right"><?php echo $singleorder['transactionId']; ?></p>
										<div class="clearfix"></div>
									</div>
								</div>
									
								</li>
                				<li>
									<h2>Address</h2>
									<div class="dtls address-d">
										<p><?php echo $addressdata['firstname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $addressdata['lastname'];?></p>
										<p><?php echo $addressdata['address'];?>, <?php echo $addressdata['apartment'];?>, <?php echo $addressdata['town_city'];?>- <?php echo $addressdata['postcode'];?>, &nbsp;&nbsp;<?php echo $addressdata['state'];?></p>
										<p>Phone : &nbsp;<span> <?php echo $addressdata['phone'];?></span></p>
									</div>
								</li>
                				<li>
									<h2>Manage Order</h2>
									<?php 
									  $orderdate =  date('Y-m-d', strtotime($orderdate));
									  $currentdate = date('Y-m-d');
									  $orderdate	= date_create($orderdate);						
			                          $currentdate = date_create($currentdate);				
								      $diff=date_diff($orderdate, $currentdate);
                                      $datediffer = $diff->format("%R%a");
									  //echo $datediffer;
									  if($datediffer >= 6){
									  //echo "asd";
									   }
									     else
									   {
										?>
									  <button type="submit" class="cancle-btn go" data-toggle="modal" data-target="#cancelOrderModal">Cancel Order</button>
									  
									  
									  
									  
									  
									<?php 
										 } ?>
									<button type="submit" class="edit-btn go">Edit</button>
								</li>
								
						
            		</ul>
            	</div>
			<div class="clearfix"></div>
			
			<div class="order-rate">
			<?php 
			
			
			//pr($singleorderdata);
			
			
			$orderpro = unserialize($singleorder['oderDetails']);
			
			//pr($orderpro);
			
		    foreach($orderpro as $orderVal){
			
			?>
			
			   <div class="first">
				<ul class="order-listing">
					<li>
						<div class="product-box lets">
						<a href="<?php echo base_url('product/').$orderVal['pro_slug']; ?>"><img src="<?php echo base_url('uploads/product_images/thumb_images/').$orderVal['pro_image']; ?>"/></a>
						</div>
						<div class="product-txt lets">
							<p><?php echo $orderVal['name'];?></p>

							<span><?php echo $orderVal['pro_SUK'];?></span>
						</div>
						<div class="clearfix"></div>
					</li>
					<li>
						<div class="rate-pay">
							<p><?php  echo $orderVal['qty'];?> X $<?php  echo $orderVal['price'];?> = $<?php  echo $orderVal['subtotal'];?></p>
							<p><a href="#"><span><i class="fa fa-star" aria-hidden="true"></i></span>Rate & Review Product</a></p>
						</div>
					</li>
				</ul>
				</div>
				<!--------------------------------------------  Harish chander 5-16-2017--------------------------------------------------------------->
	<?php if($datediffer >= 6){
									  //echo "asd";
									   }
									     else
									   {
								   ?>
								   
 <div class="modal fade" id="cancelOrderModal" role="dialog" style="display: none;">
<div class="modal-dialog">
<!-- Modal comment section -->
<div class="modal-content">
<div class="modal-header bgwhite ">

<button id="close_btn" type="button" class="close close_btn CanceladdNewForumPostClosebtn" data-dismiss="modal">×</button>

<!--img class="popup_logo" width="5%;" src="http://a1professionals.org/oneappafrica/assets/images/logo/popup-new-logo.png" alt="logo" /-->

<h4 class="modal-title">Reason for cancellation order</h4>

</div>
<!-- Pop up content start here -->	
<div class="modal-body">
	<form method="post" id="submitcancelform">
<textarea class="addpost_desc" id="add_new_posttxt" rows="10" name="cancellation_reason" cols="50" placeholder="Reason for cancellation"></textarea>
<input type="hidden" value="<?php echo $singleorder['o_id'] ?>" id="cancelorderid">
<div id="errors_message" style="display:none;">Please enter the cancellation reason</div>
<div class="modal-footer">
<button type="button" id="post_newstatus_btn" class="btn btn-danger CanceladdNewForumPostClosebtn" data-dismiss="modal">Cancel</button> 

<button id="post_newstatus_btn"type="button" style="display:none;" class="cus-btn" data-toggle="modal" data-target="#post_React_options_txt">Send</button>
</form>

</div>
</div>
</div>
</div>
</div>
									   <?php } ?>
									 
	<!------------------------------------------------------------------------------------------------------------>
	
				
			<?php  }  ?>
				<!---<div class="second">
				<ul class="order-listing">
					<li>
						<div class="product-box lets">
							<img src="images/watch.png"/>
						</div>
						<div class="product-txt lets">
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>

							<span>Lorem Ipsum is simply dummy text</span>
						</div>
						<div class="clearfix"></div>
					</li>
					<li>
						<div class="rate-pay">
							<p>$500</p>
							<p><a href="#"><span><i class="fa fa-star" aria-hidden="true"></i></span>Rate & Review Product</a></p>
						</div>
					</li>
				</ul>
				</div>--->
				<div class="deliver-pro">
					<div class="col-md-9 deli lets">
						<p><span><i class="fa fa-truck" aria-hidden="true"></i></span><?php echo ucfirst($singleorder['orderStatus']); ?></p>
					</div>
					<div class="col-md-3 total">
						<h5>Total : $<?php echo $singleorder['totalPrice']; ?></h5>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
				<?php  } } ?>
		
	</div>
	</section>
	
	
	
	
	
	<script>
	
	jQuery('#loginformlink').click(function(){
		jQuery('#login_signup').trigger('click');
		jQuery('#login-form-link').trigger('click');
	});
	
	jQuery('#registerformlink').click(function(){
		jQuery('#login_signup').trigger('click');
		jQuery('#register-form-link').trigger('click');
	});
	
	jQuery("#post_newstatus_btn").click(function(){
		var cancellation_reason =  jQuery("#add_new_posttxt").val();
		if(cancellation_reason == "")
		{
			jQuery("#errors_message").show();
			return false;
		}
		else
		{
			
		jQuery("#errors_message").hide();
			return true;	
		}
		///
		});
	
	
	
	
</script>
