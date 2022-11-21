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
	
	  $query1 = sprintf("select sup.vehicle_id, sup.made_model, sup.plat_number, sup.createdate,
	 tbl_employee_info.vehicle_id, tbl_employee_info.emp_id "
	."from tbl_vehicle_info sup "
	."left join tbl_employee_info on sup.vehicle_id = tbl_employee_info.vehicle_id "
	//."left join tbl_vehicle_info on sup.truck_id = tbl_vehicle_info.vehicle_id "
	."where tbl_employee_info.emp_id = %s and sup.deleteflag = 0 order by tbl_employee_info.emp_id",
	 GetSQLValueString($_SESSION["emp_id"], "int"));
	$n = db_select_query($conn, $query1, $rs_vehicle);
   			
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
					<a href="index.php" class="btn btn-primary btn-block font-weight-bold p-2" role="button">Back</a>
				</div>	
			</div>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="th-sm">Truck Made Model
					</th>
					<th class="th-sm">Truck Number 
					</th>
					<th class="th-sm">Registration Date
					</th>				
				</tr>
			</thead>
			<tbody>
				<?php
				for($i=0; $i<$n; $i++){
				?>
				<tr>	
					<td><?php echo $rs_vehicle[$i]["made_model"]; ?></td>				
					<td><?php echo $rs_vehicle[$i]["plat_number"]; ?></td>
					<td><?php echo $rs_vehicle[$i]["createdate"]; ?></td> 
				</tr>
				<?php
				}
				?>  
				</tbody>
			<tfoot>
			<tr>
			<th>Truck Made Model  
			</th>
			<th>Truck Number
			</th>	
			<th>Registration Date
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
