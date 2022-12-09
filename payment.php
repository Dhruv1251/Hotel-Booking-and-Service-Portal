<?php
session_start();
error_reporting(0);
$dt = date("Y-m-d");
include("connection.php");

if(isset($_POST[btncancellation]))
{
	$sql = "INSERT INTO payment(customer_id,card_holder,name,payment_date,payment_type,card_no,cvv_no,exp_date,total_amt,status,mobileno,note) VALUES('$_SESSION[customer_id]','$_POST[card_holder]','$_POST[room_booking_id]','$dt','$_POST[payment_type]','$_POST[card_no]','$_POST[cvv_no]','$_POST[exp_date]-01','$_POST[totcost]','Cancelled','$_POST[contactnumber]','$_POST[note]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	echo $insid = mysqli_insert_id($con);

	$sql ="UPDATE payment SET status='Cancel' WHERE room_booking_id='$_POST[room_booking_id]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	
}
if(isset($_POST[btnpayment]))
{
	$sql = "INSERT INTO payment(customer_id,card_holder,room_booking_id,cab_bookingid,payment_date,payment_type,card_no,cvv_no,exp_date,total_amt,status,name,mobileno,note) VALUES('$_SESSION[customer_id]','$_POST[card_holder]','$_POST[room_booking_id]','$_POST[cab_bookingid]','$dt','$_POST[payment_type]','$_POST[card_no]','$_POST[cvv_no]','$_POST[exp_date]-01','$_POST[totcost]','Active','$_POST[name]','$_POST[contactnumber]','$_POST[note]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	echo $insid = mysqli_insert_id($con);

	$sql = "UPDATE cab_booking SET status='Active',payment_id='$insid' WHERE cab_bookingid='$_POST[cab_bookingid]'";
	$qsql = mysqli_query($con,$sql);	
}

if(isset($_POST[btnhotelbooking]))
{
	$sql = "INSERT INTO room_booking(hotel_id,room_typeid,customer_id,no_ofadults,no_ofchildren,check_in,check_out,cost,status) VALUES('$_POST[hotelid]','$_POST[room_type]','$_SESSION[customer_id]','$_POST[adults]','$_POST[children]','$_POST[checkin]','$_POST[checkout]','$_POST[cost]','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);

	$insid = mysqli_insert_id($con);
	
	$sql = "INSERT INTO payment(customer_id,card_holder,room_booking_id,payment_date,payment_type,card_no,cvv_no,exp_date,total_amt,status,name,mobileno,note) VALUES('$_SESSION[customer_id]','$_POST[card_holder]','$insid','$dt','$_POST[payment_type]','$_POST[card_no]','$_POST[cvv_no]','$_POST[exp_date]-01','$_POST[totcost]','Active','$_POST[name]','$_POST[contactnumber]','$_POST[note]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);	
	echo $insid = mysqli_insert_id($con);
}
?>