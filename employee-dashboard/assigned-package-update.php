<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();
 if($_REQUEST["accept_decline"]=='accepted')
 {
	  $query1 = sprintf("update tbl_package_info set status_id = %s, arrival_time = %s, accept_decline = %s, commnts = %s where package_id = %s",						
									GetSQLValueString($_REQUEST["status_id"], "int"),	
									GetSQLValueString($_REQUEST["arrival_time"], "text"),
									GetSQLValueString($_REQUEST["accept_decline"], "text"),	
                                    GetSQLValueString($_REQUEST["commnts"], "text"),									 
						           GetSQLValueString($_REQUEST["package-id"], "int"));
	$n1 = db_other_query($conn, $query1);	
	 
 }
 else{
	 
	   $query2 = sprintf("update tbl_package_info set status_id = %s, arrival_time = %s, accept_decline = %s, commnts = %s, emp_id = Null, assign_status = '0' where package_id = %s",						
									GetSQLValueString($_REQUEST["status_id"], "int"),	
									GetSQLValueString($_REQUEST["arrival_time"], "text"),
									GetSQLValueString($_REQUEST["accept_decline"], "text"),	
                                    GetSQLValueString($_REQUEST["commnts"], "text"),									 
						           GetSQLValueString($_REQUEST["package-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
	 
 } 
 
        
			
	db_close($conn);	
	header("Location: assigned-package-list.php");
	?>

