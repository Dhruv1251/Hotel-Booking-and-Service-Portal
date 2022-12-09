<?php
include("header.php"); 
if(!isset($_SESSION[staffid])) // ! operator used to check whether the staffid is set or not . If staff is not logged in then the dashboard page redirects to stafflogin.php.
{
	echo "<script>window.location='stafflogin.php';</script>";
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<!--start grids_of_3 -->
	<center><h2 style="font-size:50px;">Dashboard</h2></center>
	<div class="grids_of_3" style="padding: 2% 0% 0%;">
		
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					 <img style="height:200px;width:300px;"src="images/cabooking.jpg" />
				</a>
			</div>
			<h4><a href="#">Cab bookings<span>
			<?php
			$sql = "SELECT * FROM cab_booking WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/customer.jpg"  style="height:200px;width:300px;" />
				</a>
			</div>
			<h4><a href="#">Customer<span>
			<?php
			$sql = "SELECT * FROM customer WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/feedback.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Feedback<span>
			<?php
			$sql = "SELECT * FROM feedback WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>

		<div class="clear"></div>
	</div>
	
		<div class="grids_of_3" style="padding: 0% 0% 0%;">
		
		
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/hotel.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Hotel<span>
			<?php
			$sql = "SELECT * FROM hotel WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		
	</div>
	
		<div class="grids_of_3" style="padding: 0% 0% 0%;">
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/hotelfacility.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Hotel Facility<span>
			<?php
			$sql = "SELECT * FROM hotel_facility WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/hotelimage.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Hotel Image<span>
			<?php
			$sql = "SELECT * FROM hotel_image WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		<div class="grid1_of_3">
			
		<div class="clear"></div>
	</div>
	
		<div class="grids_of_3" style="padding: 0% 0% 0%;">
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/location.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Location<span>
			<?php
			$sql = "SELECT * FROM location WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/payment.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Payment<span>
			<?php
			$sql = "SELECT * FROM payment WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/roombooking.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Room Booking<span>
			<?php
			$sql = "SELECT * FROM room_booking WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		
	</div>
	
		<div class="grids_of_3" style="padding: 0% 0% 0%;">
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/roomtype.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Room Type<span>
			<?php
			$sql = "SELECT * FROM room_type WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		<div class="grid1_of_3">
			
		</div>
		<div class="grid1_of_3">
			
		<div class="clear"></div>
	</div>
	
		<div class="grids_of_3" >
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/staff.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Staff<span>
			<?php
			$sql = "SELECT * FROM staff WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		<div class="grid1_of_3">
			<div class="grid1_of_3_img">
				<a href="#">
					<img src="images/vehicletype.jpg"  style="height:200px;width:300px;"/>
				</a>
			</div>
			<h4><a href="#">Vehicle Type<span>
			<?php
			$sql = "SELECT * FROM vehicle_type WHERE status='Active'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_num_rows($qsql);
			?>
			</span></a></h4>
		</div>
		<div class="clear"></div>
	</div>	
</div>
</div>		
<!--start main -->
<?php
include("footer.php");
?>