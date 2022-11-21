<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
  
 if($_REQUEST["email"] != ""){
 
 $email = $_REQUEST['email'];
		$query = sprintf("SELECT email FROM tbl_admin_info where email = %s ", GetSQLValueString($_REQUEST["email"], "text"));
		$n = db_select_query($conn, $query, $rs_users);

		if($n > 0){
		// do not insert
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 The email address already exists!.
				 <button class='btn btn-primary btn-sm btn-link'><a href='administrator-registration-form.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit();
		} else {
			// insert 
			  echo   $query1 = sprintf("insert into tbl_admin_info(first_name, last_name,email, password, mobile,country_id, address) values(%s, %s, %s, %s, %s,%s,%s)", 
									GetSQLValueString($_REQUEST["first_name"], "text"),
									GetSQLValueString($_REQUEST["last_name"], "text"),							
									GetSQLValueString($_REQUEST["email"], "text"),									
									GetSQLValueString(MD5($_REQUEST["password"]), "text"),
									GetSQLValueString($_REQUEST["mobile"], "text"),
									GetSQLValueString($_REQUEST["country_id"], "int"),
									GetSQLValueString($_REQUEST["address"], "text"));
			$n1 = db_other_query($conn, $query1);
			
		} 	
	}		
	 db_close($conn);	 
	header("Location: admin_profile.php");	
	?>

