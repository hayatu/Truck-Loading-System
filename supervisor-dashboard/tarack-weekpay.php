<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
$conn = db_connect();
  
if(isset($_POST["From"], $_POST["to"])){
	
	    $query1 = sprintf("select *, SUM(net_pay) as netpay_total, SUM(gross_pay_total) as grosspay_total,SUM(commission) as commission_total,
	  SUM(fuel) as fuel_total,SUM(insurance_fee) as insurance_fee_total,SUM(other_charges) as other_charges_total,
	 tbl_employee_info.first_name, tbl_employee_info.last_name "
	."from tbl_paycheck_info "
	."left join tbl_employee_info on tbl_paycheck_info.emp_id = tbl_employee_info.emp_id "	
	."where tbl_paycheck_info.emp_id = %s and sdate BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."' and tbl_paycheck_info.deleteflag = 0" ,
	GetSQLValueString($_REQUEST["emp_id"], "text"));

	$n = db_select_query($conn, $query1, $rs_paycheck);

	 db_close($conn);	 
	//header("Location: customer-list.php");	
	?>
	<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<link href="js/export/buttons.dataTables.min.css" rel="stylesheet" />
<!--<script src="js/export/jquery.dataTables.min.js"></script>-->
<script src="js/export/dataTables.buttons.min.js"></script>
<script src="js/export/jszip.min.js"></script>
<script src="js/export/pdfmake.min.js"></script>
<script src="js/export/vfs_fonts.js"></script>
<script src="js/export/buttons.html5.min.js"></script>
<main class="pl-1 pt-1">
<div class="container">
<!--Section: Main panel-->
<section class="mb-3">
<!--Card-->
<div class="card card-cascade narrower">
	<!--Section: Table-->
	<section class="text-dark">
		<!--Top Table UI-->
		<div class="table-ui p-0 mb-0 mx-0 mb-0">
			<!--Grid row-->
			<h6 class="font-weight-bold pl-2 pt-1">Supervisor Dashboard</h6>
			<hr class="light-blue lighten-1 title-hr">
			<!--Grid row-->
		</div>
		<!--Top Table UI-->
	</section>
	<!--Section: Table-->
</div>
<!--/.Card-->
</section>
<!--Section: Main panel-->   

<main class="pl-1 pt-1">
	<div class="container">
	<?php include("track-weeklypay-form.php"); ?>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<!--<div class="row">
				<div class="col-md-12 p-2">
					<p class="text-center font-weight-bold card-header  warning-color"> Weekly Pay total : <i class="fas fa-dollar-sign fa-sm"></i> <?php //echo $sum_grosspay;  ?></p>
				</div>
			</div>-->
		
			<thead>
				
				<tr>
				
				<th class="th-sm">Gross Pay Total
					</th>
					<th class="th-sm">Commission (12%) Total	
					</th>
					<th class="th-sm">Fuel Fee Total
					</th>	
					<th class="th-sm">Insurance Fee	Total 
					</th>						
					<th class="th-sm">Othere Charges Total	
					</th>	
					<th class="th-sm">Net Pay Total
					</th>
				
					<th class="th-sm">Employee Full Name
					</th>	
					 <th class="th-sm">Truck Number
					</th>
					<th class="th-sm">Start Date 
					</th>
					<th class="th-sm">End Date
					</th>	
										
					<!--<th class="th-sm">Update
					</th>					
					<th class="th-sm"> Delete
					</th>	-->				
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr>
					    <td><?php echo "$" .$rs_paycheck[$i]["grosspay_total"] ; ?></td>
						<td><?php echo "$" .$rs_paycheck[$i]["commission_total"]; ?></td>				
						<td><?php echo "$" .$rs_paycheck[$i]["fuel_total"]; ?></td>
						<td><?php echo "$" .$rs_paycheck[$i]["insurance_fee_total"]; ?></td>
                       <td><?php echo "$" .$rs_paycheck[$i]["other_charges_total"]; ?></td>						
						<td><?php echo "$" .$rs_paycheck[$i]["netpay_total"]; ?></td>						
						<td><?php echo $rs_paycheck[$i]["first_name"]." " .$rs_paycheck[$i]["last_name"]; ?></td> 
						<td><?php echo $rs_paycheck[$i]["truck_id"]; ?></td>
						<td><?php $orgDate =  $_POST["From"]; $newFromdate = date("m-d-Y", strtotime($orgDate));  echo $newFromdate;  ?></td>
						<td><?php $orgDate =  $_POST["to"]; $newTodate = date("m-d-Y", strtotime($orgDate));  echo $newTodate;  ?></td>		
					</tr>
					<?php
					}
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
				 <th>Gross pay total
					</th>
					<th>Commission (12%)	
					</th>
					<th>Fuel Fee 
					</th>	
					<th>Insurance Fee	 
					</th>						
					<th>Othere Charges	
					</th>	
					<th>Net Pay Total
					</th>
					
					<th>Employee Full Name
					</th>
                    <th>Truck Number
					</th>
					<th>Start Date
					</th>					
					<th>End Date
					</th>
					<!--<th>Update
					</th>					
					<th> Delete
					</th>-->						
				</tr>
			</tfoot>
		</table>
	</div>
	
	<script>
		$(document).ready(function () {
		$('#dtBasicExample').DataTable(
		{
               
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Weekly Report',
                        text:'Export to excel'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3,4,5,6]
                       // }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Weekly Report',
                        text: 'Export to PDF'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3, 4, 5, 6]
                      //  }
                    }
                ]
            }
		
		);
		$('.dataTables_length').addClass('bs-select');
		});
		</script>	
</div>
</main>

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
