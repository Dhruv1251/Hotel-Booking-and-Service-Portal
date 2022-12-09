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
			<h4>View Cancellation Report</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Bill No.</th>
							<th>Room Booking</th>
							<th>Customer</th>
							<th>Refundable Amount</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
 $sql = "SELECT * FROM payment LEFT JOIN room_booking ON payment.name=room_booking.room_booking_id LEFT JOIN customer ON payment.customer_id=customer.customer_id where payment.payment_id!='0' and payment.status='Cancel'  ";
	if(isset($_SESSION[customer_id]))
	{
	  $sql = $sql . " AND payment.customer_id='$_SESSION[customer_id]'";
	}
 
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
$sqlhotel = "select * from hotel WHERE hotel_id='$rs[hotel_id]'";
$qsqlhotel = mysqli_query($con,$sqlhotel);
$rshotel = mysqli_fetch_array($qsqlhotel);
						
						echo "<tr>
							<td><p style='color:red;'>$rs[payment_id]</p></td>
							<td>$rshotel[hotel_name]</td>
							<td>$rs[customer_name]</td>
							<td>₹$rs[12]</td>
							<td><a href='cancellationreceipt.php?paymentid=$rs[0]' >Receipt</a>
							
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