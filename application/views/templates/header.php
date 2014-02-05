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

<link rel="stylesheet" href="assets/css/ace-fonts.css" />

<!-- ace styles -->

<link rel="stylesheet" href="assets/css/ace.min.css" />
<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

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
						href="#"> <i class="icon-group"></i> Admin <i
							class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li><a href="#"> <i class="icon-cog"></i> Company Data
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Icon
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> H/W Types
							</a></li>
							<li><a href="#"> <i class="icon-user"></i> Client Security
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
						href="#"> <i class="icon-tasks"></i> Map <i
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
						href="#"> <i class="icon-tasks"></i> Replay <i
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

			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span> <span class="btn btn-info"></span>

						<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
					</div>
				</div>
				<!-- #sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li><a href="index.html"> <i class="icon-dashboard"></i> <span
							class="menu-text"> Dashboard </span>
					</a></li>

					<li><a href="typography.html"> <i class="icon-text-width"></i> <span
							class="menu-text"> Typography </span>
					</a></li>

					<li><a href="#" class="dropdown-toggle"> <i class="icon-desktop"></i>
							<span class="menu-text"> UI Elements </span> <b
							class="arrow icon-angle-down"></b>
					</a>

						<ul class="submenu">
							<li><a href="elements.html"> <i class="icon-double-angle-right"></i>
									Elements
							</a></li>

							<li><a href="buttons.html"> <i class="icon-double-angle-right"></i>
									Buttons &amp; Icons
							</a></li>

							<li><a href="treeview.html"> <i class="icon-double-angle-right"></i>
									Treeview
							</a></li>

							<li><a href="jquery-ui.html"> <i class="icon-double-angle-right"></i>
									jQuery UI
							</a></li>

							<li><a href="nestable-list.html"> <i
									class="icon-double-angle-right"></i> Nestable Lists
							</a></li>

							<li><a href="#" class="dropdown-toggle"> <i
									class="icon-double-angle-right"></i> Three Level Menu <b
									class="arrow icon-angle-down"></b>
							</a>

								<ul class="submenu">
									<li><a href="#"> <i class="icon-leaf"></i> Item #1
									</a></li>

									<li><a href="#" class="dropdown-toggle"> <i class="icon-pencil"></i>

											4th level <b class="arrow icon-angle-down"></b>
									</a>

										<ul class="submenu">
											<li><a href="#"> <i class="icon-plus"></i> Add Product
											</a></li>

											<li><a href="#"> <i class="icon-eye-open"></i> View Products
											</a></li>
										</ul></li>
								</ul></li>
						</ul></li>

					<li><a href="#" class="dropdown-toggle"> <i class="icon-list"></i>
							<span class="menu-text"> Tables </span> <b
							class="arrow icon-angle-down"></b>
					</a>

						<ul class="submenu">
							<li><a href="tables.html"> <i class="icon-double-angle-right"></i>
									Simple &amp; Dynamic
							</a></li>

							<li><a href="jqgrid.html"> <i class="icon-double-angle-right"></i>
									jqGrid plugin
							</a></li>
						</ul></li>

					<li><a href="#" class="dropdown-toggle"> <i class="icon-edit"></i>
							<span class="menu-text"> Forms </span> <b
							class="arrow icon-angle-down"></b>
					</a>

						<ul class="submenu">
							<li><a href="form-elements.html"> <i
									class="icon-double-angle-right"></i> Form Elements
							</a></li>

							<li><a href="form-wizard.html"> <i
									class="icon-double-angle-right"></i> Wizard &amp; Validation
							</a></li>

							<li><a href="wysiwyg.html"> <i class="icon-double-angle-right"></i>
									Wysiwyg &amp; Markdown
							</a></li>

							<li><a href="dropzone.html"> <i class="icon-double-angle-right"></i>
									Dropzone File Upload
							</a></li>
						</ul></li>

					<li><a href="widgets.html"> <i class="icon-list-alt"></i> <span
							class="menu-text"> Widgets </span>
					</a></li>

					<li><a href="calendar.html"> <i class="icon-calendar"></i> <span
							class="menu-text"> Calendar <span
								class="badge badge-transparent tooltip-error"
								title="2&nbsp;Important&nbsp;Events"> <i
									class="icon-warning-sign red bigger-130"></i>
							</span>
						</span>
					</a></li>

					<li><a href="gallery.html"> <i class="icon-picture"></i> <span
							class="menu-text"> Gallery </span>
					</a></li>

					<li><a href="#" class="dropdown-toggle"> <i class="icon-tag"></i> <span
							class="menu-text"> More Pages </span> <b
							class="arrow icon-angle-down"></b>
					</a>

						<ul class="submenu">
							<li><a href="profile.html"> <i class="icon-double-angle-right"></i>
									User Profile
							</a></li>

							<li><a href="inbox.html"> <i class="icon-double-angle-right"></i>
									Inbox
							</a></li>

							<li><a href="pricing.html"> <i class="icon-double-angle-right"></i>
									Pricing Tables
							</a></li>

							<li><a href="invoice.html"> <i class="icon-double-angle-right"></i>
									Invoice
							</a></li>

							<li><a href="timeline.html"> <i class="icon-double-angle-right"></i>
									Timeline
							</a></li>

							<li><a href="login.html"> <i class="icon-double-angle-right"></i>
									Login &amp; Register
							</a></li>
						</ul></li>

					<li class="active open"><a href="#" class="dropdown-toggle"> <i
							class="icon-file-alt"></i> <span class="menu-text"> Other Pages <span
								class="badge badge-primary ">5</span>
						</span> <b class="arrow icon-angle-down"></b>
					</a>

						<ul class="submenu">
							<li><a href="faq.html"> <i class="icon-double-angle-right"></i>
									FAQ
							</a></li>

							<li><a href="error-404.html"> <i class="icon-double-angle-right"></i>
									Error 404
							</a></li>

							<li><a href="error-500.html"> <i class="icon-double-angle-right"></i>
									Error 500
							</a></li>

							<li><a href="grid.html"> <i class="icon-double-angle-right"></i>
									Grid
							</a></li>

							<li class="active"><a href="blank.html"> <i
									class="icon-double-angle-right"></i> Blank Page
							</a></li>
						</ul></li>
				</ul>
				<!-- /.nav-list -->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"
						data-icon1="icon-double-angle-left"
						data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
			</div>
			<div class="main-content">