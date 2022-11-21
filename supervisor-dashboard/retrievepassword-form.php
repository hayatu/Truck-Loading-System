<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
include_once($CommonAssets ."/delivery/top-header-section.php"); 
include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>	
<?php
if(array_key_exists("password",$_REQUEST)){
	
	$newpassword =$_REQUEST["password"];
	if(strlen($newpassword)>10||strlen($newpassword)<6 || !preg_match("#[A-Z]+#",$newpassword)) {
    echo "<div class='container pt-3'>
	<div class='alert alert-danger' role='alert'>
	Password must be betwwen atleast 6 & 10 and Must Contain At Least 1 Capital Letter!
	</div>
	</div>";
}
else {
        $query2 = sprintf("update tbl_admin_info set password = %s where admin_id = %s",						
						            GetSQLValueString(MD5($_REQUEST["password"]), "text"),
									GetSQLValueString($_REQUEST["admin-id"], "int"));
	  $n2 = db_other_query($conn, $query2);

	if($n2==1){
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-success' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 Your Password has been updated!.
			</div>
		</div>";
		
	}
	
	else{
		
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 Your Password has not been updated please try again!.
				  <button class='btn btn-primary btn-sm btn-link'><a href='password-update-form.php'><span class='text-white'>Go Back</span></a></button>
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
					<h4 class="font-weight-bold pt-4 text-left">Online Delivery Update Password</h4>
					<hr class="light-blue lighten-1 title-hr mb-3">   
					<!-- Email -->	

					<span>Your Password is </span>
					<input name="password" type="password" id="password" class="form-control" required>
					<!-- Sign in button -->
					<button class="btn btn-info btn-block my-4" type="submit">Show me my Password</button>
					<div class="form-control mb-1">
					  <!-- Forgot password -->					 
					  <a href="login.php">Go to Login Page</a>
					</div>						
			</div>
			
		</div>
	</div>	
</main>
<!--/ Main layout -->
<!-- Footer -->
<?php  include("footer.php"); ?>
<!-- Footer -->
<!-- Default form login -->
	
