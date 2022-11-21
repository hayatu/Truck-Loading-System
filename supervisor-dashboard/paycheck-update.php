<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();
          $query2 = sprintf("update tbl_paycheck_info set gross_pay_total = %s, commission = %s, fuel = %s, insurance_fee = %s, other_charges = %s, net_pay = %s, truck_id = %s, emp_id = %s, sdate = %s, edate = %s, week_name = %s  where paycheck_id = %s",						
				GetSQLValueString($_REQUEST["gross_pay_total"], "int"),
				GetSQLValueString($_REQUEST["commission"], "int"),	
				GetSQLValueString($_REQUEST["fuel"], "int"),
				GetSQLValueString($_REQUEST["insurance_fee"], "int"),
				GetSQLValueString($_REQUEST["other_charges"], "int"),
				GetSQLValueString($_REQUEST["net_pay"], "int"),	
				GetSQLValueString($_REQUEST["truck_id"], "int"),
				GetSQLValueString($_REQUEST["emp_id"], "int"),	
				GetSQLValueString($_REQUEST["sdate"], "text"),
				GetSQLValueString($_REQUEST["edate"], "text"),
				GetSQLValueString($_REQUEST["week"], "text"),					
				GetSQLValueString($_REQUEST["paycheck-id"], "int"));
				$n2 = db_other_query($conn, $query2);	
				db_close($conn);	
			header("Location: paycheck-list.php");
	?>

