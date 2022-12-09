<?php
include("header.php");
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
<!-- start main_content -->

<div class="col-md-12">
&nbsp;
</div>
<div class="col-md-12">
	<div class="online_reservation">
	<div class="b_room">
		<div class="booking_room" >
			<h4>book a room online</h4>
			 <h5 class="title1"> FindMyStay - Smart Booking Solution </h5>
		</div>
<form method="get" action="hotel.php">
		<div class="reservation">
			<ul>
<li class="span1_of_1 left" style="width:305px;">
	<h5>Hotel Type:</h5>
	<div class="section_room">
		<select name="hotel_type" class="form-control" >
			<option value=''>Select hotel type</option>
			<?php
			$arr = array("Half Star","1 Star","2 Star","3 Star","4 Star","5 Star");
			foreach($arr as $val)
			{
				if($val == $_GET[hotel_type])
				{
				echo "<option selected value='$val'>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
	</div>	
</li>

<li class="span1_of_1" style="width:5px;">&nbsp;
</li>

<li class="span1_of_1 left" style="width:450px;">
	<h5>Location:</h5>
	<div class="section_room">
<input class="form-control" id="locationhotel" name="locationhotel" type="text" placeholder="Search location / Hotel" value="<?php echo $_GET[locationhotel]; ?>">
	</div>	
</li>
		
<li class="span1_of_1" style="width:5px;">&nbsp;
</li>

<li class="span1_of_1 left" style="width:305px;">
	<h5>&nbsp;</h5>
	<div class="section_room">
<input type="submit" value="Search"   class="form-control"/>
	</div>	
</li>		
				<div class="clear"></div>
			</ul>
		</div>
</form>	
						<div class="clear"></div>
			</div>
	</div>					
</div>
	
	
<?php
$i=0;
	$sql = "SELECT * FROM hotel LEFT JOIN location ON location.location_id = hotel.location_id WHERE hotel.status='Active'";
	if($_GET[hotel_type] != "")
	{
		$sql = $sql . " AND hotel.hotel_type='$_GET[hotel_type]'";
	}
	if($_GET[locationhotel] != "")
	{
		$sql = $sql . " AND (location.location_name like '%$_GET[locationhotel]%' OR hotel.hotel_name LIKE '%$_GET[locationhotel]%')";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlimg= "SELECT * FROM hotel_image WHERE hotel_id='$rs[hotel_id]'";
		$qsqimg = mysqli_query($con,$sqlimg);
		$rsimg = mysqli_fetch_array($qsqimg);
		if(mysqli_num_rows($qsqimg) ==0)
		{
				$imgname= "images/noimage.png";
		}
		else
		{
			if(file_exists("imghotel/".$rsimg[hotel_image]))
			{
				$imgname= "imghotel/".$rsimg[hotel_image];
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
			<div class="ser_img">
				<a href="hoteldetails.php?hotelid=<?php echo $rs[0]; ?>">
		<img src="<?php echo $imgname ; ?>" alt="<?php echo $rs[hotel_name]; ?>" style="height:200px;" />
				
				</a>
			</div>	
			<a href="hoteldetails.php?hotelid=<?php echo $rs[0]; ?>"><h3><?php echo $rs[hotel_name]; ?></h3></a>
			<p class="para"><?php echo $rs[hotel_type]; ?> hotel</p>
			<h4><a  href="hoteldetails.php?hotelid=<?php echo $rs[0]; ?>">View hotel detail</a></h4>
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