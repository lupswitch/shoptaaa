<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
        <?php echo $pagetitle; ?>
        <small>advanced Search</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>admin/user-listing">Product Listing</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
           <div class="box">
            <div class="box-header">
              <h2 class="box-title">List Of all Products</h2>
            </div>
			<?php /* pr($all_Products); */ ?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customer_listingTable-stop_data_tbl" class="table table-bordered table-striped">
                
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Product Image</th>
						<th>Name</th>
						<th>SKU-Code</th>
						<!--th>Description</th>
						<th>Use</th>
						<th>Product Design</th-->
						<th>Price</th>
						<th>Quantity</th>
						<th>Is Featured</th>
						<th>Is Active</th>
						<th>Create Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php //pr($all_Products); ?>
				<?php if(!empty($all_Products)){ ?>
				<?php $count =  (isset($counter))? $counter  : '1'; ?>
					<?php foreach( $all_Products as $key =>$ProVal): ?>   
						<tr>
							<td><?php echo $count; ?></td>
							<?php /*(!empty($ProVal->MainImage)) ? $imgPath = base_url().$ProVal->MainImage  : $imgPath = base_url("assets/images/user-1.png"); */
							?>

							<td><img class="img-circle" height="60px" width="60px" src="<?php if(!empty($ProVal->MainImage)){ echo base_url('/uploads/product_images/thumb_images/').$ProVal->MainImage; } else { echo base_url('assets/frontend/images/no-image.jpg'); }?>"/></td>
							<td><?php echo $ProVal->productName; ?></td>
							<td><?php echo $ProVal->pro_SUK; ?></td>
							<td><?php echo $ProVal->productPrice; ?></td>
							<td><?php echo $ProVal->proQuantity; ?></td>
							
							<?php /*
							<td><?php echo $smallDec = substr($ProVal->productDescription, 0, 80); ?></td>
							<td><?php echo $ProVal->useCare; ?> </td>
							<td><?php echo $ProVal->productDesign;  ?></td>
							<td><?php echo $ProVal->productPrice; ?></td>
							
							*/	?>
							
							<td><?php echo ($ProVal->pro_isFeature == true)? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
							<td><?php echo ($ProVal->pro_isActive == true)? '<span class="label label-success">Active</span>' : '<span class="label label-danger">De-Active</span>'; ?></td>
							
							<?php if(!empty($ProVal->product_create_date)) { ?>
									<td><?php echo date('d F Y  h:m A', $ProVal->product_create_date); ?></td>
							<?php }else{ ?>
									<td>---</td>
							<?php } ?>
							<td>
								<a href="<?php echo base_url('admin/product-update/'.$ProVal->pId.''); ?>"><span class="label label-primary"><i class="fa fa-fw fa-edit"></i></span></a>
							
								<a href="<?php echo base_url('admin/product-delete/'.$ProVal->pId.''); ?>"><span class="label label-danger" onclick="return confirm('Are you sure want to delete this Product ?')"><i class="fa fa-trash-o"></i></span> </a>
								
							</td>
						</tr>
					<?php $count++; ?>
					<?php endforeach; ?>		
				
				<?php } else { ?>
						<tr><td colspan="8" style="text-align:center;"><h2>There is now Record..</h2></td></tr>
				<?php } ?>		
				</tbody> 
				
              </table>
            </div>
			
		
			
			<div id="customer_listingTable_paginate" class="dataTables_paginate paging_simple_numbers" style="padding:10px;">
				<ul class="pagination">
					<?php  //echo $links; ?>	
				</ul>    
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
