<nav class="navbar navbar-inverse custm_nav">

<!--- Top Menu, Logo and Cart menu section --->
	<div class="container">
		<div class="navbar-header">
			<!--Responsive Menu Icon start --->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" aria-expanded="true">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url(); ?>">
			<?php if($siteData['siteLogoKey']['optionValue']){ ?>
			<img src="<?php echo base_url('uploads/main/').$siteData['siteLogoKey']['optionValue']; ?>" alt="logo Shopta App">
					<?php /* if(file_exists(base_url('/uploads/main/').$siteData['siteLogoKey']['optionValue'])): ?>
						<img src="<?php echo base_url('/uploads/main/').$siteData['siteLogoKey']['optionValue'];  ?>" alt="logo Shopta App">
					<?php else: ?>Shopta App <?php  endif; */ ?>
				
			<?php }else{ ?> Shopta App <?php } ?>
			</a>
		</div>
		<div class="wish-list">
		<?php if($siteData['is_active_siteWishlistKey']['optionValue'] == '1'): ?>
			<a  id="wish_notify" href="<?php if(!empty($this->session->userdata['is_customer']['user_id'])){ echo base_url('account/wishlist'); } else { echo "javascript:void(0);"; } ?>"><i class="fa fa-heart" aria-hidden="true"></i><?php echo $siteData['siteWishlistKey']['optionValue']; ?> (<span id="wishlistcount"><?php echo $wishlistcounter; ?></span>)</a>
		<?php endif; ?>	
		
		<?php if($siteData['is_active_siteCartKey']['optionValue'] == '1'): ?>
			<a href="<?php echo base_url('cart'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php echo $siteData['siteCartKey']['optionValue']; ?>  (<span id="cartItemsCount"><?php echo count($this->cart->contents()); ?></span>)</a>
		<?php endif; ?>	
			
		<?php if($siteData['is_active_siteSigninKey']['optionValue'] == '1'): ?>
			
				<?php if(!$this->session->has_userdata('is_customer')){ ?>
						<a id="login_signup" href="javascript:void();" data-toggle="modal" data-target="#myModal"><i class="fa fa-lock" aria-hidden="true"></i><?php echo $siteData['siteSigninKey']['optionValue']; ?></a>
				<?php }else{ ?>
						<a href="<?php echo base_url('account/profile'); ?>" ><span><i class="fa fa-user" aria-hidden="true"></i></span>My Profile</a>
						<a href="<?php echo base_url('frontend/Auth/Logout'); ?>" ><i class="fa fa-lock" aria-hidden="true"></i>Log Out</a>
				<?php } ?>
					
		<?php 	endif; ?>		
			
			<div class="clearfix"></div>
		</div>

	</div>
<!---- TOP MENU END --->		

<!--------- Main NAVBAR START  ------------>
		<div class="nav-contnt">
			<div class="container">
				<div class="navbar-collapse collapse" id="myNavbar" aria-expanded="true" style="">
					<ul class="nav navbar-nav">
						<li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><a href="<?php echo base_url('products'); ?>">Shop</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);">foods <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0);">Page 1-1</a></li>
								<li><a href="javascript:void(0);">Page 1-2</a></li>
								<li><a href="javascript:void(0);">Page 1-3</a></li>
							</ul>
						</li>
						<li><a href="javascript:void(0);">Household</a></li>
						<li><a href="javascript:void(0);">cigarettes</a></li>
						<li><a href="<?php echo base_url('about-us'); ?>">About us</a></li>
						<li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
					</ul>
			<!---- SEARCH SECTION START --->
					<ul class="nav navbar-nav navbar-right" id="right-div">
						
							<div class="in-box">
								<input name="search_keyword" id="search_keyword" class="customsearch" placeholder="Search products" type="text">
								<button type="submit" id="search-keyword">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</div>
						
					</ul>
			<!---- SEARCH SECTION END --->
				</div>
			</div>
		</div>
</nav>

<!---------  NAVBAR END  ------------>


<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button id="login-close" type="button" class="close" data-dismiss="modal">&times;</button>
				
				<!--heading--->	
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
						<div class="pull-right">
							<a href="javascript:void(0);" class="active" id="login-form-link">Login</a>
						</div>
						</div>
						<div class="col-xs-6">
							<a href="javascript:void(0);" id="register-form-link">Sign up</a>
						</div>
						
					</div>
					<hr>
				</div>
			</div>
		<!---BODY-->	
			<div class="modal-body">
				<div class="row">
					<!---Alert div ---->
						<div style="display:none" class="fail_login" id="loginFailed"></div>
					<div class="col-lg-12">
					<!----Login form start----->
						<form id="loginform"  method="POST" action="<?php echo base_url('frontend/Auth/LoginConfirmation');?>" role="form" style="display: block;">
							<div class="form-group">
								<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Enter Email" value="">
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
							</div>						
							<div class="form-group">
							<div class="col-xs-12 col-sm-6">
								<input type="checkbox" tabindex="3" class="" value="remember-me" name="remember" id="remember">
								<label for="remember" class="checkbox-label"> Remember me</label>
							</div>
							<div class="col-xs-12 col-sm-6">
							<div class="pull-right">
								<a id="forgot_pass" href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
							</div>
							</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3">
										<input type="submit" name="loginsubmit" id="loginsubmit" tabindex="4" class="form-control btn btn-login" value="Log In">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3">
									<?php $fbData =  facebookAccess(); ?>
									
										<a href="<?php echo $fbData['FBAuthUrl']; ?>" name="loginsubmit" id="facebooksubmit" tabindex="5" class="form-control btn btn-facebook" >Login with Facebook</a>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!---- Login form End ----->
						
					<!---- Signup Form Start ----->
					<div class="col-lg-12">						
						<form id="register-form"  action="<?php echo base_url('frontend/Auth/UserSignup'); ?>" method="post" role="form" style="display: none;">
						
							<div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
							
							<div class="suces_signup alert" style="padding: 0; background: transparent;"></div>
							
							<div class="form-group">
								<input type="text" name="userName" id="userName" tabindex="1" class="form-control" placeholder="Username" value="">
							</div>
							<div class="form-group">
								<input type="email" name="email" id="email1" tabindex="1" class="form-control" placeholder="Email Address" value="">
							</div>
							<div class="form-group">
								<input type="password" name="password" id="passwords" tabindex="2" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<input type="password"  name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirm Password">
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3">
										<input type="submit" name="registersubmit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
									</div>
								</div>
							</div>
							
							<div class="form-group">
							<?php if(!empty($redirect_url)) {
								echo '<a id="facebook" href="'.$redirect_url.'">Login With Facebook</a>';
							} ?>	
							</div>
							
						</form>
					</div>
					<!---- Signup Form End  ----->
					
					<!--- Forgot password ------>
					<div class="col-lg-12">
						
						
					
						<form id="forgot-form"  action="<?php echo base_url('frontend/Auth/ForgotPassword'); ?>" method="post" role="form" style="display: none;">
						
						<h4 class="forgot_heading">Forgot Your Password ?</h4>
						<span class="forgot_label"><i>To reset your password, enter the email address you use to sign in to <a href="<?php echo base_url(); ?>">Shopta App</a></i></span>
						
							<div class="form-group">
								<input type="email" name="email" id="forgot_email" tabindex="1" class="form-control" placeholder="Email Address" value="">
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3">
										<input type="submit" name="forgotsubmit" id="forgot-submit" tabindex="4" class="form-control btn btn-register" value="SEND">
									</div>
								</div>
							</div>
							<div class="form-group" id="reset_msg"></div>
							
						</form>
					</div>
					<!--- Forgot password ------>
					
				</div>
			</div><!---BODY--->
		</div>
	</div>
</div>

<input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />

<script>
$( document ).ready(function() {


	$( "#search-keyword" ).click(function() {
		//$(".customsearch").val('keyword');
		var keyword = $('#search_keyword').val();
		$("#search_value").val('keyword');
		if(keyword == '')
		{alert("Please enter search keyword");}
			else
		{ 
		  
		   
			location.href = '<?php echo base_url();?>search/'+keyword;
		}
			
		});
		
		$('#search_keyword').keypress(function(e){
			if(e.which == 13){//Enter key pressed
				$('#search-keyword').click();//Trigger search button click event
		}
		});

	});
</script>