
<div class="container">
<div class="row">
	
	<?php if($is_validRequest === TRUE) { ?>
	
	<div class="head-set-area">
		<div class="breadcrumb-div">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
					<li class="breadcrumb-item">Reset Password</li>
				</ol>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="section2-headeing">
				<h2>Reset Password</h2> 
			</div>	
		</div>
	</div>
	<div class="clearfix"></div>
<div class="col-sm-12">	
	<div class="outer-form">					
		<form id="resetpassword-form" class="conf-pass" action="<?php echo base_url('frontend/Auth/ResetPassword/'.$password_token.''); ?>" method="post" role="form">
			
			<div class="suces_signup alert" style="padding: 0; background: transparent;"></div>
			<div class="form-group">
				<input type="password" name="new_passwords" id="new_passwords" tabindex="2" class="form-control" placeholder="Password">
			</div>
			
			<div class="form-group">
				<input type="password"  name="match_password" id="match_password" tabindex="2" class="form-control" placeholder="Confirm Password">
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<input type="submit" name="resetsubmit" id="resetsubmit" tabindex="4" class="form-control btn btn-register" value="Submit">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
	<?php } else { ?>
	
		<div class="col-md-12 inavlidRequest">
			<div class="outer-form">
			<?php echo $this->session->flashdata('verify_msg'); ?>
			</div>
		</div>
		
	<?php } ?>
</div>
</div>
<script type="text/javascript">
		jQuery(document).ready(function () {

			/******* START RESET-PASSWORD *****/
			 $('#resetpassword-form').validate({
				 
				rules: {
					
					new_passwords: {
						required: true,
						minlength: 8,
						
									   
					},
					match_password: {
						required: true,
						equalTo : '#new_passwords',
					},
					
				},
				  messages: {
					
					new_passwords: {
						required: "Please enter password",
						minlength: "Password should be more than 8 characters"
					
					},
					
				},
				submitHandler: function(form) {
					//alert(form.action);
				$.ajax({
					url: form.action,
					type: form.method,
					data: $(form).serialize(),
					success: function(response) 
					{
						if(response == 1){
							
							$('.suces_signup').html('<div class="alert-success alert-dismissable">Sucessfully update!</div>');
							$('#new_passwords').attr('disabled','disabled');
							$('#match_password').attr('disabled','disabled');
							var baseURL =	$('#base_url').val();
							 
							setTimeout(function() {
								 window.location.href = baseURL;
							}, 3000); 
							
						}
						else
						{
                     $('.suces_signup').html('<div class="alert-danger alert-dismissable">Please Try Again !</div>');
             						// alert('Please Try Again !');
						}
				
					},
				  error: function(data, errorThrown)
				  {
					  alert('request failed :'+errorThrown);
				  }          
				});
			},
			});
			/******* END RESET-PASSWORD *******/
			
			
		

	}); 
</script>