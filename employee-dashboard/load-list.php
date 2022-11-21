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
	
	  $query1 = sprintf("select sup.load_id, sup.emp_id, sup.truck_id, sup.pick_up_price, sup.pick_up_location,sup.delivery_location,sup.other_Notes,sup.createdate,
	 tbl_employee_info.first_name, tbl_employee_info.last_name,tbl_vehicle_info.plat_number "
	."from tbl_load_info sup "
	."left join tbl_employee_info on sup.emp_id = tbl_employee_info.emp_id "
	."left join tbl_vehicle_info on sup.truck_id = tbl_vehicle_info.vehicle_id "
	."where tbl_employee_info.emp_id = %s and sup.deleteflag = 0 order by tbl_employee_info.first_name",
	 GetSQLValueString($_SESSION["emp_id"], "int"));
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
				<a href="index.php" class="btn btn-primary btn-block font-weight-bold" role="button">Back</a>				
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
					<th class="th-sm">Registration Date
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
						<td><?php echo $rs_load[$i]["createdate"]; ?></td>						
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
