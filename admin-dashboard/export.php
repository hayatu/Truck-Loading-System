<?php  
//export.php  
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();	
$output = '';
if(isset($_POST["export"]))
{
  $query1 = sprintf("select paycheck_id, gross_pay_total, commission, fuel, insurance_fee,other_charges,net_pay,createdate
	 	from tbl_paycheck_info sup where deleteflag = 0 order by gross_pay_total ");
	$n = db_select_query($conn, $query1, $rs_paycheck);
	
	
	
 if($n > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Gross pay total</th>  
                         <th>Commission (12%)	</th>  
                         <th>Fuel Fee</th>  
       <th>Insurance Fee</th>
       <th>Othere Charges</th>
	    <th>Net Pay</th>
                    </tr>
  ';
  	for($i=0; $i<$n; $i++)
  {
   $output .= '
    <tr>  
                         <td>'.$rs_export[$i]["gross_pay_total"].'</td>  
                         <td>'.$rs_export[$i]["commission"].'</td>  
                         <td>'.$rs_export[$i]["fuel"].'</td>  
       <td>'.$rs_export[$i]["insurance_fee"].'</td>  
       <td>'.$rs_export[$i]["other_charges"].'</td>
	   <td>'.$rs_export[$i]["net_pay"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
  //db_close($conn);	
 }
}
?>