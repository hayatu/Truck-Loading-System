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
	
	  $query1 = sprintf("select *, COUNT(*) as total from tbl_package_info  where deleteflag = 0 and assign_status = 0 group by zone_name order by weight ASC" );
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
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
		<div class="row">
			<div class="col-md-6">
			<a href="available_package-list.php" class="btn btn-block font-weight-bold text-dark" role="button" style="background-color:#d1ecf1"> Available Packages List</a>				
			</div>	
			
			<div class="col-md-6">
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
					<th class="th-sm">Pickup Price
					</th>
					<th class="th-sm">Zone
					</th>
					<th class="th-sm">City
					</th>				
                    <th class="th-sm">Is fragile
					</th>	
					 <th class="th-sm">Reciever Full Name
					</th>
					<th class="th-sm">Reciever Phone
					</th>
					<th class="th-sm">Total Packages
					</th>
					<th class="th-sm">Registration Date
					</th>
					
					<th class="th-sm">Select/Pick Package
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
						<td><?php echo $rs_package[$i]["pickupprice"]."$"; ?></td>	
						<td><?php echo $rs_package[$i]["zone_name"]; ?></td>
						<td><?php echo $rs_package[$i]["city_name"]; ?></td>
						<td><?php echo $rs_package[$i]["is_fragile"]; ?></td> 
						<td><?php echo $rs_package[$i]["c_first_name"]." " .$rs_package[$i]["c_last_name"]; ?></td>
						<td><?php echo $rs_package[$i]["c_mobile"]; ?></td> 						 
                        <td><?php echo $rs_package[$i]["total"]." Packages"." to"." " .$rs_package[$i]["zone_name"] ; ?></td>						
						<td><?php echo $rs_package[$i]["createdate"]; ?></td>
						<td><a href="assign-package-form.php?zone-name=<?php echo $rs_package[$i]["zone_name"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-box-open"></i></a></td>
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
					<th>Pickup Price
					</th>
					<th>Zone
					</th>
					<th>City
					</th>				
                    <th>Is fragile
					</th>	
					 <th>Reciever Full Name
					</th>
					<th>Reciever Phone
					</th>
					<th>Total Packages
					</th>
					<th>Registration Date
					</th>
					<th>Select/Pick Package
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
