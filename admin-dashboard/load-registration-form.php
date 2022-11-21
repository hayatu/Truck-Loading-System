<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
?>
	
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();
	 $query1 = sprintf("select emp_id, first_name, last_name from tbl_employee_info order by emp_id ");
	$n1 = db_select_query($conn, $query1, $rs_employee);

  $query2 = sprintf("select vehicle_id, plat_number from tbl_vehicle_info order by plat_number ");
	$n2 = db_select_query($conn, $query2, $rs_vehicle);
	
	$query3 = sprintf("select  * from tbl_weeks_info order by week_id ");
	$n3 = db_select_query($conn, $query3, $rs_week);
	
	db_close($conn);
?>
<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<script type="text/javascript" src="js/date-picker.min.js"></script>
<main class="pl-1 pt-1">
    <div class="container">
        <!--Section: Main panel-->
        <section class="mb-3">
            <!--Card-->
            <div class="card card-cascade narrower">
                <!--Section: Table-->
                <section class="text-dark">
                    <!--Top Table UI-->
                    <div class="table-ui p-0 mb-0 mx-0 mb-0">
                        <!--Grid row-->
                        <h6 class="font-weight-bold pl-2 pt-1">Admin Dashboard</h6>
                        <hr class="light-blue lighten-1 title-hr">
                        <!--Grid row-->
                    </div>
                    <!--Top Table UI-->
                </section>
                <!--Section: Table-->
            </div>
            <!--/.Card-->
        </section>
        <!--Section: Main panel-->   
    
        <!-- Register form -->
        <form name="form1" action="load-insert.php" method="post" enctype="multipart/form-data">
		
            <p class="h5 text-center mb-0">Load Registration Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
							
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-dollar-sign prefix grey-text"></i>   
                        <label for="pick_up_price" class="active">Pickup Price </label>
                        <input name="pick_up_price" type="text" id="pick_up_price" class="form-control" placeholder="Pickup Price" required>
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-people-carry prefix grey-text"></i>
                        <label for="pick_up_location" class="active">Pickup Location </label> 
                        <input name="pick_up_location" type="text" id="pick_up_location" class="form-control" placeholder="Pickup Location" required>
                    </div>
                </div>
                <!--Grid column-->
				 				                             		           
				  <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                         <i class="fas fa-search-location prefix grey-text"></i>
                        <label for="delivery_location" class="active">Delivery Location</label> 
                        <input name="delivery_location" type="text" id="delivery_location" class="form-control" placeholder="Delivery Location" required>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-3">
                    <div>
                        <i class="fas fa-audio-description prefix grey-text"></i>
                        <label for="other_Notes" class="active">Other Notes</label>
                        <textarea name="other_Notes" type="text" class="form-control md-textarea" id="other_Notes" placeholder="Other Notes" required rows="3"></textarea>
                    </div>
                </div>
              <!--Grid column-->
			  <!--Grid column-->
				<div class="col-md-4 mb-4">
				<div>
				
				<i class="fas fa-user prefix grey-text"></i>
				<label for="emp_id" class="active">Employee Name</label>
				<select name="emp_id" class=" form-control">
				<option value="0" selected >Employee Name</option>
				<?php 
				for($i=0; $i<$n1; $i++){
				?>
				<option value="<?php echo $rs_employee[$i]["emp_id"]; ?>"><?php echo $rs_employee[$i]["first_name"].' '.$rs_employee[$i]["last_name"].' '; ?></option>
				<?php 
				} 
				?>
				</select>
				</div>
				</div>
                <!--Grid column-->
				<!--Grid column-->
				<div class="col-md-4 mb-4">
				<div>
				<i class="fas fa-truck prefix grey-text"></i>
				<label for="truck_id" class="active">Truck Number</label>
				<select name="truck_id" class=" form-control">
				<option value="0" selected >Select Truck Number</option>
				<?php 
				for($i=0; $i<$n2; $i++){
				?>
				<option value="<?php echo $rs_vehicle[$i]["vehicle_id"]; ?>"><?php echo $rs_vehicle[$i]["plat_number"]; ?></option>
				<?php 
				} 
				?>
				</select>
				</div>
				</div>
                <!--Grid column-->
				
				<div class="col-md-4 mb-4">
				<div>
				
				<i class="fas fa-user prefix grey-text"></i>
				<label for="week" class="active">Weeks</label>
				<select name="week" class=" form-control">
				<option value="0" selected >Week Name</option>
				<?php 
				for($i=0; $i<$n3; $i++){
				?>
				<option value="<?php echo $rs_week[$i]["week"]; ?>"><?php echo $rs_week[$i]["week"]; ?></option>
				<?php 
				} 
				?>
				</select>
				</div>
				</div>
				<!--Grid column-->
				<div class="col-md-4 mb-4">
					<div>
						<i class="fas fa-calendar-week prefix grey-text"></i>
						<label for="sdate" class="active">Start Date</label>
						<input name="sdate" type="text" id="datepicker_start" placeholder="Start Date" class="form-control" required>  
					</div>
				</div>	
              <!--Grid column-->	
               <!--Grid column-->
				<div class="col-md-4 mb-4">
					<div>
						<i class="fas fa-calendar-week prefix grey-text"></i>
						<label for="edate" class="active">End Date</label>
						<input name="edate" type="text" id="datepicker_end" placeholder="End Date" class="form-control" required>  
					</div>
				</div>	
              <!--Grid column-->
            </div>
		<!--Grid row-->	
            
            <div class="text-center mt-4">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
        <!-- Register form -->
   
        <!--Grid column-->
    </div>
</main>
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
<!--Main layout-->
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->