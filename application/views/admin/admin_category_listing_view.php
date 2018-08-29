<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
        <?php echo $pagetitle; ?>
        <small>advanced Search</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>admin/category-listing">Category Listing</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
           <div class="box">
            <div class="box-header">
              <h2 class="box-title">List Of all Category</h2>
            </div>
			
            <!-- /.box-header -->
            <div class="box-body">
              <table id="customer_listingTable" class="table table-bordered table-striped">
                
				<thead>
					<tr>
						<th>Sr.</th>
						<!--<th>Feature</th>-->
						<th>Image</th>
						<th>Name</th>
						<!--th>Description</th-->
						<th>Status</th>
						<th>Create Date</th>
						<th>Update Date</th>
						<th>Sub category count</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($all_Cat)){ ?>
				<?php $count ='1'; ?>
					<?php 
       					
					
					foreach( $all_Cat as $key =>$CatVal): ?>   
						<tr>
							<td><?php echo $count; ?></td>
							<!--<td><input type="checkbox" id="checkgrid" name="is_feature" value=""/></td>-->
							<?php (!empty($CatVal->categaryImage)) ? $imgPath = base_url('uploads/categories_images/').$CatVal->categaryImage  : $imgPath = base_url("assets/images/user-1.png"); ?>
							<td><img class="img-circle" height="60px" width="60px" src="<?php echo $imgPath;  ?>"/></td>
							<td><?php echo $CatVal->categaryName; ?></td>
							<!--td><?php /* echo $smallDec = substr($CatVal->catDescription, 0, 80); */ ?></td-->
							<td>
							<?php  if($CatVal->is_cat_active == '1'): ?>
									<span class="label label-success">Active</span>
							<?php elseif($CatVal->is_cat_active == '0'): ?>
									<span class="label label-danger">De-Active</span>
							<?php else: ?>
									<span class="label label-warning"><?php echo $CatVal->is_cat_active; ?></span>
							<?php endif; ?>
							</td>
							<td>
							<?php if(!empty($CatVal->cat_create_date)) { ?>
									<?php echo date('d F Y  h:m A', $CatVal->cat_create_date); ?>
							<?php }else{ ?>N/A<?php } ?>
							</td>
							
							<td>
							<?php if(!empty($CatVal->cat_update_date)) { ?>
									<?php echo date('d F Y  h:m A', $CatVal->cat_update_date); ?>
							<?php }else{ ?> N/A <?php } ?>
							</td>
							<td> 
								<h4 style="text-align:center;">
									<a href="<?php echo base_url('admin/sub-category-listing/').$CatVal->c_id; ?>"><?php echo $CatVal->count_subCat; ?></a>
								</h4>
							</td>
							<td>
								<a href="<?php echo base_url('admin/update-category/'.$CatVal->c_id.''); ?>"><span class="label label-primary"><i class="fa fa-fw fa-edit"></i></span></a>
								
								<a href="<?php echo base_url('admin/delete-category/'.$CatVal->c_id.''); ?>"><span class="label label-danger" onclick="return confirm('Are you sure want to delete this Category ?')"><i class="fa fa-trash-o"></i></span> </a>
								
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
  
  