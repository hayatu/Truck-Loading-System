<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>
	<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);
	$query = sprintf("select * from tbl_employee_info where emp_id = %s", GetSQLValueString($_SESSION["emp_id"], "int") );
	$n = db_select_query($conn, $query, $rs_employee);
	db_close($conn);
?><hr class="light-blue lighten-1 title-hr">
	<main class="pl-1 pt-1">
	
		<div class="container">
			 <form name="form1" action="employee-staus-update.php" method="post" enctype="multipart/form-data" class="form-inline">
			<input name="employee-id" type="hidden" id="employee-id" value="<?php echo $_SESSION["emp_id"]; ?>">
				<div class="form-group mb-2">
					<i class="fas fa-user prefix grey-text"></i>
					<label for="viecles" class="active pl-2"> Are you Available?</label>
					<!-- Default inline 1-->
					<i class="far fa-check-circle prefix grey-text pl-2"></i>
					<div class="custom-control custom-radio custom-control-inline">
						<input name="is_available" type="radio" class="custom-control-input" id="is_available" value="Yes" <?php if($rs_employee[0]["is_available"]=='Yes'){echo "checked";} ?>>
						<label class="custom-control-label" for="is_available">Yes</label>
					</div>
				</div>
			<div class="form-group mx-sm-3 mb-2">
				<!-- Default inline 2-->
				<i class="far fa-times-circle"></i>
				<div class="custom-control custom-radio custom-control-inline">
					<input name="is_available" type="radio" class="custom-control-input" id="isavailable" value="No" <?php if($rs_employee[0]["is_available"]=='No'){echo "checked";} ?>>
					<label class="custom-control-label" for="isavailable">No</label>
				</div>		
			</div>
			<button class="btn btn-primary btn-sm" type="submit">Update Status</button>
			</form>
		<!-- Track form -->
		</div>
	</main>
<hr class="light-blue lighten-1 title-hr">