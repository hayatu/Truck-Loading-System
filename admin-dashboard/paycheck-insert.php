<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();
  
            		// insert 
			          echo $query1 = sprintf("insert into tbl_paycheck_info(gross_pay_total, commission,fuel, insurance_fee,other_charges, net_pay,truck_id,sdate,edate,emp_id,week_name,other_Notes) values(%s,%s,%s,%s,%s,%s, %s, %s, %s, %s,%s,%s)", 
									GetSQLValueString($_REQUEST["gross_pay_total"], "int"),
									GetSQLValueString($_REQUEST["commission"], "decimal"),							
									GetSQLValueString($_REQUEST["fuel"], "int"),							
									GetSQLValueString($_REQUEST["insurance_fee"], "int"),
									GetSQLValueString($_REQUEST["other_charges"], "int"),
									GetSQLValueString($_REQUEST["net_pay"], "decimal"),
									GetSQLValueString($_REQUEST["truck_id"], "int"),
									GetSQLValueString($_REQUEST["sdate"], "text"),
									GetSQLValueString($_REQUEST["edate"], "text"),
									GetSQLValueString($_REQUEST["emp_id"], "int"),
									GetSQLValueString($_REQUEST["week"], "text"),
									GetSQLValueString($_REQUEST["other_Notes"], "text"));
			$n1 = db_other_query($conn, $query1);
			
		
		
	 db_close($conn);	 
	header("Location: paycheck-list.php");	
	?>

