<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();

           echo $query2 = sprintf("update tbl_load_info set pick_up_price = %s, pick_up_location = %s, delivery_location= %s ,other_Notes = %s, emp_id = %s,truck_id = %s where load_id = %s",						
								GetSQLValueString($_REQUEST["pick_up_price"], "int"),
								GetSQLValueString($_REQUEST["pick_up_location"], "text"),							
								GetSQLValueString($_REQUEST["delivery_location"], "text"),									
								GetSQLValueString($_REQUEST["other_Notes"], "text"),
								GetSQLValueString($_REQUEST["emp_id"], "int"),	
								GetSQLValueString($_REQUEST["truck_id"], "int"),	
								GetSQLValueString($_REQUEST["load-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	db_close($conn);	
	header("Location: load-list.php");
	?>
 
