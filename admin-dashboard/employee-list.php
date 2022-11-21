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
     $query1 = sprintf("select sup.emp_id, sup.vehicle_id, sup.first_name, sup.last_name,sup.email,sup.mobile,sup.address, sup.createdate,sup.vehicle_id, tble_countries.country_name,
	 tbl_vehicle_info.plat_number,tbl_vehicle_info.made_model "
	."from tbl_employee_info sup "
	."left join tble_countries on sup.country_id = tble_countries.country_id "
	."left join tbl_vehicle_info on sup.vehicle_id = tbl_vehicle_info.vehicle_id "
	."where sup.deleteflag = 0 order by sup.first_name, tble_countries.country_name");
	$n = db_select_query($conn, $query1, $rs_employee);	
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->
<main class="pl-1 pt-1">
	<div class="container">
			<div class="row p-1">
			<div class="col-md-12">
				<a href="employee-registration-form.php" class="btn btn-primary btn-block font-weight-bold" role="button"> Add (<i class="fas fa-plus"></i>) Employee info</a>
			</div>	
			
			</div>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
		
			<thead>
				
				<tr>
					<th class="th-sm">First Name
					</th>
					<th class="th-sm">Last Name
					</th>
					<th class="th-sm">Email Address
					</th>					
					<th class="th-sm">Mobile
					</th>	
					<th class="th-sm">Address
					</th>					
					<th class="th-sm">Country
					</th>	
					<th class="th-sm">Plate Number
					</th>	
					  <th class="th-sm">Vehicle Model
					</th>
					<th class="th-sm">Registration Date
					</th>					
					
					<th class="th-sm">Update
					</th>
					<th class="th-sm">Delete
					</th>
					
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr>	
						<td><?php echo $rs_employee[$i]["first_name"]; ?></td>				
						<td><?php echo $rs_employee[$i]["last_name"]; ?></td>						
						<td><?php echo $rs_employee[$i]["email"]; ?></td>			
						<td><?php echo $rs_employee[$i]["mobile"]; ?></td>
						<td><?php echo $rs_employee[$i]["address"]; ?></td>
						<td><?php echo $rs_employee[$i]["country_name"]; ?></td>
						<td><?php echo $rs_employee[$i]["plat_number"]; ?></td>
						<td><?php echo $rs_employee[$i]["made_model"]; ?></td>
						<td><?php echo $rs_employee[$i]["createdate"]; ?></td>						
						<td><a href="employee-update-form.php?emp-id=<?php echo $rs_employee[$i]["emp_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	

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

							<a href="#" data-href="employee_info_delete.php?emp-id=<?php echo $rs_employee[$i]["emp_id"]; ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>  

						<script>
						$('#confirm-delete').on('show.bs.modal', function(e) {
						$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

						 $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
						});
						</script>
						<!--Modal: modalConfirmDelete-->		
						</td>
						
					</tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
					<th>Firs Name
					</th>
					<th>Last Name
					</th>
					<th>Email Address
					</th>		
					<th>Mobile
					</th>	
					<th>Address
					</th>					
					<th>Country
					</th>
					<th>Plate Number
					</th>
					<th>Vehicle Model
					</th>
					<th>Registration Date
					</th>	
					<th>Update
					</th>
					<th>Delete
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
