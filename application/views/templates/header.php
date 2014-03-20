
<?php
if (!isset($_SESSION['gps_username'])) {
	print_r($_SESSION);
	//echo 'ga dapet';exit;
	// echo 'login';
	// print_r($_SESSION);
	$_SESSION['last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	redirect(site_url() . 'login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Haidar Mar'ie, Rizki Faishal">
<link rel="shortcut icon"
	href="<?php echo base_url()?>assets/ico/favicon.png">

<title>GPS Tracking <?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></title>

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url()?>assets/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/datepicker.css"
	rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/font-awesome.min.css"
	rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.min.js"></script>
</script>
<script src="<?php echo base_url()."assets/js/"?>OpenLayers/lib/OpenLayers.js" type="text/javascript"></script>
<script src="<?php echo base_url()."assets/js/"?>OpenLayers/lib/deprecated.js" type="text/javascript"></script>
<?php if(isset($map_use)) { ?>
<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<?php } ?>	
<script src="<?php echo base_url_new()?>:8000/socket.io/socket.io.js"></script>
<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome-ie7.min.css" />
<![endif]-->

<!-- page specific plugin styles -->

<!-- fonts -->
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/css/ace-fonts.css" />

<!-- ace styles -->
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/css/ace.min.css" />
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/css/ace-rtl.min.css" />
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/css/ace-skins.min.css" />

<!--[if lte IE 8]>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-ie.min.css" />
<![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>
	<script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
	<script src="<?php echo base_url()?>assets/js/respond.min.js"></script>
<![endif]-->
<style type="text/css">
/* .form-control::-moz-placeholder {
	color: #000000;
} */
ul.nav li.dropdown:hover>ul.dropdown-menu {
	display: block;
}
</style>
</head>
<body>

	<div class="navbar navbar-default" id="navbar">
		<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

		<div class="navbar-container" id="navbar-container">
			<div class="navbar-header pull-left">
				<a href="<?php echo site_url()?>" class="navbar-brand"> <small><img
						width="30"
						src="<?php echo base_url()?>assets/images/logo-small.png"> <i
						class="icon-leaf"></i> GPS Tracking Apps </small>
				</a>
				<!-- /.brand -->
			</div>
			<!-- /.navbar-header -->

			<div class="navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<?php if($_SESSION['gps_level'] != 'operator') {?>
					<li class="grey dropdown-hover"><a class="" href="#"> <i
							class="icon-gears"></i> Admin <i class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="<?php echo site_url()?>admin/sys_config/user/operator"><i
									class="icon-user"></i>Create Operator</a></li>
							<?php if($_SESSION['gps_level'] == 'admin') {?>
							<li><a href="<?php echo site_url()?>admin/sys_config/user/admin"><i
									class="icon-user"></i>Create Admin</a></li>
							<li><a
								href="<?php echo site_url()?>admin/sys_config/vendor"><i
									class="icon-briefcase"></i>Vendor</a></li>
							<?php }?>		
							<li><a href="<?php echo site_url()?>admin/sys_config/driver"><i
									class="icon-user"></i>Driver</a></li>
							<li><a href="<?php echo site_url()?>admin/sys_config/icon"><i
									class="icon-picture"></i>Icon</a></li>
							<li><a href="<?php echo site_url()?>admin/sys_config/hardware"><i
									class="icon-wrench"></i>Hardware</a></li>
							<li><a href="<?php echo site_url()?>admin/fleet_config"> <i
									class="icon-cog"></i> Fleet Configuration
							</a></li>
							<li><a href="<?php echo site_url()?>admin/fleet_config/base"><i
									class="icon-home"></i>Base</a></li>
							<li><a href="<?php echo site_url()?>admin/fleet_config/vehicle"><i
									class="icon-truck"></i> Vehicle </a></li>
							<li><a href="<?php echo site_url()?>admin/fleet_config/assign"><i
									class="icon-truck"></i>Vehicle Assign </a></li>
							<li></li>
						</ul></li>
					<?php } ?>	
					<li class="light-green dropdown-hover"><a
						href="<?php echo site_url()?>admin/fleet_config/fleet"> <i class="icon-tasks"></i>
							Fleet State
					</a></li>
					<!-- 					<li class="light-blue2 dropdown-hover"><a href="#"> <i class="icon-download-alt"></i>  -->
					<!-- 					I/O Grid</a></li> -->
					<!-- 					<li class="purple dropdown-hover"><a href="#"> <i class="icon-laptop"></i>  -->
					<!-- 					Job Module</a></li> -->
					<li class="green dropdown-hover"><a data-toggle="dropdown"
						class="dropdown-toggle" href="<?php echo site_url()?>"> <i class="icon-globe"></i> Map <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="<?php echo site_url()?>profile/region_alert"> <i
									class="icon-cog"></i> Create Region
							</a></li>
						</ul></li>
					<!-- 					<li class="blue"><a href="#"> <i class="icon-comments"></i> -->
					<!-- 					Messaging </a></li> -->
					<li class="light-purple dropdown-hover"><a
						href="<?php echo site_url()?>replay"> <i class="icon-play"></i>
							Replay
					</a></li>
					<li class="red dropdown-hover"><a href="#"> <i
							class="icon-bar-chart"></i> Reports <i class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="<?php echo site_url()?>report/vehicle/"> <i
									class="icon-truck"></i> Vehicles Report
							</a></li>
							<li><a href="<?php echo site_url()?>report/employee/"> <i
									class="icon-user"></i> Employee Report
							</a></li>
							<li><a href="<?php echo site_url()?>report/form/activity/"> <i
									class="icon-user"></i> Activity Report
							</a></li>
							<li><a href="<?php echo site_url()?>report/form/alert"> <i class="icon-cog"></i> Alerts Report
							</a></li>
							<li><a href="<?php echo site_url()?>report/form/speed"> <i class="icon-cog"></i> Speed Report
							</a></li>
							<li><a href="<?php echo site_url()?>report/form/stop"> <i class="icon-cog"></i> Stop/Idling Report
							</a></li>
							<li></li>
						</ul></li>

					<li class="light-blue"><a data-toggle="dropdown" href="#"
						class="dropdown-toggle"> <img class="nav-user-photo"
							src="assets/avatars/user.jpg" alt="<?php echo $_SESSION['gps_username']?>'s Photo" /> <span
							class="user-info"> <small>Welcome,</small> <?php echo $_SESSION['gps_username']?>
						</span> <i class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url()?>login/logout"> <i class="icon-off"></i> Logout
							</a></li>
						</ul></li>
				</ul>
				<!-- /.ace-nav -->
			</div>
			<!-- /.navbar-header -->
		</div>
		<!-- /.container -->
	</div>


	<div class="main-container" id="main-container">
		<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#"> <span
				class="menu-text"></span>
			</a>
