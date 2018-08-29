<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>View Order Delivery</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/delivery">Delivery</a></li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="msg_noti"></div>
				<div class="box">
					<div class="box-header">
						<h2 class="box-title">List of all order delivery</h2>
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">
						<!---<a class="btn btn-success" href="<?php //echo base_url('admin/create-page');?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Page</a>-->
						<p></p>
						<table id="customer_listingTable" class="table table-bordered table-striped">
							
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Order ID</th>
									<th>Status</th>
									<th>Address</th>
									<th>Delivery Boy</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tbody>
								
								<?php
									$count = 1; 

                                   
									foreach($orderdata as $od_data){
									?>
									<tr>
										<td data-oid="<?php echo $od_data->o_id; ?>"><?php echo $count;?></td>
										
										<td><?php if(!empty($od_data->order_id)){ echo $od_data->order_id; } else { echo "---"; } ?></td>
										
										<td>
											<span class="<?php if($od_data->orderStatus == 'processing'){ echo "Delivery_in_process"; } ?>" id="Deliverystatus_<?php echo $od_data->o_id; ?>" ><?php echo $od_data->orderStatus;?>
											</span>
										</td>
										
										<td>
											<?php 
												//$data = $od_data->billingAddress; 
												$data = $od_data->shippingAddress; 
												$ShippingAdd = unserialize($data);

                                               //  pr($ShippingAdd);

												if(!empty($ShippingAdd['appartment'])){
													$appartment = $ShippingAdd['appartment'];
												}else{ $appartment = "Appartment: N/A";}
												
												//echo $ShippingAdd['address'].', '.$ShippingAdd['country'].', '.$ShippingAdd['state'].', '.$appartment.', '.$ShippingAdd['town_city'].'-'.$ShippingAdd['postcode'];	

                                                   echo $ShippingAdd['address'].', '.$appartment.', '.$ShippingAdd['town_city']. ','.
                                                   $ShippingAdd['state']. '-'.$ShippingAdd['postcode'] .','.$ShippingAdd['country'];	  



												
											?>
										</td>
										
										<td>
											<select class="form-control <?php if($od_data->orderStatus == 'processing') {echo "deliverd";}?>" id="deleveryBoyId_<?php echo $od_data->o_id; ?>" name="deleveryBoyId" required >
												<option value="0">-- Assign dlivery Boy --</option>
												<?php foreach($userData as $val ){ ?>
													<option  
													value="<?php echo $val->user_id; ?>" <?php echo ($val->user_id == $od_data->deleveryBoyId )? "selected='selected'" : "";  ?> ><?php echo $val->firstName. ' ' .$val->lastName; ?>&nbsp;( <?php echo $val->userLocation ;?> )</option>
												<?php } ?>
											</select>
										</td>
										
										<td> 
											<a class="Delivery" data-href="<?php echo base_url('admin/assign/delivery'); ?>" data-id="<?php echo $od_data->o_id ; ?>" class="btn btn-info">Update</a>
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

