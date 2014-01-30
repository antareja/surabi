<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from getbootstrap.com/examples/navbar/ by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 02 Oct 2013 12:14:32 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Haidar Mar'ie">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo site_url()?>assets/css/bootstrap.css" rel="stylesheet">
    
    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo site_url()?>assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo site_url()?>assets/css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo site_url()?>assets/css/sb-admin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="<?php echo site_url()?>assets/navbar.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">GPS Tracker</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.html">Default</a></li>
            <li><a href="../navbar-static-top/index.html">Static top</a></li>
            <li><a href="../navbar-fixed-top/index.html">Fixed top</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>