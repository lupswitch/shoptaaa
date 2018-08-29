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

    <section class="content">
		<div class="row">
			<div class="col-xs-12"> 
				<div class="msg_noti"></div>
				<div class="box">
					<div class="box-header">
						<!---<h2 class="box-title">Order #<strong><?php //echo $singleCancelOrderData['orderDetail']['order_id']; ?></strong> detail</h2>--->
						<?php 
							if($singleCancelOrderData['orderDetail']['orderStatus'] == 'pending'){
								$status = "default";
							}
							if($singleCancelOrderData['orderDetail']['orderStatus'] == 'processing'){
								$status = "info";
							}
							if($singleCancelOrderData['orderDetail']['orderStatus'] == 'ongoing'){
								$status = "warning";
							}
							if($singleCancelOrderData['orderDetail']['orderStatus'] == 'complete'){
								$status = "success";
							}
							if($singleCancelOrderData['orderDetail']['orderStatus'] == 'cancel'){
								$status = "danger";
							}
							if($singleCancelOrderData['orderDetail']['orderStatus'] == 'refund'){
								$status = "danger";
							}
						?>
						<div class="callout callout-danger">
						
							<h4 class="col-sm-6"><i>Order</i>&nbsp;&nbsp;#<?php echo $singleCancelOrderData['orderDetail']['order_id']; ?>  Details</h4>
						
						<?php if($singleCancelOrderData['orderDetail']['orderStatus'] != 'refund' && $singleCancelOrderData['orderDetail']['order_device_mode'] == 'website'){ ?>
						<a class="btn custom_single_oder"   href="<?php echo base_url('admin/paymentrefund-view/'. $singleCancelOrderData['orderDetail']['o_id']); ?>">Request Refund</a>
						<?php } ?>
						
						<?php if($singleCancelOrderData['orderDetail']['orderStatus'] != 'refund' && $singleCancelOrderData['orderDetail']['order_device_mode'] == 'app'){ ?>
						<a class="btn custom_single_oder"   href="<?php echo base_url('admin/paymentrefundforApp-view/'. $singleCancelOrderData['orderDetail']['o_id']); ?>">Request Refund</a>
						<?php } ?>
						
						
						
						
						<div class="clearfix"></div>
						
						</div>
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">
						
						<section class="invoices">
							<!-- title row -->
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col col-dum">
									<div class="inner-tab">
										<h4>General Details</h4>
										<ul>
											<li>
												<strong>Order Date</strong>
												<p><?php $orderdate  = $singleCancelOrderData['orderDetail']['orderAt']; 
													
													
													 
						   
						  echo  date("F d, Y", strtotime($orderdate));
							   
													
													?></p>	
											</li>
											<li>
												<strong>Order Status</strong>
												<p>
													<?php 
														if($singleCancelOrderData['orderDetail']['orderStatus'] == 'pending'){
															$status = "default";
														}
														if($singleCancelOrderData['orderDetail']['orderStatus'] == 'processing'){
															$status = "info";
														}
														if($singleCancelOrderData['orderDetail']['orderStatus'] == 'ongoing'){
															$status = "warning";
														}
														if($singleCancelOrderData['orderDetail']['orderStatus'] == 'complete'){
															$status = "success";
														}
														if($singleCancelOrderData['orderDetail']['orderStatus'] == 'cancel'){
															$status = "danger";
														}
													?>
													<span class="label label-<?php echo $status; ?>"><?php echo $singleCancelOrderData['orderDetail']['orderStatus']; ?></span>
													
												</p>
											</li>
											<li>
												<strong>Delivery Boy</strong>
												<p><?php if(!empty($singleCancelOrderData['DeliveryBoyData'])){ echo $singleCancelOrderData['DeliveryBoyData']['firstName'].' '.$singleCancelOrderData['DeliveryBoyData']['lastName']; } else { echo "N/A"; }?></p>
											</li>
											
											
											
											
											
										</ul>
									</div>
									
								</div>
								<!----------------------------------------------->
								<div class="col-sm-4 invoice-col col-dum">
									<div class="inner-tab">
										<h4>Account Information</h4>
										<ul>
											<li>
												
												<strong>Customer Name</strong>
												<p><?php echo $singleCancelOrderData['userData']['firstName'];?>&nbsp;&nbsp;<?php echo $singleCancelOrderData['userData']['lastName'];?></p></li>
											<li>
												
												<strong>Email</strong>
												<p><?php echo $singleCancelOrderData['userData']['email'];?></p></li>
												
											
												
											
											</ul>
										</div></div>
								<!----------------------------------------------->
								<div class="col-sm-4 invoice-col col-dum cancel-order-request">
									<div class="inner-tab">
										<h4>Cancel Request</h4>
										<ul>
											<li>
												
												<strong>Order Cancel Reason</strong>
												<p><?php echo $singleCancelOrderData['orderDetail']['cancelReason'];?></p></li>
											
												
											
											</ul>
										</div></div>
								
								
								
								
								
								
								
								
								<!-- /.col -->
								<div class="col-sm-6 invoice-col col-dum">
									<div class="inner-tab">
										<h4>Billing Details</h4>
										<ul>
											<li>
												<strong>Address</strong>
												<p>
													<?php
														
														$data = $singleCancelOrderData['orderDetail']['billingAddress'];
														
														$ShippingAdd = unserialize($data);
														
														
														//pr($ShippingAdd);
														$appartment = "";
														if(!empty($ShippingAdd['appartment'])){
														$appartment = $ShippingAdd['appartment'];
														}
														 
														echo $ShippingAdd['address'].', '.$ShippingAdd['country'].', '.$ShippingAdd['state'].', '.$appartment.', '.$ShippingAdd['town_city'].'-'.$ShippingAdd['postcode'];	
													?>
													
												</p>	
											</li>
											<li>
												<strong>Email</strong>
												<p><?php echo $ShippingAdd['email']; ?></p>
											</li> 
											<li>
												<strong>First Name</strong>
												<p><?php echo $ShippingAdd['firstname']; ?></p>
											</li>
											
											<li>
												<strong>Last Name</strong>
												<p><?php echo $ShippingAdd['lastname']; ?></p>
											</li>
											
											<li>
												<strong>Phone Number</strong>
												<p><?php echo $ShippingAdd['phone']; ?></p>
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
														
														
														$data = $singleCancelOrderData['orderDetail']['shippingAddress'];
														$ShippingAdd = unserialize($data);
														
														//pr($ShippingAdd);
														$appartment = "";
													   if(!empty($ShippingAdd['appartment'])){
														$appartment = $ShippingAdd['appartment'];
														}else{ }
														
														echo $ShippingAdd['address'].', '.$ShippingAdd['country'].', '.$ShippingAdd['state'].', '.$appartment.', '.$ShippingAdd['town_city'].'-'.$ShippingAdd['postcode'];
													?>
												</p>	
											</li>
											<li>
												<strong>Email</strong>
												<p><?php echo $ShippingAdd['email']; ?></p>
											</li> 
											<li>
												<strong>First Name</strong>
												<p><?php echo $ShippingAdd['firstname']; ?></p>
											</li>
											
											<li>
												<strong>Last Name</strong>
												<p><?php echo $ShippingAdd['lastname']; ?></p>
											</li>
											
											<li>
												<strong>Phone Number</strong>
												<p><?php echo $ShippingAdd['phone']; ?></p>
											</li>
											
											
											
											
											
											
										</ul>
									</div>	
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
							
							<!-- Table row -->
							<div class="row">
								<div class="col-xs-12 col-sm-12 table-responsive invoice-col col-dum">
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
												$orderDetails = unserialize($singleCancelOrderData['orderDetail']['oderDetails']);
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
									<!--<p class="lead">Payment Methods:</p>-->
									<h4>Payment Methods</h4>
									
									<img src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">
									<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
										<?php echo $singleCancelOrderData['orderDetail']['payment_method']; ?>
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
													<td>$<?php echo $singleCancelOrderData['orderDetail']['totalPrice']; ?></td>
												</tr>
												
												
												
												
												<tr>
													<th>Total:</th>
													<td>$<?php echo $singleCancelOrderData['orderDetail']['totalPrice']; ?></td>
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




<!-- /.content-wrapper -->

