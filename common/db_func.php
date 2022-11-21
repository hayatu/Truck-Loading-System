<?php
/*
Prepared By: Comp. Eng. Ciisecarab
Date : 23.12.2020
Purpose : Some commomly used database functions are coded as such to make the reusability and readability of the code easier.
Needs: A preincluded php script file called db_config.php which defines or gives values to the following variables:
                $DBTYPE
                $DBNAME
                $HOST
                $PORT
                $USERNAME
                $PASSWORD
*/

include_once("db_conf.php");

if ( !check_db_variables() ) exit(1);

if ( $LANGUAGE == "ENGLISH" ) include_once("messages_en.php");
if ($DBTYPE == "MYSQLI") include_once("mysqli_func.php");
include_once("general_func.php");
//include_once($SPECIAL_FUNCTIONS_DIRECTORY."/".$SPECIAL_FUNCTIONS_FILE);

?>
