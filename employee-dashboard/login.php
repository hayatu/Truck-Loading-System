<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
//error_message = "";
if( array_key_exists("email", $_REQUEST) && array_key_exists("password",$_REQUEST)){
	//authentication
	$conn = db_connect();
	     $query = sprintf("SELECT * from tbl_employee_info WHERE tbl_employee_info.email = %s and tbl_employee_info.password = %s and tbl_employee_info.is_enabled = 1", 
					GetSQLValueString($_REQUEST["email"], "text"),
					GetSQLValueString(MD5($_REQUEST["password"]), "text"));
	$n = db_select_query($conn, $query, $rs_user);
	if($n == 1){
		session_start();
		$_SESSION["first_name"] = $rs_user[0]["first_name"];	
		$_SESSION["last_name"] = $rs_user[0]["last_name"];	
		$_SESSION["emp_id"] = $rs_user[0]["emp_id"];			
		$_SESSION["user_loggedin"] = true;
		header("Location: index.php");
		exit;
	}	
	else{
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 The username or password is incorrect please try again!.
			</div>
		</div>";
	}	
	db_close($conn);
}

?>
<?php 
     	include_once($CommonAssets ."/truck/top-header-section.php"); 
		include_once($CommonAssets ."/truck/main-top-header.php"); 
	?> 
<!-- Navigation -->
<main class="pl-0 pt-0">
	<div class="container pt-5">
		<!-- Default form login -->		
		<div class="row">
			<div class="col-md-12">					
				<form class="text-center p-2 border border-light rounded mb-0" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">	
					<h4 class="font-weight-bold pt-4 text-left">Truck Load Management System Login</h4>
					<hr class="light-blue lighten-1 title-hr mb-3">   
					<!-- Email -->
					<input name="email" type="email" id="email" class="form-control mb-4" placeholder="Email Address" required>
					<!-- Password -->
					<input name="password" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" required>
					<!-- Sign in button -->
					<button class="btn btn-info btn-block my-4" type="submit">Login</button> 
					<div class="form-control mb-1">
					  <!-- Forgot password -->					 
					  <a href="forgot-password-form.php">Create New password?</a>
					</div>										
				</form>			
			</div>
			
		</div>
	</div>	
</main>
<!--/ Main layout -->
<!-- Footer -->
<?php  include("footer.php"); ?>
<!-- Footer -->
<!-- Default form login -->



