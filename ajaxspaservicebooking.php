<?php
error_reporting(0);
session_start();
include("connection.php");
$dt = date("Y-m-d");
if(isset($_GET[delete]))
{
	$sqldelete = "DELETE FROM spa_service_booking WHERE spa_sevice_bookingid='$_GET[spa_sevice_bookingid]'";
	$qsql = mysqli_query($con,$sqldelete);
}
?>
<?php
if(isset($_GET[submit]))
{
	$sql = "INSERT INTO spa_service_booking(spa_serviceid,customer_id,cost,status) VALUES('$_GET[spaid]','$_SESSION[customer_id]','$_GET[cost]','Pending')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
?>
<form method="post" action="" onsubmit="return validateform()">
<h2 style="color:violet;font-size:25px;">Your Orders</h2>
<?php
	$sql = "SELECT * FROM spa_service_booking LEFT JOIN spa_service ON spa_service_booking.spa_serviceid=spa_service.spa_serviceid LEFT JOIN customer ON spa_service_booking.customer_id=customer.customer_id WHERE spa_service_booking.status='Pending' ORDER BY spa_service_booking.spa_sevice_bookingid desc";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
				if(file_exists("imgspa/$rssqlspa_service[service_images]"))
			{
				$imgname = "imgspa/$rssqlspa_service[service_images]";				
			}
			else
			{
				$imgname = "images/noimage.png";
			}
?>		
<div class="well">
  <div class="media">
		<div class="media-body">
			<h4 class="media-heading" style="color:blue;font-size:25px;"><?php echo $rs[service_type]; ?><span class="text-left" style="color:red;font-size:12px;"> For <?php echo $rs[gender]; ?></span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="text-align: right;cursor:pointer;color:red;" onclick="deletespaservice('<?php echo $rs[0]; ?>')">X</span>
			</h4>
			<span> Cost : ₹<?php echo $rs[service_cost]; ?></span>
		</div>
		<hr>
		<input type="hidden" name="spa_serviceid[]" value='<?php echo $rs[0]; ?>' >
		<div class="col-md-12">
			Booking Date:
			<input type="Date" name="bookingdate[]" id="bookingdate[]" min="<?php echo $_GET[checkin]; ?>" max="<?php echo $_GET[checkout]; ?>" required >
		</div>
		<div class="col-md-12">
			Booking Time:
			<input type="time" name="bookingtime[]" id="bookingtime[]"  required >
		</div>
		
		<div class="col-md-12">
			Any Note: 
			<textarea name="note[]" id="note[]" class="form-control"></textarea>
		</div>
		<p>&nbsp;</p>
	</div>
</div>
</form>
	<?php
	}
?>

	<div>
	<br>
		<input type="submit" name="submit" value="Confirm Booking" class="form-control" >
	</div>
</div>
<script>
function validateform()
{
	if(document.getElementById("bookingdate").value == "")
	{
		alert("Kindly select the Booking Date..");
		return false;
	}
	else if(document.getElementById("bookingtime").value == "")
	{
		alert("Kindly select the Booking Time..");
		return false;
	}
else
{
	return true;
}
}
</script>