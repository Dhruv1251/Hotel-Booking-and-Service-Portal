<?php
include("header.php");
$sql = "SELECT * FROM hotel LEFT JOIN location ON hotel.location_id = location.location_id WHERE hotel_id='$_GET[hotelid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
?>
<!--start main -->
<div class="main_bg">
	<div class="wrap">
		<div class="main">
			<div class="content">
				<div class="room">
					<h4><?php echo $rs[hotel_name]; ?></h4>
				<div class="det_pic">
					  
	<ul id="slides">
	<?php
	$sqlhotel_image = "SELECT * FROM hotel_image WHERE hotel_id='$_GET[hotelid]'";
	$qsqlhotel_image = mysqli_query($con,$sqlhotel_image);
	while($rshotel_image = mysqli_fetch_array($qsqlhotel_image))
	{
		echo "<li class='slide'>
		<img src='imghotel/$rshotel_image[hotel_image]' style='width:100%;height:340px;'></li>";
	}
	?>
	</ul>				  
				</div>
					<p class="para" ><?php echo $rs[hotel_description]; ?></p>
				</div>		
			</div>
			<div class="sidebar">
			
				<h4 style="color:#32A2E3;"> Location -<hr></h4>
					<p><?php echo $rs[hotel_name]; ?>,</p>
					<p><?php echo $rs[hotel_address]; ?>,</p>
					<p><?php echo $rs[location_name]; ?>,</p>
					<p>PIN - <?php echo $rs[hotel_pincode]; ?></p>
					<hr>
					<p><b>Mobile No.</b> - <?php echo $rs[contactnumber]; ?></p>
					<hr>			
				
				<h4>Hotel features</h4>
<div style="height: 200px; overflow: auto;">
	<ul class="s_nav">
		<li><a href="#"><?php echo $rs[hotel_type]; ?> hotel</a></li>
			<?php
			$sqlhotel_facility = "SELECT * FROM hotel_facility WHERE hotel_id='$_GET[hotelid]'";
			$qsqlhotel_facility = mysqli_query($con,$sqlhotel_facility);
			while($rshotel_facility = mysqli_fetch_array($qsqlhotel_facility))
			{
			echo '<li><a href="#">' . $rshotel_facility[facility_type]. '</a></li>';
			}
			?>
	</ul>
</div>
				<?php
				/*
				 <div class="date_btn">
					<form>
						<input type="submit" value="book now" style="width: 82px;" onclick>
					</form>
				</div>
				*/
				?>
				<h4>we accept</h4>
				<ul class="s_nav1">
					<li><a class="icon1" href="#"></a></li>
					<li><a class="icon2" href="#"></a></li>
					<li><a class="icon3" href="#"></a></li>
					<li><a class="icon4" href="#"></a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>		
<!--start main -->
<?php
include("searchroomtype.php");
include("looproomtypes.php");
?>
<hr>
<!--start main -->
<div class="main_bg">
	<div class="wrap">
		<div class="main">
			<div class="contact">				
					<div class="contact_left">
						<div class="contact_info">
							<h3>Find Us Here</h3>
						</div>
					<div class="company_address">
							<h3>Location :</h3>						
							<p><?php echo $rs[hotel_address]; ?>,</p>
							<p><?php echo $rs[location_name]; ?>,</p>
							<p>PIN - <?php echo $rs[hotel_pincode]; ?></p>
							<p>Contact - <?php echo $rs[contactnumber]; ?></p>
					   </div>
					</div>				
					<div class="contact_right">
					  <div class="contact-form">
						<h3>Route Map</h3>
							<form method="post" action="">
								<?php echo $rs[hotel_map]; ?>
							</form>
						</div>
					</div>		
					<div class="clear"></div>		
			  </div>
		</div>
	</div>
</div>		
<!--start main -->
<hr>

<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="content">
			<div class="room">
				<h4>Hotel Policies</h4>
				<p class="para" ><?php echo $rs[hotel_policies]; ?></p>
			</div>		
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>		
<!--start main -->
<hr>
<?php
include("feedback.php");
?>
<style>
/*
essential styles:
these make the slideshow work
*/
#slides{
	position: relative;
	height: 350px;
	padding: 0px;
	margin: 0px;
	list-style-type: none;
}

.slide{
	position: absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	opacity: 0;
	z-index: 1;

	-webkit-transition: opacity 1s;
	-moz-transition: opacity 1s;
	-o-transition: opacity 1s;
	transition: opacity 1s;
}

.showing{
	opacity: 1;
	z-index: 2;
}
/*
non-essential styles:
just for appearance; change whatever you want
*/

.slide{
	font-size: 40px;
	padding: 4px;
	box-sizing: border-box;
	background: #333;
	color: #fff;
}

.slide:nth-of-type(1){
	background: red;
}
.slide:nth-of-type(2){
	background: orange;
}
.slide:nth-of-type(3){
	background: green;
}
.slide:nth-of-type(4){
	background: blue;
}
.slide:nth-of-type(5){
	background: purple;
}
</style>
<script>
var slides = document.querySelectorAll('#slides .slide');
var currentSlide = 0;
var slideInterval = setInterval(nextSlide,2000);

function nextSlide(){
	slides[currentSlide].className = 'slide';
	currentSlide = (currentSlide+1)%slides.length;
	slides[currentSlide].className = 'slide showing';
}
</script>


<?php
include("footer.php");
?>
