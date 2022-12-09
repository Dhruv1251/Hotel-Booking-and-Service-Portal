<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM payment WHERE payment_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Payment record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<center style="font-size:25px;"><h2>Payment Report</h2></center>
		</div>			
			<div class="span_of_2">
				
<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Customer</th>
			<th>Transaction type</th>
			<th>Payment Date</th>
			<th>Payment Type</th>
			<th>Card No</th>
			<th>CVV No</th>
			<th>Card Expiry Date</th>
			<th>Total Amount</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN room_booking ON payment.room_booking_id=room_booking.room_booking_id LEFT JOIN spa_service_booking ON payment.spa_service_bookingid=spa_service_booking.spa_sevice_bookingid LEFT JOIN food_order ON payment.food_order_id=food_order.food_order_id LEFT JOIN cab_booking ON payment.cab_bookingid=cab_booking.cab_bookingid ORDER BY payment.payment_id DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs[2] != 0 && $rs[3] == 0 && $rs[4] == 0 && $rs[5] == 0)
		{
			$transtype = "<b style='color:green;'>Room Booking</b>";
		}
		else if($rs[2] != 0 && $rs[3] != 0 && $rs[4] == 0 && $rs[5] == 0)
		{
			$transtype = "<b style='color:violet;'>Spa service</b>";
		}
		else if($rs[2] != 0 && $rs[3] == 0 && $rs[4] != 0 && $rs[5] == 0)
		{
			$transtype = "<b style='color:red;'>Food Order</b>";
		}
		else if($rs[2] != 0 && $rs[3] == 0 && $rs[4] == 0 && $rs[5] != 0)
		{
			$transtype = "<b style='color:blue;'>Cab Booking</b>";
		}
		echo "<tr>
			<td>$rs[0]</td>
			<td>$rs[customer_name]</td>
			<td>$transtype</td>
			<td>" . date("d-M-Y",strtotime($rs[payment_date])) . "</td>
			<td>$rs[payment_type]</td>
			<td>$rs[card_no]</td>
			<td>$rs[cvv_no]</td>
			<td>" . date("M-Y",strtotime($rs[exp_date])) . "</td>
			<th style='color:green;'>₹$rs[total_amt]</th>
		</tr>";
	}
	?>	
	</tbody>
</table>
				
				
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
function confirmdelete()
{
	if(confirm("Are you sure you want to delete this record??") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>