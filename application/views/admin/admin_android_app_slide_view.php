	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <section class="content-header">
			<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
				<?php echo $pagetitle; ?>
				<small>Android App Slide</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>App Slider</a></li>
			</ol>
		</section>
		
	    <!-- Main content -->
	    <section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="msg_noti"></div>
					<div class="box">
						<div class="box-header">
							<h2 class="box-title">List of all App Slide</h2>
						</div>
						
						<!-- /.box-header -->
						<div class="box-body">
						
							<table class="table table-responsive table-hover table-bordered">
								
								<thead>
									<tr>
										<th>Sr.</th>
										<th>App Image</th>
										<th>Action</th>
									</tr>
								</thead>
								
								<tbody>
									<?php
										$count = 1;
										foreach($appslidedata as $slide){ ?>
										<tr>	
											<td><?php echo $count; ?></td>
											
											<td>
											<?php

												

//$image = explode("/", $slide->welcomeImage);
												
											?>
												<img class="img-circle" width="80px" height="80px"; src="<?php echo base_url('uploads/App-thumb-images/'.$slide->welcomeImage.''); ?>">
											</td>
											
											<td>
												<a href="<?php echo base_url('admin/update-app-slide/'.$slide->id.''); ?>" class="btn btn-info" > Update </a>
											</td>
										</tr>	
										<?php $count++; }
									?> 
										
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
	
