<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
include_once($CommonAssets ."/delivery/top-header-section.php"); 
include_once($CommonAssets ."/delivery/main-top-header.php"); 
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();

if(array_key_exists("password",$_REQUEST)){
	
	$newpassword =$_REQUEST["password"];
	if(strlen($newpassword)>10||strlen($newpassword)<6 || !preg_match("#[A-Z]+#",$newpassword)) {
    echo "<div class='container pt-3'>
	<div class='alert alert-danger' role='alert'>
	The Password lenght must be between at least 6 & 10 Characters and mus Contain at Least 1 Capital Letter!
	</div>
	</div>";
}
else {
          $query2 = sprintf("update tbl_employee_info set password = %s where email = %s",						
						            GetSQLValueString(MD5($_REQUEST["password"]), "text"),
									GetSQLValueString($_REQUEST["email"], "text"));
	   $n2 = db_other_query($conn, $query2);

	if($n2 > 0){
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-success' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 A new password has been created!.
			</div>
		</div>";
		
	}
	
	else{
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 Your Password has not been updated please try again!.
				  <button class='btn btn-primary btn-sm btn-link'><a href='forgot-password-form.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit;
	}	
	db_close($conn);	
	}
	}

?> 

<!-- Navigation -->
<main class="pl-0 pt-0">
	<div class="container pt-5">
		<!-- Default form login -->		
		<div class="row">
			<div class="col-md-12">					
				<form class="text-center p-2 border border-light rounded mb-0" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
					<h4 class="font-weight-bold pt-4 text-left">Online Delivery Create New Password</h4>
					<hr class="light-blue lighten-1 title-hr mb-3">   
					<!-- Email -->	
					<input name="email" type="email" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Enter your email" required>					
					<!-- Password -->
					<input name="password" type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Enter your new password" required>
					<!-- Sign in button -->
					<button class="btn btn-info btn-block my-4" type="submit">Create my Password</button>
					<div class="form-control mb-1">
					  <!-- Forgot password -->					 
					  <a href="login.php">Go to Login Page</a>
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
	
