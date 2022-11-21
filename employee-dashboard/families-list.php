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
	  $query1 = sprintf("select pack.package_id, pack.destination, pack.customer_id, tbl_employee_info.emp_id, tbl_customer_info.first_name,tbl_customer_info.last_name,
	  tbl_customer_info.createdate, tbl_customer_info.mobile,tbl_customer_info.email "
	."from tbl_package_info pack "
	."left join tbl_employee_info on pack.emp_id = tbl_employee_info.emp_id "	
	."left join tbl_customer_info on pack.customer_id = tbl_customer_info.customer_id "
	."where tbl_employee_info.emp_id = %s and  pack.deleteflag = 0 order by tbl_customer_info.first_name ASC",
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
			<span class="btn btn-primary btn-block font-weight-bold" role="button">View assigned families/households List</span>				
			</div>								
		</div>
			<thead>
				<tr>
				 <th class="th-sm">First Name
				 </th>
				 <th class="th-sm">Last Name
				 </th>
					<th class="th-sm">Address
					</th>
					<th class="th-sm">Phone
					</th>
					<th class="th-sm">Email Address
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
					    <td><?php echo $rs_package[$i]["first_name"]; ?></td>				
						<td><?php echo $rs_package[$i]["last_name"]; ?></td>
						<td><?php echo $rs_package[$i]["destination"]; ?></td>
						<td><?php echo $rs_package[$i]["mobile"]; ?></td>
						<td><?php echo $rs_package[$i]["email"]; ?></td>						
						<td><?php echo $rs_package[$i]["createdate"]; ?></td>						
                     </tr>
					<?php
					}
				?>  
			</tbody>
			<tfoot>
				<tr>
				 <th>First Name 
					</th>
					<th>Last Name
					</th>
					<th>Address
					</th>	
					<th>Phone
					</th>	
					<th>Email Address
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
