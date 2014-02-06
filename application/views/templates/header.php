<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Haidar Mar'ie">
<link rel="shortcut icon"
	href="<?php echo site_url()?>assets/ico/favicon.png">

<title>GPS Tracker <?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></title>
<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo site_url() ?>assets/js/jquery-2.1.0.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo site_url() ?>assets/js/jquery-2.1.0.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->


		<!-- inline scripts related to this page -->
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo site_url() ?>assets/js/jquery-2.1.0.min.js"></script>
    <!-- Map -->
    <! -- Maps Google -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="http://localhost:8000/socket.io/socket.io.js"></script>
    <script src="<?php echo site_url() ?>assets/js/map.js"></script>	
    <script src="<?php echo site_url() ?>assets/js/bootstrap.min.js"></script>

	<script src="<?php echo site_url() ?>assets/js/typeahead-bs2.min.js"></script>
	<!-- ace scripts -->
	<script src="<?php echo site_url() ?>assets/js/ace-elements.min..js"></script>
    <script src="<?php echo site_url() ?>assets/js/ace.min.js"></script>
<!-- Bootstrap core CSS -->
<link href="<?php echo site_url()?>assets/css/bootstrap.min.css"
	rel="stylesheet">
<link href="<?php echo site_url()?>assets/css/font-awesome.min.css"
	rel="stylesheet">

<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->


<!-- page specific plugin styles -->

<!-- fonts -->

<link rel="stylesheet" href="<?php echo site_url()?>assets/css/ace-fonts.css" />

<!-- ace styles -->

<link rel="stylesheet" href="<?php echo site_url()?>assets/css/ace.min.css" />
<link rel="stylesheet" href="<?php echo site_url()?>assets/css/ace-rtl.min.css" />
<link rel="stylesheet" href="<?php echo site_url()?>assets/css/ace-skins.min.css" />

<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

<!-- inline styles related to this page -->

<!-- ace settings handler -->

<script src="assets/js/ace-extra.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
<style type="text/css">
.form-control::-moz-placeholder {
    color: #000000;
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
				<a href="#" class="navbar-brand"> <small> <i class="icon-leaf"></i>
						GPS Tracker Apps
				</small>
				</a>
				<!-- /.brand -->
			</div>
			<!-- /.navbar-header -->

			<div class="navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="grey"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-gears"></i> Admin <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="<?php echo site_url()?>admin/sys_config"> <i class="icon-cog"></i> System Configuration
							</a></li>
							<li><a href="<?php echo site_url()?>admin/fleet_config"> <i class="icon-user"></i> Fleet Configuration
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Items
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="light-green"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-tasks"></i> Fleet State <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="light-blue2"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-download-alt"></i> I/O Grid <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="purple"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-laptop"></i> Job Module<i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Contact
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> New Contact
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="green"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-road"></i> Map <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="blue"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-comments"></i> Messaging <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="light-purple"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-play"></i> Replay <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="red"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-bar-chart"></i> Reports <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
					<li class="grey"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-tasks"></i> Status Grid <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Settings
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Profile
							</a></li>
							<li></li>
						</ul>
					</li>
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

			
