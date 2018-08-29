	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
			<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
				<?php echo $pagetitle; ?>
				<small>advanced Search</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active"><a href="<?php echo base_url(); ?>admin/revslider">Revslider</a></li>
			</ol>
		</section>
		
	    <!-- Main content -->
	    <section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="msg_noti"></div>
					<div class="box">
						<div class="box-header">
							<h2 class="box-title">List of all Slides</h2>
						</div>
						
						<!-- /.box-header -->
						<div class="box-body">
							
							<a class="btn btn-success" href="<?php echo base_url();?>admin/create-revslide"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Slide</a>
							<p></p>
							
							<table id="customer_listingTable-stop_data_tbl" class="table table-bordered table-striped">
								
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Image</th>
										<th>Title</th>
										<th>Is Active</th>
										<th>Action</th>
									</tr>
								</thead>
								
								<tbody>
									
									<?php if(!empty($revslide)){ ?>
										<?php $count =  1; ?>
										<?php foreach( $revslide as $slide): ?>   
										<tr>
											<td><?php echo $count; ?></td>
											
											<td>
												<img class="img-square" height="60px" width="60px" src="<?php if(!empty($slide->image)){echo base_url("/assets/revslideimage/$slide->image");}else{echo base_url("assets/frontend/images/no-image.jpg");}?>"/>
											</td>
											
											<td><?php echo $slide->slideTitle; ?></td>
											<td><?php echo ($slide->slide_isActive == true)? '<span class="label label-success">Active</span>' : '<span class="label label-danger">De-Active</span>'; ?></td>
											
											<td>
											<a title="EDIT" href="<?php echo base_url('admin/update-slide/'.$slide->rid.''); ?>">
												<span class="label label-primary">
													<i class="fa fa-fw fa-edit"></i>
												</span>
											</a>
											&nbsp;&nbsp;
											<a title="DELETE" href="<?php echo base_url('admin/slide-delete/'.$slide->rid.''); ?>">
													<span class="label label-danger" onclick="return confirm('Are you sure want to delete this slide?')">
														<i class="fa fa-trash-o"></i>
													</span>
											</a>
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
	