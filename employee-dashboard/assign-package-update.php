<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/mailer_func.php");
$conn = db_connect();
	 
    $query1 = sprintf("select first_name,last_name,mobile,vehicle_id from tbl_employee_info where emp_id = %s",
   GetSQLValueString($_REQUEST["emp_id"], "int"));
	$n1 = db_select_query($conn, $query1, $rs_employee);
	$emp_fullname = $rs_employee[0]["first_name"]." ".$rs_employee[0]["last_name"];
	$emp_phone = $rs_employee[0]["mobile"];
	$emp_vehicle_id = $rs_employee[0]["vehicle_id"];
	
if(isset($_POST['submit']))
{
	$n=count($_POST["package_id"]);
	
for($i=0;$i<$n;$i++){
	$package_id = $_POST['package_id'][$i];
	$current_loc = $_POST['current_loc'][$i];
	$destination = $_POST['destination'][$i];
	$delivery_time = $_POST['delivery_time'][$i];
	$status_id = $_POST['status_id'][$i];
	
 if($current_loc !='' && $destination !='' && $delivery_time != '' ){
    $query2 = sprintf("update tbl_package_info set emp_id = %s, current_loc = %s, destination = %s, delivery_time = %s, status_id= %s, assign_status = %s,  pickedby = %s, vehicle_id = %s WHERE package_id = %s",	
					GetSQLValueString($_REQUEST["emp_id"], "int"),
					GetSQLValueString($current_loc, "text"), 
					GetSQLValueString($destination, "text"),					
					GetSQLValueString($delivery_time, "text"),
					GetSQLValueString($status_id, "int"),
					GetSQLValueString($_REQUEST["assign_status"], "text"), 
					GetSQLValueString($_REQUEST["pickedby"], "text"),
					GetSQLValueString($emp_vehicle_id, "int"),
					GetSQLValueString($package_id, "int"));
			//GetSQLValueString($_REQUEST["emp_id"], "int"),		
	      $n2 = db_other_query($conn, $query2);
	}	
}
    $query1 = sprintf("select * , COUNT(*) as total from tbl_package_info where zone_name = %s and emp_id != 'NULL' ", GetSQLValueString($_REQUEST["zone-name"], "text"));
	 $n1 = db_select_query($conn, $query1, $rs_package);
		$total_packages = $rs_package[0]["total"];
		$detination_zone  = $rs_package[0]["zone_name"];
		//$total_packages;
		
		
	 	 $query2 = sprintf("select first_name, last_name,mobile,address,c_first_name,c_last_name,c_mobile,c_address,zone_name from tbl_package_info where zone_name = %s and emp_id != 'NULL' ", GetSQLValueString($_REQUEST["zone-name"], "text"));
	 $n2 = db_select_query($conn, $query2, $rs_info);
             $destin = $rs_info[0]["zone_name"];
       //Admin Mailer starts

		$mail             = new PHPMailer(); // defaults to using php "mail()"
		
		$body="";
		$body.="<b>Total Packages:"."</b>".$total_packages."<br/>";
		$body.="<b>Picked By: "."</b>".$emp_fullname."<br/>";
		$body.="<b>Employee Phone: "."</b>".$emp_phone."<br/>";
		$body.="<b>Zone Name: "."</b>".$destin."<br/>";
		for($i=0;$i<$n2;$i++){ 
		$body.="<b>Sender Full Name: "."</b>".$rs_info[$i]["first_name"]." ".$rs_info[$i]["last_name"].", ".""."<b>Mobile: "."</b>" ." ".$rs_info[$i]["mobile"].", "."".""."<b>Address: "."</b>" ." ".$rs_info[$i]["address"]."<br/>";
        $body.="<b>Reciever Full Name: "."</b>".$rs_info[$i]["c_first_name"]." ".$rs_info[$i]["c_last_name"].", ".""."<b>Mobile:"."</b>" ." ".$rs_info[$i]["c_mobile"].", "."".""."<b>Address:"."</b>" ." ".$rs_info[$i]["c_address"]."<br/>";
			
		}
    
		 $mail->From       = "info@hasskay.com";
		 $mail->FromName   = "Package Selection Notifications";

		$mail->Subject    = "Shipment Notifications";

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->MsgHTML($body);
		echo $body;

		$mail->AddAddress("kamaal_bd@yahoo.com"); 	
		$mail->AddBCC("bile132@gmail.com");
		$mail->AddBCC("abdirazakkaynan@gmail.com");

		if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		}
	db_close($conn);	
	//header("Location: assign-package-form.php?zone-name=".$_REQUEST["zone-name"]);
	header("Location: picked-package-list.php");
	
		}	
	?>

