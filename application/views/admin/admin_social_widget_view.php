<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>  <i class="fa fa-<?php echo $font_icon; ?>"></i>
			<?php echo $pagetitle; ?>
			<small>Links</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/social-connect">Social Connect</a></li>
		</ol>
	</section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="msg_noti"><?php echo $this->session->flashdata('verify_msg'); ?></div>
				
				<div class="box">
					<div class="box-header">
						<h2 class="box-title">List of all social links</h2>
					</div>
					
					<!-- /.box-header -->
					<div class="box-body">
						<?php $attributes = array('id' => 'CreateSocialConnect' ,'class'=>'');
						echo form_open_multipart('admin/social-connect', $attributes);?>
						
						<div class="box-body">
							
							
							<div class="col-md-6">
							<label><i>Paste your Social url here ...</i></label>
							<p></p>
							
							<div class="clearfix" style="height:10pxl" ></div>
							
								<div class="form-group">
									<div class="input-group input-group-lg">
										<span class="input-group-addon" id="sizing-addon1">
											<i class="fa fa-facebook" aria-hidden="true"></i>
										</span>
										<input type="text" class="form-control" id="socialFacebookKey" name="socialFacebookKey" placeholder="https://" aria-describedby="sizing-addon1" Value="<?php if(!empty($socialData['socialFacebookKey']['optionValue'])) { echo $socialData['socialFacebookKey']['optionValue'];}?>" >
										
										
									</div>
								</div>
								

								<div class="form-group">
									<div class="input-group input-group-lg">
										<span class="input-group-addon" id="sizing-addon1">
											<i class="fa fa-twitter" aria-hidden="true"></i>
										</span>
										<input type="text" class="form-control" id="socialTwitterKey" name="socialTwitterKey" placeholder="https://" aria-describedby="sizing-addon1" value="<?php if(!empty($socialData['socialTwitterKey']['optionValue'])) { echo $socialData['socialTwitterKey']['optionValue'];}?>">
										
									</div>
								</div>
								
								
								
								
								<div class="form-group">
									<div class="input-group input-group-lg">
										<span class="input-group-addon" id="sizing-addon1">
											<i class="fa fa-instagram" aria-hidden="true"></i>
										</span>
										<input type="text" class="form-control" id="socialInstagramKey" name="socialInstagramKey" placeholder="https://" aria-describedby="sizing-addon1" value="<?php if(!empty($socialData['socialInstagramKey']['optionValue'])) { echo $socialData['socialInstagramKey']['optionValue'];}?>">
										
								</div>
							</div>
						
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-pinterest" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialPinterestKey" name="socialPinterestKey" placeholder="https://" aria-describedby="sizing-addon1" Value="<?php if(!empty($socialData['socialPinterestKey']['optionValue'])) { echo $socialData['socialPinterestKey']['optionValue'];}?>" >
							</div>
						</div>
						
						
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-rss" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialRssKey" name="socialRssKey" placeholder="https://" aria-describedby="sizing-addon1" 
								Value="<?php if(!empty($socialData['socialRssKey']['optionValue'])) { echo $socialData['socialRssKey']['optionValue'];}?>">
								
							</div>
						</div>
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-google-plus" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialGoogleplusKey" name="socialGoogleplusKey" placeholder="https://" aria-describedby="sizing-addon1" Value="<?php if(!empty($socialData['socialGoogleplusKey']['optionValue'])) { echo $socialData['socialGoogleplusKey']['optionValue']; } ?>">
								
							</div>
						</div>
						
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-linkedin" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialLinkedinKey" name="socialLinkedinKey" placeholder="https://" aria-describedby="sizing-addon1"
								Value="<?php if(!empty($socialData['socialLinkedinKey']['optionValue'])) { echo $socialData['socialLinkedinKey']['optionValue']; } ?>">
							</div>
						</div>
						
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-youtube" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialYoutubeKey" name="socialYoutubeKey" placeholder="https://" aria-describedby="sizing-addon1" value="<?php if(!empty($socialData['socialYoutubeKey']['optionValue'])) { echo $socialData['socialYoutubeKey']['optionValue'];}?>">
							</div>
						</div>
						
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-vimeo" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialVimeoKey" name="socialVimeoKey" placeholder="https://" aria-describedby="sizing-addon1" Value="<?php if(!empty($socialData['socialVimeoKey']['optionValue'])) { echo $socialData['socialVimeoKey']['optionValue']; } ?>">
							</div>
						</div>
						
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-tumblr" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialTumblrKey" name="socialTumblrKey" placeholder="https://" aria-describedby="sizing-addon1" Value="<?php if(!empty($socialData['socialTumblrKey']['optionValue'])) { echo $socialData['socialTumblrKey']['optionValue']; } ?>">
							</div>
						</div>
						
						
						
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon" id="sizing-addon1">
									<i class="fa fa-bold" aria-hidden="true"></i>
								</span>
								<input type="text" class="form-control" id="socialBlogKey" name="socialBlogKey" placeholder="https://" aria-describedby="sizing-addon1" Value="<?php if(!empty($socialData['socialBlogKey']['optionValue'])) { echo $socialData['socialBlogKey']['optionValue'];}?>">
							</div>
						</div>
						
						
						
					</div>
				</div>
					
					<!-- /.box-body -->
					
					<div class="box-footer">
						<button type="submit" name="updateSocialLinks" class="btn btn-success">Submit now</button>
					</div>
				</form>
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