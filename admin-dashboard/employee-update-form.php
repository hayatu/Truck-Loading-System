<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();
	 $query1 = sprintf("select country_id, country_name from tble_countries order by country_name ");
	$n1 = db_select_query($conn, $query1, $rs_country);
	
	 $query2 = sprintf("select vehicle_id, plat_number from tbl_vehicle_info order by plat_number ");
	$n2 = db_select_query($conn, $query2, $rs_vehicle);
	
	$query = sprintf("select * from tbl_employee_info where emp_id = %s", GetSQLValueString($_REQUEST["emp-id"], "int") );
	$n = db_select_query($conn, $query, $rs_employee);
	db_close($conn);
?>

<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->

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
        <form name="form1" action="employee-update.php" method="post" enctype="multipart/form-data">
		<input name="emp-id" type="hidden" id="emp-id" value="<?php echo $rs_employee[0]["emp_id"]; ?>">
            <p class="h5 text-center mb-0">Employee Update Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="first_name" class="active">Frist Name</label>
                        <input name="first_name" type="text" id="first_name" class="form-control" value="<?php echo  $rs_employee[0]["first_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="last_name" class="active">Last Name</label>
                        <input name="last_name" type="text" id="last_name" class="form-control" value="<?php echo  $rs_employee[0]["last_name"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label for="email" class="active">Email</label>
                        <input name="email" type="email" id="email" class="form-control" value="<?php echo  $rs_employee[0]["email"]; ?>">
                    </div>
                </div>
                <!--Grid column-->				
               			
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-phone-volume prefix grey-text"></i>
                        <label for="mobile" class="active">Cell Phone</label>
                        <input name="mobile" type="text" id="mobile" class="form-control" value="<?php echo  $rs_employee[0]["mobile"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
				
				   <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <div>
                        <i class="fas fa-truck prefix grey-text"></i>
                        <label for="vehicle_id" class="active">Plate Number</label>
                        <select name="vehicle_id" class=" form-control" required>
							<option value="0" selected >Select Plate Number</option>
							<?php 
							for($i=0; $i<$n2; $i++){
							?>
							<option value="<?php echo $rs_vehicle[$i]["vehicle_id"]; ?>"<?php if($rs_vehicle[$i]["vehicle_id"] == $rs_employee[0]["vehicle_id"]) echo " selected"; ?>><?php echo $rs_vehicle[$i]["plat_number"]; ?></option>
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
                        <i class="fas fa-globe prefix grey-text"></i>
                        <label for="country_id" class="active">Country</label>
                        <select name="country_id" class=" form-control" required>
							<option value="" selected >Select Country</option>
							<?php 
							for($i=0; $i<$n1; $i++){
							?>
							<option value="<?php echo $rs_country[$i]["country_id"]; ?>"<?php if($rs_country[$i]["country_id"] == $rs_employee[0]["country_id"]) echo " selected"; ?>><?php echo $rs_country[$i]["country_name"]; ?></option>
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
                        <i class="fas fa-address-card prefix grey-text"></i>
                        <label for="address" class="active">Address</label>
                        <textarea name="address" type="text" class="form-control md-textarea" id="address"> <?php echo  $rs_employee[0]["address"]; ?></textarea>
                    </div>
                </div>
                <!--Grid column-->
				<!--Grid column-->
            <div class="col-md-4 mb-4 p-4">
			 <i class="fas fa-user-cog prefix grey-text"></i>
			 <label for="address" class="active">Enable/Disable</label>
              <div>	
                <!-- Default inline 1-->
						<i class="far fa-check-circle prefix grey-text"></i>
						<div class="custom-control custom-radio custom-control-inline"> 
							<input name="is_enabled" type="radio" class="custom-control-input" id="Enabled" value="1" <?php if($rs_employee[0]["is_enabled"] == 1) echo " checked"; ?>>
							<label class="custom-control-label" for="Enabled">Enable</label>
						</div>
						
						<!-- Default inline 2-->
						<i class="far fa-times-circle"></i>
						<div class="custom-control custom-radio custom-control-inline">
							<input name="is_enabled" type="radio" class="custom-control-input" id="Disable" value="0" <?php if($rs_employee[0]["is_enabled"] == 0) echo " checked"; ?>>
							<label class="custom-control-label" for="Disable">Disable</label>
						</div>
              </div>
            </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
            <div class="text-center mt-4">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
        <!-- Register form -->
   
        <!--Grid column-->
    </div>
</main>
<!--Main layout-->

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->