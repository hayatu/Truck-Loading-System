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
	
	 $query1 = sprintf("select sup.load_id, sup.emp_id, sup.truck_id, sup.pick_up_price, sup.pick_up_location,sup.delivery_location,sup.other_Notes,sup.week_name,sup.sdate, sup.edate,
	 tbl_employee_info.first_name, tbl_employee_info.last_name,tbl_vehicle_info.plat_number "
	."from tbl_load_info sup "
	."left join tbl_employee_info on sup.emp_id = tbl_employee_info.emp_id "
	."left join tbl_vehicle_info on sup.truck_id = tbl_vehicle_info.vehicle_id "
	."where sup.deleteflag = 0 order by tbl_employee_info.first_name");
	$n = db_select_query($conn, $query1, $rs_load);
    
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->

<main class="pl-1 pt-1">
	<div class="container">
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
		<div class="row">
		<div class="col-md-12">
				<a href="load-registration-form.php" class="btn btn-primary btn-block font-weight-bold" role="button"> Add (<i class="fas fa-plus"></i>) New Load</a>
			</div>		
		</div>
				
			<thead>
				
				<tr>
				<th class="th-sm">Pickup Price
					</th>
					<th class="th-sm">Pickup Location
					</th>
					<th class="th-sm">Delivery Location 
					</th>	
					<th class="th-sm">Other Notes Needed 
					</th>						
					<th class="th-sm">Employee Full Name
					</th>	
					<th class="th-sm">Truck Number
					</th>
					<th class="th-sm">Week Name
					</th>
					<th class="th-sm">Start Date
					</th>
					<th class="th-sm">End Date
					</th>
					<th class="th-sm">Add Paycheck
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
					    <td><?php echo $rs_load[$i]["pick_up_price"]; ?></td>
						<td><?php echo $rs_load[$i]["pick_up_location"]; ?></td>				
						<td><?php echo $rs_load[$i]["delivery_location"]; ?></td>
						<td><?php echo $rs_load[$i]["other_Notes"]; ?></td>							
                        <td><?php echo $rs_load[$i]["first_name"]." " .$rs_load[$i]["last_name"]; ?></td> 						
						<td><?php echo $rs_load[$i]["plat_number"]; ?></td>
						<td><?php echo $rs_load[$i]["week_name"]; ?></td>	
						<td><?php $orgDate =  $rs_load[$i]["sdate"]; $newSdate = date("m-d-Y", strtotime($orgDate));  echo $newSdate;  ?> </td>
						<td><?php $orgDate =  $rs_load[$i]["edate"]; $newEdate = date("m-d-Y", strtotime($orgDate));  echo $newEdate;  ?></td>							
						<td><a href="weekly-pay-form.php?load-id=<?php echo $rs_load[$i]["load_id"]; ?>&emp-id=<?php echo $rs_load[$i]["emp_id"]; ?> &week-name=<?php echo $rs_load[$i]["week_name"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-plus"></i></a></td>
                        <td><a href="load-update-form.php?load-id=<?php echo $rs_load[$i]["load_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	                       						
						<td>						
						<!-- Delete trigger modal-->
							<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header pl-5">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
										</div>
										<div class="modal-body">
											<p>You are about to delete one track, this procedure is irreversible.</p>
											<p>Do you want to proceed?</p>
											<p class="debug-url"></p>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
											<a class="btn btn-danger btn-ok">Yes</a>
										</div>
									</div>
								</div>
							</div>

							<a href="#" data-href="load_info_delete.php?load-id=<?php echo $rs_load[$i]["load_id"]; ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>  

						<script>
						$('#confirm-delete').on('show.bs.modal', function(e) {
						$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

						 $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
						});
						</script>
						<!--Modal: modalConfirmDelete-->		
						</td>
						<td> </td>
						
					</tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
				 <th>Pickup Price
					</th>
					<th>Pickup Location
					</th>
					<th>Delivery Location 
					</th>	
					<th >Other Notes Needed 
					</th>						
					<th>Employee Full Name
					</th>	
					<th>Truck Number
					</th>
					<th>Week Name
					</th>	
					<th>Start Date
					</th>
					<th>End Date
					</th>
					<th>Add Paycheck
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
