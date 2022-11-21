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
	
	 $query1 = sprintf("select sup.paycheck_id, sup.emp_id, sup.gross_pay_total, sup.commission, sup.fuel,sup.insurance_fee,sup.other_charges, sup.net_pay, sup.sdate, sup.truck_id, sup.edate,sup.week_name,sup.other_Notes,
	 tbl_employee_info.first_name, tbl_employee_info.last_name "
	."from tbl_paycheck_info sup "
	."left join tbl_employee_info on sup.emp_id = tbl_employee_info.emp_id "	
	."where sup.deleteflag = 0 order by tbl_employee_info.first_name");
	 
	 //$query1 = sprintf("select paycheck_id, gross_pay_total, commission, fuel, insurance_fee,other_charges,net_pay,createdate
	 	//from tbl_paycheck_info sup where deleteflag = 0 order by gross_pay_total ");
	$n = db_select_query($conn, $query1, $rs_paycheck);
	
	 $query2 = sprintf("select SUM(gross_pay_total) as total from tbl_paycheck_info where deleteflag = 0 order by gross_pay_total");
	$n2 = db_select_query($conn, $query2, $rs_grosspay);
	$sum_grosspay = $rs_grosspay[0]["total"];	
    
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->

<main class="pl-1 pt-1">
	<div class="container">
	 <?php include("track-weeklypay-form.php"); ?>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<div class="row">
				<div class="col-md-12">
					<a href="load-list.php" class="btn btn-primary btn-block font-weight-bold" role="button"> Add (<i class="fas fa-plus"></i>) New Paycheck</a>
				</div>
				<div class="col-md-12 p-2">
					<p class="text-center font-weight-bold card-header  warning-color"> Yearly total : <i class="fas fa-dollar-sign fa-sm"></i> <?php echo $sum_grosspay;  ?></p>
				</div>
				
			</div>
			 		
			
			<thead>
				
				<tr>
				<th class="th-sm">Gross pay
					</th>
					<th class="th-sm">Commission (12%)	
					</th>
					<th class="th-sm">Fuel Fee 
					</th>	
					<th class="th-sm">Insurance Fee	 
					</th>						
					<th class="th-sm">Othere Charges	
					</th>	
					<th class="th-sm">Net Pay
					</th>
					<th class="th-sm">Truck Number
					</th>	
					<th class="th-sm">Employee Full Name
					</th>
                    <th class="th-sm">Week Name
					</th>	
					<th class="th-sm">Other Notes
					</th>						
					<th class="th-sm">Start Date
					</th>	
					<th class="th-sm">End Date
					</th>	
										
					<th class="th-sm">Update
					</th>					
					<th class="th-sm"> Delete
					</th>					
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr>
					    <td><i class="fas fa-dollar-sign fa-sm text-black-50"></i><?php echo $rs_paycheck[$i]["gross_pay_total"]; ?></td>
						<td><i class="fas fa-dollar-sign fa-sm text-black-50"></i><?php echo $rs_paycheck[$i]["commission"]; ?></td>				
						<td><i class="fas fa-dollar-sign fa-sm text-black-50"></i><?php echo $rs_paycheck[$i]["fuel"]; ?></td>
						<td><i class="fas fa-dollar-sign fa-sm text-black-50"></i><?php echo $rs_paycheck[$i]["insurance_fee"]; ?></td>
                       <td><i class="fas fa-dollar-sign fa-sm text-black-50"></i><?php echo $rs_paycheck[$i]["other_charges"]; ?></td>						
						<td><i class="fas fa-dollar-sign fa-sm text-black-50"></i><?php echo $rs_paycheck[$i]["net_pay"]; ?></td>
						 <td><?php echo $rs_paycheck[$i]["truck_id"]; ?></td>
						<td><?php echo $rs_paycheck[$i]["first_name"]." " .$rs_paycheck[$i]["last_name"]; ?></td>
						<td><?php echo $rs_paycheck[$i]["week_name"]; ?></td>	
						<td><?php echo $rs_paycheck[$i]["other_Notes"]; ?></td>							
						  <td><?php $orgDate =  $rs_paycheck[$i]["sdate"]; $newSdate = date("m-d-Y", strtotime($orgDate));  echo $newSdate;  ?> </td>
						<td><?php $orgDate =  $rs_paycheck[$i]["edate"]; $newEdate = date("m-d-Y", strtotime($orgDate));  echo $newEdate;  ?></td>					
						<td><a href="paycheck-update-form.php?paycheck-id=<?php echo $rs_paycheck[$i]["paycheck_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	                        
						<td>						
						<!-- Delete trigger modal-->
							<a href="load_info_delete.php?load-id=<?php echo $rs_load[$i]["load_id"]; ?>" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this record')"><i class="fas fa-trash-alt"></i></a>
						<!--Modal: modalConfirmDelete-->		
						</td>
						
						
					</tr>
					<?php
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
					<th>Net Pay
					</th>
					<th>Truck Number
					</th>	
					<th>Employee Full Name
					</th>	
					   <th>Week Name
					</th>	
					 <th>Other Notes
					</th>	
					<th>Start Date 
					</th>	
					<th>End Date
					</th>
					<th>Update
					</th>					
					<th> Delete
					</th>						
				</tr>
			</tfoot>
		</table>
	</div>
	
	<script>
		$(document).ready(function () {
			$('#dtBasicExample').DataTable();
			$('.dataTables_length').addClass('bs-select');
		});
	</script>	
</div>
</main>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
