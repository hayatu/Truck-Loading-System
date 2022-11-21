<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/delivery/top-header-section.php"); 
	include_once($CommonAssets ."/delivery/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/delivery/common/db_func.php");
	$conn = db_connect();
	
	$query = sprintf("select * from tbl_package_info where zone_name = %s and assign_status = 0", GetSQLValueString($_REQUEST["zone-name"], "text") );
	$n = db_select_query($conn, $query, $rs_package);
	
	  $query1 = sprintf("select emp_id, first_name,last_name from tbl_employee_info where emp_id = %s",
	 GetSQLValueString($_SESSION["emp_id"], "int"));	
	$n1 = db_select_query($conn, $query1, $rs_employee);
	
	$query2 = sprintf("select status_id, status from tbl_status_info order by status_id ");
	$n2 = db_select_query($conn, $query2, $rs_status);
	
	 $query3 = sprintf("select pack.package_id, pack.customer_id, tbl_employee_info.emp_id"
	."from tbl_package_info pack "
	."left join tbl_employee_info on pack.emp_id = tbl_employee_info.emp_id "	
	."where tbl_employee_info.emp_id = %s and  pack.deleteflag = 0 order by tbl_employee_info.emp_id ASC",
	 GetSQLValueString($_SESSION["emp_id"], "int"));	  
	$n3 = db_select_query($conn, $query3, $rs_customer);	 
	
	$query4 = sprintf("select status_id, status from tbl_status_info order by status_id ");
	$n4 = db_select_query($conn, $query4, $rs_status);
		
	db_close($conn);
?>
   	
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- JQuery -->
<!--<script type="text/javascript" language="JavaScript">
function handleData()
{
    var form_data = new FormData(document.querySelector("form"));
    if(!form_data.has("package_id[]"))
    {
        document.getElementById("chk_option_error").style.visibility = "visible";
      return false;      
    }
    else
    {
        document.getElementById("chk_option_error").style.visibility = "hidden";
      return true;
    }

}
</script> -->
	<div class="container">
	<form name="form1" action="assign-package-update.php" method="post" enctype="multipart/form-data">
	
			<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<input name="assign_status" type="hidden" id="assign_status" value="1">
			<input name="pickedby" type="hidden" id="pickedby" value="1">
			<input name="zone-name" type="hidden" id="zone-name" value="<?php echo $rs_package[0]["zone_name"]; ?>">
			
				<tr> 
					<td>
					<i class="fas fa-user prefix grey-text" ></i>
					 <label for="emp_id" class="font-weight-bold">Employee Name</label>
					<select name="emp_id" class=" form-control disabled"  id="dropdown">
							<option value="" selected >Employee Name</option>
							<?php 
							for($i=0; $i<$n1; $i++){
							?>
							<option value="<?php echo $rs_employee[$i]["emp_id"]; ?>" selected><?php echo $rs_employee[$i]["first_name"]." ".$rs_employee[$i]["last_name"]; ?></option>
							<?php 
							} 
							?>
						</select>
					</td>
				</tr>
			</table>
			<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<div style="visibility:hidden; color:red; "id="chk_option_error">Please select at least one package.</div>
			<input type="submit" value="Select Packages" name="submit">
			
			<thead>
				
				<th class="th-sm">Truck Number
					</th>
					<th class="th-sm">Pickup Price
					</th>
					<th class="th-sm">Current Location
					</th>
					
					<th class="th-sm">Destination
					</th>
                   		<th class="th-sm">Estimated Delivery Time
					</th>	
                 </th>
                   		<th class="th-sm">Status
					</th>					
				</tr>
			</thead>

			<tbody>
			 
				<?php
					for($i=0; $i<$n; $i++){
					?>
					<tr class="alert-info">
					<td style="display:none"><input name="package_id[]" type="text" id="package_id" value="<?php echo $rs_package[$i]["package_id"]; ?>">
					</td>
					<td><input type="text" name="track_num"  value="<?php echo $rs_package[$i]["track_num"]; ?>" style="width:3rem" readonly></td>
					<td><input type="text" name="pickupprice"  value="<?php echo $rs_package[$i]["pickupprice"]; ?>" style="width:4rem" readonly></td>
					<td>
					<textarea name="current_loc[]" type="text"  class="form-control md-textarea" id="current_loc" readonly><?php echo $rs_package[$i]["current_loc"]; ?></textarea>
					</td>
					<td><textarea name="destination[]" type="text" class="form-control md-textarea" id="destination" readonly><?php echo $rs_package[$i]["destination"]; ?></textarea></td>
					 <!--<td style="width:1rem"> 
                <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-clock prefix grey-text"></i>
                        
						 <input name="departure_time[]" type="text" class="form-control departure_time" style="width:8rem" required>
                        
                    </div>
                </div>
				</td>-->
				<td style="width:1rem"> 
				<!--Grid column-->
                 <div class="col-md-3 mb-4">
                    <div>
                        <i class="fas fa-clock prefix grey-text"></i>
                        
						 <input name="delivery_time[]" type="text" class="form-control delivery_time" style="width:8rem" required>
                        
                    </div>
                </div>
				</td>
				<td> 
				<!--Grid column-->
                <div class="col-md-4 mb-4">				
                    <div>
                        <select name="status_id[]" class=" form-control" required style="width:10rem" required>
							<option value="" selected>Select Status</option>
							<option value="1">Shipped</option>
							<option value="2">Delivered</option>
							<option value="3">Onhold</option>
							<option value="4">Canceled</option>
							<option value="5">Returned</option>
							<option value="6">Expected to Pickup</option>
							
						</select>
                    </div>
                </div>
				</td>
				<!--Grid column-->
					</tr>
					<?php
					}
				?>  
			</tbody>
			</form>
		</table>
	</div>
	
</div>
</main>
<!--Main layout-->

<script>
   $(document).ready(function() {
        
        $('.delivery_time').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
           format: 'h:mm:ss A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
           icons: {
               time: "fa fa-clock-o",
               date: "fa fa-calendar",
               up: "fa fa-chevron-up",
               down: "fa fa-chevron-down",
               previous: 'fa fa-chevron-left',
               next: 'fa fa-chevron-right',
               today: 'fa fa-screenshot',
               clear: 'fa fa-trash',
               close: 'fa fa-remove'

           }
        });
});
</script>

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->