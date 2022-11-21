<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


//DATABASE CONNECTION PARAMETERS

//$DBTYPE variable currently supports "MYSQL" and "ORACLE" values.
$DBTYPE = "MYSQLI";

//$DBNAME is the name of the database.
$DBNAME = "";

//The database server's IP or machine name. "localhost" can be used if the WEB server is on the same machine.
//$HOST = "176.235.141.70";
$HOST = "";
//The database server' s port number
$PORT = "";

//For Oracle DB' s only : The SID of the database
$SID = "";

// The Username used to access the database
$USERNAME = "root";

//The password used to access the database
$PASSWORD = "";

//DIRECTORY PATHS and SPECIAL FILES USED

//$SUCCESS_STORY_Image_DIR =  $_SERVER["DOCUMENT_ROOT"]."Source/Repos/OicHealthPhpMdb/editor/img/";
$OIC_HEALTH_Image_DIR = $_SERVER['DOCUMENT_ROOT'].'/';
//LANGUAGE SELECTION FOR MESSAGES

$LANGUAGE = "ENGLISH";

//****************************************************************************************************************

//Checks variables needed to access the database
//On success returns 1
//On failure echos error message and returns 0

function check_db_variables()
{
	if ( empty( $GLOBALS["USERNAME"] ) ){
		echo db_error(3);
		return 0;
	}
    if( empty( $GLOBALS["HOST"] ) ){
		echo db_error(0);
        return 0;
    }
    if( empty( $GLOBALS["DBNAME"] ) ){
		echo db_error(1);
		return 0;
    }
	if( empty( $GLOBALS["DBTYPE"] ) ){
		echo db_error(2);
		return 0;
    }
	return 1;
}
?>
