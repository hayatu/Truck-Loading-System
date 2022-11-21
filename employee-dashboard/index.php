<?php require_once("authenticate.php");?>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
?> 
	<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<main class="pl-1 pt-1">
	<div class="container">
		<!--Section: Main panel-->
		<section class="mb-3">	
		 <?php /* include("employee-status-form.php"); */?>		
         <!--Card-->
			<div class="card card-cascade narrower">         
				<!--Section: Table-->
				<section class="text-dark">
				
					<!--Top Table UI-->
					<div class="table-ui p-0 mb-0 mx-0 mb-0">
						<!--Grid row-->						
							<h6 class="font-weight-bold pl-2 pt-1">Employee Dashboard  (<?php echo $_SESSION["first_name"]; ?> <?php echo $_SESSION["last_name"];?>)</h6>
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
                 <div class="col-lg-12 col-md-4 mb-4">					
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
									<a href="load-list.php" class="list-group-item d-flex justify-content-between text-info">View Load Info
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>
							<div class="card-body text-center">								
								<div class="list-group list-panel">									
									<a href="vehicle-list.php" class="list-group-item d-flex justify-content-between text-info">View Truck Info
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>
							
							<div class="card-body text-center">								
								<div class="list-group list-panel">									
									<a href="paycheck-list.php" class="list-group-item d-flex justify-content-between text-info">View Paycheck Info
									<i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>
								</div>								
							</div>
							
							<div class="card-body text-center">								
								<div class="list-group list-panel">	
								<?php
								$files = scandir("../uploads");
								for ($a = 2; $a < count($files); $a++)
								{
								?>
								<p>						
								<a href="../uploads/<?php echo $files[$a]; ?>" target="_blank"  class="list-group-item d-flex justify-content-between text-info"> Click here to preview <i class="fas fa-list ml-auto" data-toggle="tooltip" data-placement="top" title="Click to View Package"></i></a>       
								</p>
								<?php
								}
								?>								
									
								</div>								
							</div>
							<!--/.Card content-->							
						</div>
						<!--/.Card-->						
					</div>
					<!--Panel-->					
				</div>
					
			</div>	
			</section>
			<!--Section: Cascading panels-->		
	</div>
</main>
<!--Main layout-->

<!--/ Main layout -->
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->