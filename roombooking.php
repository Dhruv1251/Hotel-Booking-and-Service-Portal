<?php
include("header.php");
if(isset($_POST[submit]))
{
	//4. Update the record
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE room_booking SET hotel_id='$_POST[hotel_id]', room_typeid='$_POST[room_typeid]', customer_id='$_POST[customer_id]', no_ofadults='$_POST[no_ofadults]',no_ofchildren='$_POST[no_ofchildren]',check_in='$_POST[check_in]',check_out='$_POST[check_out]',cost='$_POST[cost]', status='$_POST[status]' WHERE room_booking_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Room Booking record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		
	$sql = "INSERT INTO room_booking(hotel_id,room_typeid,customer_id,no_ofadults,no_ofchildren,check_in,check_out,cost,status) VALUES('$_POST[hotel_id]','$_POST[room_typeid]','$_POST[customer_id]','$_POST[no_ofadults]','$_POST[no_ofchildren]','$_POST[check_in]','$_POST[check_out]','$_POST[cost]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<SCRIPT>alert('Room Booking record inserted successfully..');</SCRIPT>";
	}
	}
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM room_booking WHERE room_booking_id='$_GET[editid]'";
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
<?php
include("leftsidebar.php");
?>				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Room Booking</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	<div>
						    	<span><label>Hotel</label></span>
						    	<span><select name="hotel_id" id="hotel_id" class="form-control">
								<option value="">Select</option>
								<?php
	//This program links primary key to foreign key
	//Select record from hotel
	$sqlhotel = "SELECT * FROM hotel WHERE status='Active'";
	$qsqlhotel = mysqli_query($con,$sqlhotel);
	while($rshotel = mysqli_fetch_array($qsqlhotel))
	{
		//if statement executes in the update statement
		if($rshotel[hotel_id] == $rsedit[hotel_id])
		{
			echo "<OPTION selected value='$rshotel[hotel_id]'>$rscustomer[hotel_name]</option>";
		}
		//else statement executes in the else statement
		else
		{
			echo "<OPTION value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
		}
	}
	?>
								</select></span>
						    </div>
							<div>
						    	<span><label>Room Type</label></span>
						    	<span><select name="room_typeid" id="room_typeid" class="form-control">
								<option value="">Select</option>
									<?php
	//This program links primary key to foreign key
	//Select record from room_type
	$sqlroomtype = "SELECT * FROM room_type WHERE status='Active'";
	$qsqlroomtype = mysqli_query($con,$sqlroomtype);
	while($rsroomtype = mysqli_fetch_array($qsqlroomtype))
	{
		//if statement executes in the update statement
		if($rsroomtype[room_typeid] == $rsedit[room_typeid])
		{
			echo "<OPTION selected value='$rsroomtype[room_typeid]'>$rsroomtype[room_type]</option>";
		}
		//else statement executes in the else statement
		else
		{
			echo "<OPTION value='$rsroomtype[room_typeid]'>$rsroomtype[room_type]</option>";
		}
	}
	?>
								</select></span>
						    </div>
							<div>
						    	<span><label>Customer</label></span>
						    	<span><select name="customer_id" id="customer_id" class="form-control">
								<option value="">Select</option>
								<?php
	//This program links primary key to foreign key
	//Select record from customer
	$sqlcustomer = "SELECT * FROM customer WHERE status='Active'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	while($rscustomer = mysqli_fetch_array($qsqlcustomer))
	{
		//if statement executes in the update statement
		if($rscustomer[customer_id] == $rsedit[customer_id])
		{
			echo "<OPTION selected value='$rscustomer[customer_id]'>$rscustomer[customer_name]</option>";
		}
		//else statement executes in the else statement
		else
		{
			echo "<OPTION value='$rscustomer[customer_id]'>$rscustomer[customer_name]</option>";
		}
	}
	?>
								</select></span>
						    </div>
							<div> 
						     	<span><label>No. Of Adults</label></span>
						    	<span><input name="no_ofadults" id="no_ofadults" type="text" class="form-control" value="<?php echo $rsedit[no_ofadults]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>No. Of Childrens</label></span>
						    	<span><input name="no_ofchildren" id="no_ofchildren" type="text" class="form-control" value="<?php echo $rsedit[no_ofchildren]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Check-In <label></span>
						    	<span><input name="check_in" id="check_in" type="datetime" class="form-control"value="<?php echo $rsedit[check_in]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Check-Out</label></span>
						    	<span><input name="check_out" id="check_out" type="datetime" class="form-control" value="<?php echo $rsedit[check_out]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Cost</label></span>
						    	<span><input name="cost" id="cost" type="text" class="form-control" value="<?php echo $rsedit[cost]; ?>"></span>
						    </div>
					     	<div>
						     	<span><label>Status</label></span>
						    	<span>
								<select name="status" id="status" class="form-control">
								<option value="">Select</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
								</select>
								</span>
						    </div>
							
						   <div>
						   		<span><input type="submit" value="submit" name="submit" ></span>
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
	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the Hotel Name..");
		return false;
	}
	else if(document.getElementById("room_typeid").value == "")
	{
		alert("Kindly Select the Room Type..");
		return false;
	}
	else if(document.getElementById("customer_id").value == "")
	{
		alert("Kindly select the Customer Name..");
		return false;
	}
	else if(document.getElementById("no_ofadults").value == "")
	{
		alert("Kindly enter Number of adults..");
		return false;
	}
	else if(document.getElementById("no_ofchildren").value == "")
	{
		alert("Kindly enter Number of children....");
		return false;
	}
	else if(document.getElementById("check_in").value == "")
	{
		alert("Kindly enter Check-in....");
		return false;
	}
	else if(document.getElementById("check_out").value == "")
	{
		alert("Kindly enter Check-out....");
		return false;
	}
	else if(document.getElementById("cost").value == "")
	{
		alert("Cost should not empty....");
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