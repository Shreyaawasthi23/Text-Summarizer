<?php
include("./config.php");

$Err=$notify="";

date_default_timezone_set('Asia/Kolkata');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['login'])){

		if (empty($_POST["email"])) {
	   		$Err = "Email-Id is required";
	  	} 
	  	else {
	    	$email = test_input($_POST["email"]);
	    	if (!preg_match("/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook|aol|icloud|banasthali|du)\.(com|org|net|info|biz|io|me|co|edu|gov|mil|co\.uk|ac\.in|\.in|\.org)$/",$email)) {
	    	  $Err = "Only letters(a-z,A-Z),digits(0-9),underscore(_),full stop(.), and hypen(-) allowed in first name in Email provided or Invalid domain name may be there..";
	    	}
	    	else if(empty($_POST['password'])){
	    		$Err = "Password is required";
	    	}
	    	else{
	    		$password = test_input($_POST['password']);
	    		if(!preg_match("/^[a-zA-Z@0-9']{8}$/", $password)){
	    			$Err = "Only letters, digits or @ are allowed and should be of length 8";
    			}
	    		else{
	    			$password = md5($password);
		            $sql = "SELECT user_id,username,role FROM user_details WHERE user_email = ? AND password = ?";
		            $stmt = $conn->prepare($sql);
		            $stmt->bind_param("ss",$email,$password);
		            if($stmt->execute()== TRUE){
		              $res = $stmt->get_result();
		              // print_r($res);
		              if($res->num_rows == 1){
		                while($r = $res->fetch_array()){
		                  //echo $r["id"];
		                  session_start();
		                  $_SESSION["user_id"] = $r["user_id"];
		                  $_SESSION["username"] = $r["username"];
		                  $_SESSION["role"] = $r["role"];
		                  if($r["role"]=="admin"){
		                    header("location: ./admin/adminDashboard.php");
		                  }
		                  else if($r["role"]=="user"){
		                    header("location: ./user/userDashboard.php");
		                  }
		                  
		                }
		              }
		              else{
		                $Err = "Invalid Email-ID and Password";
		              }
		            }
    			}
	    	}
	  	}
	}
	else if (isset($_POST['reset'])){

		if (empty($_POST["email"])) {
	   		$Err = "Email-Id is required";
	  	} 
	  	else {
	    	$email = test_input($_POST["email"]);
	    	if (!preg_match("/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook|aol|icloud|banasthali|du)\.(com|org|net|info|biz|io|me|co|edu|gov|mil|co\.uk|ac\.in|\.in|\.org)$/",$email)) {
	    	  $Err = "Only letters(a-z,A-Z),digits(0-9),underscore(_),full stop(.), and hypen(-) allowed in first name in Email provided or Invalid domain name may be there..";
	    	}
	    	else if(empty($_POST['password'])){
	    		$Err = "Password is required";
	    	}
	    	else{
	    		$password = test_input($_POST['password']);
	    		if(!preg_match("/^[a-zA-Z@0-9']{8}$/", $password)){
	    			$Err = "Only letters, digits or @ are allowed and should be of length 8";
    			}
		    	else if(empty($_POST['repassword'])){
		    		$Err = "Re-Entering Password is required";
		    	}
		    	else{
		    		$repassword = test_input($_POST['repassword']);
		    		if(!preg_match("/^[a-zA-Z@0-9']{8}$/", $repassword)){
		    			$Err = "Only letters, digits or @ are allowed and should be of length 8";
	    			}
	    			else if($password != $repassword){
	    				$Err = "Passwords Don't match!! Try Again!!";
	    			}
		    		else{
		    			$password = md5($password);
			            $sql = "UPDATE `user_details` SET `password`=? WHERE `user_email`=?";
			            $stmt = $conn->prepare($sql);
			            $stmt->bind_param("ss",$password,$email);
			            if($stmt->execute()== TRUE){
			            	$notify = "Password changed..";
			            }
			            else{
			            	$Err = "Something went wrong!! Try again!!";
			            }
	    			}
		    	}
	    	}
	  	}
	}
	else if (isset($_POST['submit'])) {
		// $Err = $_POST['name'].",".$_POST['state'].",".$_POST['city'].",".$_POST['mobile'].",".$_POST['alt_mobile'].",".$_POST['perm_address'].",".$_POST['curr_address'];

		if(empty($_POST['fname'])){
	  		$Err = "Enter Your First Name";
	  	}
	  	elseif(!preg_match("/^['A-Za-z ']*$/", $_POST['fname'])){
  			$Err = "Name can only have alpabets and spaces";
  		}
  		else{
	  		$fname = test_input($_POST['fname']);
	  		if(empty($_POST['lname'])){
		  		$Err = "Enter Your Last Name";
		  	}
		  	elseif(!preg_match("/^['A-Za-z ']*$/", $_POST['lname'])){
	  			$Err = "Name can only have alpabets and spaces";
	  		}
	  		else{
		  		$lname = test_input($_POST['lname']);
		  		$username = $fname.$lname;
		  		if (empty($_POST["email"])) {
			   		$Err = "Email-Id is required";
			  	} 
			  	else {
			    	$email = test_input($_POST["email"]);
			    	if (!preg_match("/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook|aol|icloud|banasthali|du)\.(com|org|net|info|biz|io|me|co|edu|gov|mil|co\.uk|ac\.in|\.in|\.org)$/",$email)) {
			    	  $Err = "Only letters(a-z,A-Z),digits(0-9),underscore(_),full stop(.), and hypen(-) allowed in first name in Email provided or Invalid domain name may be there..";
			    	}
			    	else if(empty($_POST['pass'])){
			    		$Err = "Password is required";
			    	}
			    	else{
			    		$password = test_input($_POST['pass']);
			    		if(!preg_match("/^[a-zA-Z@0-9']{8}$/", $password)){
			    			$Err = "Only letters, digits or @ are allowed and must be of length 8";
		    			}
			    		else if(empty($_POST['repass'])){
				    		$Err = "Password is required";
				    	}
				    	else{
				    		$repassword = test_input($_POST['repass']);
				    		if(!preg_match("/^[a-zA-Z@0-9']{8}$/", $repassword)){
				    			$Err = "Only letters, digits or @ are allowed and must be of length 8";
			    			}
			    			elseif ($password != $repassword) {
			    				$Err = "Password and Re-Entered Password doesn't match";
			    			}
				    		else{
				    			$password = md5($password);
				    			$uid = uniqid();
				    			$role = "user";

				    			$sql = "INSERT INTO `user_details`(`user_id`, `user_email`, `username`, `password`, `role`) VALUES (?,?,?,?,?)";
								$stmt = $conn->prepare($sql);
								$stmt->bind_param("sssss",$uid,$email,$username,$password,$role);
								if($stmt->execute()== TRUE){
									$notify = "Registeration Completed!!";
								}
								else{
									$Err = "Something went wrong! Try Again!";
								}
							}
						}
					}
				}
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

	<title>Text Summarizer</title>

	<link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="./assets/css/adminlte.min.css">

	<script src="./assets/plugins/jquery/jquery.min.js"></script>
	<script src="./assets/js/code.js"></script>
</head>
<body>

<body class="hold-transition layout-top-nav layout-navbar-fixed" style="height: auto;">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  	<nav class="main-header navbar navbar-expand-md navbar-white navbar-light" style="background: black;">
    	<!-- Left navbar links -->

    	<div>
    		<img src="./assets/images/logoExp.png" style="height: 60px; margin: -5px; margin-left: 10px;">
    		<img src="./assets/images/websiteName.png" style="height: 60px; margin: -5px; margin-left: 10px;">		
    		
    	</div>

	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="./index.php" class="nav-link text-bold" style="color: white">Home</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="./summary.php" class="nav-link text-bold" style="color: white">Text Summary</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="./index.php#contact" class="nav-link text-bold" style="color: white">Contact</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="./index.php#about" class="nav-link text-bold" style="color: white">About Us</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="" class="nav-link text-bold" data-target="#Register" data-toggle="modal" style="color: white">Register</a>
	      </li>
	      <li class="nav-item d-none d-sm-inline-block">
	        <a href="" class="nav-link text-bold" data-target="#Login" data-toggle="modal" style="color: white">Login</a>
	      </li>
	    </ul>
  	</nav>
  <!-- /.navbar -->

  <section class = "content">
  	<div class= "container-fluid">
  		<div class = "row" style="margin-top: 65px; background: linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px; padding-top: 25px;">
  			<div class="row">
                  	<!-- <div class="row mt-4"> -->
	                  <div class="col-sm-4" style="display: flex;">
	                    <div class="position-relative" style="height: 100%; width: 100%;">
	                      <img src="./assets/images/img6.jpeg" alt="Photo 1" class="img-fluid" style="height: inherit; width: inherit; border-radius: 15px; box-shadow: rgba(0,0,0,0.56) 0px 22px 70px 4px; ">
	                    </div>
	                  </div>
	                  <div class="col-sm-4" style="display: flex;">
	                    <div class="position-relative" style="height: 100%; width: 100%;">
	                      <img src="./assets/images/img8.jpeg" alt="Photo 2" class="img-fluid" style="height: inherit; width: inherit; border-radius: 15px; box-shadow: rgba(0,0,0,0.56) 0px 22px 70px 4px;">
	                    </div>
	                  </div>
	                  <div class="col-sm-4" style="display: flex;">
	                    <div class="position-relative" style="height: 100%; width: 100%;">
	                      <img src="./assets/images/img7.jpeg" alt="Photo 3" class="img-fluid" style="height: inherit; width: inherit; border-radius: 15px; box-shadow: rgba(0,0,0,0.56) 0px 22px 70px 4px;">
	                    </div>
	                  </div>
	              	<!-- </div> -->
                </div>
  			
  		</div>


  		<div class="row " style="background: linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
  			<div class="col-md-12" style="margin: 15px;">
  				<h1 class="text-center text-bold"><u>Text Summary</u></h1>
  			</div>
  			<div class="container col-md-12" style="background: #ffffff30; margin: 15px; padding: 15px; box-shadow: rgba(240,46,170,0.4) -5px 5px,  rgba(240,46,170,0.3) -10px 10px,  rgba(240,46,170,0.2) -15px 15px,  rgba(240,46,170,0.1) -20px -20px,  rgba(240,46,170,0.05) -25px -25px; ">
  				<div class="d-flex" style="height: 350px;">
  					<div class="col1 w-50 me-1" style="height: inherit;">
  						<div class="form-group">
                          <label>Text: </label>
                          <textarea class="form-control" name="text" id="text" placeholder="Enter Text..." rows="10"></textarea>
                          <br>
                          <button  name="summarize" class="btn btn-primary" onclick="generate();">Summarize Text</button>
                          <button onclick="cl();" class="btn btn-primary">Clear Text</button>
                        </div>
  					</div>
  					<div class="col1 w-50 me-1 text-center d-flex align-items-center justify-content-center" style=" padding:15px; margin-top: -30px;">
  						<textarea class="form-control" name="text1" id="text1" placeholder="Summarized Text..." rows="10" readonly></textarea>
  					</div>
  				</div>
  			</div>
  		</div>

  		


	</div>


<?php
if($Err != ""){
	// echo $Err;
	echo "<script type='text/javascript'>
	$(document).ready(function(){
		$('#Error').modal('show');
	});
	</script>";
}

else if($notify != ""){
	// echo $Err;
	echo "<script type='text/javascript'>
	$(document).ready(function(){
		$('#Notify').modal('show');
	});
	</script>";
}
?>	
	<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  </section>
</div>


<div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="reg" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      	<div class="modal-header" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
        	<h5 class="modal-title" id="reg">Register</h5>
        		
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>
      	
	      	<div class="modal-body" style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
	      		<form method="POST" action="">
	      		<div class="text-center">
	            	<img class="profile-user-img img-fluid img-circle" id="eimg" src="./assets/images/avtar.jpeg" alt="User profile picture">
	            </div>
	      		<div class="row">
	      			<p class="text-red"><b><?php echo $Err; ?></b></p>
		            <p class="text-green"><b><?php echo $notify; ?></b></p>
	            	<div class="col-md-12">
	                    <div class="form-group">
	                      <label>First Name: </label>
	                      <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Your First Name" required onchange="validateText(this.value, 'regfname');">
	                      <label class="text-red" id="regfname"></label>
	                    </div>
	                </div>
	                <div class="col-md-12">
	                    <div class="form-group">
	                      <label>Last Name: </label>
	                      <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Your Last Name" required onchange="validateText(this.value, 'reglname');">
	                      <label class="text-red" id="reglname"></label>
	                    </div>
	                </div>
	                <div class="col-md-12">
	                    <div class="form-group">
	                      <label>Email: </label>
	                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email ID" required onchange="validateEmail(this.value,'regemail');">
	                      <label class="text-red" id="regemail"></label>
	                    </div>
	                </div>
	            	<div class="col-md-12">
	                    <div class="form-group">
	                      <label>Password: </label>
	                      <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Password" required onchange="validatePassword(this.value, 'regpass');">
	                      <label class="text-red" id="regpass"></label>
	                    </div>
	                </div>
	            	<div class="col-md-12">
	                    <div class="form-group">
	                      <label>Confirm Password: </label>
	                      <input type="password" class="form-control" name="repass" id="repass" placeholder="Re-Enter Password" required onchange="validatePassword(this.value, 'regrepass');">
	                      <label class="text-red" id="regrepass"></label>
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        		&nbsp;&nbsp;
	        		<button type="submit" name="submit" class="btn btn-primary" id="submit" value="">Submit</button>
	        	</div>
	            </form>
	      	</div>
	      	
	  	
    </div>
  </div>
</div>

<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      	<div class="modal-header" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
        	<h5 class="modal-title" id="login">Login</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>
      	
	      	<div class="modal-body" style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
	      		<form method="POST" action="">
	      		<div class="text-center">
	            	<img class="profile-user-img img-fluid img-circle" id="eimg" src="./assets/images/avtar.jpeg" alt="User profile picture">
	            </div>
	      		<div class="row">
	      			<div class="col-md-12">
	      				<div class="form-group">
		                    <label>Email-Id: </label>
		                    <input type="email" class="form-control" name="email" placeholder="Enter Email-Id" required onchange="validateEmail(this.value, 'logemail');">
		                    <label class="text-red" id="logemail"></label>
	                  	</div>
	      			</div>
	      			<div class="col-md-12">
	      				<div class="form-group">
		                    <label>Password: </label>
                    		<input type="password" class="form-control" name="password" placeholder="Enter Password" required onchange="validatePassword(this.value,'logpass');">
                    		<label class="text-red" id="logpass"></label>
	                  	</div>
	      			</div>
	            </div>
	            <div class="row text-center" style="display: block;">
	        		<button type="submit" name="login" class="btn btn-primary">Login</button>
	        	</div>
	        	<div class="row text-center" style="display: block; padding-top: 10px;">
	        		<a href="" class="nav-link text-bold" data-target="#Reset" data-toggle="modal">Reset/Forgot Password</a>
	        	</div>
	            </form>
	      	</div>
	      	
	  	
    </div>
  </div>
</div>

<div class="modal fade" id="Reset" tabindex="-1" role="dialog" aria-labelledby="reset" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      	<div class="modal-header" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
        	<h5 class="modal-title" id="reset">Reset/Forgot Password</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>
      	
	      	<div class="modal-body" style="background: linear-gradient(109.6deg, rgba(156,252,248,1) 11.2%, rgba(110,123,251,1) 91.1%); padding: 15px;">
	      		<form method="POST" action="">
	      		<div class="text-center">
	            	<img class="profile-user-img img-fluid img-circle" id="eimg" src="./assets/images/avtar.jpeg" alt="User profile picture">
	            </div>
	      		<div class="row">
	      			<div class="col-md-12">
	      				<div class="form-group">
		                    <label>Email-Id: </label>
		                    <input type="email" class="form-control" name="email" placeholder="Enter Email-Id" required onchange="validateEmail(this.value,'resetemail');">
		                    <label class="text-red" id="resetemail"></label>
	                  	</div>
	      			</div>
	      			<div class="col-md-12">
	      				<div class="form-group">
		                    <label>New Password: </label>
                    		<input type="password" class="form-control" name="password" placeholder="Enter Password" required onchange="validatePassword(this.value, 'resetpass');">
                    		<label class="text-red" id="resetpass"></label>
	                  	</div>
	      			</div>
	      			<div class="col-md-12">
	      				<div class="form-group">
		                    <label>Re-Enter New Password: </label>
                    		<input type="password" class="form-control" name="repassword" placeholder="Re-Enter Password" required onchange="validatePassword(this.value, 'resetrepass');">
                    		<label class="text-red" id="resetrepass"></label>
	                  	</div>
	      			</div>
	            </div>
	            <div class="row text-center" style="display: block;">
	        		<button type="submit" name="reset" class="btn btn-primary">Reset</button>
	        	</div>
	            </form>
	      	</div>
	      	
	  	
    </div>
  </div>
</div>

<div class="modal fade" id="Error" tabindex="-1" role="dialog" aria-labelledby="error" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<h5 class="modal-title" id="error">Error</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>
      	
      	<div class="modal-body">
      		<h3 class="text-red"><?php echo $Err; ?></h3>
      	</div>
      	<div class="modal-footer">
      	</div>
	  	
    </div>
  </div>
</div>

<div class="modal fade" id="Notify" tabindex="-1" role="dialog" aria-labelledby="notify" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<h5 class="modal-title" id="notify">Notify</h5>
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
      	</div>
      	
      	<div class="modal-body">
      		<h3 class="text-green"><?php echo $notify; ?></h3>
      	</div>
      	<div class="modal-footer">
      	</div>
	  	
    </div>
  </div>
</div>

<script type="text/javascript">
	 $(document).ready(function() {
	 $('body').bind('cut copy', function(event) {
	 event.preventDefault();
	 });
	 });
	
	function generate(){
		var text = document.getElementById('text').value.trim();
		// console.log(text);
		 query({"inputs": text,"parameters": {"min_length": 10, "max_length":500}}).then((response) => {
			// console.log(response);
			document.getElementById('text1').innerHTML = response[0]['summary_text'];
			// document.getElementById('summtext').innerHTML = response[0]['summary_text'];
			
		});
	}

	function cl(){
		// console.log(document.getElementById('text').value);
		document.getElementById('text1').innerHTML = "";
		// document.getElementById('text').innerHTML = "";
		document.getElementById('text').value = "";
	}
</script>

<script src="./assets/js/validate.js"></script>
<!-- jQuery -->
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/js/adminlte.min.js"></script>

</body>
</html>