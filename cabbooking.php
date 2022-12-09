<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql = "INSERT INTO cab_booking(vehicle_typeid,customer_id,booking_date,booking_time,flocation,tlocation,total_km,cost,status,payment_id) VALUES('$_GET[vehicle_typeid]','$_SESSION[customer_id]','$_POST[booking_date]','$_POST[booking_time]','$_POST[flocation]','$_POST[tlocation]','$_POST[total_km]','$_POST[costperkm]','Pending','$_GET[paymentid]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1 )
	{
		$insid = mysqli_insert_id($con);
		echo "<SCRIPT>alert('Cab Booking record inserted successfully..');</SCRIPT>";
		echo "<SCRIPT>window.location='cabbookingpayment.php?cab_bookingid=$insid&vehicle_typeid=$_GET[vehicle_typeid]&paymentid=$_GET[paymentid]';</SCRIPT>";			
	}
}
else
{
	$sql = "DELETE FROM cab_booking WHERE status='Cancel'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM cab_booking WHERE cab_bookingid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Update - select record ends here
?>

<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="contact">

		
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
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
			<th>Adult</th>
			<th>Children</th>
			<th>Check-in date</th>
			<th>Check-out date</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql = "SELECT * FROM room_booking LEFT JOIN hotel ON room_booking.hotel_id=hotel.hotel_id LEFT JOIN room_type ON room_booking.room_typeid=room_type.room_typeid LEFT JOIN customer ON room_booking.customer_id=customer.customer_id LEFT JOIN payment ON payment.room_booking_id=room_booking.room_booking_id LEFT JOIN location ON location.location_id=hotel.location_id WHERE room_booking.status='Active' AND payment.payment_id='$_GET[paymentid]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$room_booking_id = $rs[room_booking_id];
		$hotelid=  $rs[hotel_id];
		$_GET[hotel_id] = $hotelid;
		$location_name = $rs[location_name];
		$hotel_pincode = $rs[hotel_pincode];
		$hotel_address= $rs[hotel_address];
		echo "<input type='hidden' name='room_booking_id' value='$rs[room_booking_id]' >";
		$checkin = date("d-M-Y",strtotime($rs[check_in]));
		$checkout = date("d-M-Y",strtotime($rs[check_out]));
		$checkindt = date("Y-m-d",strtotime($rs[check_in]));
		$checkoutdt = date("Y-m-d",strtotime($rs[check_out]));
		echo "<tr>
			<td>$rs[hotel_name]</td>
			<td>$rs[room_type]</td>";
			if(!isset($_SESSION[customer_id]))
			{
		echo "<td>$rs[customer_name]</td>";
			}
		echo "<td>$rs[no_ofadults]</td>
			<td>$rs[no_ofchildren]</td>
			<td>$checkin</td>
			<td>$checkout</td>
		</tr>";
	}
	?>	
	</tbody>
</table>
<hr>
		
<div class="contact_left">

<div class="company_address">
		<h3>Vehicle information :</h3>
		<p>
		
		<?php
$i=0;
	$sql = "SELECT * FROM vehicle_type WHERE status='Active' AND vehicle_typeid='$_GET[vehicle_typeid]'";
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

		
			<div class="panel panel-default">
			<div class="ser_img">
				<a href="cabbooking.php?vehicle_typeid=<?php echo $rs[0]; ?>">
		<img src="<?php echo $imgname ; ?>" alt="<?php echo $rs[hotel_name]; ?>" style="height:200px;" />
				
				</a>
			</div>	
			<a href="cabbooking.php?vehicle_typeid=<?php echo $rs[0]; ?>"><h3 style="padding:10px;"><?php echo $rs[vehicle_type]; ?></h3></a>
			<p class="para" style="padding:10px;">Cost : ₹<?php echo $kmcost = $rs[km_cost]; ?>/KM</p>
			</div>
			<div class="clear"></div>
			<hr>

<?php
	}
?>		
		</p>		
   </div>
</div>
				
<div class="contact_right">
  <div class="contact-form">
	<h3>Cab Booking detail</h3>
<form method="post" action="" onsubmit="return validateform()">

<input type="hidden" name="pincode" id="pincode" value="<?php echo $hotel_pincode; ?>" >

	<div>
		<span><label>Booking Date</label></span>
		<span ><input name="booking_date" id="booking_date" type="date" class="form-control" value="<?php echo $rsedit[booking_date]; ?>" min="<?php
		echo $checkindt;
		?>" max="<?php echo $checkoutdt; ?>" onchange="funbooking_date(this.value,'<?php echo $dt; ?>')"></span>
	</div>
	<script>
	function funbooking_date(selecteddate,bookingdate)
	{
		if(selecteddate == bookingdate)
		{
			//alert(selecteddate);
			//alert(bookingdate);
			document.getElementById("divbooking_time").innerHTML = "<input name='booking_time' id='booking_time' type='time' class='form-control' min='<?php echo $tim; ?>'>";
		}
	}
	</script>
	<div>
		<span><label>Booking Time</label></span>
		<span id="divbooking_time"><input name="booking_time" id="booking_time" type="time" class="form-control" value="<?php echo $rsedit[booking_time]; ?>" ></span>
	</div>
	<script>
	function 
	divbooking_time
	</script>
	<div> 
		<span><label>From Location</label></span>
		<span><input name="flocation" id="flocation" type="text" class="form-control" value="<?php echo $hotel_address. "," .$location_name; ?>" readonly style="background-color:grey;color:white;"></span>
	</div>
	
	
	<div>
		<span><label>To Location</label></span>
		<span><input name="tlocation" id="tlocation" type="text" class="form-control" value="<?php echo $hotel_address. "," .$location_name; ?>"></span>
		
	</div>
	

	<div>
		<span><label>Cost / KM</label></span>
		<span><input type="text" class="form-control" name="costperkm" id="costperkm" placeholder="Enter a location" readonly  style="background-color:grey;color:white;" value="<?php echo $kmcost; ?>" /></span>
	</div>
	
	
	<div>
		<span><label>Total KM</label></span>
		<span><input name="total_km" id="total_km" type="text" class="form-control"  ></span>
	</div>
	<div>
		<span><label>Minimum to Pay in Advanced</label></span>
		<span><input name="cost" id="cost" type="text" class="form-control" value="<?php echo $kmcost; ?>" readonly style="background-color:grey;color:white;"></span>
	</div>
	
   <div>
		<span><input type="submit" value="Click here to Confirm" name="submit" ></span>
  </div>
</form>

	</div>
</div>		
  				<div class="clear"></div>		
		  </div>
	</div>
</div>
</div>		
<!--start main -->
<?php
include("footer.php");
?>
<script>
function validateform()
{
	if(document.getElementById("booking_date").value == "")
	{
		alert("Kindly enter Booking Date..");
		return false;
	}
	else if(document.getElementById("booking_time").value == "")
	{
		alert("Kindly enter Booking Time...");
		return false;
	}
	else if(document.getElementById("flocation").value == "")
	{
		alert("Kindly enter from Location...");
		return false;
	}
	else if(document.getElementById("txtPlaces").value == "")
	{
		alert("Kindly enter To Location...");
		return false;
	}
	else if(document.getElementById("total_km").value == "")
	{
		alert("Kindly enter Total Kilometers...");
		return false;
	}
	else if(document.getElementById("cost").value == "")
	{
		alert("Cost should not be empty");
		return false;
	}
	else if(document.getElementById("status").value == "")
	{
		alert("Kindly select the status....");
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDn1JrKoNqygrc0Wjei_wpPCSFIJXvvclk"></script>

<script type="text/javascript">
	google.maps.event.addDomListener(window, 'load', function () {
		var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
		google.maps.event.addListener(places, 'place_changed', function () {
			var place = places.getPlace();
			var address = place.formatted_address;
			var latitude = place.geometry.location.lat();
			var longitude = place.geometry.location.lng();
			var mesg = "Address: " + address;
			mesg += "\nLatitude: " + latitude;
			mesg += "\nLongitude: " + longitude;
			funcalculatekm(latitude,longitude);
		});
	});
</script>
<script>
function funcalculatekm(latitude,longitude)
{
		var latitude = latitude;
		var longitude = longitude;
		var pincode  = $('#pincode').val();
			$.post("ajaxtotalkm.php",
			{
				latitude : latitude,
				longitude : longitude,
				pincode : pincode
			},
			function(data, status){
				document.getElementById('total_km').value=data;
				calculatetotalamount();
			});
}
function calculatetotalamount()
{
	var total_km = document.getElementById("total_km").value;
	var costperkm = document.getElementById("costperkm").value;;
	document.getElementById("cost").value  = parseFloat(total_km) * parseFloat(costperkm);
}
</script>