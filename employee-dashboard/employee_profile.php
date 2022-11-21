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
      $query1 = sprintf("select emp.emp_id, emp.first_name, emp.last_name,emp.email, emp.mobile,emp.address, tble_countries.country_name "
	."from tbl_employee_info emp "
	."left join tble_countries on emp.country_id = tble_countries.country_id "
	."where emp.emp_id = %s  and emp.deleteflag = 0 order by emp.first_name, tble_countries.country_name",
	 GetSQLValueString($_SESSION["emp_id"], "int"));
	$n = db_select_query($conn, $query1, $rs_employee);	
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
					<th class="th-sm">Update
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
						<td><?php echo $rs_employee[$i]["country_name"]; ?></td>
						<td><?php echo $rs_employee[$i]["address"]; ?></td>
						<td><a href="employee-update-form.php?employee-id=<?php echo $rs_employee[$i]["emp_id"]; ?>" class="btn btn-sm" role="button"><i class="fas fa-edit"></i></a></td>	
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
