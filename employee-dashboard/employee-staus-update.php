<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
          $query2 = sprintf("update tbl_employee_info set is_available = %s  where emp_id = %s",						
						           	GetSQLValueString($_REQUEST["is_available"], "text"),
						           GetSQLValueString($_REQUEST["employee-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	db_close($conn);	
	header("Location: index.php");
	?>

