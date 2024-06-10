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
	    			$Err = "Only letters, digits or @ are allowed and must be of length 8";
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
	    			$Err = "Only letters, digits or @ are allowed and must be of length 8";
    			}
		    	else if(empty($_POST['repassword'])){
		    		$Err = "Re-Entering Password is required";
		    	}
		    	else{
		    		$repassword = test_input($_POST['repassword']);
		    		if(!preg_match("/^[a-zA-Z@0-9']{8}$/", $repassword)){
		    			$Err = "Only letters, digits or @ are allowed and must be of length 8";
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
  	else if(isset($_POST['contact'])){
		$name = $_POST['name'];
		$from = $_POST['from'];
		$subject = $_POST['subject'];
		$msg = $_POST['msg'];


		$id = uniqid();
		$sql = "INSERT INTO `contact`(`c_id`, `name`, `mail`, `subject`, `msg`) VALUES (?,?,?,?,?)";

	    $stmt = $conn->prepare($sql);
	    $stmt->bind_param("sssss",$id,$name,$from,$subject,$msg);
		
		if($stmt->execute()!= TRUE){
	      	$Err = "Error in accepting query. Try Again..";
	    }
	    else{
			$notify = "Query Stored!!.";
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

	    
	    	<!-- <li class="nav-item">
	        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	      </li> -->
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

  		<div id="about" class = "row" style="background: linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
			<div class="col-12 col-lg-6 col-md-12 col-sm-12 text-center" style="display: inline-block;">
				<img src="./assets/images/about.png" alt="Photo 2" class="img-fluid" style="width: inherit; padding: 20px;">
			</div>
			<div class="col-12 col-lg-6 col-md-12 col-sm-12" style="display: inline-block; padding: 25px;">
				<h3 class="text-center"><u>About Us</u></h3>
				<br><br>
				<h3>Welcome to our website!</h3>
				<h5>
					<br/>We are a team of coders dedicated to provide you with high-quality text summarization services. Our website allows the user to easily summarize any piece of text or URL.<br>We understand that time is valuable which is why our website allows the user to quickly and accurately generate summaries that capture the essence of any text. Our text summarization approach goes beyond simply extracting key phrases and instead create unique summaries that convey the most important ideas and concepts from the original text.<br>Thank you for choosing our website for your text summarization needs.<br><i>Below are the services provided to our registered users.</i>  
				</h5>
			</div>
  		</div>

  		<div class="row" style="background: linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
  			<div class="col-md-12" style="margin: 15px;">
  				<h1 class="text-center text-bold"><u>Our Services</u></h1>
  			</div>
  			<div class="container" style="margin-top: 15px; margin-bottom: 15px;">
  				<div class="d-flex" style="height: 350px;">
  					<div class="col1 w-50 me-1" style="height: inherit;">
  						<img src="./assets/images/img2.jpeg" alt="Photo 2" class="img-fluid" style="height: inherit; width: 100%;">
  					</div>
  					<div class="col1 w-50 me-1 text-center d-flex align-items-center justify-content-center" style="background-color: #f0f0f0; padding:20px;">
  						<h3 style="margin: 15px;">Text Summary</h3>
  						<p class="text-center text-bold" style="margin: 15px;">
  						A summary is a shorted version of a text.
						It contains the main points in the text and in your own words.
						It is the mixture of reducing a long text to a short text and selecting relevant information.
						A good summary shows that you have understood the text.
  						</p>
  					</div>
  				</div>
  				<div class="d-flex" style="height: 350px;">
  					<div class="col1 w-50 me-1 text-center d-flex align-items-center justify-content-center" style="background-color: #f0f0f0; padding:20px;">
  						<h3 style="margin: 15px;">Summarize URL</h3>
  						<p class="text-center text-bold" style="margin: 15px;">
  							Our Summarize URL service allows user to input a URL of a webpage that they would like to summarize.This service is useful for users who want to quickly digest the main points of an article, blog post, or other type of webpage without having to read through the entire content.
  
  						</p>
  					</div>
  					<div class="col1 w-50 me-1" style="height: inherit;">
  						<img src="./assets/images/url.jfif" alt="Photo 2" class="img-fluid" style="height: inherit; width: 100%;">
  					</div>
  				</div>
  				<div class="d-flex" style="height: 350px;">
  					<div class="col1 w-50 me-1" style="height: inherit;">
  						<img src="./assets/images/copy.jfif" alt="Photo 2" class="img-fluid" style="height: inherit; width: 100%;">
  					</div>
  					<div class="col1 w-50 me-1 text-center d-flex align-items-center justify-content-center" style="background-color: #f0f0f0; padding:20px;">
  						<h3 style="margin: 15px;">Copy Text</h3>
  						<p class="text-center text-bold" style="margin: 15px;">
  							Our Copy Text service allows users to copy the summarized text to their clipboard , making it easy to paste the summary into another document or application.
  						</p>
  					</div>
  				</div>
  				<div class="d-flex" style="height: 350px;">
  					<div class="col1 w-50 me-1 text-center d-flex align-items-center justify-content-center" style="background-color: #f0f0f0; padding:20px;">
  						<h3 style="margin: 15px;">Download Summary</h3>
  						<p class="text-center text-bold" style="margin: 15px;">
  							Our Download Summary service allows uses to download a summarized version of a piece of text or a webpage in the pdf file format. This feature is useful for users who want to save the summary for later reference or for sharing with others.

  						</p>
  					</div>
  					<div class="col1 w-50 me-1" style="height: inherit;">
  						<img src="./assets/images/download.jpeg" alt="Photo 2" class="img-fluid" style="height: inherit; width: 100%;">
  					</div>
  				</div>
  				<div class="d-flex" style="height: 350px;">
  					<div class="col1 w-50 me-1" style="height: inherit;">
  						<img src="./assets/images/history.jpeg" alt="Photo 2" class="img-fluid" style="height: inherit; width: 100%;">
  					</div>
  					<div class="col1 w-50 me-1 text-center d-flex align-items-center justify-content-center" style="background-color: #f0f0f0; padding:20px;">
  						<h3 style="margin: 15px;">View History</h3>
  						<p class="text-center text-bold" style="margin: 15px;">
  							Our 'View history' service for text summarized texts is useful for users who want to revisit summaries they have previously generated or users who want to keep a record of their summarized texts for future refrence.
  						</p>
  					</div>
  				</div>
  			</div>
  		</div>

  		<div id="contact" class="row" style="background:  linear-gradient(95.2deg, rgba(173,252,234,1) 26.8%, rgba(192,229,246,1) 64%); padding: 15px;">
  			<div class="container"> 
				<div class="card" style="background: #ffffff30; margin: 15px; padding: 15px; box-shadow: rgba(240,46,170,0.4) -5px 5px,  rgba(240,46,170,0.3) -10px 10px,  rgba(240,46,170,0.2) -15px 15px,  rgba(240,46,170,0.1) -20px -20px,  rgba(240,46,170,0.05) -25px -25px; ">
			        <div class="card-body row">
			          <div class="col-5 text-center d-flex col-md-5" style=" padding: 10px;">
			            <img src="./assets/images/contact.jpeg" style="height: inherit; width: inherit;">
			          </div>
			          <div class="col-7 col-md-7" style="padding: 10px; padding-left: 30px;">
			          	<form method="POST" action="">
				            <div class="form-group">
				              <label for="inputName">Name</label>
				              <input type="text" id="inputName" name="name" class="form-control" required />
				            </div>
				            <div class="form-group">
				              <label for="inputEmail">E-Mail</label>
				              <input type="email" id="inputEmail" name="from" class="form-control" required />
				            </div>
				            <div class="form-group">
				              <label for="inputSubject">Subject</label>
				              <input type="text" id="inputSubject" name="subject" class="form-control" required />
				            </div>
				            <div class="form-group">
				              <label for="inputMessage">Message</label>
				              <textarea id="inputMessage" name="msg" class="form-control" rows="4" required></textarea>
				            </div>
				            <div class="form-group">
				              	<button class="btn btn-primary" type="submit" name="contact">Send message</button>
				            </div>
				        </form>
			          </div>
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