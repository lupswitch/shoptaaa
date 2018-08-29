<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $pagetitle; ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.css">
		
		
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/skins/_all-skins.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/flat/blue.css">
		<!-- Morris chart -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/morris/morris.css">
		<!-- jvectormap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		
		<!-- Date Picker -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datepicker/datepicker3.css">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker.css">
		
		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/all.css">
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.css">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="http://a1professionals.net/shopta_app/assets/frontend/js/jquery.js"></script>
		
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		
		<?php
			/* get CI instance and load model direct */
			$CI =& get_instance();
			$CI->load->model('admin/AdminUserModel');
			
			$aid = $this->session->userdata['is_admin']['user_id']; 
			
			function AdminProfileData($uid, $CI){
				return  $Profile = $CI->AdminUserModel->getAdminProfile($uid);
			}
			
			
			$AdminId = $this->session->userdata['is_admin']['user_id'];
			
			$AdminData = AdminProfileData($AdminId, $CI); 
			//pr($AdminData); 
			
		?>	
		
		
		
		<div class="wrapper">
			
			<header class="main-header">
				<!-- Logo -->
				<a href="<?php echo base_url(); ?>admin/dashboard" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>A</b>LT</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Admin</b>Panel</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages: style can be found in dropdown.less-->
							<?php /*
								<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="label label-success">4</span>
								</a>
								<ul class="dropdown-menu">
								<li class="header">You have 4 messages</li>
								<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
								<li><!-- start message -->
								<a href="#">
								<div class="pull-left">
								<img src="<?php echo base_url(); ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
								</div>
								<h4>
								Support Team
								<small><i class="fa fa-clock-o"></i> 5 mins</small>
								</h4>
								<p>Why not buy a new awesome theme?</p>
								</a>
								</li>
								<!-- end message -->
								<li>
								<a href="#">
								<div class="pull-left">
								<img src="<?php echo base_url(); ?>assets/admin/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
								</div>
								<h4>
								AdminLTE Design Team
								<small><i class="fa fa-clock-o"></i> 2 hours</small>
								</h4>
								<p>Why not buy a new awesome theme?</p>
								</a>
								</li>
								<li>
								<a href="#">
								<div class="pull-left">
								<img src="<?php echo base_url(); ?>assets/admin/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
								</div>
								<h4>
								Developers
								<small><i class="fa fa-clock-o"></i> Today</small>
								</h4>
								<p>Why not buy a new awesome theme?</p>
								</a>
								</li>
								<li>
								<a href="#">
								<div class="pull-left">
								<img src="<?php echo base_url(); ?>assets/admin/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
								</div>
								<h4>
								Sales Department
								<small><i class="fa fa-clock-o"></i> Yesterday</small>
								</h4>
								<p>Why not buy a new awesome theme?</p>
								</a>
								</li>
								<li>
								<a href="#">
								<div class="pull-left">
								<img src="<?php echo base_url(); ?>assets/admin/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
								</div>
								<h4>
								Reviewers
								<small><i class="fa fa-clock-o"></i> 2 days</small>
								</h4>
								<p>Why not buy a new awesome theme?</p>
								</a>
								</li>
								</ul>
								</li>
								<li class="footer"><a href="#">See All Messages</a></li>
								</ul>
							</li> */ ?>
							<!-- Notifications: style can be found in dropdown.less -->
							
							<?php /*
								
								<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning">10</span>
								</a>
								<ul class="dropdown-menu">
								<li class="header">You have 10 notifications</li>
								<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
								<li>
								<a href="#">
								<i class="fa fa-users text-aqua"></i> 5 new members joined today
								</a>
								</li>
								<li>
								<a href="#">
								<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
								page and may cause design problems
								</a>
								</li>
								<li>
								<a href="#">
								<i class="fa fa-users text-red"></i> 5 new members joined
								</a>
								</li>
								<li>
								<a href="#">
								<i class="fa fa-shopping-cart text-green"></i> 25 sales made
								</a>
								</li>
								<li>
								<a href="#">
								<i class="fa fa-user text-red"></i> You changed your username
								</a>
								</li>
								</ul>
								</li>
								<li class="footer"><a href="#">View all</a></li>
								</ul>
							</li> */  ?>
							<!-- Tasks: style can be found in dropdown.less -->
							<?php /*
								
								<li class="dropdown tasks-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">9</span>
								</a>
								<ul class="dropdown-menu">
								<li class="header">You have 9 tasks</li>
								<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
								<li><!-- Task item -->
								<a href="#">
								<h3>
								Design some buttons
								<small class="pull-right">20%</small>
								</h3>
								<div class="progress xs">
								<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">20% Complete</span>
								</div>
								</div>
								</a>
								</li>
								<!-- end task item -->
								<li><!-- Task item -->
								<a href="#">
								<h3>
								Create a nice theme
								<small class="pull-right">40%</small>
								</h3>
								<div class="progress xs">
								<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">40% Complete</span>
								</div>
								</div>
								</a>
								</li>
								<!-- end task item -->
								<li><!-- Task item -->
								<a href="#">
								<h3>
								Some task I need to do
								<small class="pull-right">60%</small>
								</h3>
								<div class="progress xs">
								<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">60% Complete</span>
								</div>
								</div>
								</a>
								</li>
								<!-- end task item -->
								<li><!-- Task item -->
								<a href="#">
								<h3>
								Make beautiful transitions
								<small class="pull-right">80%</small>
								</h3>
								<div class="progress xs">
								<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">80% Complete</span>
								</div>
								</div>
								</a>
								</li>
								<!-- end task item -->
								</ul>
								</li>
								<li class="footer">
								<a href="#">View all tasks</a>
								</li>
								</ul>
								</li>
								
							*/ ?>
							
							<!-- User Account: style can be found in dropdown.less -->
							
							<li class="dropdown user user-menu">
								<a href="<?php echo base_url(); ?>admin/dashboard" class="dropdown-toggle" data-toggle="dropdown">
									
									<?php (!empty($AdminData->profileImage)) ? $imgPath = $AdminData->profileImage  : $imgPath = base_url("uploads/main/noimage.png");    ?>
									
									
									<img src="<?php echo $imgPath ; ?>" class="user-image" alt="User Image">
									
									<span class="hidden-xs"><?php if(!empty($this->session->userdata['is_admin']['userName'])) { echo $this->session->userdata['is_admin']['userName']; } else { echo "Admin"; } ?></span>
								</a>
								<ul class="dropdown-menu">
									
									<li class="user-header">
										<img src="<?php echo $imgPath ; ?>" class="img-circle" alt="User Image">
										
										<p>
											<?php echo $this->session->userdata['is_admin']['userName']; ?>
											<!--small>Member since Nov. 2012</small-->
										</p>
									</li>
									<!-- Menu Body -->
									<!--li class="user-body">
										<div class="row">
										<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
										</div>
										<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
										</div>
										<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
										</div>
										</div>
									</li-->
									<!-- /.row -->
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<?php $AdminID = $this->session->userdata['is_admin']['user_id'];?>
											<a href="<?php echo base_url('admin/profile/'.$AdminID.''); ?>" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?php echo site_url("admin/logout");?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
							<!-- Control Sidebar Toggle Button -->
							<!--li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							</li-->
						</ul>
					</div>
				</nav>
			</header>
			
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel --> 
					<div class="user-panel">
						<div class="pull-left image">
							<img src="<?php echo $imgPath ; ?>" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p><?php echo $this->session->userdata['is_admin']['userName']; ?></p>
							<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-circle text-success"></i>Online</a>
						</div> 
					</div>
					<!-- search form -->
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
					<!-- /.search form -->
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="header">MAIN NAVIGATION</li>
						
						<li class="<?php echo (isset($slug) && $slug =='dashboard')? 'active' : "";  ?> treeview">
							
							<a href="<?php echo base_url(); ?>admin/dashboard">
								<i class="fa fa-dashboard"></i> <span>Dashboard</span>
							</a>
							
						</li>
						
						<li class="<?php echo (isset($slug) && $slug =='user')? 'active' : "";  ?> treeview">
							<a href="<?php echo site_url('admin/user-listing');?>">
								<i class="fa fa-user"></i> <span>Users</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
					      <li><a href="<?php echo site_url('admin/user-listing');?>"><i class="fa fa-users" aria-hidden="true"></i>All Customers</a></li>

 <li><a href="<?php echo site_url('admin/deliveryboys-listing');?>"><i class="fa fa-users" aria-hidden="true"></i>All Delivery Boys</a></li>
 
 
 <li><a href="<?php echo site_url('admin/staff-listing');?>"><i class="fa fa-users" aria-hidden="true"></i>All Staff</a></li>
 
 
	
					 <li><a href="<?php echo site_url('admin/create-user');?>"><i class="fa fa-user" aria-hidden="true"></i>Create New User</a></li>
								
							</ul>
						</li>
						
						<li class="<?php echo (isset($slug) && $slug =='category')? 'active' : "";  ?> treeview">
							<a href="<?php echo site_url('admin/category-listing');?>">
								<i class="fa fa-sitemap"></i> <span>Categories</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo site_url('admin/category-listing');?>"><i class="fa fa-list" aria-hidden="true"></i> All Categories</a></li>
								<li><a href="<?php echo site_url('admin/create-category');?>"><i class="fa fa-plus" aria-hidden="true"></i> Create New Categories</a></li>
							</ul>
						</li>
						<li class="<?php echo (isset($slug) && $slug =='brands')? 'active' : "";  ?> treeview">
							<a href="<?php echo site_url('admin/brand-listing');?>">
								<i class="fa fa-tags" aria-hidden="true"></i> <span>Brands</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo site_url('admin/brand-listing');?>"><i class="fa fa-list" aria-hidden="true"></i> All Brands</a></li>
								<li><a href="<?php echo site_url('admin/create-brand');?>"><i class="fa fa-plus" aria-hidden="true"></i> Create New Brand</a></li>
							</ul>
						</li>
						
						
						<li class="<?php echo (isset($slug) && $slug =='product')? 'active' : '';  ?> treeview">
							<a href="javascript:void(0);">
								<i class="fa fa-cart-plus" aria-hidden="true"></i>
								<span>&nbsp;Products</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
							<li><a href="<?php echo site_url('admin/product-listing');?>"><i class="fa fa-list" aria-hidden="true"></i></i>All Products</a></li>
							<li><a href="<?php echo site_url('admin/create-product');?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New Product</a></li>
						</ul>
					</li>
					
					
					<!---start Order menu---->
					<li class="<?php echo (isset($slug) && $slug =='order-listing')? 'active' : "";  ?> treeview">
						<a href="javascript:void(0);">
							<i class="fa fa- fa-shopping-basket" aria-hidden="true"></i> <span>Orders</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo site_url('admin/order-listing');?>"><i class="fa fa-list" aria-hidden="true"></i> All Orders</a></li>
							<li><a href="<?php echo site_url('admin/request-cancel');?>"><i class="fa fa-times" aria-hidden="true"></i> Cancel Orders</a></li>
						</ul>
					</li>
					<!---End Order menu---->
					
					<!---Setting Menu--->
					<li class="<?php echo (isset($slug) && $slug =='setting')? 'active' : '';  ?> treeview">
						<a href="javascript:void(0);">
							<i class="fa fa-cog fa-spin fa-1x fa-fw" style="color: red; aria-hidden="true"></i>
							<span>&nbsp;Setting</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
						<li><a href="<?php echo site_url('admin/revslider');?>"><i class="fa fa-sliders" aria-hidden="true"></i>Revslider</a></li>
						<li><a href="<?php echo site_url('admin/app-slider');?>"><i class="fa fa-android" aria-hidden="true"></i>App Slider</a></li>
					<li><a href="<?php echo site_url('admin/social-connect');?>"><i class="fa fa-facebook" aria-hidden="true"></i>Social Connect</a></li>
				<li><a href="<?php echo site_url('admin/site-option');?>"><i class="fa fa-cog" aria-hidden="true"></i>Site Option</a></li>
			<li><a href="<?php echo site_url('admin/grid-option');?>"><i class="fa fa-table" aria-hidden="true"></i>Grid Option</a></li>
		<li><a href="<?php echo site_url('admin/contact-info');?>"><i class="fa fa-info" aria-hidden="true"></i>Conntact Info</a></li>
		<li><a href="<?php echo site_url('admin/outofstock-option'); ?>"><i class="fa fa-ban fa-3" style="color: red" aria-hidden="true"></i>
Out Of Stock
</a></li>
	</ul>
</li>
 
<!---Pages Menu--->
<li class="<?php echo (isset($slug) && $slug =='pages')? 'active' : '';  ?> treeview">
	<a href="javascript:void(0);">
		<i class="fa fa-book" aria-hidden="true"></i>
		<span>&nbsp;Pages</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
		</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="<?php echo site_url('admin/pages');?>"><i class="fa fa-list" aria-hidden="true"></i></i>All Pages</a></li>
<li><a href="<?php echo site_url('admin/create-page');?>"><i class="fa fa-plus" aria-hidden="true"></i></i>Create New Page</a></li>
</ul>
</li>

<!---- Delivery order ---> 
<li>
	<a href="<?php echo base_url('admin/delivery'); ?>">
		<i class="fa fa-truck"></i> <span>Delivery</span>
	</a>
</li>


<!--li class="treeview">
	<a href="#">
	<i class="fa fa-files-o"></i>
	<span>Layout Options</span>
	<span class="pull-right-container">
	<span class="label label-primary pull-right">4</span>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
	<li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
	<li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
	<li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
	</ul>
</li---->
<!--li>
	<a href="pages/widgets.html">
	<i class="fa fa-th"></i> <span>Widgets</span>
	<span class="pull-right-container">
	<small class="label pull-right bg-green">new</small>
	</span>
	</a>
</li-->
<!--li class="treeview">
	<a href="#">
	<i class="fa fa-pie-chart"></i>
	<span>Charts</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
	<li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
	<li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
	<li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
	</ul>
</li--->
<!--li class="treeview">
	<a href="#">
	<i class="fa fa-laptop"></i>
	<span>UI Elements</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
	<li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
	<li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
	<li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
	<li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
	<li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
	</ul>
</li--->
<!--li class="treeview">
	<a href="#">
	<i class="fa fa-edit"></i> <span>Forms</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
	<li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
	<li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
	</ul>
</li-->
<!--li class="treeview">
	<a href="#">
	<i class="fa fa-table"></i> <span>Tables</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
	<li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
	</ul>
</li-->
<!--li>
	<a href="pages/calendar.html">
	<i class="fa fa-calendar"></i> <span>Calendar</span>
	<span class="pull-right-container">
	<small class="label pull-right bg-red">3</small>
	<small class="label pull-right bg-blue">17</small>
	</span>
	</a>
</li-->
<!--li>
	<a href="pages/mailbox/mailbox.html">
	<i class="fa fa-envelope"></i> <span>Mailbox</span>
	<span class="pull-right-container">
	<small class="label pull-right bg-yellow">12</small>
	<small class="label pull-right bg-green">16</small>
	<small class="label pull-right bg-red">5</small>
	</span>
	</a>
</li-->
<!--li class="treeview">
	<a href="#">
	<i class="fa fa-folder"></i> <span>Examples</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
	<li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
	<li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
	<li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
	<li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
	<li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
	<li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
	<li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
	<li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
	</ul>
</li-->
<!----li class="treeview">
	<a href="#">
	<i class="fa fa-share"></i> <span>Multilevel</span>
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
	<li>
	<a href="#"><i class="fa fa-circle-o"></i> Level One
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
	<li>
	<a href="#"><i class="fa fa-circle-o"></i> Level Two
	<span class="pull-right-container">
	<i class="fa fa-angle-left pull-right"></i>
	</span>
	</a>
	<ul class="treeview-menu">
	<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
	<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
	</ul>
	</li>
	</ul>
	</li>
	<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
	</ul>
</li--->
<!--li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
	<li class="header">LABELS</li>
	<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
	<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li--->
</ul>
</section>
<!-- /.sidebar -->
</aside>


<input type="hidden" name="baseurl" Id="getBaseURL" value="<?php echo base_url(); ?>" />
