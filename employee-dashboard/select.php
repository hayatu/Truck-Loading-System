<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();	
	
	   $query1 = sprintf("select * tbl_package_info  where deleteflag = 0 and assign_status = 0 group by zone_name order by weight ASC" );
	$n = db_select_query($conn, $query1, $rs_package);	
	
    //   $query1 = sprintf("select * from tbl_package_info where deleteflag = 0 order by weight");
	//$n = db_select_query($conn, $query1, $rs_package);	
	db_close($conn);	
?>