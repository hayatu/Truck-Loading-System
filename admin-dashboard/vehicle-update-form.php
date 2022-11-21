<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
?>

<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();
	
	 $query = sprintf("select * from tbl_vehicle_info where vehicle_id = %s", GetSQLValueString($_REQUEST["vehicle-id"], "int") );
	$n = db_select_query($conn, $query, $rs_vehicle);
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
        <form name="form1" action="vehicle-update.php" method="post" enctype="multipart/form-data">
		<input name="vehicle-id" type="hidden" id="vehicle-id" value="<?php echo $rs_vehicle[0]["vehicle_id"]; ?>">
            <p class="h5 text-center mb-0">Vehicle Update Form</p>
            <hr class="light-blue lighten-1 title-hr">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="made_model" class="active">vehicle Model</label>
                        <input name="made_model" type="text" id="made_model" class="form-control" value="<?php echo  $rs_vehicle[0]["made_model"]; ?>">
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <div>
                        <i class="fas fa-user prefix grey-text"></i>
                        <label for="plat_number" class="active">Truck Number</label>
                        <input name="plat_number" type="text" id="plat_number" class="form-control" value="<?php echo  $rs_vehicle[0]["plat_number"]; ?>">
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