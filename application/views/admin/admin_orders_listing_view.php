<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>View Orders</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="<?php echo base_url('admin/order-listing'); ?>">Orders</a></li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="msg_noti"></div>
				<div class="box">
					<div class="box-header">
						<h2 class="box-title">List of all orders</h2>
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">
						
						<p></p>
						<table id="customer_listingTable" class="table table-responsive">
							
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Order ID</th>
									<th>Status</th>
									<th>Delivery Boy</th>
									<th>Total Price</th>
									<th>Purchased</th>
									<th>Address</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tbody>
								
								<?php
									$count = 1; 
									foreach($orderData as $od_data){
									?>
									<tr>
										<td data-oid="<?php echo $od_data->o_id; ?>"><?php echo $count;?></td>
										
										<td><?php if(!empty($od_data->order_id)){ echo $od_data->order_id; } else { echo "N/A"; } ?></td>
										
										<td>
											
											<?php
											//pr($od_data->orderStatus);
											
												if($od_data->orderStatus == 'pending'){
													$status = "default";
												}
												if($od_data->orderStatus == 'processing'){
													$status = "info";
												}
												if($od_data->orderStatus == 'ongoing'){
													$status = "warning";
												}
												if($od_data->orderStatus == 'complete'){
													$status = "success";
												}
												if($od_data->orderStatus == 'cancel'){
													$status = "danger";
												}
												if($od_data->orderStatus == 'refund'){
													$status = "danger";
												}
											?>	
												
												<span  id="Deliverystatus_<?php echo $od_data->o_id; ?>" class="label label-<?php echo $status; ?>"><?php echo  $od_data->orderStatus; ?></span>
												
											</span>
											
											</td>
										
										<td><?php if(!empty($od_data->userDetail)) { echo $od_data->userDetail; } else { echo "N/A"; } ?></td>
										
										<td><?php if(!empty($od_data->totalPrice)) { echo $od_data->totalPrice; } else { echo "N/A"; } ?></td>
											
											<td><?php if(!empty($od_data->purchasedTotal_item)) { echo $od_data->purchasedTotal_item."&nbsp;item" ; } else { echo "No item"; } ?></td>
											
											<td>
												<?php 
													
													if(!empty($od_data->shippingAddress)) 
													{ 
														$data = $od_data->shippingAddress;
														
														$ShippingAdd = unserialize($data);
														
														if(!empty($ShippingAdd['appartment'])){
														$appartment = $ShippingAdd['appartment'];
														}else{ $appartment = "Appartment: N/A";}
														
														echo $ShippingAdd['address'].' '.$ShippingAdd['country'].' '.$ShippingAdd['state'].' '.$appartment.' '.$ShippingAdd['town_city'].'-'.$ShippingAdd['postcode'];
													}
													else 
													{ echo "N/A"; } 
												?>
											</td>
											
											<td><?php if(!empty($od_data->orderAt)) { echo $od_data->orderAt ; } else { echo "N/A"; } ?></td>
											
											<td> 
												<a href="<?php echo base_url('admin/order-view/'.$od_data->o_id); ?>" class="btn btn-info">View</a>
											</td>
											
									</tr>
								<?php $count++; } ?>		
							</tbody> 
							
						</table>
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

