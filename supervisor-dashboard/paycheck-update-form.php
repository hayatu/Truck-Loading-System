<?php require_once("authenticate.php");?>
<?php
    require_once($_SERVER["DOCUMENT_ROOT"]."/configs.php");
	include_once($CommonAssets ."/truck/top-header-section.php"); 
	include_once($CommonAssets ."/truck/main-top-header.php"); 
		ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);		
	require_once($_SERVER["DOCUMENT_ROOT"]."/truck/common/db_func.php");
	$conn = db_connect();	
	  $query = sprintf("select * from tbl_paycheck_info where paycheck_id = %s", GetSQLValueString($_REQUEST["paycheck-id"], "int") );
	$n = db_select_query($conn, $query, $rs_paycheck);
	
	 $query2 = sprintf("select  * from tbl_weeks_info order by week_id ");
	$n1 = db_select_query($conn, $query2, $rs_week);

  $query3 = sprintf("select vehicle_id, plat_number from tbl_vehicle_info order by plat_number ");
	$n3 = db_select_query($conn, $query3, $rs_vehicle);
	
	 $query4 = sprintf("select emp_id, first_name, last_name from tbl_employee_info order by emp_id ");
	$n4 = db_select_query($conn, $query4, $rs_employee);
	db_close($conn);
?>

<!-- Navbar -->
<?php include("nav-bar.php"); ?>
<!-- /.Navbar -->

 <script>
      $(document).ready(function(){
        var count = 1;        
       
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          html_code += '<td><input type="text" name="item_name" id="item_name'+count+'" class="form-control input-sm" /></td>';
		  html_code += '<td><input type="text" name="item_type" id="item_type'+count+'" class="form-control input-sm" /></td>';          
          html_code += '<td><input type="text" name="gross_pay_total" id="gross_pay_total'+count+'" data-srno="'+count+'" class="form-control input-sm number_only gross_pay_total" /></td>';
		  html_code += '<td><input type="text" name="item_kg" value="kg" id="item_kg'+count+'" class="form-control input-sm" /></td>';
          html_code += '<td><input type="text" name="commission" id="commission'+count+'" data-srno="'+count+'" class="form-control input-sm number_only commission" /></td>';
		  html_code += '<td><input type="text" name="fuel" id="fuel'+count+'" data-srno="'+count+'" class="form-control input-sm number_only fuel" /></td>';
          html_code += '<td><input type="text" name="net_pay" id="net_pay'+count+'" data-srno="'+count+'" readonly class="form-control input-sm net_pay" /></td>';
          html_code += '</tr>';
          //$('#invoice-item-table').append(html_code);        

        function cal_final_total(count)
        {
          var final_item_total = 0;
          for(j=1; j<=count; j++)
          {
            var quantity = 0;
            var price = 0;
            var actual_amount = 0;
			var cleanse_rate = 0;
            var cleanse_amount = 0;
			var cleanse_rate_new = 0;
            var cleanse_amount_new = 0;
			
			var othercharge_rate = 0;
            var othercharge_amount = 0;
            
            var item_total = 0;
            quantity = $('#gross_pay_total'+j).val();
            if(quantity > 0)
            {
              price = $('#commission'+j).val();
              if(price > 0)
              {
                actual_amount = parseFloat(quantity)- parseFloat(price);
               // $('#order_item_actual_amount'+j).val(actual_amount);
				cleanse_rate = $('#fuel'+j).val();
                if(cleanse_rate > 0)
                {
                  cleanse_amount = parseFloat(cleanse_rate);
                  $('#fuel'+j).val(cleanse_amount);
                }
				
				cleanse_rate_new = $('#insurance_fee'+j).val();
                if(cleanse_rate_new > 0)
                {
                  cleanse_amount_new = parseFloat(cleanse_rate_new);
                  $('#insurance_fee'+j).val(cleanse_rate_new);
                }
				
				othercharge_rate = $('#other_charges'+j).val();
                if(othercharge_rate > 0)
                {
                  othercharge_amount = parseFloat(othercharge_rate);
                  $('#other_charges'+j).val(othercharge_rate);
                }
				
               // item_total = parseFloat(actual_amount);
				item_total = parseFloat(actual_amount) - parseFloat(cleanse_amount)  - parseFloat(cleanse_amount_new) - parseFloat(othercharge_amount);
                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                $('#net_pay'+j).val(item_total);
              }
            }
          }
        }

        $(document).on('blur', '.commission', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.fuel', function(){
          cal_final_total(count);
        });
		
		 $(document).on('blur', '.insurance_fee', function(){
          cal_final_total(count);
        });
		
		 $(document).on('blur', '.other_charges', function(){
          cal_final_total(count);
        });
      
        
      });
      </script>
 
<!-- /.Navbar -->
<script type="text/javascript" src="js/date-picker.min.js"></script>
<main class="pl-1 pt-1">
	<div class="container">	
          
              <!-- Register form -->
              <form name="form1" method="post" action="paycheck-update.php" enctype="multipart/form-data">
		     <input name="paycheck-id" type="hidden" id="paycheck-id" value="<?php echo $rs_paycheck[0]["paycheck_id"]; ?>">
                <p class="h5 text-center mb-0 p-2">Paycheck Update Form </p><!--<p>All fields indicated in (*) are obligatory.</p>-->
                   <hr class="light-blue lighten-1 title-hr">
				
			<table id="invoice-item-table" class="table table-bordered">
				<tr>
                <td colspan="2">
                    <tr>
                      <!--<th width="7%">Sr No.</th>-->                      
                      <th width="10%">Gross pay total </th>
                      <th width="10%">Commission (12%) </th>
					  <th width="10%">Fuel</th>
					  <th width="10%">Insurance Fee </th>
                      <th width="10%">Othere Charges</th>                    
                      <th width="10%">Net Pay</th>
                      <!--<th width="3%" rowspan="2"></th>-->
                    </tr>
                  
                    <tr>
                      <!--<td><span id="sr_no">1</span></td>  -->                   
                      <td><input type="text" name="gross_pay_total" value="<?php echo $rs_paycheck[0]["gross_pay_total"]; ?>" id="gross_pay_total1" data-srno="1" class="form-control input-sm gross_pay_total" /></td>
					  <td><input type="text" name="commission" value="<?php echo $rs_paycheck[0]["commission"]; ?>" id="commission1" data-srno="1" class="form-control input-sm number_only commission" /></td>
					  <td><input type="text" name="fuel" id="fuel1" value="<?php echo $rs_paycheck[0]["fuel"]; ?>" data-srno="1" class="form-control input-sm number_only commission" required /></td>
                      <td><input type="text" name="insurance_fee" id="insurance_fee1" value="<?php echo $rs_paycheck[0]["insurance_fee"]; ?>" data-srno="1" class="form-control input-sm number_only insurance_fee" /></td>
					  <!--<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount" readonly /></td>-->
                      <td><input type="text" name="other_charges" id="other_charges1" data-srno="1" value="<?php echo $rs_paycheck[0]["other_charges"]; ?>" class="form-control input-sm number_only other_charges" /></td>
					  <td><input type="text" name="net_pay" id="net_pay1"  value="<?php echo $rs_paycheck[0]["net_pay"]; ?>" data-srno="1" readonly class="form-control input-sm net_pay" /></td>
                    </tr>
                  </table>	
				<!--<div align="right">
					<button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
				</div>	-->		  
				</td>
              </tr>
			  <p class="h5 text-center mb-0 p-2">Other Info </p><!--<p>All fields indicated in (*) are obligatory.</p>-->
                   <hr class="light-blue lighten-1 title-hr">
				   <!--Grid row-->
            <div class="row">
			<!--Grid column-->
				<div class="col-md-4 mb-4">
				<div>
				<i class="fas fa-truck prefix grey-text"></i>
				<label for="truck_id" class="active">Truck Number</label>
				<select name="truck_id" class=" form-control">
				<option value="0" selected >Select Truck Number</option>
				<?php 
				for($i=0; $i<$n3; $i++){
				?>
				<option value="<?php echo $rs_vehicle[$i]["plat_number"]; ?>"<?php if($rs_vehicle[$i]["plat_number"] == $rs_paycheck[0]["truck_id"]) echo " selected"; ?>><?php echo $rs_vehicle[$i]["plat_number"]; ?></option>
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
				
				<i class="fas fa-user prefix grey-text"></i>
				<label for="emp_id" class="active">Employee Name</label>
				<select name="emp_id" class=" form-control">
				<option value="0" selected >Employee Name</option>
				<?php 
				for($i=0; $i<$n4; $i++){
				?>
				<option value="<?php echo $rs_employee[$i]["emp_id"]; ?>"<?php if($rs_employee[$i]["emp_id"] == $rs_paycheck[0]["emp_id"]) echo " selected"; ?>><?php echo $rs_employee[$i]["first_name"].' '.$rs_employee[$i]["last_name"].' '; ?></option>
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
						<i class="fas fa-calendar-week prefix grey-text"></i>
						<label for="sdate" class="active">Start Date</label>
						<input name="sdate" type="text" id="datepicker_start" value="<?php echo $rs_paycheck[0]["sdate"]; ?>" class="form-control">  
					</div>
				</div>	
              <!--Grid column-->	
               <!--Grid column-->
				<div class="col-md-4 mb-4">
					<div>
						<i class="fas fa-calendar-week prefix grey-text"></i>
						<label for="edate" class="active">End Date</label>
						<input name="edate" type="text" id="datepicker_end" value="<?php echo $rs_paycheck[0]["edate"]; ?>"  class="form-control" >  
					</div>
				</div>	
              <!--Grid column-->	
				<!--Grid column-->
				<div class="col-md-4 mb-4">
				<div>
				
				<i class="fas fa-user prefix grey-text"></i>
				<label for="week" class="active">Weeks</label>
				<select name="week" class=" form-control">
				<option value="0" selected >Week Name</option>
				<?php 
				for($i=0; $i<$n1; $i++){
				?>
				<option value="<?php echo $rs_week[$i]["week"]; ?>"<?php if($rs_week[$i]["week"] == $rs_paycheck[0]["week_name"]) echo " selected"; ?>><?php echo $rs_week[$i]["week"]; ?></option>
				<?php 
				} 
				?>
				</select>
				</div>
				</div>
                <!--Grid column-->						  
            </div>
		<!--Grid row-->	
               <div class="text-center mt-4">
                 <input name="submit" type="submit" value="Update" id="submit" class="btn btn-primary"/>
                  <!--<button name="submit"  type="submit" class="btn btn-primary" id="submit" >Submit</button>-->
                </div>
				
              </form>
			
              <!-- Register form -->
			
        <!--Grid column-->
		 	
		 
	</div>
</main>
<!--Main layout-->
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

<!-- Footer -->
<?php include("footer.php"); ?>

<!-- Footer -->