<?php
include("../config.php");

session_start();
$Err="";
if(!isset($_SESSION["user_id"])){
  session_destroy();
   header("location: ../login.php");
}

include("../logout.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>

	<link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="../assets/css/adminlte.min.css">
</head>
<body class="sidebar-mini layout-fixed">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	    <!-- Left navbar links -->
	    <ul class="navbar-nav">
		    <li class="nav-item">
		        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		    </li>
	    </ul>
	</nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    	<!-- Brand Logo -->
	    <a href="#" class="brand-link">
	      <img src="../assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
	      <span class="brand-text font-weight-light">ADMIN</span>
	    </a>

	    <!-- Sidebar -->
	    <div class="sidebar">
	      <!-- Sidebar user (optional) -->
	      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	          <img src="../assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
	        </div>
	        <div class="info">
	          <a href="#" class="d-block"><?php echo ucwords($_SESSION['username']); ?></a>
	        </div>
	      </div>

	      <!-- SidebarSearch Form -->
	      <div class="form-inline">
	        <div class="input-group" data-widget="sidebar-search">
	          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
	          <div class="input-group-append">
	            <button class="btn btn-sidebar">
	              <i class="fas fa-search fa-fw"></i>
	            </button>
	          </div>
	        </div>
	      </div>

	      <!-- Sidebar Menu -->
	      <nav class="mt-2">
	        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          <!-- Add icons to the links using the .nav-icon class
	               with font-awesome or any other icon font library -->
		        <li class="nav-item menu-open">
		            <a href="./adminDashboard.php" class="nav-link active">
		              <i class="nav-icon fas fa-tachometer-alt"></i>
		              <p>
		                Dashboard
		              </p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="viewFeedback.php" class="nav-link">
		              <i class="nav-icon fas fa-vote-yea"></i>
		              <p>
		                View Feedback
		                <!-- <i class="fas fa-angle-left right"></i> -->
		              </p>
		            </a>
		        </li> 
		        <li class="nav-item">
		            <a href="maintainFunc.php" class="nav-link">
		              <i class="nav-icon fas fa-tools"></i>
		              <p>
		                Maintain Functions
		                <!-- <i class="fas fa-angle-left right"></i> -->
		              </p>
		            </a>
		        </li> 
		        <li class="nav-item">
		            <a href="checkUsage.php" class="nav-link">
		              <i class="nav-icon fas fa-chart-bar"></i>
		              <p>
		                Check Usage
		                <!-- <i class="fas fa-angle-left right"></i> -->
		              </p>
		            </a>
		        </li> 
	        </ul>
	      </nav>
	      <!-- /.sidebar-menu -->
	    </div>
	    <!-- /.sidebar -->
  	</aside>
	<section class="content-wrapper" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%);">
		<div class="container-fluid">
			<div class="row mb-2 col-md-12" style="margin-top: 20px;">
	  			<div class="col-sm-6">
	    			<h1>Welcome</h1>
	    			<?php 
	    			// echo $_SESSION["admin_username"]; 
	    			// var_dump($_SESSION); 
	    			?>
	  			</div>
	  			<div class="col-sm-6 text-right">
	    			<form method = "POST" action=""><button type="submit" name="logout" class="btn btn-primary">Logout</button></form>
	  			</div>
			</div>
		</div>
	</section>
	<footer class="main-footer">
	    <div class="float-right d-none d-sm-block">
	      	<b>Version</b> 3.2.0
	    </div>
	    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  	</footer>
</div>

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
</body>
</html>