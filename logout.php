<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: ../index.php");
	}
}

?>