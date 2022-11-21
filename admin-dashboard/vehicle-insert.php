<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();
  
 if($_REQUEST["plat_number"] != ""){
 
       $plat_number = $_REQUEST['plat_number'];
		$query = sprintf("SELECT plat_number FROM tbl_vehicle_info where plat_number = %s ", GetSQLValueString($_REQUEST["plat_number"], "text"));
		$n = db_select_query($conn, $query, $rs_vehicle);

		if($n > 0){
		// do not insert
		echo " <div class='container pt-3'> 	
			<div class='alert alert-danger' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				 The Plate Number already exists!.
				 <button class='btn btn-primary btn-sm btn-link'><a href='vehicle-registration-form.php'><span class='text-white'>Go Back</span></a></button>
			</div>
		</div>";
		exit();
		} else {
			// insert 
			 echo  $query1 = sprintf("insert into tbl_vehicle_info(made_model, plat_number) values(%s,%s)", 
			GetSQLValueString($_REQUEST["made_model"], "text"),
			GetSQLValueString($_REQUEST["plat_number"], "int"));
			$n1 = db_other_query($conn, $query1);
		} 	
		
	 db_close($conn);	 
	header("Location: vehicle-list.php");	
	} 
	?>

