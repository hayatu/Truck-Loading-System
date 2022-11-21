<?php require_once("authenticate.php");?>
<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	
		ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);		
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();	
	
	 $query1 = sprintf("select  * from tbl_weeks_info order by week_id ");
	$n1 = db_select_query($conn, $query1, $rs_week);
	
	 $query2 = sprintf("select emp_id, first_name, last_name from tbl_employee_info order by emp_id ");
	$n2 = db_select_query($conn, $query2, $rs_employee);
 
?>	
	<script type="text/javascript" src="js/date-picker.min.js"></script>
	<!-- Track form -->
	<form name="form1" action="tarack-weekpay.php" method="POST" enctype="multipart/form-data">
	
	 <!--Grid row-->
            <div class="row">
			<div class="col-md-2 pt-1 p-0">
			<select name="emp_id" class=" form-control">
				<option value="0" selected >Employee Name</option>
				<?php 
				for($i=0; $i<$n2; $i++){
				?>
				<option value="<?php echo $rs_employee[$i]["emp_id"]; ?>"><?php echo $rs_employee[$i]["first_name"].' '.$rs_employee[$i]["last_name"].' '; ?></option>
				<?php 
				} 
				?>
				</select>
				</div>
				 <!--Grid column-->
				 <div class="col-md-2 pt-1 p-0">
			<select name="week" class=" form-control">
				<option value="0" selected >Week Name</option>
				<?php 
				for($i=0; $i<$n1; $i++){
				?>
				<option value="<?php echo $rs_week[$i]["week"]; ?>"><?php echo $rs_week[$i]["week"]; ?></option>
				<?php 
				} 
				?>
				</select>
				</div>
				 <!--Grid column-->
				<div class="col-md-2  pt-2">
					<div>
						
						<input name="From" type="text" id="datepicker_start" placeholder="Start Date" class="form-control" required>  
					</div>
				</div>	
              <!--Grid column-->	
			   <!--Grid column-->
				<div class="col-md-3 pt-2">
					<div>
						
						<input name="to" type="text" id="datepicker_end" placeholder="End Date" class="form-control" required>  
					</div>
				</div>	
              <!--Grid column-->		
				<div class="col-md-3 p-0">
		<button class="btn btn-primary btn-md" type="submit">Track Weekly Pay</button>
		</div>
		</div>
		<!--Grid row-->
	</form>
	<!-- Track form -->
<script>	
$('#datepicker_start').datepicker(
{		
autoclose: true,
format: 'yyyy/mm/dd',
todayHighlight: true,
});  		
</script>
<script>	
$('#datepicker_end').datepicker(
{		
autoclose: true,
format: 'yyyy/mm/dd',
todayHighlight: true,
});  		
</script>
