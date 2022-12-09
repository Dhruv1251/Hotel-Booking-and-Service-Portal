<?php
include("header.php");
 $sqlpayment ="SELECT * FROM payment LEFT JOIN room_booking ON payment.room_booking_id=room_booking.room_booking_id where payment_id='$_GET[paymentid]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
echo mysqli_error($con);
$rspayment = mysqli_fetch_array($qsqlpayment);
//echo $rspayment[room_booking_id];
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
<!-- start main_content -->
<center style="font-size:25px;">Rent a Car</center><br>
<center>Select vehicle to Book...</center>
<hr>
<?php
$i=0;
	$sql = "SELECT * FROM vehicle_type WHERE status='Active' AND hotel_id='$rspayment[hotel_id]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs[vehicle_img] == "")
		{
				$imgname= "images/noimage.png";
		}
		else
		{
			if(file_exists("imgvehicletype/".$rs[vehicle_img]))
			{
				$imgname= "imgvehicletype/".$rs[vehicle_img];
			}
			else
			{
				$imgname= "images/noimage.png";
			}
		}
	?>
		<?php
		if($i==0)
		{
		?>
		<ul class="service_list">
		<?php
		}
		?>
		
		<li>
			<div class="panel panel-default">
			<div class="ser_img">
				<a href="cabbooking.php?vehicle_typeid=<?php echo $rs[0]; ?>&paymentid=<?php echo $_GET[paymentid]; ?>">
		<img src="<?php echo $imgname ; ?>" alt="<?php echo $rs[hotel_name]; ?>" style="height:200px;" />
				
				</a>
			</div>	
			<a href="cabbooking.php?vehicle_typeid=<?php echo $rs[0]; ?>&paymentid=<?php echo $_GET[paymentid]; ?>"><h3 style="padding:10px;"><?php echo $rs[vehicle_type]; ?></h3></a>
			<p class="para" style="padding:10px;">Cost : ₹<?php echo $rs[km_cost]; ?>/KM</p>
			<h4><a  href="cabbooking.php?vehicle_typeid=<?php echo $rs[0]; ?>&paymentid=<?php echo $_GET[paymentid]; ?>"  class="btn btn-default">Select</a></h4>
			</div>
		</li>
		
		<?php
		if($i==3)
		{
		?>
			<div class="clear"></div>
			</ul>
			<hr>
		<?php
			$i=0;
		}
		else
		{
			$i++;
		}
		?>
<?php
	}
?>		
					
					
		<div class="clear"></div>
	<!-- end main_content -->

	</div>
</div>
</div>		
<!--start main -->
<?php
include("footer.php");
?>