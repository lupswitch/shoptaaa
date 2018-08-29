<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Order Detail</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="<?php echo base_url('admin/order-listing/'); ?>">Order</a></li>
		</ol>
	</section> 
    <!-- Main content -->
	<?php //pr($singleOrderData); die(); ?>
    <section class="content">
		<div class="row">
			<div class="col-xs-12"> 
				<div class="msg_noti"></div>
				<div class="box">
					<div class="box-header">
						<!---<h2 class="box-title">Order #<strong><?php //echo $singleOrderData['orderDetail']['order_id']; ?></strong> detail</h2>--->
						<?php 
							if($singleOrderData['orderDetail']['orderStatus'] == 'pending'){
								$status = "default";
							}
							if($singleOrderData['orderDetail']['orderStatus'] == 'processing'){
								$status = "info";
							}
							if($singleOrderData['orderDetail']['orderStatus'] == 'ongoing'){
								$status = "warning";
							}
							if($singleOrderData['orderDetail']['orderStatus'] == 'complete'){
								$status = "success";
							}
							if($singleOrderData['orderDetail']['orderStatus'] == 'cancel'){
								$status = "danger";
							}
							if($singleOrderData['orderDetail']['orderStatus'] == 'refund'){
								$status = "danger";
							}
						?>
						<div class="callout callout-<?php echo $status;?>">
							<h4><i>Order</i>&nbsp;&nbsp;#<?php echo $singleOrderData['orderDetail']['order_id']; ?>  Details</h4>
						</div>
						
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">
						
						<section class="invoices">
							<!-- title row -->
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-6 invoice-col col-dum">
									<div class="inner-tab">
										<h4>General Details</h4>
										<ul>
											<li>
												<strong>Order Date</strong>
												<p><?php //echo $singleOrderData['orderDetail']['orderAt'];
													$orderdate  = $singleOrderData['orderDetail']['orderAt']; 
													echo  date("F d, Y", strtotime($orderdate));
												  ?></p>	
											</li>
											<li>
												<strong>Order Status</strong>
												<p>
													<?php 
														if($singleOrderData['orderDetail']['orderStatus'] == 'pending'){
															$status = "default";
														}
														if($singleOrderData['orderDetail']['orderStatus'] == 'processing'){
															$status = "info";
														}
														if($singleOrderData['orderDetail']['orderStatus'] == 'ongoing'){
															$status = "warning";
														}
														if($singleOrderData['orderDetail']['orderStatus'] == 'complete'){
															$status = "success";
														}
														if($singleOrderData['orderDetail']['orderStatus'] == 'cancel'){
															$status = "danger";
														}
														if($singleOrderData['orderDetail']['orderStatus'] == 'refund'){
								$status = "danger";
							}
													?>
													<span class="label label-<?php echo $status; ?>"><?php echo $singleOrderData['orderDetail']['orderStatus']; ?></span>
													
												</p>
											</li>
											<li>
												<strong>Delivery Boy</strong>
												<p><?php if(!empty($singleOrderData['DeliveryBoyData'])){ echo $singleOrderData['DeliveryBoyData']['firstName'].' '.$singleOrderData['DeliveryBoyData']['lastName']; } else { echo "N/A"; }?></p>
											</li>
										</ul>
									</div>
								</div>
								
								
								<!----------------------------------------------->
								<div class="col-sm-6 invoice-col col-dum">
									<div class="inner-tab">
										<h4>Account Information</h4>
										<ul>
											<li>
												
												<strong>Customer Name</strong>
												<p><?php echo $singleOrderData['userData']['firstName'];?>&nbsp;&nbsp;<?php echo $singleOrderData['userData']['lastName'];?></p></li>
											<li>
												
												<strong>Email</strong>
												<p><?php echo $singleOrderData['userData']['email'];?></p></li>
										
												
											
											</ul>
										</div></div>
										
										
										<!------------------------------------------->
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								<!-- /.col -->
								<div class="col-sm-6 invoice-col col-dum">
									<div class="inner-tab">
										<h4>Billing Details</h4>
										<ul>
											<li>
												<strong>Address</strong>
												<p>
													<?php
														
														$data = $singleOrderData['orderDetail']['billingAddress'];
														
														$ShippingAdd = unserialize($data);
														if(!empty($ShippingAdd['appartment'])){
														$appartment = $ShippingAdd['appartment'];
														}else{ $appartment = "Appartment: N/A";}
														 
														echo $ShippingAdd['address'].', '.$ShippingAdd['country'].', '.$ShippingAdd['state'].', '.$appartment.', '.$ShippingAdd['town_city'].'-'.$ShippingAdd['postcode'];	
													?>
													
												</p>	
											</li>
											<li>
												<strong>Email</strong>
												<p><?php echo $singleOrderData['userData']['email']; ?></p>
											</li> 
											<li>
												<strong>First Name</strong>
												<p><?php echo $singleOrderData['userData']['firstName']; ?></p>
											</li>
											
											<li>
												<strong>Last Name</strong>
												<p><?php echo $singleOrderData['userData']['lastName']; ?></p>
											</li>
											
											<li>
												<strong>Phone Number</strong>
												<p><?php echo $singleOrderData['userData']['phoneNumber']; ?></p>
											</li>
											
										</ul>
									</div>
								</div>
								<!-- /.col -->
								<div class="col-sm-6 invoice-col col-dum">
									<div class="inner-tab">
										<h4>Shipping Details</h4>
										<ul>
											<li>
												<strong>Address</strong>
												<p>
													<?php
														
														
														$data = $singleOrderData['orderDetail']['shippingAddress'];
														$ShippingAdd = unserialize($data);
														
														if(!empty($ShippingAdd['appartment'])){
														$appartment = $ShippingAdd['appartment'];
														}else{ $appartment = "Appartment: N/A";}
														
														echo $ShippingAdd['address'].', '.$ShippingAdd['country'].', '.$ShippingAdd['state'].', '.$appartment.', '.$ShippingAdd['town_city'].'-'.$ShippingAdd['postcode'];
													?>
												</p>	
											</li>
										</ul>
									</div>	
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
							
							<!-- Table row -->
							<div class="row">
								<div class="col-xs-12 table-responsive invoice-col col-dum">
								<h4>Product Details</h4>
									<table class="table table-striped table-hover tab-lok">
										<thead>
											<tr>
												<th>Sr.</th>
												<th>Product</th>
												<th>Purchased</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										
										<tbody>											
											<?php 
												$orderDetails = unserialize($singleOrderData['orderDetail']['oderDetails']);
												$count = '1';
												foreach($orderDetails as $data){ 
													if(!empty($data)){
													//pr($data);
													?>
													<tr>
														<td><?php echo $count; ?></td>	
														<td><?php echo $data['name']; ?></td>	
														<td><?php echo $data['qty']; ?></td>	
														<td>$<?php echo $data['price']; ?></td>
													</tr>
												<?php $count++; } }
											?>
										</tbody>
										
									</table>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
							
							<div class="row">
								<!-- accepted payments column -->
								<div class="col-sm-6 invoice-col col-dum">
									<h4>Payment Methods</h4>
									<img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">
									<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
										<?php echo $singleOrderData['orderDetail']['payment_method']; ?>
									</p>
								</div>
								<!-- /.col -->
								<div class="col-sm-6 invoice-col col-dum">
								<h4>Order Totals</h4>
								
									
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<th style="width:50%">Subtotal:</th>
													<td>$<?php echo $singleOrderData['orderDetail']['totalPrice']; ?></td>
												</tr>
												<tr>
													<th>Total:</th>
													<td>$<?php echo $singleOrderData['orderDetail']['totalPrice']; ?></td>
												</tr>
											</tbody></table>
									</div>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
							
							<!-- this row will not appear when printing -->
							
						</section> 
					</div>
					
					
					
				</div>
				<!-- /.box-body -->
				
				
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->



</div>
<!-- /.content-wrapper -->

