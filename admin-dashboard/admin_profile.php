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
     $query1 = sprintf("select ai.admin_id, ai.first_name, ai.last_name,ai.email, ai.mobile,ai.address, tble_countries.country_name "
	."from tbl_admin_info ai "
	."left join tble_countries on ai.country_id = tble_countries.country_id "
	."where ai.admin_id = %s  and ai.deleteflag = 0 order by ai.first_name, tble_countries.country_name",
	 GetSQLValueString($_SESSION["admin_id"], "int"));
	$n = db_select_query($conn, $query1, $rs_admin);	
	db_close($conn);	
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->
<main class="pl-1 pt-1">
	<div class="container">
			
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<thead>
				
				<tr>
					<th class="th-sm">Firs Name
					</th>
					<th class="th-sm">Last Name
					</th>
					<th class="th-sm">Email Address
					</th>				
					
					<th class="th-sm">Mobile
					</th>
					
					<th class="th-sm">Country
					</th>					
					<th class="th-sm">Address
					</th>
					<th class="th-sm text-center" colspan="2">Action
					</th>
					<th class="th-sm" style="display: none">
					</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr>	
						<td><?php echo $rs_admin[$i]["first_name"]; ?></td>				
						<td><?php echo $rs_admin[$i]["last_name"]; ?></td>
						<td><?php echo $rs_admin[$i]["email"]; ?></td>		
						<td><?php echo $rs_admin[$i]["mobile"]; ?></td>
						<td><?php echo $rs_admin[$i]["country_name"]; ?></td>
						<td><?php echo $rs_admin[$i]["address"]; ?></td>
						<td><a href="administrator-update-form.php?admin-id=<?php echo $rs_admin[$i]["admin_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	

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

							<a href="#" data-href="admin_info_delete.php?admin-id=<?php echo $rs_admin[$i]["admin_id"]; ?>" data-toggle="modal" data-target="#confirm-delete" class="btn btn-sm" role="button"><i class="fas fa-trash-alt"></i></a>  

						<script>
						$('#confirm-delete').on('show.bs.modal', function(e) {
						$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

						 $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
						});
						</script>
						<!--Modal: modalConfirmDelete-->		
						</td>
						<td style="display: none"></td>
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
					
					<th>Country
					</th>
					<th>Address
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
