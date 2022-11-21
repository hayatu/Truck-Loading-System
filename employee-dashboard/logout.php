<?php
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['user_loggedin'])) {
   	unset($_SESSION['user_loggedin']);
   	unset($_SESSION["email"]); 
	unset($_SESSION["password"]);	
	unset($_SESSION["userid"]);
}

// now that the user is logged out,
// go to login page
header("Location: ../login.php");
?>