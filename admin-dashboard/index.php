<?php require_once("authenticate.php");?>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
?> 

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();
	 $query1 = sprintf("select * from tbl_employee_info where deleteflag = 0 order by first_name ");
	$n1 = db_select_query($conn, $query1, $rs_employee);
	
	 $query2 = sprintf("select * from tbl_vehicle_info where deleteflag = 0 order by made_model ");
	$n2 = db_select_query($conn, $query2, $rs_truck);
	
	 $query3 = sprintf("select SUM(gross_pay_total) as total from tbl_paycheck_info where deleteflag = 0 order by gross_pay_total");
	$n3 = db_select_query($conn, $query3, $rs_grosspay);
	$sum_grosspay = $rs_grosspay[0]["total"];	
	
	 $query4 = sprintf("select * from tbl_load_info where deleteflag = 0 order by pick_up_price ");
	$n4 = db_select_query($conn, $query4, $rs_load);
	
	db_close($conn);
?>
	<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<main class="pl-1 pt-1">
	<div class="container">
	 <div class="row">

          <!--Grid column-->
          <div class="col-xl-3 col-md-6 mb-1">

            <!--Card-->
            <div class="card">

              <!--Card Data-->
              <div class="row mt-1">
                <div class="col-md-5 col-5 text-left pl-1">
                  <a type="button" class="btn-floating btn-lg primary-color ml-4"><i class="far fa-eye" aria-hidden="true"></i></a>
                </div>

                <div class="col-md-7 col-7 text-right pr-5">
                  <h5 class="ml-4 mt-4 mb-2 font-weight-bold"><?php echo $n2 ?> </h5>
                 <!-- <p class="font-small grey-text">Trucks</p>-->
                </div>
              </div>
              <!--/.Card Data-->

              <!--Card content-->
              <div class="row my-3">
                <div class="col-md-7 col-7 text-left pl-1">
                  <p class="font-small dark-grey-text font-up ml-4 font-weight-bold">Trucks</p>
                </div>

                <!--<div class="col-md-5 col-5 text-right pr-5">
                  <p class="font-small grey-text">145,567</p>
                </div>-->
              </div>
              <!--/.Card content-->

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-xl-3 col-md-6 mb-1">

            <!--Card-->
            <div class="card">

              <!--Card Data-->
              <div class="row mt-1">
                <div class="col-md-5 col-5 text-left pl-1">
                  <a type="button" class="btn-floating btn-lg warning-color ml-4"><i class="fas fa-user" aria-hidden="true"></i></a>
                </div>

                <div class="col-md-7 col-7 text-right pr-5">
                  <h5 class="ml-4 mt-4 mb-2 font-weight-bold"><?php echo $n1 ?></h5>
                  <!--<p class="font-small grey-text">Employee</p>-->
                </div>
              </div>
              <!--/.Card Data-->

              <!--Card content-->
              <div class="row my-3">
                <div class="col-md-7 col-7 text-left pl-1">
                  <p class="font-small dark-grey-text font-up ml-4 font-weight-bold">Employees</p>
                </div>

                <!--<div class="col-md-5 col-5 text-right pr-5">
                  <p class="font-small grey-text"><?php echo $n1 ?></p>
                </div>-->
              </div>
              <!--/.Card content-->

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-xl-3 col-md-6 mb-1">

            <!--Card-->
            <div class="card">

              <!--Card Data-->
              <div class="row mt-1">
                <div class="col-md-5 col-5 text-left pl-1">
                  <a type="button" class="btn-floating btn-lg light-blue lighten-1 ml-4"><i class="fas fa-dollar-sign"
                      aria-hidden="true"></i></a>
                </div>

                <div class="col-md-7 col-7 text-right pr-5">
                  <h5 class="ml-4 mt-4 mb-2 font-weight-bold"><?php echo $sum_grosspay ; ?></h5>
                 <!-- <p class="font-small grey-text">Yearly total</p>-->
                </div>
              </div>
              <!--/.Card Data-->

              <!--Card content-->
              <div class="row my-3">
                <div class="col-md-7 col-7 text-left pl-1">
                  <p class="font-small dark-grey-text font-up ml-4 font-weight-bold">Yearly total</p>
                </div>

               <!-- <div class="col-md-5 col-5 text-right pr-5">
                  <p class="font-small grey-text">145,567</p>
                </div>-->
              </div>
              <!--/.Card content-->

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-xl-3 col-md-6 mb-1">

            <!--Card-->
            <div class="card">

              <!--Card Data-->
              <div class="row mt-1">
                <div class="col-md-5 col-5 text-left pl-1">
                  <a type="button" class="btn-floating btn-lg red accent-2 ml-4"><i class="fas fa-database" aria-hidden="true"></i></a>
                </div>

                <div class="col-md-7 col-7 text-right pr-5">
                  <h5 class="ml-4 mt-4 mb-2 font-weight-bold"><?php echo $n4 ?></h5>
                  <!--<p class="font-small grey-text">Order Amount</p>-->
                </div>
              </div>
              <!--/.Card Data-->

              <!--Card content-->
              <div class="row my-3">
                <div class="col-md-7 col-7 text-left pl-1">
                  <p class="font-small dark-grey-text font-up ml-4 font-weight-bold">Number of loads</p>
                </div>

                <!--<div class="col-md-5 col-5 text-right pr-5">
                  <p class="font-small grey-text">145,567</p>
                </div>-->
              </div>
              <!--/.Card content-->

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

        </div>
		<!--Section: Main panel-->
		<section class="mb-3">	
        		
			<!--Card-->
			<div class="card card-cascade narrower">         
				<!--Section: Table-->
				<section class="text-dark">
				
					<!--Top Table UI-->
					<div class="table-ui p-0 mb-0 mx-0 mb-0">
						<!--Grid row-->						
							<h6 class="font-weight-bold pl-2 pt-1">Admin Dashboard  (<?php echo $_SESSION["first_name"]; ?> <?php echo $_SESSION["last_name"];?>)</h6>
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
		<!--Section: Cascading panels-->
		<section class="mb-3">	
			<!--Grid row-->
			<div class="row">				
				
				<!--Grid column-->	
                 <div class="col-lg-4 col-md-4 mb-1">					
					<!--Panel-->
					<div class="card" style="height:19rem">
						<div class="card-header white-text primary-color font-weight-bold">
							Supervisor Section
						</div>
						<!--/.Card-->
						<div class="card-body pt-0 px-1">							
							<!--Card content-->
							<div class="card-body text-center">								
								<div class="list-group list-panel">
									<a href="supervisor-registration-form.php" class="list-group-item d-flex justify-content-between text-info">Add Supervisor Info
									<i class="fas fa-user-cog ml-auto" data-toggle="tooltip" data-placement="top" title="Click to add Supervisor"></i></a>
									<a href="supervisor-list.php" class="list-group-item d-flex justify-content-between text-info">Supervisor List
									<i class="fas fa-users ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Supervisors"></i></a>
									<a href="file-upload-form.php" class="list-group-item d-flex justify-content-between text-info">Upload File
									<i class="fas fa-file" data-toggle="tooltip" data-placement="top" title="Click to View Supervisors"></i></a>
								</div>								
							</div>
							<!--/.Card content-->							
						</div>
						<!--/.Card-->						
					</div>
					<!--Panel-->					
				</div>
				<!--Grid column-->	
				<!--Grid column-->	
                 <div class="col-lg-4 col-md-4 mb-1">					
					<!--Panel-->
					<div class="card">
						<div class="card-header white-text primary-color font-weight-bold">
							Employee Section
						</div>
						<!--/.Card-->
						<div class="card-body pt-0 px-1">							
							<!--Card content-->
							<div class="card-body text-center">								
								<div class="list-group list-panel">
									<a href="vehicle-registration-form.php" class="list-group-item d-flex justify-content-between text-info">Add Truck Info
									<i class="fas fa-truck ml-auto" data-toggle="tooltip" data-placement="top" title="Click to add Vehicle"></i></a>
									<a href="vehicle-list.php" class="list-group-item d-flex justify-content-between text-info">Truck List
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Vehicle"></i></a>
									<!--<a href="employee-registration-form.php" class="list-group-item d-flex justify-content-between text-info">Add Employee Info
									<i class="fas fa-user ml-auto" data-toggle="tooltip" data-placement="top" title="Click to add Employee"></i></a>-->
									<a href="employee-registration-form.php" class="list-group-item d-flex justify-content-between text-info">Add Employee Info
									<i class="fas fa-user ml-auto" data-toggle="tooltip" data-placement="top" title="Click to add Employee"></i></a>
									<a href="employee-list.php" class="list-group-item d-flex justify-content-between text-info">Employee List
									<i class="fas fa-users ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Vehicle"></i></a>
								</div>								
							</div>
							<!--/.Card content-->							
						</div>
						<!--/.Card-->						
					</div>
					<!--Panel-->					
				</div>
				<!--Grid column-->	
				<!--Grid column-->	
                 <div class="col-lg-4 col-md-4 mb-1">					
					<!--Panel-->
					<div class="card">
						<div class="card-header white-text primary-color font-weight-bold">
							Load  Section
						</div>
						<!--/.Card-->
						<div class="card-body pt-0 px-1">							
							<!--Card content-->
							<div class="card-body text-center">								
								<div class="list-group list-panel">
								<a href="load-registration-form.php" class="list-group-item d-flex justify-content-between text-info">Add Load Info
									<i class="fas fa-archive ml-auto" data-toggle="tooltip" data-placement="top" title="Click to add Package"></i></a>									
									<a href="load-list.php" class="list-group-item d-flex justify-content-between text-info">Load List
									</a>
									<!--<a href="paycheck-registration-form.php" class="list-group-item d-flex justify-content-between text-info">Add Paycheck Info
									<i class="fas fa-archive ml-auto" data-toggle="tooltip" data-placement="top" title="Click to add Package"></i></a>-->
									<a href="paycheck-list.php" class="list-group-item d-flex justify-content-between text-info">Paycheck List
									</a>
									<a href="search-weekly-pay-form.php" class="list-group-item d-flex justify-content-between text-info">Paycheck Search
									</a>
									
									
								</div>								
							</div>
							<!--/.Card content-->							
						</div>
						<!--/.Card-->						
					</div>
					<!--Panel-->					
				</div>
				
				<!--Grid column-->					
			</div>	
			<!--Grid row-->
       
        <!--Grid row-->
			</section>
			<!--Section: Cascading panels-->		
	</div>
</main>
<!--Main layout-->

<!--/ Main layout -->
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->