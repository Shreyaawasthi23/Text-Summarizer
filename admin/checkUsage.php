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
		        <li class="nav-item">
		            <a href="./adminDashboard.php" class="nav-link ">
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
		        <li class="nav-item menu-open">
		            <a href="checkUsuage.php" class="nav-link active">
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
		<section class="content">
	            <div class="container-fluid">
	              <div class="row">
	                <!-- left column -->
	                <div class="col-md-12">
	                	<div class="row">
		                	<div class="col-md-3">
		                	</div>
		                	<div class="col-md-6">
		                		<div class="card">
									<div class="card-body">
										<div class="chartjs-size-monitor">
											<div class="chartjs-size-monitor-expand">
												<div class=""></div>
											</div>
											<div class="chartjs-size-monitor-shrink">
												<div class=""></div>
											</div>
										</div>
										<canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 487px;" width="487" height="250" class="chartjs-render-monitor"></canvas>
									</div>
									<!-- /.card-body -->
								</div>
		                	</div>
		                	<div class="col-md-3">
		                	</div>
	                	</div>
	                	<div class="card card-primary">
	                		<div class="card-header" style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
	                			<div class="card-title">
	                				<h4>Usage</h4>
	                			</div>
	                		</div>
	                		<div class="card-body">
	                			<table class="table">
	                				<thead>
	                					<th>S.No.</th>
	                					<th>Date</th>
	                					<th>Function Used</th>
	                					<th>Summary</th>
	                					<th>Action</th>
	                				</thead>
	                				<tbody>
	                					<?php
						                $sql = "SELECT * FROM `usage_record`";
						                $stmt = $conn->prepare($sql);
						                
						                if($stmt->execute()==TRUE){
							                $res = $stmt->get_result();
							                $c=0;
							                while($r = $res->fetch_array()){
							                	// print_r($r);
							            ?>
							            <tr>
							            	<td><?php echo ++$c; ?></td>
							            	<td><?php echo $r['record_date']; ?></td>
							            	<td><?php echo $r['func_used']; ?></td>
							            	<td><?php echo substr(html_entity_decode($r['usage_info']),0,60)."..."; ?></td>
							            	<td>
								                <button class="btn btn-primary" data-target="#View" data-toggle="modal" style="background: none; border: none;" onclick="content('<?php echo $r['record_id']; ?>')"><i class="fa-eye fas nav-icon text-purple"></i></button>
							            	</td>
							            </tr>
							            <?php    	
						                ?>
						                <?php
							                  }
							            }
						                ?>
	                				</tbody>
	                			</table>
	                		</div>
	                		<div class="card-footer"></div>
	                	</div>
	                </div>
	              </div>
	            </div>
	        </section>
		</div>
	</section>
	</section>
	<footer class="main-footer">
	    <div class="float-right d-none d-sm-block">
	      	<b>Version</b> 3.2.0
	    </div>
	    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  	</footer>
</div>


<div id="View" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      	<div class="modal-header">
        	<h4 class="modal-title">View</h4>
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
      	</div>
      	<div class="modal-body">
	      	<p id="mtext"></p>
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	</div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function content(id) {
		// console.log(id);
		// document.getElementById('mtext').innerHTML = text;
		$.ajax({
	      	type: "POST",
	      	url: "../test.php",
	      	data: {record: id},
	      	datatype: 'JSON',
	      	success: function(response){
		        // console.log(response);
		        var text = response;
		        // console.log(arr);
		        document.getElementById('mtext').innerHTML = text;
	      	}
    	});
	}
</script>
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>

<!-- Chart JS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>

<script>

  $(function () {
  	$.ajax({
      	type: "POST",
      	url: "../test.php",
      	data: {usage:''},
      	datatype: 'JSON',
      	success: function(response){
	        // console.log(response);
	        var arr = JSON.parse(response);
	        // console.log(arr);
	
		    var a = [];
		    for (var i in arr) {
		    	a.push(arr[i]);
		    }
		    // console.log(a);

		    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
		    var donutData        = {
		      labels: [
		          'Text Summary',
		          'Summarize URL',
		      ],
		      datasets: [
		        {
		          data: a,
		          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
		        }
		      ]
		    }
		    var donutOptions     = {
		      maintainAspectRatio : false,
		      responsive : true,
		    }
		    //Create pie or douhnut chart
		    // You can switch between pie and douhnut using the method below.
		    new Chart(donutChartCanvas, {
		      type: 'doughnut',
		      data: donutData,
		      options: donutOptions
		    })
      	}
	});
  })
</script>
</body>
</html>