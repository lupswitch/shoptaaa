<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Shopta</title>
		
		<!-- Bootstrap -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url('assets/frontend/css/bootstrap.css');?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style1.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/full-slider.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/sign_in.css');?>">
		
		<script src="<?php echo base_url('assets/frontend/js/jquery.js');?>"></script>
		<!----Jquery validate-------->
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
		<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Date Picker -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datepicker/datepicker3.css">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
		
		<!---Bootstrap growl : Notify ----->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
		
		<!---- Ion range slider ------->
		<ink rel="stylesheet" href="<?php echo base_url('assets/frontend/ionRangeSlider/css/normalize.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/ionRangeSlider/css/ion.rangeSlider.css'); ?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/frontend/ionRangeSlider/css/ion.rangeSlider.skinFlat.css'); ?>" />
		
	</head>
	<body>

		<!----top header------>
			<?php /* echo $this->site_data['sitedata']; */ ?>
			<?php echo $this->site_data['HeaderTopSectionData'];?>
		<!---End of top header------->
		
		<!----Header Middle and main menu section ------->
			<?php echo $this->site_data['HeaderMiddle_Main_MenuSectionData'];?>
		<!----- End Here ---->

<?php
/********************************** 
* Description : Open SignUp pop up and display error message if facebook auth failed 
* Developer   : Er.Parwinder Singh
* DOC 		  : 25th-April-2017 	
***********************************/
 if($this->uri->segment(1) == 'facebook-error') { ?>

<script>
$(document).ready(function () {
	
	$('#login_signup').trigger('click');
	
	$('#loginFailed').html('<div class="alert-danger alert-dismissable">Something went worng Facebook Authentication Failed! </div>');
	$('#loginFailed').show().delay(5000).fadeOut();
	
});	
</script>
<?php } ?>

<div id="snackbar">Some text some message..</div>	

<style>
#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}
</style>