<?php
include("header.php");
$sqlpayment = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN cab_booking ON cab_booking.payment_id = payment.payment_id WHERE payment.payment_id='$_GET[paymentid]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
$rspayment = mysqli_fetch_array($qsqlpayment);
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">			
			<div>				

<div >
	<div >
		
        <div class="col-md-12" id="divprintarea">
         
		
			
            <div>
			
			<center><h4 style="font-size:25px;font-weight: bold; color:red;">Cab Booking Receipt...</h4></center>
			
<table class="table table-bordered">
	<thead>
		<tr>
			<th colspan="2">
				<center>
				<img src="images/findmystay.png" alt="" width="250px;" style="height:150px;"><br>
				FindMyStay<br>
				3rd floor, city light building<br>
				Mangalore
				</center>
			</th>
		</tr>
		<tr>
			<th style="width:50%">Name : <?php echo $rspayment[customer_name]; ?></td>
			<th style="width:50%">Bill No. <?php echo $rspayment[payment_id]; ?></th>
		</tr>
		<tr>
			<th style="width:50%">
			Address:<br>  <?php echo $rspayment[address]; ?>, <?php echo $rspayment[city]; ?>, <?php echo $rspayment[pincode]; ?><br>
			Contact No.   <?php echo $rspayment[contact_no]; ?><br>
			Email ID.   <?php echo $rspayment[email_id]; ?>
			</th>
			<th style="width:50%;">
			Bill Date: <?php echo date("d-M-Y",strtotime($rspayment[payment_date])); ?><br>&nbsp;
			</th>
		</tr>
	</tbody>
</table>



<hr>
<table  class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Vehicle Type</th>
			<th>Booking Date</th>
			<th>Booking Time</th>
			<th>From Location</th>
			<th>To Location</th>
			<th>Cost</th>
			<th>Total K.M</th>
			<th>Total Cost</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM cab_booking LEFT JOIN vehicle_type ON cab_booking.vehicle_typeid=vehicle_type.vehicle_typeid LEFT JOIN customer ON cab_booking.customer_id=customer.customer_id WHERE cab_booking.cab_bookingid='$rspayment[cab_bookingid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[vehicle_type]</td>
			<td>$rs[booking_date]</td>
			<td>$rs[booking_time]</td>
			<td>$rs[flocation]</td>
			<td>$rs[tlocation]</td>
			<td>₹$rs[cost]</td>
			<td>$rs[total_km]</td>
			<td>₹" . $totalamt = $rs[cost] * $rs[total_km] . "</td>
		</tr>"; 
	}
	?>	
	</tbody>
</table>



				<hr>
<center><input type="button" class="form-control" value="Print" style="width:500px;" onclick="PrintElem('divprintarea')"></center>
				
            </div>
			
			
        </div>    
	</div>
</div>
				
				<div class="clear"></div>
			</div>
	</div>
</div>
</div>		
<!--start main -->
<?php
include("datatable.php");
include("footer.php");
?>
<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>