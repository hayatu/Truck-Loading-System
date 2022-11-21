<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();


	
			// insert 
			$query1 = sprintf("insert into tbl_load_info(pick_up_price,pick_up_location, delivery_location,other_Notes,emp_id,truck_id, week_name,sdate,edate) values( %s,%s,%s,%s, %s,%s, %s,%s,%s)", 
			GetSQLValueString($_REQUEST["pick_up_price"], "int"),
			GetSQLValueString($_REQUEST["pick_up_location"], "text"),
			GetSQLValueString($_REQUEST["delivery_location"], "text"),							
			GetSQLValueString($_REQUEST["other_Notes"], "text"),
			GetSQLValueString($_REQUEST["emp_id"], "int"),	
			GetSQLValueString($_REQUEST["truck_id"], "int"),
			GetSQLValueString($_REQUEST["week"], "text"),
			GetSQLValueString($_REQUEST["sdate"], "text"),
			GetSQLValueString($_REQUEST["edate"], "text"));
			$n1 = db_other_query($conn, $query1);		
	        db_close($conn);	 
	      header("Location: load-list.php");	
	?>


									
									