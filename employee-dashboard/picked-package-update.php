<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();

	  $query1 = sprintf("update tbl_package_info set status_id = %s, arrival_time = %s, commnts = %s where package_id = %s",						
									GetSQLValueString($_REQUEST["status_id"], "int"),	
									GetSQLValueString($_REQUEST["arrival_time"], "text"),									
                                    GetSQLValueString($_REQUEST["commnts"], "text"),									 
						           GetSQLValueString($_REQUEST["package-id"], "int"));
	$n1 = db_other_query($conn, $query1);	
	 
	db_close($conn);	
	header("Location: picked-package-list.php");
	?>

