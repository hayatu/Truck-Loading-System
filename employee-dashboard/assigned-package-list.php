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
	$query1 = sprintf("select pack.package_id, pack.emp_id, pack.track_num, pack.weight,pack.quantity,pack.is_fragile,pack.first_name as fname,pack.last_name as lname, 
	pack.current_loc,pack.destination,pack.status_id,pack.zone_name, pack.commnts, pack.city_name, pack.c_first_name,pack.c_last_name,pack.c_mobile, pack.createdate,
    pack.pickupprice,	
	tbl_employee_info.emp_id, tbl_status_info.status "
	."from tbl_package_info pack "
	."left join tbl_employee_info on pack.emp_id = tbl_employee_info.emp_id "
	."left join tbl_status_info on pack.status_id = tbl_status_info.status_id "
	."where tbl_employee_info.emp_id = %s and  pack.deleteflag = 0 and assign_status = 1  and pickedby = 0 and tbl_status_info.status_id <>2  order by pack.weight ASC",
	 GetSQLValueString($_SESSION["emp_id"], "int"));	  
	$n = db_select_query($conn, $query1, $rs_package);	    	
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
			<span class="btn btn-primary btn-block font-weight-bold" role="button"> Assigned Package List</span>				
			</div>								
		</div>
		
			<thead>
				<tr>
				 <th class="th-sm">Truck Number
				 </th>
				 <th class="th-sm">Status
				 </th>
					<th class="th-sm">Package Weight
					</th>
					<th class="th-sm">Pickup Price
					</th>
					<th class="th-sm">Current location 
					</th>
					<th class="th-sm">Destination
					</th>	
					<th class="th-sm">Reciever Full Name 
					</th>	
                     <th class="th-sm">Reciever Phone 
					</th>						
					<th class="th-sm">Quantity 
					</th>				
                    <th class="th-sm">Is fragile
					</th>	
					<th class="th-sm">Zone
					</th>	
                    <th class="th-sm">City
					</th>	
					<th class="th-sm">Registration Date
					</th>
					<th class="th-sm text-center">View
					</th>
					<th class="th-sm text-center">Direction
					</th>
					<th class="th-sm">Comment
					</th>	
					
				</tr>
			</thead>
			
			<tbody>
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr>	
					    <td><?php echo $rs_package[$i]["track_num"]; ?></td>
						<td><?php echo $rs_package[$i]["status"]; ?></td>
						<td><?php echo $rs_package[$i]["weight"]; ?></td>	
                        <td><?php echo $rs_package[$i]["pickupprice"]."$"; ?></td>						
						<td><?php echo $rs_package[$i]["current_loc"]; ?></td>
						<td><?php echo $rs_package[$i]["destination"]; ?></td>
						<td><?php echo $rs_package[$i]["c_first_name"]." ".$rs_package[$i]["c_last_name"]; ?></td>
						<td><?php echo $rs_package[$i]["c_mobile"]; ?></td>						
						<td><?php echo $rs_package[$i]["quantity"]; ?></td>													
						<td><?php echo $rs_package[$i]["is_fragile"]; ?></td>
						<td><?php echo $rs_package[$i]["zone_name"]; ?></td>	
						<td><?php echo $rs_package[$i]["city_name"]; ?></td>						
						<td><?php echo $rs_package[$i]["createdate"]; ?></td>
						
						<td><a href="assigned-package-update-form.php?package-id=<?php echo $rs_package[$i]["package_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>
						<td>
							<form action="http://maps.google.com/maps" method="get" target="_blank">
								<input type="hidden" name="saddr" value="<?php echo $rs_package[$i]["current_loc"]; ?>" />
								<input type="hidden" name="daddr" value="<?php echo $rs_package[$i]["destination"]; ?>" />
								<input type="submit" value="Get directions" />
							</form>
						</td>
						<td><?php echo $rs_package[$i]["commnts"]; ?></td>	
					 </tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
				 <th>Truck Number
				 </th>
				 <th>Status
				 </th>
					<th>Package Weight
					</th>
					<th>Pickup Price
					</th>
					<th>Current location 
					</th>
					<th>Destination
					</th>	
					<th>Reciever Full Name 
					</th>	
                     <th>Reciever Phone 
					</th>						
					<th>Quantity 
					</th>				
                    <th>Is fragile
					</th>	
					<th>Zone
					</th>	
                    <th>City
					</th>	
					<th>Registration Date
					</th>
					<th>View
					</th>
					<th>Direction
					</th>
					<th>Comment
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
