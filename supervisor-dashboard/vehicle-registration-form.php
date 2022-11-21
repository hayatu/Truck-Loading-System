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
        <form name="form1" action="vehicle-insert.php" method="post" enctype="multipart/form-data">
            <p class="h5 text-center mb-0">Truck Registration Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <div>
                        <i class="fas fa-car-side prefix grey-text"></i>  
                        <label for="made_model" class="active">Truck Made Model</label>
                        <input name="made_model" type="text" id="made_model" class="form-control" placeholder="Vehicle Model" required>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <div>
                        <i class="fas fa-list-ol prefix grey-text"></i>
                        <label for="plat_number" class="active">Truck Number</label> 
                        <input name="plat_number" type="text" id="plat_number" class="form-control" placeholder="Truck Number" required>
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
<!--Main layout-->

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->