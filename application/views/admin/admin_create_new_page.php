

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Create </small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url(); ?>admin/pages">Pages</a></li>
			<li class="active">Create New Page</li>
		</ol>
	</section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Page Entry Fields</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="col-md-12"><?php echo $this->session->flashdata('verify_msg'); ?></div> 
					
					<?php $attributes = array('id' => 'CreateNewPage' ,'class'=>'createNewCat_form');
					echo form_open_multipart('admin/create-page', $attributes);?>
					<div class="box-body">
						
						<div class="col-md-6">
							<h4>Title *</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="pageTitle" name="pageTitle" placeholder="Enter Page Title"   Value="<?php echo set_value('pageTitle'); ?>" />
								<span class="text-danger"><?php echo form_error('pageTitle'); ?></span>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<h4>Slug *</h4>
							<div class="form-group">
								<input type="text" class="form-control" id="pageSlug" name="pageSlug" placeholder="Enter Page Slug"   Value="<?php echo set_value('pageSlug'); ?>" />
								<span class="text-danger"><?php echo form_error('pageSlug'); ?></span>
							</div>
						</div>
						
						
						
						<div class="col-md-6">	
							<h4>Status *</h4>
							<div class="form-group">
								
								<select class="form-control" id="is_page_active" name="is_page_active" required >
									<option value="1" selected > Active </option>
									<option value="0"> De-active </option>
								</select>
								<span class="text-danger"><?php echo form_error('is_page_active'); ?></span>
							</div>
						</div>
						<br/>
						<hr/>
						
						<div class="col-md-12">	
							<h4>Content*</h4>
							<div class="form-group">
								<div class="box-body pad">
									<textarea id="productDescriptionCKEditor" name="pageContent" rows="10" cols="80" placeholder="Add Page content Here.."  Required ><?php echo set_value('pageContent'); ?></textarea>
									<span class="text-danger"><?php echo form_error('pageContent'); ?></span>
								</div>
							</div>
						</div>
						
						
						<!---setting seo------>
						<div class="col-md-12">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title"><label><i>Seo - Settings</i></label></h3>
								</div>
								<div class="box-body">
									
									<div class="input-group">
										<span class="input-group-addon">Meta Title</span>
										<input class="form-control" id="page_meta_title" name="page_meta_title" value="" type="text">
									</div>
									<br>
									
									<div class="input-group">
										<span class="input-group-addon">Meta Keyword</span>
										<input class="form-control" id="page_meta_keyword" name="page_meta_keyword" value="" type="text">
									</div>
									<br>
									
									
									<div class="input-group">
										<span class="input-group-addon">Meta Description</span>
										<textarea class="form-control" rows="3" cols="40" id="page_meta_description" name="page_meta_description"></textarea>
									</div>
									<br>
								</div>
								<!-- /.box-body -->
							</div>
						</div>
						<!---setting seo------>
						
					</div>
					<!-- /.box-body -->
					
					<div class="box-footer">
					<button type="submit" name="addNewPage" class="btn btn-success">Create Now</button>
						</div>
				</form>
			</div>
			<!-- /.box -->
			
		</div>
        <!--/.col (left) -->
        <!-- right column -->
		
		
		
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
</div>

<!-- /.content-wrapper -->

