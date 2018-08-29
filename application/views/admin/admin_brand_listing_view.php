<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
        <?php echo $pagetitle; ?>
        <small>advanced Search</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>admin/brand-listing">Brand Listing</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
           <div class="box">
            <div class="box-header">
              <h2 class="box-title">List Of all Brands</h2>
            </div>
			
			
            <!-- /.box-header -->
            <div class="box-body">
				<a class="btn btn-success" href="<?php echo base_url();?>admin/create-brand"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Brand</a><p>&nbsp;</p>
			
              <table id="customer_listingTable" class="table table-bordered table-striped">
                
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Image</th>
						<th>Name</th>
						<!--th>Description</th-->
						<th>Status</th>
						<th>Create Date</th>
						<th>Update Date</th>
						<th>Sub Brand count</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($all_Brands)){ ?>
				<?php $count ='1'; ?>
					<?php foreach( $all_Brands as $key =>$BrandVal): ?>   
						<tr>
							<td><?php echo $count; ?></td>
							<?php (!empty($BrandVal->BrandImgPath)) ? $imgPath = base_url().$BrandVal->BrandImgPath  : $imgPath = base_url("assets/frontend/images/no-image.jpg");  
								
							?>
							
							<td><img class="img-circle" height="60px" width="60px" src="<?php echo $imgPath;  ?>" alt="<?php echo $BrandVal->BrandImage; ?>"/></td>
							<td><?php echo $BrandVal->BrandName; ?></td>
							<!--td><?php /* echo $smallDec = substr($BrandVal->BrandDescription, 0, 80); */ ?></td-->
							<td>
							<?php  if($BrandVal->is_brand_active == '1'): ?>
									<span class="label label-success">Active</span>
							<?php elseif($BrandVal->is_brand_active == '0'): ?>
									<span class="label label-danger">De-Active</span>
							<?php else: ?>
									<span class="label label-warning"><?php echo $BrandVal->is_brand_active; ?></span>
							<?php endif; ?>
							</td>
							<td>
							<?php if(!empty($BrandVal->Brand_create_date)) { ?>
									<?php echo date('d F Y  h:m A', $BrandVal->Brand_create_date); ?>
							<?php }else{ ?>N/A<?php } ?>
							</td>
							
							<td>
							<?php if(!empty($BrandVal->Brand_update_date)) { ?>
									<?php echo date('d F Y  h:m A', $BrandVal->Brand_update_date); ?>
							<?php }else{ ?> N/A <?php } ?>
							</td>
							<td> 
								<h4 style="text-align:center;">
									<a href="<?php echo base_url('admin/sub-brand-listing/').$BrandVal->BrandId; ?>"><?php echo $BrandVal->count_subBrand; ?></a>
								</h4>
							</td>
							<td>
								<a href="<?php echo base_url('admin/update-brand/'.$BrandVal->BrandId.''); ?>"><span class="label label-primary"><i class="fa fa-fw fa-edit"></i></span></a>
								
								<a href="<?php echo base_url('admin/delete-brand/'.$BrandVal->BrandId.''); ?>"><span class="label label-danger" onclick="return confirm('Are you sure want to delete this Category ?')"><i class="fa fa-trash-o"></i></span> </a>
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
            <!-- /.box-body -->
			
			<div id="customer_listingTable_paginate" class="dataTables_paginate paging_simple_numbers" style="padding:10px;">
				<ul class="pagination">
					<?php  echo (isset($links))? $links : ""; ?>	
				</ul>    
			</div>
			
			
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
  
  