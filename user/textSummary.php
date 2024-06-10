<?php
include("../config.php");

session_start();
$Err=$notify=$text1="";
if(!isset($_SESSION["user_id"])){
  session_destroy();
   header("location: ../login.php");
}

include("../logout.php");
date_default_timezone_set('Asia/Kolkata');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// print(var_dump($_SESSION));
if($_SERVER["REQUEST_METHOD"]=="POST"){
  	if (isset($_POST['summarize'])){
	    if(empty($_POST['summtext'])){
	        $Err = "Text is required";
	    }
	    else{
	      	$text = test_input($_POST['summtext']);
	      	// $notify = $text;
	      	$text = strip_tags($text);
	      	$id = uniqid();
	        $a = array();
	        $date = date("Y-m-d");
	        // print(var_dump($_SESSION));
	        if(isset($_SESSION['f']) && $_SESSION['f']=="f02"){
	        	$f = "f02";
	        }
	        else{
	        	$f="f01";
	        }
	        $text1 = $text;
	      	$sql = "INSERT INTO `usage_record`(`record_id`, `user_id`, `record_date`, `func_used`, `usage_info`) VALUES (?,?,?,?,?)";

	        $stmt = $conn->prepare($sql);
	        $stmt->bind_param("sssss",$id,$_SESSION["user_id"],$date,$f,$text);
			
			if($stmt->execute()!= TRUE){
	          $Err = "Error in summarizing text. Try Again..";
	        }
	        else{
	        	unset($_SESSION['f']);
	        	unset($_SESSION['url']);
	          	$notify = "Text Summarized.";
	          	// echo $f;
	        }
	  	}    
  	}
  	else if (isset($_POST['feedback'])) {
	  	if(empty($_POST['rating'])){
	  		$Err = "Select rating(s) to give feedback.";
	  	}
	  	else{
	  		$rating = test_input($_POST['rating']);
	  		$msg = test_input($_POST['msg']);
	  		$date = date("Y-m-d");
	  		$time = date("h:i:s a");
	  		$id = uniqid();
	  		$sql = "INSERT INTO `feedback`(`feedback_id`, `user_id`, `message`, `date`, `time`, `rating`) VALUES (?,?,?,?,?,?)";

	        $stmt = $conn->prepare($sql);
	        $stmt->bind_param("ssssss",$id,$_SESSION["user_id"],$msg,$date,$time,$rating);
			
			if($stmt->execute()!= TRUE){
	          $Err = "Error in accepting feedback. Try Again..";
	        }
	        else{

	          	$notify = "Feedback Stored!!.";
	        }
	  	}
  	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>

	<link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="../assets/css/adminlte.min.css">

	<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
	<script src="../assets/js/code.js"></script>
</head>
<body class="sidebar-mini layout-fixed"style="background:  linear-gradient(to right, #fc5c7d, #6a82fb); padding: 15px">
<div class="wrapper">
	<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
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
		        <li class="nav-item menu-open">
		            <a href="./textSummary.php" class="nav-link active">
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
		        <li class="nav-item">
		            <a href="summarize_webpage.php" class="nav-link">
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
	                <div class="col-md-6" style="display: flex;">
	                  <!-- general form elements -->
	                  	<div class="card card-primary" style="width: 100%;">
		                    <div class="card-header" style="background:  linear-gradient(to right, #fc5c7d, #6a82fb); padding: 15px;">Summarize Text</h3>
		                    </div>
		                    <!-- /.card-header -->
		                    <!-- form start -->
		                    <!-- <form method="POST" action="" id="summary"> -->
		                      	<div class="card-body" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
			                        <p class="text-red"><b><?php echo $Err; ?></b></p>
			                        <p class="text-green"><b><?php echo $notify; ?></b></p>
			                        <div class="form-group">
			                          <label>Text: </label>
			                          <textarea class="form-control" name="text" id="text" placeholder="Enter Text..." rows="15" cols="15"><?php if(isset($_SESSION['url'])){echo $_SESSION['url'];} ?></textarea>
			                          <!-- <script>
			                              CKEDITOR.replace('text');
			                          </script> -->
			                          <label>Minimum Length: </label>
			                          <input type="number" name="minl" id="minl" min="1" class="form-control">
			                          <label>Maximum Length: </label>
			                          <input type="number" name="maxl" id="maxl" min="1" max="5000" class="form-control">
			                        </div>
			                        
			                    </div>
			                      <!-- /.card-body -->

			                    <div class="card-footer"style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
			                        <button  name="summarize" class="btn btn-primary" onclick="generate();">Summarize Text</button>
			                        <button class="btn btn-primary" onclick="cl();">Clear Text</button>
			                    </div>
		                    <!-- </form> -->
		                </div>
	                </div>
	              
	                <div class="col-md-6" style="display: flex;">
	                  <!-- general form elements -->
	                  	<div class="card card-primary" style="width: 100%;">
		                    <div class="card-header" style="background:  linear-gradient(to right, #fc5c7d, #6a82fb); padding: 15px;">
		                      <h3 class="card-title">Summarized Text</h3>
		                    </div>
		                    <!-- /.card-header -->
		                    <!-- form start -->
		                    
		                      	<div class="card-body" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
			                        <!-- <p class="text-red"><b><?php echo $Err; ?></b></p>
			                        <p class="text-green"><b><?php echo $notify; ?></b></p> -->
			                        <br><br>
			                        <div class="form-group">
			                          <!-- <label>Text: </label> -->
			                          <textarea class="form-control" name="text1" id="text1" placeholder="Summarized Text..." rows="15" readonly><?php echo $text1;?></textarea>
			                          <!-- <script> -->
			                              <!-- // CKEDITOR.replace('details'); -->
			                          <!-- </script> -->
			                        </div>
			                        
			                    </div>
			                      <!-- /.card-body -->

			                    <div class="card-footer"style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
			                        <button class="btn btn-primary" data-target="#Feedback" data-toggle="modal">Feedback</button>
			                        <button class="btn btn-outline-secondary" onclick="copy();"><i class="fas fa-copy"></i> Copy Text </button>
			                        <button class="btn btn-outline-success" onclick="printSummary();"><i class="fas fa-download"></i> Download </button>
			                        <form method="POST" action="" style="display: contents;">
			                        	<textarea id="summtext" name="summtext" hidden></textarea>
			                        	<button type="submit" name="summarize" class="btn btn-outline-dark"> Save </button>
			                        </form>
			                    </div>
		                    
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

<div id="Feedback" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      	<div class="modal-header">
        	<h4 class="modal-title">Give Feedback</h4>
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
      	</div>
      	<form method="POST" action="">
	      	<div class="modal-body">
	      		<h4><center><b>Hope You Liked It!!</b></center></h4>
	      		<div class="form-group">
	      			<h5><label>Rating: </label>
	      			<a href="#"><i class="fas fa-sad-cry" id="1" onclick="rate(this.id)"></i></a>
	      			<a href="#"><i class="fas fa-frown" id="2" onclick="rate(this.id)"></i></a>
	      			<a href="#"><i class="fas fa-meh" id="3" onclick="rate(this.id)"></i></a>
	      			<a href="#"><i class="fas fa-smile" id="4" onclick="rate(this.id)"></i></a>
	      			<a href="#"><i class="fas fa-smile-wink" id="5" onclick="rate(this.id)"></i></a>
	      			<input type="number" id="rating" name="rating" readonly hidden></h5>
	      		</div>
	      		<div class="form-group">
	      			<label>Message:</label>
	      			<textarea class="form-control" name="msg" placeholder="(Optional)"></textarea>
	      		</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit" class="btn btn-primary" name="feedback">Submit</button>
	      	</div>
      	</form>
    </div>
  </div>
</div>

<script type="text/javascript">
	function rate(id){
		// console.log(id);
		document.getElementById(id).classList.add("text-purple");
		for(var i=1;i<=5;i++){
			if(i<=id){
				document.getElementById(i).classList.add("text-purple");
			}
			else{
				document.getElementById(i).classList.remove("text-purple");
			}
		}
		document.getElementById('rating').value = id;
	}
	function printSummary(){
		// console.log(document.getElementById('text1').innerHTML);
		var content = document.getElementById('text1').innerHTML;
		var a = window.open('','name=Summary','height=600,width=600,left=300');
		a.document.write('<html><body><h5>');
		a.document.write(content);
		a.document.write('</h5></body></html>');
		a.document.close();
		a.print();
	}
	function copy() {
		if (document.selection) {
			var range = document.body.createTextRange();
			range.moveToElementText(document.getElementById('text1'));
			range.select().createTextRange();
			document.execCommand('copy');
		}
		else if (window.getSelection) {
			var range = document.createRange();
			range.selectNode(document.getElementById('text1'));
			window.getSelection().addRange(range);
			document.execCommand('copy');
			alert("Text Copied!!");
		}
	}

	function generate(){
		var text = document.getElementById('text').value.trim();
		var minl = parseInt(document.getElementById('minl').value);
		var maxl = parseInt(document.getElementById('maxl').value);
		// console.log(text);
		// console.log(minl);
		// console.log(maxl);
		 query({"inputs": text,"parameters": {"min_length": minl, "max_length":maxl}}).then((response) => {
			// console.log(response);
			document.getElementById('text1').innerHTML = response[0]['summary_text'];
			document.getElementById('summtext').innerHTML = response[0]['summary_text'];
			
		});
	}

	function cl(){
		document.getElementById('text1').value = "";
		document.getElementById('minl').value = "";
		document.getElementById('maxl').value = "";
		document.getElementById('text').value = "";
	}
</script>

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
</body>
</html>