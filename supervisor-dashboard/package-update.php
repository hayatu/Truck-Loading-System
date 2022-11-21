<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
$conn = db_connect();

           $query2 = sprintf("update tbl_package_info set weight = %s, criteria = %s, quantity= %s ,description = %s, pickupprice = %s, is_fragile = %s, zone_name = %s , city_name = %s,first_name = %s, last_name = %s, email= %s, mobile = %s, address = %s, country_id = %s,c_first_name = %s, c_last_name = %s, c_email= %s, c_mobile = %s, c_address = %s, c_country_id = %s,current_loc = %s,destination = %s, departure_time = %s  where package_id = %s",						
								GetSQLValueString($_REQUEST["weight"], "text"),
								GetSQLValueString($_REQUEST["criteria"], "text"),							
								GetSQLValueString($_REQUEST["quantity"], "text"),									
								GetSQLValueString($_REQUEST["description"], "text"),
								GetSQLValueString($_REQUEST["pickupprice"], "text"),	
								GetSQLValueString($_REQUEST["is_fragile"], "text"),	
								GetSQLValueString($_REQUEST["zone_name"], "text"),
								GetSQLValueString($_REQUEST["city_name"], "text"),
								GetSQLValueString($_REQUEST["first_name"], "text"),
								GetSQLValueString($_REQUEST["last_name"], "text"),																		
								GetSQLValueString($_REQUEST["email"], "text"),							
								GetSQLValueString($_REQUEST["mobile"], "text"),
								GetSQLValueString($_REQUEST["address"], "text"),
								GetSQLValueString($_REQUEST["country_id"], "int"),
								GetSQLValueString($_REQUEST["c_first_name"], "text"),
								GetSQLValueString($_REQUEST["c_last_name"], "text"),							
								GetSQLValueString($_REQUEST["c_email"], "text"),							
								GetSQLValueString($_REQUEST["c_mobile"], "text"),									
								GetSQLValueString($_REQUEST["c_address"], "text"),																	
								GetSQLValueString($_REQUEST["c_country_id"], "int"),
                                GetSQLValueString($_REQUEST["current_loc"], "text"),
                                GetSQLValueString($_REQUEST["destination"], "text"),
                               GetSQLValueString($_REQUEST["departure_time"], "text"),								
								GetSQLValueString($_REQUEST["package-id"], "int"));
	$n2 = db_other_query($conn, $query2);	
			
	db_close($conn);	
	header("Location: package-list.php");
	?>
 
