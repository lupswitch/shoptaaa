<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-------we-accpted-section---->
<div class="we-accpted">
	<div class="container">
		
		<ul>    
			<li><span>We Accept</span></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr1.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr2.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr3.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr4.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr5.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr6.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr7.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr8.jpg');?>"></a></li>
			<li><a href="#"><img src="<?php echo base_url('assets/frontend/images/cr9.jpg');?>"></a></li>
		</ul>
	</div>
</div>


<!---MAIN footer start --->
<footer>
	<div class="container cus-footer">
		<div class="col-md-12">
			
			<!--Footer Cloumn-1 start---->
			<?php echo $this->site_data['footercolumnone']; ?>
			<!--Footer Cloumn-1 End---->
			
			<!--Footer Cloumn-2 start---->
			<?php echo $this->site_data['footercolumntwo']; ?>
			<!--Footer Cloumn-2 End---->
			
			
			<!--Footer Cloumn-3 start---->
			<?php echo $this->site_data['footercolumnthree']; ?>
			<!--Footer Cloumn-3 End---->
			
			
			<!--Footer Cloumn-4 start---->
			<div class="col-sm-3 cus-ft lasted">
				<h3>STAY CONNECTED</h3>
				<?php echo $this->site_data['socialwidget']; ?>
			</div>
			<!--Footer Cloumn-4 End---->
			
		</div>
		
		<!---Copy right section End---->
		<div class="col-md-12">
			<?php echo $this->site_data['copyright'];?>	
		</div>
		<!---Copy right section End---->
		
	</div>
</footer>
<!---MAIN footer END --->
<script src="<?php echo base_url('assets/frontend/js/jquery.js');?>"></script>

<script src="<?php echo base_url('assets/frontend/js/jquery/3.1.1/jquery.min.js');?>"></script>


<!---Frontend  Script ----->
<script src="<?php echo base_url('assets/frontend/js/Frontend_custom.js');?>"></script>

<!--Bootstrap bootbox---->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<!---- AllAjax ------>
<script src="<?php echo base_url('/assets/frontend/js/ajax/Allajax.js');?>"></script>


<!---Datepicker---->
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>

<!---Validation js----->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>

<!---boxslider JS ---->
<script src="<?php echo base_url('assets/frontend/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/frontend/js/jquery.bxslider.min.js');?>"></script>



<script>
	
	jQuery(document).on('click', '#login-form-link', function(e) {
		jQuery('#register-form')[0].reset();
		jQuery("#forgot-form")[0].reset();
		jQuery("#loginform").delay(100).fadeIn(100);
		jQuery("#register-form").fadeOut(100);
		jQuery("#forgot-form").fadeOut(100);
		jQuery('#register-form-link').removeClass('active');
		jQuery(this).addClass('active');
		e.preventDefault();
	});
	
	jQuery(document).on('click', '#register-form-link', function(e) {
		jQuery('#loginform')[0].reset();
		jQuery("#forgot-form")[0].reset();
		jQuery("#register-form").delay(100).fadeIn(100);
		jQuery("#loginform").fadeOut(100);
		jQuery("#forgot-form").fadeOut(100);
		jQuery('#login-form-link').removeClass('active');
		jQuery(this).addClass('active');
		e.preventDefault();
	});
	
	
	jQuery(document).on('click', '#forgot_pass', function(e) {
		jQuery('#loginform')[0].reset();
		jQuery('#register-form')[0].reset();
		jQuery("#forgot-form").delay(100).fadeIn(100);
		jQuery("#loginform").fadeOut(100);
		jQuery('#login-form-link').removeClass('active');
		e.preventDefault();
	});
	
	jQuery(document).on('click', '#login-close', function(e) {
		jQuery('#loginform')[0].reset();
		jQuery('#register-form')[0].reset();
		jQuery("#forgot-form")[0].reset();
		e.preventDefault();
	});
	
</script>

<script>
	jQuery('.carousel').carousel({
        interval: 5000 //changes the speed
	})
</script>
<script>
	jQuery(document).ready(function(){
		jQuery('.slider1').bxSlider({
			slideWidth:600,
			minSlides: 5,
			maxSlides: 3,
			slideMargin: 10
		});
	});
	
</script>
<script>
	jQuery(document).ready(function(){
		var devident='';
		var ww = jQuery(window).width();
		if(ww>=1200){devident=5;}
		else if(ww<=1199 && ww>=992){devident=4;}
		else if(ww<=991 && ww>=768){devident=3;}
		else if(ww<=767 && ww>=481){devident=2;}
		else if(ww<=480){devident=1;}
		var width_container = jQuery(".slider_test").width()/devident;
		
		//New Products slider
		jQuery('.slider4').bxSlider({
			auto: true,
			autoHover: true,
			speed: 400,
			touchEnabled : true,
			swipeThreshold : 50,
			slideWidth: width_container,
			minSlides: 1,
			maxSlides:5,
			moveSlides: 1,
			slideMargin: 0
		});
		
		//Featured Products slider
		jQuery('.slider5').bxSlider({
			auto: true,
			autoHover: true,
			speed: 500,
			touchEnabled : true,
			swipeThreshold : 60,
			slideWidth: width_container,
			minSlides: 1,
			maxSlides:5,
			moveSlides: 2,
			slideMargin: 0
		});
	});
</script>

<!--- ion.rangeSlider --->
<script src="<?php // echo base_url('assets/frontend/ionRangeSlider/js/jquery-1.12.3.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/ionRangeSlider/js/ion.rangeSlider.js'); ?>"></script>	

</body>
</html>