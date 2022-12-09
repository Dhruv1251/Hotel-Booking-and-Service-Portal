<?php
include("header.php");
if(isset($_POST[submit]))
{
	//4. Update the record
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE room_type SET hotel_id='$_POST[hotel_id]', room_type='$_POST[room_typea]', max_adult='$_POST[max_adult]', max_children='$_POST[max_children]', cost='$_POST[cost]', status='$_POST[status]',no_of_room='$_POST[noofrooms]' WHERE room_typeid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Room Type record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		$sql = "INSERT INTO room_type(hotel_id,room_type,max_adult,max_children,cost,status,no_of_room) VALUES('$_POST[hotel_id]','$_POST[room_typea]','$_POST[max_adult]','$_POST[max_children]','$_POST[cost]','$_POST[status]','$_POST[noofrooms]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Room Type record inserted successfully..');</SCRIPT>";
		}
	}
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM room_type WHERE room_typeid='$_GET[editid]'";
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
		
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Room Type</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	<div>
						    	<span><label>Hotel</label></span>
						    	<span>
<select name="hotel_id" id="hotel_id" class="form-control">
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
		echo "<OPTION selected value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
		}
		//else statement executes in the else statement
		else
		{
		echo "<OPTION value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
		}
	}
	?>
</select>
								</span>
						    </div>
<div>
	<span><label>Room Type</label></span>
	<span><input name="room_typea" id="room_typea" type="text" class="form-control" value="<?php echo $rsedit[room_type]; ?>"></span>
</div>

<div> 
	<span><label>Maximum Adults</label></span>
	<span><input name="max_adult" id="max_adulta"  type="number" min='1'  MAX='10' class="form-control" value="<?php echo $rsedit[max_adult]; ?>"></span>
</div>
							<div> 
						     	<span><label>Maximum Children</label></span>
						    	<span><input name="max_children" id="max_childrena" type="number" min='0' MAX='5' class="form-control" value="<?php echo $rsedit[max_children]; ?>" ></span>
						    </div>
							<div> 
						     	<span><label>Cost</label></span>
						    	<span><input name="cost" id="costa" type="text" class="form-control" value="<?php echo $rsedit[cost]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>No. of Rooms</label></span>
						    	<span><input name="noofrooms" id="noofrooms"  type="number" min='1'  class="form-control" value="<?php echo $rsedit[no_of_room]; ?>"></span>
						    </div>
					     	<div>
						     	<span><label>Status</label></span>
						    	<span>
<select name="status" id="status" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Active","Inactive");
	foreach($arr as $val)
	{
		if($rsedit[status] == $val)
		{
		echo "<OPTION value='$val' selected>$val</option>";
		}
		else
		{
		echo "<OPTION value='$val'>$val</option>";
		}
	}
	?>
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
	var onlycharacter = /^[a-zA-Z\s]*$/;
	var isDecimal =  /^(\d+\.?\d{0,9}|\.\d{1,9})$/;
	
	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the hotel name..");
		return false;
	}	
	else if(document.getElementById("room_typea").value == "")
	{
		alert("Kindly enter Room type..");
		return false;
	}
	/*
	else if(!document.getElementById("room_typea").value.match(onlycharacter))
	{
		alert("Room Type should contain only Character..");
		return false;
	}
	*/
	else if(document.getElementById("max_adulta").value == "")
	{
		alert("Kindly enter Maximum Adults field..");
		return false;
	}
	else if(document.getElementById("max_childrena").value == "")
	{
		alert("Kindly enter Maximum Children field..");
		return false;
	}
	else if(document.getElementById("costa").value == "")
	{
		alert("Cost should not be empty....");
		return false;
	}
	else if (!document.getElementById("costa").value.match(isDecimal))
	{
		alert("Cost Should contain only numbers..");
		return false;
	}
	else if(document.getElementById("noofrooms").value == "")
	{
		alert("Number of rooms field should not be empty....");
		return false;
	}
	/*
	else if (!document.getElementById(""noofrooms"").value.match(onlynumbers))
	{
		alert("Number of rooms field Should contain only numbers..");
		return false;
	}
	*/
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