<?php
include("header.php");
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Room Booking</h4>
		</div>			
			<div class="span_of_2">
				
<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Hotel</th>
			<th>Room Type</th>
			<?php
			if(!isset($_SESSION[customer_id]))
			{
			?>
			<th>Customer</th>
			<?php
			}
			?>
			<th>Booked for</th>
			<th>Booking date</th>
			<th>Cost</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM room_booking LEFT JOIN hotel ON room_booking.hotel_id=hotel.hotel_id LEFT JOIN room_type ON room_booking.room_typeid=room_type.room_typeid LEFT JOIN customer ON room_booking.customer_id=customer.customer_id LEFT JOIN payment ON payment.room_booking_id=room_booking.room_booking_id WHERE room_booking.status='Active' ";
	if(isset($_SESSION[customer_id]))
	{
	$sql = $sql . " AND room_booking.customer_id='$_SESSION[customer_id]'";
	}
	$sql = $sql . " ORDER BY room_booking.room_booking_id desc";
	//echo $sql;
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlhotel_image = "SELECT * FROM hotel_image WHERE hotel_id='$rs[1]' AND room_typeid='$rs[room_typeid]'";
		$qsqlhotel_image = mysqli_query($con,$sqlhotel_image);
		$rshotel_image = mysqli_fetch_array($qsqlhotel_image);		
		
		if(mysqli_num_rows($qsqlhotel_image) == 0)
		{
			$imgname = "images/noimage.png";
		}
		else
		{
			if(file_exists("imghotel/$rshotel_image[hotel_image]"))
			{
				$imgname = "imghotel/$rshotel_image[hotel_image]";				
			}
			else
			{
				$imgname = "images/noimage.png";
			}
		}

		$checkin = date("d-M-Y",strtotime($rs[check_in]));
		$checkout = date("d-M-Y",strtotime($rs[check_out]));
		echo "<tr>
			<th>
			<center>
			<p style='color:red;font-size:25px;'><br>
			$rs[payment_id]</p>
			</center>
			</th>
			<td>$rs[hotel_image] $rs[hotel_name]<br><img src='$imgname' style='width:150px;height:100px;'></td>
			<td>$rs[room_type]<br>(₹$rs[cost] / day)</td>";
			if(!isset($_SESSION[customer_id]))
			{
		echo "<td>$rs[customer_name]</td>";
			}
		echo "<td>Adults : $rs[no_ofadults]<br>Children: $rs[no_ofchildren]</td>
			<td>
			CheckIn : $checkin<br>Checkout : $checkout <br><b style='color:green;'>";
$checkin = strtotime($rs[check_in]);
$checkout = strtotime($rs[check_out]);
$datediff = $checkout - $checkin;
$nodays = round($datediff / (60 * 60 * 24));
$nodays = $nodays +1;
if($nodays == 1 )
{
	echo $nodays . " Day"; 
}
else
{
	echo $nodays . " Days"; 
}
		echo "</b></td>
			<td>₹". $rs[cost]*$nodays . "</td>
			<td><center><a href='hotelbookingreceipt.php?paymentid=$rs[payment_id]'>Receipt</a>";
			echo "<hr><a href='cancellation.php?paymentid=$rs[payment_id]'>Cancellation</a>";
			if(isset($_SESSION[customer_id]))
			{
				
$checkoutday = strtotime($rs[check_out]);
$datediffday = $checkoutday - strtotime($dt);
$nodays = round($datediffday / (60 * 60 * 24));
$nodays = $nodays+1;

				if($nodays >= 1)
				{
				echo "<hr><a href='hotelservices.php?paymentid=$rs[payment_id]'>Add Services</a>";
				}
				
$checkoutday = strtotime($rs[check_in]);
$datediffday = $checkoutday - strtotime($dt);
$nodays = round($datediffday / (60 * 60 * 24));
$nodays = $nodays+1;
				if($nodays > 1)
				{
				echo "<hr><a href='cancellation.php?paymentid=$rs[payment_id]'>Cancellation</a>";
				}
			}
			
			
			echo "</center></td></tr>";
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