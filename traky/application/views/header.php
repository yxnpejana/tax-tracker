<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JZE Traker | <?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo DIR_TRAKY; ?>JZE-mini.png" />
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo DIR_TRAKY_RES; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo DIR_TRAKY_RES; ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo DIR_TRAKY_RES; ?>dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo DIR_TRAKY_RES; ?>plugins/iCheck/all.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo DIR_TRAKY_RES; ?>plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo DIR_TRAKY_RES; ?>plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo DIR_TRAKY_RES; ?>plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.css" rel="stylesheet"/>
    <link href="<?php echo DIR_TRAKY_RES; ?>plugins/iCheck/flat/green.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo DIR_TRAKY_RES; ?>plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="sidebar-mini fixed skin-black">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../welcome" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>JZE</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>JZE</b>Traker</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                  <!-- inner menu: contains the actual data -->                
                <ul class="dropdown-menu">
                    <li class="header">You have 10 notifications</li>
                    <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
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
              </li>              
              <!-- User Account: style can be found in dropdown.less -->
              <!--<li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php // echo DIR_TRAKY; ?>users/<?php // echo $this->session->userdata('user_id'); ?>.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php // echo $this->session->userdata('name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <!--<li class="user-header">
                    <img src="<?php // echo DIR_TRAKY; ?>users/<?php // echo $this->session->userdata('user_id'); ?>.png" class="img-circle" alt="User Image">
                    <p>
                      <?php // echo $this->session->userdata('name'); ?> - <?php // echo $this->session->userdata('position'); ?>
                      <small>Member since <?php // echo date("F j, Y", strtotime($this->session->userdata('started'))); ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <!--<li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?php // echo DIR_TRAKY; ?>welcome/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>-->
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!--<div class="user-panel">
            <div class="pull-left image">
              <img src="<?php // echo DIR_TRAKY; ?>users/<?php // echo $this->session->userdata('user_id'); ?>.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php // echo $this->session->userdata('name'); ?></p>
             <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            <!--</div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
		  <!-- /.search form -->