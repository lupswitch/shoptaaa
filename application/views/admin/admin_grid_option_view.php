<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/grid-option">Grid Option</a></li>
		</ol>
	</section>
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
				<div class="box">
					<div class="box-header">
						<h2 class="box-title">Manage Grid Options</h2>
					</div>
					<!-- /.box-header -->
				
					<form action="<?php echo base_url('admin/grid-option');?>" id="CreateNewCategory" class="createNewCat_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
						<div class="box-body">
							
							
							
							<!---- column - 1----------------->
							<div class="col-md-6">
								<div class="form-group">
									<h4>Grid 1</h4>
									
									<input type="text" class="form-control" id="siteGridButtonUrlOne" name="siteGridButtonUrlOne" placeholder="Enter Button Url"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonUrlOne'])) ? $SiteGridOption['siteGridButtonUrlOne']['optionValue'] : ""; ?>" />
									<p></p>
									
									<input type="text" class="form-control" id="siteGridButtonTextOne" name="siteGridButtonTextOne" placeholder="Enter Button Text"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonTextOne'])) ? $SiteGridOption['siteGridButtonTextOne']['optionValue'] : ""; ?>" />
									
									<p></p>
									
									<label><i>Image Should  Be ( 480 x 262 ) For Better Display.</i></label>
									<div class="form-group">
										
										<img src="<?php echo base_url('uploads/main/');?><?php echo $SiteGridOption['siteGridImageOne']['optionValue'] ?>" alt="Image" class="media-object img-rounded thumb48"  width="500" height="200">
										<br/>
										<p></p>
										<div id="dynamic-image1">
											
											</div>
										<!--<input type="file" name="images" id="image">-->
										<input type="hidden" name="old-img1" value="">
										<p></p>
										<div class="input_fields_wrap">
											<button data-filepath="" type="button" class="btn btn-success image" id="filetype1" >Edit Image</button>
										</div>
									</div>
								</div>
							</div>
							<!----- column 1--------------->
							
							<!---- column-2----------------->
							<div class="col-md-6">
								<div class="form-group">
									<h4>Grid 2</h4>
									
									<input type="text" class="form-control" id="siteGridButtonUrlTwo" name="siteGridButtonUrlTwo" placeholder="Enter Button Url"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonUrlTwo'])) ? $SiteGridOption['siteGridButtonUrlTwo']['optionValue'] : ""; ?>" />
									<p></p>
									
									<input type="text" class="form-control" id="siteGridButtonTextTwo" name="siteGridButtonTextTwo" placeholder="Enter Button Text"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonTextTwo'])) ? $SiteGridOption['siteGridButtonTextTwo']['optionValue'] : ""; ?>" />
									
									<p></p>
									
									<label><i>Image Should  Be (  568 x 156 ) For Better Display.</i></label>
									<div class="form-group">
										
										<img src="<?php echo base_url('uploads/main/');?><?php echo $SiteGridOption['siteGridImageTwo']['optionValue'] ?>" alt="Image" class="media-object img-rounded thumb48"  width="500" height="200">
										<br/>
										<p></p>
										<div id="dynamic-image2"></div>
										<!--<input type="file" name="images" id="image">-->
										<input type="hidden" name="old-img2" value="">
										<p></p>
										<div class="input_fields_wrap">
											<button data-filepath="" type="button" class="btn btn-success image" id="filetype2" >Edit Image</button>
										</div>
									</div>
								</div>
							</div>
							<!---- column-2----------------->
							
							
							<!---- column - 3----------------->
							<div class="col-md-6">
								<div class="form-group">
									<h4>Grid 3</h4>
									
									<input type="text" class="form-control" id="siteGridButtonUrlThree" name="siteGridButtonUrlThree" placeholder="Enter Button Url"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonUrlThree'])) ? $SiteGridOption['siteGridButtonUrlThree']['optionValue'] : ""; ?>" />
									<p></p>
									
									<input type="text" class="form-control" id="siteGridButtonTextThree" name="siteGridButtonTextThree" placeholder="Enter Button Text"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonTextThree'])) ? $SiteGridOption['siteGridButtonTextThree']['optionValue'] : ""; ?>" />
									
									<p></p>
									
									<label><i>Image Should  Be ( 480 x 261 ) For Better Display.</i></label>
									<div class="form-group">
										
										<img src="<?php echo base_url('uploads/main/');?><?php echo $SiteGridOption['siteGridImageThree']['optionValue'] ?>" alt="Image" class="media-object img-rounded thumb48"  width="500" height="200">
										<br/>
										<p></p>
										<div id="dynamic-image3"></div>
										<!--<input type="file" name="images" id="image">-->
										<input type="hidden" name="old-img3" value="">
										<p></p>
										<div class="input_fields_wrap">
											<button data-filepath="" type="button" class="btn btn-success image" id="filetype3" >Edit Image</button>
										</div>
									</div>
								</div>
							</div>
							<!----- column 3--------------->
							
							<!---- column-4----------------->
							<div class="col-md-6">
								<div class="form-group">
									<h4>Grid 4</h4>
									
									<input type="text" class="form-control" id="siteGridButtonUrlFour" name="siteGridButtonUrlFour" placeholder="Enter Button Url" Value="<?php echo (!empty($SiteGridOption['siteGridButtonUrlFour'])) ? $SiteGridOption['siteGridButtonUrlFour']['optionValue'] : ""; ?>" />
									<p></p>
									
									<input type="text" class="form-control" id="siteGridButtonTextFour" name="siteGridButtonTextFour" placeholder="Enter Button Text"   Value="<?php echo (!empty($SiteGridOption['siteGridButtonTextFour'])) ? $SiteGridOption['siteGridButtonTextFour']['optionValue'] : ""; ?>" />
									
									<p></p>
									
									<label><i>Image Should  Be ( 480 x 261 ) For Better Display.</i></label>
									<div class="form-group">
										
										<img src="<?php echo base_url('uploads/main/');?><?php echo $SiteGridOption['siteGridImageFour']['optionValue'] ?>" alt="Image" class="media-object img-rounded thumb48"  width="500" height="200">
										<br/>
										<p></p>
										<div id="dynamic-image4"></div>
										<!--<input type="file" name="images" id="image">-->
										<input type="hidden" name="old-img4" value="">
										<p></p>
										<div class="input_fields_wrap">
											<button data-filepath="" type="button" class="btn btn-success image" id="filetype4">Edit Image</button>
										</div>
									</div>
								</div>
							</div>
							<!---- column-4----------------->
							
							
							
							<!----row end---------->
							
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" class="btn btn-success" id="UpdateGridoption" name="UpdateGridoption" value="Save" />
								</div>
							</div>
						</div>
						
						
					</form>
					
					
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
	    <!-- /.content -->
		
		
		
	</div>
	<!-- /.content-wrapper -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
		
		jQuery(document).one('click','#filetype1',function(){
			jQuery("#dynamic-image1").append('<input type="file" name="siteGridImageOne" id="image">');
		});		
		
		jQuery(document).one('click','#filetype2',function(){
			jQuery("#dynamic-image2").append('<input type="file" name="siteGridImageTwo" id="image">');
		});		
		
		jQuery(document).one('click','#filetype3',function(){
			jQuery("#dynamic-image3").append('<input type="file" name="siteGridImageThree" id="image">');
		});		
		
		jQuery(document).one('click','#filetype4',function(){
			jQuery("#dynamic-image4").append('<input type="file" name="siteGridImageFour" id="image">');
		});		
		
	</script>	