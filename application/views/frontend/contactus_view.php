<div class="breadcrumb-div">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="breadcrumb-item">Contact-us</li>
		</ol>
	</div>
</div>

<section class="contact dis">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="section2-headeing">
					<h2>Contact Us</h2>
				</div>
				<div class="pra-text">
					<?php echo $contactusinfo['siteContactDescriptionKey']['optionValue']; ?>
				</div>	
			</div>
		</div>
	</div>
	
</section>

<section class="contact-form">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="con-box">
					<div class="col-md-6 col-xs-12">
						<div class="contact-field">
							<div class="con-hed">
								<h3>Get in touch</h3>
							</div>
							<?php $attributes = array('id' => 'Userfeed' ,'class'=>'');
							echo form_open_multipart('contact', $attributes);?>
							
							<div class="input-set">
								<input id="name" type="text" class="form-control" id="feed_name" name="feed_name" placeholder="Name">
								<span><img src="<?php echo base_url('assets/images/user.png'); ?>" />
								</span>
								<span class="text-danger"><?php echo form_error('feed_name'); ?></span>
							</div>
							
							<div class="input-set">
								<input id="feed_email" name="feed_email" type="text" class="form-control"  placeholder="Email">
								<span><img src="<?php echo base_url('assets/images/email.png'); ?>" /></span>
								<span class="text-danger"><?php echo form_error('feed_email'); ?></span>
							</div>
							
							<div class="input-set">
								<div class="form-group">
									<textarea class="form-control" rows="5" id="feed_msg" name="feed_msg"  placeholder="Your Message"></textarea>
									<span><img src="<?php echo base_url('assets/images/mess.png'); ?>"/></span>
									<span class="text-danger"><?php echo form_error('feed_msg'); ?></span>
								</div>
							</div>
							<button type="submit" id="adduserfeed" name="adduserfeed" class="btn button-box">Send</button>
							</form>
							
							<div class="form-group">
							<?php echo $this->session->flashdata('verify_msg'); ?>
							</div>
							
						</div>
					</div>
					
					<div class="col-md-6 col-xs-12">
						<div class="contact-address">
							<div class="con-hed">
								<h3><?php echo $contactusinfo['siteContactHeadingKey']['optionValue']; ?></h3>
							</div>
							<!-- First Text Area  -->			
							<div class="txt-area">
								<div class="inner-text">
									<div class="col-sm-3 head">
										<div class="row">	
											<h4>Address:</h4>
										</div>
									</div>
									<div class="col-sm-9 p-tx">
										<div class="row">
											<p><?php echo $contactusinfo['siteContactAddressKey']['optionValue'];?></p>
										</div>
									</div>
								</div>
								
								<div class="inner-text">
									<div class="col-sm-3 head">
										<div class="row">	
											<h4>Phone:</h4>
										</div>
									</div>
									<div class="col-sm-9 p-tx">
										<div class="row">
											<p><?php echo $contactusinfo['siteContactPhoneKey']['optionValue']; ?></p>
										</div>
									</div>
								</div>
								
								<div class="inner-text">
									<div class="col-sm-3 head">
										<div class="row">	
											<h4>Email:</h4>
										</div>
									</div>
									<div class="col-sm-9 p-tx">
										<div class="row">
											<p><?php echo $contactusinfo['siteContactEmailKey']['optionValue']; ?></p>
										</div>
									</div>
								</div>
							</div>
							<!-- End First Text Area  -->			
							
							<div class="clear"></div>
							
						</div>
						
						
					</div>
					<div class="clear"></div>
					
					<div class="map">
						<div class="col-md-12">
							<div class="con-hed">
								<h3>LOCATION</h3>
							</div>
							<div class="GoogleMap">
								<?php 
									$iframe = $contactusinfo['siteContactAddressKey']['optionValue'];
									$getiframe = str_replace(" ","+",$iframe); 
								?>
								<iframe width="100%" height="450" frameborder="0" scrolling="no" marginheigh
								t="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $getiframe;?>&key=AIzaSyB3MCVSyQHwa_jPHh6xWLWR20zUlkquKxw&zoom=12"allowfullscreen>
								</iframe>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!----pro-section-end-section---->
