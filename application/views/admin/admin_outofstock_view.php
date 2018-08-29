<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> <i class="fa fa-<?php echo $font_icon; ?>"></i>
			 <?php echo $pagetitle; ?>
			 <small>Manage site</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/site-option">Site Option</a></li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
		<!-----Header start-------------------->
		
		
		
		<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('admin/outofstock-option'); ?>">
			
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title"><b>Out Of Stock Options</b></h3>
					
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				
				<?php //pr($siteData);?>
				<!-- /.box-header -->  
				<div class="box-body no-padding">
					<div class="row">
						<div class="col-md-12">
						
							
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										Display Out Stock Products in frontend 
									</div>
									<div class="col-md-6">
										<label class="switch push-left">

                                              

											<input type="checkbox" name="is_display_outofstock_products" id="is_display_outofstock_products" <?php if(!empty($OutofStockData['is_display_outofstock_products']['optionValue']) && $OutofStockData['is_display_outofstock_products']['optionValue'] == '1' ){
											echo "checked"; }?> value="1">
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
						
									
							
							
						</div>
							
							
							
							
							
							
							
							
							
				
						</div>









</div>

		
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<input type="submit" class="btn btn-success" id="UpdatesiteOption" name="UpdateOutofstockOption" value="Save" />
						</div>
					</div>
				</div>
				
			</form>
			<!---Sidebar sectio End--------------->
			
			
			
		</section>
		<!-- /.content -->
		
		
		
	</div>
