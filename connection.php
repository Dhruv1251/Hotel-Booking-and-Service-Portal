<?php
$con = mysqli_connect("localhost","root","","findmystay");
if(mysqli_connect_errno($con))
{
	echo "Error in the connection - " . mysqli_connect_error();
}
?>