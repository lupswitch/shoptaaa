<!-- Breadcrumb --->
<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Your Wishlist</li>
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
		
		<div class="res-tbl new-ord-tbl">
                <div id="no-more-tables">
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
	<!-- End Register -->	
				
				
				
			   <table class="col-md-12 table-striped table-condensed cf order new-orders">
                		<thead class="cf">
                			<tr>
        						<th class="numeric">Sr. No</th>
                				<th class="numeric">CUSTOMER ID</th>
                				<th class="numeric">ORDER Date</th>
                				<th class="numeric">PRICE</th>
								<th class="numeric">STATUS</th>
								<th class="numeric">VIEW</th>
                			</tr>
                		</thead>
                		<tbody>
						<?php if(!empty($Allorders)){ 
							
							//pr($Allorders);
							
							?>
						   <?php
						   
						  $sno = 1;
						   
						   foreach($Allorders as $orderdata){
						   
						  $orderdate  = $orderdata['orderAt'];
						   
						   $your_date = date("F d, Y", strtotime($orderdate));
							   
							   ?>
						
                			<tr>
        						<td data-title="Sr. No" class="numeric"><?php echo $sno; ?></td>
                				<td data-title="ORDER ID" class="numeric bbk"><?php echo $orderdata['order_id']; ?></td>
                				<td data-title="ORDER Date" class="numeric"><?php echo $your_date; ?></td>
                				<td data-title="PICE" class="numeric"><span><i class="fa fa-usd" aria-hidden="true"></i></span><?php echo $orderdata['totalPrice']; ?></td>
								<td data-title="STATUS" class="numeric">
								<div class="rooj">
										<p class="date-d"><?php echo $orderdata['orderStatus']; ?></p>
										<?php  if($orderdata['orderStatus'] == 'complete'){ ?>
										
										<span class="deliv">Your item has been delivered</span>
										
										<?php } ?>
									</div>	
								</td>
								<td data-title="VIEW" class="numeric"><a class="view" href="<?php echo base_url('account/order-detail/').$orderdata['o_id']; ?>">View</a></td>
                			</tr>
							
						<?php $sno++; }  ?>
						<?php } else {  ?>
						<tr>
        				<td colspan="6" class="numeric">No Record Found</td>
						
						
						</tr>
						
						<?php }  ?>
						
						
							
            		</tbody>
            	</table>
				<?php  } ?>
            </div>
			<div class="clearfix"></div>
		</div>
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
	
	
</script>

	