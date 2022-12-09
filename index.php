<?php
include("header.php");
?>
<!----start-images-slider---->
		<div class="images-slider">
			<!-- start slider -->
		    <div id="fwslider">
		        <div class="slider_container">
		            <div class="slide"> 
		                <!-- Slide image -->
		                    <img src="images/hotelbackgroundimage.jpg" alt=""/>
		                <!-- /Slide image -->
		                <!-- Texts container -->
		                <div class="slide_content">
		                    <div class="slide_content_wrap">
		                        <!-- Text title -->
		                        <h4 class="title"><i class="bg"></i>FindMyStay</h4>
		                        <h5 class="title1"><i class="bg"></i>Smart Booking Solution</h5>
		                        <!-- /Text title -->
		                    </div>
		                </div>  
		                 <!-- /Texts container -->
		            </div>
		            <!-- /Duplicate to create more slides -->
		            <div class="slide">
		                <img src="images/hotelbackgroundimage1.jpg" alt=""/>
		                <div class="slide_content">
		                     <div class="slide_content_wrap">
		                        <!-- Text title -->
		                        <h4 class="title">FindMyStay</h4>
		                        <h5 class="title1"> Smart Booking Solution </h5>
		                        <!-- /Text title -->
		                    </div>
		                </div>
		            </div>
		            <!--/slide -->
		        </div>
		        <div class="timers"> </div>
		        <div class="slidePrev"><span> </span></div>
		        <div class="slideNext"><span> </span></div>
		    </div>
		    <!--/slider -->
		</div>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="online_reservation">
	<div class="b_room">
		<div class="booking_room" >
			<h4>book a room online</h4>
			 <h5 class="title1"> FindMyStay - Smart Booking Solution </h5>
		</div>
<form method="get" action="hotel.php" onsubmit="return validateform()">
		<div class="reservation">
			<ul>
<li class="span1_of_1 left" style="width:305px;">
	<h5>Hotel Type:</h5>
	<div class="section_room">
		<select name="hotel_type" id="hotel_type" class="form-control" >
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
	<!--start grids_of_3 -->
	<div class="grids_of_3">
		
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/Rent A Car.png" alt="" style="width:480;height:340px;" />
				</a>
			</div>
			<h4><a href="#">Rent a car</a></h4>
			<p>Rent or Book vehicles through online</p>
		</div>
		
		<div class="clear"></div>
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
	if(document.getElementById("hotel_type").value == "")
	{
		alert("Kindly select the Hotel Type..");
		return false;
	}
	else if(document.getElementById("locationhotel").value == "")
	{
		alert("Kindly enter Location...");
		return false;
	}
	else
	{
		return true;
	}
}
</script>