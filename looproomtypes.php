<style>
a.list-group-item {
    height:auto;
    min-height:220px;
}
a.list-group-item.active small {
    color:#fff;
}
.stars {
    margin:20px auto 1px;    
}
</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="width:100%;">
    <div class="row" style="width:100%;">
		<div class="well">
        <h1 class="text-center" style="font-size:22px;">Room types</h1>
        <div class="list-group">
<?php
	$i =0;
	$sqlroomtype ="SELECT * FROM room_type where room_type.status='Active' AND room_type.hotel_id='$_GET[hotelid]'  ";
	if($_GET[room_type])
	{
	$sqlroomtype = $sqlroomtype . " AND room_typeid='$_GET[room_type]'";
	}
	$qsqlroomtype = mysqli_query($con,$sqlroomtype);
	while($rsroomtype = mysqli_fetch_array($qsqlroomtype))
	{
		$sqlroomtypeimg ="SELECT * FROM hotel_image where status='Active' AND room_typeid='$rsroomtype[0]'";
		$qsqlroomtypeimg = mysqli_query($con,$sqlroomtypeimg);
		$rsroomtypeimg = mysqli_fetch_array($qsqlroomtypeimg);
		
		if(mysqli_num_rows($qsqlroomtypeimg) == 0)
		{
			$imgname = "images/noimage.png";
		}
		else
		{
			if(file_exists("imghotel/$rsroomtypeimg[hotel_image]"))
			{
				$imgname = "imghotel/$rsroomtypeimg[hotel_image]";				
			}
			else
			{
				$imgname = "images/noimage.png";
			}
		}
?>
   <a href="#" class="list-group-item" >
                <div class="media col-md-3">
                    <figure class="pull-left">
                        <img class="media-object img-rounded img-responsive" src="<?php echo $imgname; ?>" style="width:350px;height:175px;">
                    </figure>
                </div>
                <div class="col-md-6">
                    <h4 class="list-group-item-heading"> <?php echo $rsroomtype[room_type]; ?> </h4>
                    <p class="list-group-item-text" style="width:500px;">
					Max Adult : <?php echo $rsroomtype[max_adult]; ?> | Max Child : <?php echo $rsroomtype[max_children]; ?><br>
			
			</p>
			<p class="list-group-item-text" style="width:500px;">
			<hr>
			<b>Facilities:</b> 
	<?php
	$hotelfacility = "";
	$sqlhotel_facility ="SELECT * FROM hotel_facility where  room_typeid='$rsroomtype[0]'";
	$qsqlhotel_facility = mysqli_query($con,$sqlhotel_facility);
	while($rshotel_facility = mysqli_fetch_array($qsqlhotel_facility))
	{
		$hotelfacility =  $hotelfacility . $rshotel_facility[facility_type] . ",";
	}
	echo rtrim($hotelfacility,", ");
	?>
			</p>
                </div>
                <div class="col-md-3 text-center">
                    <h2>Rs. <?php echo $rsroomtype[cost]; ?></h2>
<?php
if($_GET[room_type] != "")
{
	$room_type = $_GET[room_type];
}
else
{
	$room_type = $rsroomtype[0];
}
?>	
<?php
if($_GET[adults] != "")
{
	$adults = $_GET[adults];
}
else
{
	$adults = $rsroomtype[max_adult];
} 
?>	
<?php
if($_GET[children] != "")
{
	$children = $_GET[children];
}
else
{
	$children = $rsroomtype[max_children];
}

	$sqlroom_booking = "SELECT * FROM room_booking WHERE room_typeid='$rsroomtype[0]' AND (('$checkindt' BETWEEN check_in AND check_out)  OR ('$checkoutdt' BETWEEN check_in AND check_out))  AND status='Active'";
	$qsqlsqlroom_booking=mysqli_query($con,$sqlroom_booking);
	$noofbookings = mysqli_num_rows($qsqlsqlroom_booking);
	$noavailableroom = $rsroomtype[no_of_room] - $noofbookings;
	if($noavailableroom >= 1 )
	{
?>						
<button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location='hotelbooking.php?hotelid=<?php echo $_GET[hotelid]; ?>&room_type=<?php echo $room_type; ?>&adults=<?php echo $adults; ?>&children=<?php echo $children; ?>&checkin=<?php echo $checkindt; ?>&checkout=<?php echo $checkoutdt; ?>&btnsearch=Check+Availability'">Book Now</button>
			No. of Rooms Available: <?php echo $noavailableroom; ?>
<?php
	}
	else
	{
?>
<button type="button" class="btn btn-primary btn-lg btn-block" style="background-color:grey;" >No rooms available</button>
<?php
	}
?>
                </div>
          </a>
       <?php
	}
	   ?>
	   </div>
        </div>
	</div>
</div>