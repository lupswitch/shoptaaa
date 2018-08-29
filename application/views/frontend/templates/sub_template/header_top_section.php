<section class="pre-hdr">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6 lft"><p>
				<?php 
					if($siteData['is_active_siteTaglineKey']['optionValue'] == '1')
					{ 
						if(!empty($siteData['siteTaglineKey']['optionValue'])) 
						{
							if(!empty($this->session->userdata['is_customer']['user_id'])) 
							{
							?>
							<?php echo $siteData['siteTaglineKey']['optionValue'];?> <a id="welcome_username" href="<?php echo base_url('account/profile/'); ?>"><span><?php echo $this->session->userdata['is_customer']['userName']; ?></span></a>
							<?php	
							}
							else
							{?>
							Welcome to our online store
							<?php	
							}
						}
					}
				?>
			</p></div>
			<div class="col-xs-12 col-md-6 rgt">
				<p class="num">
					
					<?php if($siteData['is_active_sitePhoneKey']['optionValue'] == '1'): ?>
					<i class="fa fa-phone" aria-hidden="true"></i><a href="javascript:void(0);"><?php echo $siteData['sitePhoneKey']['optionValue']; ?></a>
					<?php endif; ?>
					
					<?php if($siteData['is_active_siteMobileKey']['optionValue'] == '1'): ?>
					<a href="javascript:void(0);"><?php echo $siteData['siteMobileKey']['optionValue']; ?></a>
					<?php endif; ?>
					
				</p>
				
				<?php  if($siteData['is_active_siteAndroidKey']['optionValue'] == '1'): ?>	
				
				<button data-href="<?php  echo $siteData['siteAndroidKey']['optionValue']; ?>" id="appclick" type="button" class="btn btn-app">
					<i class="fa fa-mobile" aria-hidden="true"></i>DOWNLOAD APP NOW
				</button>
				 
				<?php endif; ?>	
				
			</div>
			
			<div class="clearfix"></div>
		</div>
	</div>
</section>