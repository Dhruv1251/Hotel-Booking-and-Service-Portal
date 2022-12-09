<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM cab_booking WHERE cab_bookingid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Cab Booking record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Cab Booking</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Bill No.</th>
							<th>Room Booking</th>
							<th>Customer</th>
							<th>Vehicle Type</th>
							<th>Booking Date & Time</th>
							<th>From Location</th>
							<th>To Location</th>
							<th>Cost/KM</th>
							<th>Approx K.M</th>
							<th>Total Amount</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
 $sql = "SELECT * FROM cab_booking LEFT JOIN payment  ON payment.payment_id=cab_booking.payment_id LEFT JOIN room_booking ON payment.room_booking_id=room_booking.room_booking_id LEFT JOIN vehicle_type ON cab_booking.vehicle_typeid=vehicle_type.vehicle_typeid LEFT JOIN customer ON cab_booking.customer_id=customer.customer_id  ";
 $sql = $sql . " WHERE cab_booking.cab_bookingid!='0' ";
	if(isset($_SESSION[customer_id]))
	{
	  $sql = $sql . " AND cab_booking.customer_id='$_SESSION[customer_id]'";
	}
 
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
$sqlhotel = "select * from hotel WHERE hotel_id='$rs[hotel_id]'";
$qsqlhotel = mysqli_query($con,$sqlhotel);
$rshotel = mysqli_fetch_array($qsqlhotel);
						
$bookdttime = date("d-M-Y",strtotime($rs[booking_date])). " " . date("h:i A",strtotime($rs[booking_time]));
						echo "<tr>
							<td><p style='color:red;'>$rs[payment_id]</p></td>
							<td>$rshotel[hotel_name]</td>
							<td>$rs[customer_name]</td>
							<td>$rs[vehicle_type]</td>
							<td>$bookdttime</td>
							<td>$rs[flocation]</td>
							<td>$rs[tlocation]</td>
							<td>₹$rs[9]</td>
							<td>$rs[total_km]</td>
							<td>₹" . $rs[total_km] * $rs[9]  . "</td>
							<td><a href='cabbookingreceipt.php?paymentid=$rs[1]' >Receipt</a>
							<td><a href='cancellation.php?paymentid=$rs[1]' >cancellation</a>
							
							</td>
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