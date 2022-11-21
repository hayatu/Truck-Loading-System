<?php require_once("authenticate.php");?>
<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
	
?>
<link href="js/export/buttons.dataTables.min.css" rel="stylesheet" />
<!--<script src="js/export/jquery.dataTables.min.js"></script>-->
<script src="js/export/dataTables.buttons.min.js"></script>
<script src="js/export/jszip.min.js"></script>
<script src="js/export/pdfmake.min.js"></script>
<script src="js/export/vfs_fonts.js"></script>
<script src="js/export/buttons.html5.min.js"></script>
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);		
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();	
       $query1 = sprintf("select * from tbl_vehicle_info where deleteflag = 0 order by made_model");
	$n = db_select_query($conn, $query1, $rs_vehicle);	
	db_close($conn);	
?>


<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->
<!-- Main layout -->

	<main class="pl-1 pt-1">
		<div class="container">

			<div class="row p-1">
				
				<div class="col-md-12">
					<a href="#" class="btn btn-primary btn-block font-weight-bold p-2" role="button"> (<i class="fas fa-file-export"></i>) Export Section </a>
				</div>	
			</div>
		<table id="dtBasicExample" class="table table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="th-sm">Truck Made Model
					</th>
					<th class="th-sm">Truck Number 
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
					<td><?php echo $rs_vehicle[$i]["made_model"]; ?></td>				
					<td><?php echo $rs_vehicle[$i]["plat_number"]; ?></td>
					<td><?php echo $rs_vehicle[$i]["createdate"]; ?></td> 

					
				</tr>
				<?php
				}
				?>  
				</tbody>
			<tfoot>
			<tr>
			<th>Truck Made Model  
			</th>
			<th>Truck Number
			</th>	
			<th>Registration Date
			</th>				
			</tr>
		</tfoot>
		</table>
		</div>

		<script>
		$(document).ready(function () {
		$('#dtBasicExample').DataTable(
		{
               
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Excel',
                        text:'Export to excel'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3,4,5,6]
                       // }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'PDF',
                        text: 'Export to PDF'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3, 4, 5, 6]
                      //  }
                    }
                ]
            }
		
		);
		$('.dataTables_length').addClass('bs-select');
		});
		</script>	
	
	</main>
<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->
