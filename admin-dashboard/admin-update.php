<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();
      $query2 = sprintf("update tbl_admin_info set first_name = %s, last_name = %s, email= %s, mobile = %s, country_id = %s, address = %s  where admin_id = %s",						
						            GetSQLValueString($_REQUEST["first_name"], "text"),
									GetSQLValueString($_REQUEST["last_name"], "text"),							
									GetSQLValueString($_REQUEST["email"], "text"),
									GetSQLValueString($_REQUEST["mobile"], "text"),
									GetSQLValueString($_REQUEST["country_id"], "int"),
									GetSQLValueString($_REQUEST["address"], "text"),
						           GetSQLValueString($_REQUEST["admin-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	db_close($conn);	
	header("Location: admin_profile.php");
	?>

