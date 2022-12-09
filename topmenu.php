<style>
#mmenu, #mmenu ul {
margin: 0;
padding: 0;
list-style: none;
}
#mmenu {
width: 100%;
border: 1px solid #222;
background-color: #308BC4;
background-image: -moz-linear-gradient(#444, #111); 
background-image: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111)); 
background-image: -webkit-linear-gradient(#308BC4, #308BC4); 
background-image: -o-linear-gradient(#308BC4, #308BC4);
background-image: -ms-linear-gradient(#308BC4, #308BC4);
background-image: linear-gradient(#308BC4, #308BC4);
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border-radius: 6px;
-moz-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
-webkit-box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
box-shadow: 0 1px 1px #777, 0 1px 0 #666 inset;
}
#mmenu:before,
#mmenu:after {
content: "";
display: table;
}
#mmenu:after {
clear: both;
}
#mmenu {
zoom:1;
}
#mmenu li {
float: left;
border-right: 1px solid #222;
-moz-box-shadow: 1px 0 0 #444;
-webkit-box-shadow: 1px 0 0 #444;
box-shadow: 1px 0 0 #444;
position: relative;
}
#mmenu a {
float: left;
padding: 12px 30px;
color: #ffffff;
text-transform: uppercase;
font: bold 12px Arial, Helvetica;
text-decoration: none;
text-shadow: 0 1px 0 #000;
}
#mmenu li:hover > a {
color: #fafafa;
}
*html #mmenu li a:hover { /* IE6 only */
color: #fafafa;
}
#mmenu ul {
margin: 20px 0 0 0;
_margin: 0; /*IE6 only*/
opacity: 0;
visibility: hidden;
position: absolute;
top: 38px;
left: 0;
z-index: 9999; 
background: #444; 
background: -moz-linear-gradient(#444, #111);
background-image: -webkit-gradient(linear, left top, left bottom, from(#444), to(#111));
background: -webkit-linear-gradient(#444, #111); 
background: -o-linear-gradient(#444, #111); 
background: -ms-linear-gradient(#444, #111); 
background: linear-gradient(#444, #111);
-moz-box-shadow: 0 -1px rgba(255,255,255,.3);
-webkit-box-shadow: 0 -1px 0 rgba(255,255,255,.3);
box-shadow: 0 -1px 0 rgba(255,255,255,.3); 
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-webkit-transition: all .2s ease-in-out;
-moz-transition: all .2s ease-in-out;
-ms-transition: all .2s ease-in-out;
-o-transition: all .2s ease-in-out;
transition: all .2s ease-in-out; 
} 
#mmenu li:hover > ul {
opacity: 1;
visibility: visible;
margin: 0;
}
#mmenu ul ul {
top: 0;
left: 150px;
margin: 0 0 0 20px;
_margin: 0; /*IE6 only*/
-moz-box-shadow: -1px 0 0 rgba(255,255,255,.3);
-webkit-box-shadow: -1px 0 0 rgba(255,255,255,.3);
box-shadow: -1px 0 0 rgba(255,255,255,.3); 
}
#mmenu ul li {
float: none;
display: block;
border: 0;
_line-height: 0; /*IE6 only*/
-moz-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
-webkit-box-shadow: 0 1px 0 #111, 0 2px 0 #666;
box-shadow: 0 1px 0 #111, 0 2px 0 #666;
}
#mmenu ul li:last-child { 
-moz-box-shadow: none;
-webkit-box-shadow: none;
box-shadow: none; 
}
#mmenu ul a { 
padding: 10px;
width: 130px;
_height: 10px; /*IE6 only*/
display: block;
white-space: nowrap;
float: none;
text-transform: none;
}
#mmenu ul a:hover {
background-color: #0186ba;
background-image: -moz-linear-gradient(#04acec, #0186ba); 
background-image: -webkit-gradient(linear, left top, left bottom, from(#04acec), to(#0186ba));
background-image: -webkit-linear-gradient(#04acec, #0186ba);
background-image: -o-linear-gradient(#04acec, #0186ba);
background-image: -ms-linear-gradient(#04acec, #0186ba);
background-image: linear-gradient(#04acec, #0186ba);
}
#mmenu ul li:first-child > a {
-moz-border-radius: 3px 3px 0 0;
-webkit-border-radius: 3px 3px 0 0;
border-radius: 3px 3px 0 0;
}
#mmenu ul li:first-child > a:after {
content: '';
position: absolute;
left: 40px;
top: -6px;
border-left: 6px solid transparent;
border-right: 6px solid transparent;
border-bottom: 6px solid #444;
}
#mmenu ul ul li:first-child a:after {
left: -6px;
top: 50%;
margin-top: -6px;
border-left: 0; 
border-bottom: 6px solid transparent;
border-top: 6px solid transparent;
border-right: 6px solid #3b3b3b;
}
#mmenu ul li:first-child a:hover:after {
border-bottom-color: #04acec; 
}
#mmenu ul ul li:first-child a:hover:after {
border-right-color: #0299d3; 
border-bottom-color: transparent; 
}
#mmenu ul li:last-child > a {
-moz-border-radius: 0 0 3px 3px;
-webkit-border-radius: 0 0 3px 3px;
border-radius: 0 0 3px 3px;
}
</style>
<div id="mmenu">
<?php
if(isset($_SESSION[staffid]))
{
	if($rsstaffprofile[stafftype] == "Administrator")
	{
?>
	<li><a href="dashboardaccount.php">Dashboard</a></li>
	<?php
	/*Coding for single menu ends here */
	?>

	<li>
	<a href="#">Staff</a>
		<ul>
		<li><a href="staff.php">Add Staff</a></li>
		<li><a href="viewstaff.php">View Staff</a></li>
		</ul>
	</li>
	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Location</a>
		<ul>
		<li><a href="location.php">Add Location</a></li>
		<li><a href="viewlocation.php">View Location</a></li>
		</ul>
	</li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Hotel</a>
		<ul>
		<li><a href="hotelmodule.php">Add Hotel</a></li>
		<li><a href="viewhotelmodule.php">View Hotel</a></li>
		<li><a href="roomtype.php">Add Room Type</a></li>
		<li><a href="viewroomtype.php">View Room Type</a></li>
		<li><a href="hotelfacility.php">Add Hotel Facility</a></li>
		<li><a href="viewhotelfacility.php">View Hotel Facility</a></li>
		<li><a href="hotelimage.php">Add Hotel Images</a></li>
		<li><a href="viewhotelimage.php">View Hotel Images</a></li>
		</ul>
	</li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Vehicle</a>
		<ul>
		<li><a href="vehicletype.php">Add vehicle type</a></li>
		<li><a href="viewvehicletype.php">View Vehicle type</a></li>
		</ul>
	</li>
	<li>
	
	</li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Report</a>
		<ul>
		<li><a href="viewcustomer.php">View Customers</a></li>
		<li><a href="viewroombooking.php">View Room Booking</a></li>
		<li><a href="viewcabbooking.php">View Cab Booking</a></li>
		<li><a href="viewpayment.php">Payment Report</a></li>
		<li><a href="viewfeedback.php">View Feedbacks</a></li>
		</ul>
	</li>
<?php
	}
	if($rsstaffprofile[stafftype] == "Employee")
	{
?>
	<li><a href="dashboardaccount.php">Dashboard</a></li>

	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Hotel</a>
		<ul>
		<li><a href="hotelmodule.php">Add Hotel</a></li>
		<li><a href="viewhotelmodule.php">View Hotel</a></li>
		<li><a href="roomtype.php">Add Room Type</a></li>
		<li><a href="viewroomtype.php">View Room Type</a></li>
		<li><a href="hotelfacility.php">Add Hotel Facility</a></li>
		<li><a href="viewhotelfacility.php">View Hotel Facility</a></li>
		<li><a href="hotelimage.php">Add Hotel Images</a></li>
		<li><a href="viewhotelimage.php">View Hotel Images</a></li>
		</ul>
	</li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Vehicle</a>
		<ul>
		<li><a href="vehicletype.php">Add vehicle type</a></li>
		<li><a href="viewvehicletype.php">View Vehicle type</a></li>
		</ul>
	</li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li>
	<a href="#">Report</a>
		<ul>
		<li><a href="viewcustomer.php">View Customers</a></li>
		<li><a href="viewfeedback.php">View Feedbacks</a></li>
		<li><a href="viewroombooking.php">View Room Booking</a></li>
		<li><a href="viewcabbooking.php">View Cab Booking</a></li>
		<li><a href="viewpayment.php">View Payments</a></li>
		</ul>
	</li>
<?php		
	}
	/*Coding for single menu */
?>
<?php
}
/*Coding for dropdown menu ends here*/
?>
<?php
/*Coding for single menu */
if(isset($_SESSION[customer_id]))
{
?>
	<?php
	/*Coding for single menu ends here */
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li><a href="viewroombooking.php">Room Booking Report</a></li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	<?php
	/*Coding for dropdown menu */
	?>
	<li><a href="viewcabbooking.php">View Cab Booking</a></li>
	<?php
	/*Coding for dropdown menu ends here*/
	?>
	
	<!-- <li><a href="viewpayment.php">Payment Report</a></li> -->
	<li><a href="cancellationreport.php">Cancellation Report</a></li>
	<li><a href="logout.php">Logout</a></li>
	<?php
	/*Coding for dropdown menu */
	?>
<?php
}
/*Coding for dropdown menu ends here*/
?>
</div>