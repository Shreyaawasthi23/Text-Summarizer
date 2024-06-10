<?php
include("../config.php");

session_start();
$Err=$notify="";
if(!isset($_SESSION["user_id"])){
  session_destroy();
   header("location: ../login.php");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['web'])) {
		if(empty($_POST['url'])){
			$Err = "Enter URL...";
		}
		else{
			$url = test_input($_POST['url']);
			$f = "f02";

			$gen_url = 'http://127.0.0.1:8080/analyse?url='.$url;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $gen_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			// echo $response;
			$text = trim(strip_tags($response)); // Output: Hello, John!

			$_SESSION['url'] = $text;
			$_SESSION['f'] = $f;
			// $notify = $text;


			header("location: ./textSummary.php");
		}
	}
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
	<nav class="main-header navbar navbar-expand navbar-white navbar-light"style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
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
	      <span class="brand-text font-weight-light">USER</span>
	    </a>

	    <!-- Sidebar -->
	    <div class="sidebar"style="background:  linear-gradient(to right, #fc5c7d, #6a82fb); padding: 15px">
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
		        <li class="nav-item">
		            <a href="./userDashboard.php" class="nav-link">
		              <i class="nav-icon fas fa-tachometer-alt"></i>
		              <p>
		                Dashboard
		              </p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <a href="./textSummary.php" class="nav-link">
		              <i class="nav-icon fas fa-book-reader"></i>
		              <p>
		                Text Summary
		                <!-- <i class="fas fa-angle-left right"></i> -->
		              </p>
		            </a>
		        </li> 
		        <li class="nav-item">
		            <a href="view_history.php" class="nav-link">
		              <i class="nav-icon fas fa-user-clock"></i>
		              <p>
		                View History
		                <!-- <i class="fas fa-angle-left right"></i> -->
		              </p>
		            </a>
		        </li>  
		        <li class="nav-item menu-open">
		            <a href="summarize_webpage.php" class="nav-link active">
		              <i class="nav-icon fas fa-scroll"></i>
		              <p>
		                Summarize WebPage
		                <!-- <i class="fas fa-angle-left right"></i> -->
		              </p>
		            </a>
		        </li> 
		        <li class="nav-item">
		            <a href="" class="nav-link">
		              <i class="nav-icon fas fa-door-open"></i>
		              <!-- <span> -->
		                <form method = "POST" action="" style="width: fit-content; display: inline;"><button type="submit" name="logout" style="border: none; background: none; color: inherit;"><p>Logout</p></button></form>
		              <!-- </span> -->
		            </a>
		        </li>
	        </ul>
	      </nav>
	      <!-- /.sidebar-menu -->
	    </div>
	    <!-- /.sidebar -->
  	</aside>
	<section class="content-wrapper">
		<div class="container-fluid">
			<div class="row mb-2 col-md-12" style="margin-top: 20px;">
	  			<div class="col-sm-6">
	    			<!-- <h1>Welcome</h1> -->
	    			<?php 
	    			// echo $_SESSION["admin_username"]; 
	    			// var_dump($_SESSION); 
	    			?>
	  			</div>
	  			<div class="col-sm-6 text-right">
	    			<!-- <form method = "POST" action=""><button type="submit" name="logout" class="btn btn-primary">Logout</button></form> -->
	  			</div>
			</div>
			<section class="content">
	            <div class="container-fluid">
	              <div class="row">
	                <!-- left column -->
	                <div class="col-md-12">
	                	<div class="card card-primary">
	                		<div class="card-header"style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
	                			<div class="card-title">
	                				<h4>Summarize Web Page</h4>
	                			</div>
	                		</div>
	                		<form method="POST" action="">
		                		<div class="card-body">
			                        <p class="text-red"><b><?php echo $Err; ?></b></p>
			                        <p class="text-green"><b><?php echo $notify; ?></b></p>
		                			<div class="form-group">
		                				<label>Enter WebPage's URL: </label>
		                			</div>
		                			<div class="input-group mb-3">
					                  	<div class="input-group-prepend">
					                    	<span class="input-group-text">@</span>
					                  	</div>
					                  	<input type="text" name="url" class="form-control" placeholder="Enter URL">
					                </div>
		                		</div>
		                		<div class="card-footer"style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
		                			<button type="submit" name="web" class="btn btn-primary">Summarize</button>
		                		</div>	
	                		</form>
	                		
	                	</div>
	                </div>
	              </div>
	            </div>
	        </section>
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