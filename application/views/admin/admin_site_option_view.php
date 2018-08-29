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
		
		
		
		<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('admin/site-option'); ?>">
			
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title"><b>Header Options</b></h3>
					
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
						
							<!---Taglline--->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<input class="form-control" type="text" value="<?php echo $siteData['siteTaglineKey']['optionValue']; ?>" Placeholder="Welcome to our online store!" id="siteTaglineKey" name="siteTaglineKey" >
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" name="is_active_siteTaglineKey" id="is_active_siteTaglineKey" <?php if(!empty($siteData['is_active_siteTaglineKey']['optionValue']) && $siteData['is_active_siteTaglineKey']['optionValue'] == '1' ){
											echo "checked"; }?> value="1">
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
							<!---phone--->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1">
												<i class="fa fa-phone" aria-hidden="true"></i>
											</span>
											<input class="form-control" id="sitePhoneKey" name="sitePhoneKey" placeholder="0123-456-478" aria-describedby="sizing-addon1" value="<?php echo $siteData['sitePhoneKey']['optionValue']; ?>" type="text">										
										</div>
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" id="is_active_sitePhoneKey" name="is_active_sitePhoneKey" <?php 
												if(!empty($siteData['is_active_sitePhoneKey']['optionValue']) && $siteData['is_active_sitePhoneKey']['optionValue'] == '1' ){ echo "checked";  
											}?> value="1" >
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
							
							<!---Mobile--->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1">
												<i class="fa fa-mobile" aria-hidden="true"></i>
											</span>
											<input class="form-control" id="siteMobileKey" name="siteMobileKey" placeholder="987-654-3210" aria-describedby="sizing-addon1" value="<?php echo $siteData['siteMobileKey']['optionValue']; ?>" type="text">										
										</div>
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" id="is_active_siteMobileKey" name="is_active_siteMobileKey" <?php if(!empty($siteData['is_active_siteMobileKey']['optionValue']) && $siteData['is_active_siteMobileKey']['optionValue'] == '1' ){ echo "checked"; }?> value="1" >
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
							
							<!---Android--->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1">
												<i class="fa fa-android" aria-hidden="true"></i>
											</span>
											<input class="form-control" id="siteAndroidKey" name="siteAndroidKey" placeholder="https://play.google.com/" aria-describedby="sizing-addon1" value="<?php echo $siteData['siteAndroidKey']['optionValue']; ?>" type="text">										
										</div>
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" id="is_active_siteAndroidKey" name="is_active_siteAndroidKey" <?php if(!empty($siteData['is_active_siteAndroidKey']['optionValue']) && $siteData['is_active_siteAndroidKey']['optionValue'] == '1' ){ echo "checked"; }?> value="<?php echo $siteData['is_active_siteAndroidKey']['optionValue'];?>" value="1" >
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
							<!---Wishlist--->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1">
												<i class="fa fa-heart" aria-hidden="true"></i>
											</span>
											<input class="form-control" id="siteWishlistKey" name="siteWishlistKey" placeholder="Wishlist" aria-describedby="sizing-addon1" value="<?php echo $siteData['siteWishlistKey']['optionValue']; ?>" type="text">										
										</div>
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" id="is_active_siteWishlistKey" name="is_active_siteWishlistKey" <?php if(!empty($siteData['is_active_siteWishlistKey']['optionValue']) && $siteData['is_active_siteWishlistKey']['optionValue'] == '1' ){ echo "checked"; }?>  value="1" >
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
							<!--My cart---->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1">
												<i class="fa fa-cart-plus" aria-hidden="true"></i>
											</span>
											<input class="form-control" id="siteCartKey" name="siteCartKey" placeholder="My Cart" aria-describedby="sizing-addon1" value="<?php echo $siteData['siteCartKey']['optionValue']; ?>" type="text">										
										</div>
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" id="is_active_siteCartKey" name="is_active_siteCartKey" <?php if(!empty($siteData['is_active_siteCartKey']['optionValue']) && $siteData['is_active_siteCartKey']['optionValue'] == '1' ){ echo "checked"; }?> 
											value="1">
											<div class="slider round"></div>
										</label>
									</div>
								</div>
							</div>
							
							
							<!--Login And Signup---->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon" id="sizing-addon1">
												<i class="fa fa-sign-in" aria-hidden="true"></i>
											</span>
											<input class="form-control" id="siteSigninKey" name="siteSigninKey" placeholder="Login / Sign up" aria-describedby="sizing-addon1" value="<?php echo $siteData['siteSigninKey']['optionValue']; ?>" type="text">										
										</div>
									</div>
									<div class="col-md-6">
										<label class="switch push-left">
											<input type="checkbox" id="is_active_siteSigninKey" name="is_active_siteSigninKey" <?php if(!empty($siteData['is_active_siteSigninKey']['optionValue']) && $siteData['is_active_siteSigninKey']['optionValue'] == '1' ){ echo "checked"; }?> value="1"
											>
											<div class="slider round"></div>
											</label>
									</div>
								</div>
							</div>
							
							<!---Append Image----->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6 ">
										<div class="form-group">
											<img  src="<?php echo base_url('uploads/main/').$siteData['siteLogoKey']['optionValue']; ?>" >
										</div>
									</div>
								</div>
							</div>
							
							
							
							<!----Logo upload---------->
							<div class="col-md-12">
								<div class="form-group site_option">
									<div class="col-md-6">
										<div id="dynamic-image"></div>
										<p></p>
										<div class="form-group">
											<button  type="button" class="image" id="filetype" >Change Logo</button>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>	
			</div>
			<!----End header-------------->
			
			
			<!----Start Footer section------------->
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"><b>Footer Options</b></h3>
					
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="row">
						
						<!---Copyright--->
						<div class="col-md-12">
							<div class="form-group site_option">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">&copy; Copyright section</label>
										<textarea class="form-control" id="siteCopyrightKey" name="siteCopyrightKey" placeholder="© 2015 Name Store. All Rights Reserved." rows="5" cols="50"><?php echo $siteData['siteCopyrightKey']['optionValue'];?></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<label class="form-label"></label>
									<label class="switch push-left">
										<input type="checkbox" id="is_active_siteCopyrightKey" name="is_active_siteCopyrightKey" <?php if(!empty($siteData['is_active_siteCopyrightKey']['optionValue']) && $siteData['is_active_siteCopyrightKey']['optionValue'] == '1' ){ echo "checked"; } ?> value="1">
										<div class="slider round"></div>
									</label>
								</div>
							</div>
							<p></p>
							
							
							
						</div>
						<p></p>
						
						<!--footer widget start--->
							<div class="col-md-12">
								<div class="clearfix"></div>
							</div>
							  
							<div class="col-md-12">
								
								<div class="col-md-4">
									<label>Footer Column - 1</label>
									<div class="form-group">
										<input type="text" id="siteFooterTitleOneKey" name="siteFooterTitleOneKey"  class="form-control" placeholder="Title" Value="<?php echo $siteData['siteFooterTitleOneKey']['optionValue']?>" />
										 <p></p>
										 <textarea id="siteFooterColumnOneKey" name="siteFooterColumnOneKey" class="form-control" rows="7" cols="40"><?php echo $siteData['siteFooterColumnOneKey']['optionValue']?></textarea>
									</div>
								</div>
								
								<div class="col-md-4">
								<label>Footer Column - 2</label>
									<div class="form-group">
										<input type="text" id="siteFooterTitleTwoKey" name="siteFooterTitleTwoKey" class="form-control" placeholder="Title" Value="<?php echo $siteData['siteFooterTitleTwoKey']['optionValue']?>" />
										 <p></p>
										<textarea id="siteFooterColumnTwoKey" name="siteFooterColumnTwoKey" class="form-control" rows="7" cols="40"><?php echo $siteData['siteFooterColumnTwoKey']['optionValue']?></textarea>
									</div>
								</div>
								
								<div class="col-md-4">
								<label>Footer Column - 3</label>
									<div class="form-group">
										<input type="text" id="siteFooterTitleThreeKey" name="siteFooterTitleThreeKey" class="form-control" placeholder="Title" Value="<?php echo $siteData['siteFooterTitleThreeKey']['optionValue']?>"  />
										 <p></p>
										 <textarea id="siteFooterColumnThreeKey" name="siteFooterColumnThreeKey" class="form-control" rows="7" cols="40"><?php echo $siteData['siteFooterColumnThreeKey']['optionValue']?></textarea>
									</div>
								</div>
								
							</div>
							<!--footer widget end--->
							<p></p>
							
					</div>
				</div> 
			</div>
			
			
			<!------end Footer section------------>
			
			
			<!---Sidebar sectio start--------------->
			
			<div class="box box-danger">
				<div class="box-header with-border">
					<h3 class="box-title"><b>Sidebar Options</b></h3>
					
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="row">
						
						<!---sidebar--->
						<div class="col-md-12">
							<div class="form-group site_option">
								<div class="col-md-6">
									<div class="form-group">
										<i>Customize sidebar</i>
										<p>Are you want to hide sidebar on frontend section ?</p>
									</div>
								</div>
								<div class="col-md-6">
									<label class="form-label"></label>
									<label class="switch push-left">
									<input type="checkbox" id="is_active_siteSidebarKey" name="is_active_siteSidebarKey" <?php if(!empty($siteData['is_active_siteSidebarKey']['optionValue']) && $siteData['is_active_siteSidebarKey']['optionValue'] == '1' ){ 
									echo "checked"; }?> value="1" >
											<div class="slider round"></div>
										</label>
										</div> 
									</div>
								</div>
								<p></p>
							</div>  
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<input type="submit" class="btn btn-success" id="UpdatesiteOption" name="UpdatesiteOption" value="Save" />
						</div>
					</div>
				</div>
				
			</form>
			<!---Sidebar sectio End--------------->
			
			
			
		</section>
		<!-- /.content -->
		
		
		
	</div>
	<!-- /.content-wrapper -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	
		jQuery(document).one('click','#filetype',function(){
			jQuery("#dynamic-image").append('<input type="file" name="siteLogoKey" id="image">');
		});		
	
</script>