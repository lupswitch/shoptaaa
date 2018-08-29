<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>View Pages</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/pages">Page Listing</a></li>
		</ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
				<div class="box">
					<div class="box-header">
						<h2 class="box-title">List of all Pages</h2>
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">
					<a class="btn btn-success" href="<?php echo base_url('admin/create-page');?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Page</a>
					<p></p>
						<table id="customer_listingTable" class="table table-bordered table-striped">
							
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Title</th>
									<th>Slug</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 1; foreach($pagesdata as $p_data){ ?>
									<tr>
										<td><?php echo $count;?></td>
										<td><?php echo $p_data->pageTitle;?></td>
										<td><?php echo $p_data->pageSlug;?></td>
										<td>
											<?php echo ($p_data->is_page_active == true)? '<span class="label label-success">Active</span>' : '<span class="label label-danger">De-Active</span>'; ?>
										</td>
										
										<td>
											<a title="Edit" href="<?php echo base_url('admin/update-page/'.$p_data->pid.''); ?>">
												<span class="label label-primary">
													<i class="fa fa-fw fa-edit"></i>
												</span>
											</a>
											&nbsp;
											<a title="Delete" href="<?php echo base_url('admin/page-delete/'.$p_data->pid.''); ?>">
												<span class="label label-danger" onclick="return confirm('Are you sure want to delete this Page?')">
													<i class="fa fa-trash-o"></i>
												</span>
											</a>
											&nbsp;
											<a target="_blank" title="Preview" href="<?php echo base_url(''.$p_data->pageSlug.''); ?>">
												<span class="label label-info">
													<i class="fa fa-external-link"></i>
												</span>
											</a>
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

