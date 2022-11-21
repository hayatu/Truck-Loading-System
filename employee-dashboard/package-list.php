<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();	
	
	  $query1 = sprintf("select *, COUNT(*) as total from tbl_package_info  where deleteflag = 0 and assign_status = 0 group by zone_name" );
	$n = db_select_query($conn, $query1, $rs_package);	

    //   $query1 = sprintf("select * from tbl_package_info where deleteflag = 0 order by weight");
	//$n = db_select_query($conn, $query1, $rs_package);	
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->

<main class="pl-1 pt-1">
	<div class="container">
			<?php include("track-package-form.php"); ?>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
		<div class="row">
		<div class="col-md-3">
				<a href="package-registration-form.php" class="btn btn-primary btn-block font-weight-bold" role="button"> Add (<i class="fas fa-plus"></i>) New Package</a>
			</div>	
			<div class="col-md-3">
			<a href="package-list.php" class="btn btn-block font-weight-bold text-dark" role="button" style="background-color:#d1ecf1"> Available Packages List</a>				
			</div>	
			<div class="col-md-3">
				<a href="picked-package-list.php" class="btn btn-primary btn-block font-weight-bold" role="button">Picked Package List</a>				
			</div>	
			<div class="col-md-3">
				<a href="assigned-package-list.php" class="btn btn-primary btn-block font-weight-bold" role="button"> Assigned Package List</a>				
			</div>				
		</div>
				
			<thead>
				
				<tr>
				<th class="th-sm">Truck Number
					</th>
					<th class="th-sm">Package Weight
					</th>
					<th class="th-sm">Criteria 
					</th>	
					<th class="th-sm">Quantity 
					</th>						
					<th class="th-sm">Description
					</th>	
					<th class="th-sm">Zone
					</th>
					<th class="th-sm">City
					</th>
					<th class="th-sm">Pickup Price
					</th>
                    <th class="th-sm">Is fragile
					</th>
                     <th class="th-sm">Sender Full Name
					</th>	
                   <th class="th-sm">Sender Phone
					</th>					
					<th class="th-sm">Registration Date
					</th>
					<th class="th-sm">Total
					</th>
					<th class="th-sm">Comment
					</th>
					
					<th class="th-sm">Assign
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
					<tr class="alert-info">
					
					    <td><?php echo $rs_package[$i]["track_num"]; ?></td>
						<td><?php echo $rs_package[$i]["weight"]; ?></td>				
						<td><?php echo $rs_package[$i]["criteria"]; ?></td>
						<td><?php echo $rs_package[$i]["quantity"]; ?></td>	
						<td><?php echo $rs_package[$i]["description"]; ?></td>
						<td><?php echo $rs_package[$i]["zone_name"]; ?></td>
						<td><?php echo $rs_package[$i]["city_name"]; ?></td>
						<td><?php echo $rs_package[$i]["pickupprice"]; ?></td>	
						<td><?php echo $rs_package[$i]["is_fragile"]; ?></td> 
                        <td><?php echo $rs_package[$i]["first_name"]." " .$rs_package[$i]["last_name"]; ?></td> 						
						<td><?php echo $rs_package[$i]["mobile"]; ?></td>
						<td><?php echo $rs_package[$i]["createdate"]; ?></td>
						<td><?php echo $rs_package[$i]["total"]." Packages"." to"." " .$rs_package[$i]["zone_name"] ; ?></td>
						<td><?php echo $rs_package[$i]["commnts"]; ?></td>
						<td><a href="assign-package-form.php?package-id=<?php echo $rs_package[$i]["package_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-hand-holding fa-lg"></i></a></td>
                       <td><a href="package-update-form.php?package-id=<?php echo $rs_package[$i]["package_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>							

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

							<a href="#" data-href="package_info_delete.php?package-id=<?php echo $rs_package[$i]["package_id"]; ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>  

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
				 <th>Truck Number
					</th>
					<th>Package Weight
					</th>
					<th>Criteria
					</th>	
					<th>Quantity
					</th>						
					<th>Description
					</th>
					<th>Zone
					</th>
					<th>City
					</th>
					<th>Pickup Price
					</th>					
					<th>Is fragile
					</th>
                    <th>Sender Full Name
					</th>	
                     <th>Sender Phone
					</th>						
					<th>Registration Date
					</th>
					<th>Total
					</th>
					<th>Comment
					</th>	
											
					<th>Assign
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
