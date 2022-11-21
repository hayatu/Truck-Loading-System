<?php
require_once("authenticate.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();
 
 $delition_date = date("y-m-d H:i:s");
$username = $_SESSION["first_name"];

	$query = sprintf("update tbl_employee_info set deleteflag = 1, deletedate= '$delition_date', deletedby = '$username'  where emp_id = %s", GetSQLValueString($_REQUEST["emp-id"], "int") );
	
	$n1 = db_other_query($conn, $query);	
db_close($conn);
header("Location: employee-list.php");
?>

