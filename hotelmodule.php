<?php
include("header.php");
if(isset($_POST[submit]))
{


	// $filename = rand().$_FILES["hotel_image"]["name"];
	// move_uploaded_file($_FILES["hotel_image"]["tmp_name"],"imghotel/".$filename);


	if(isset($_GET[editid]))
	{
		$sql = "UPDATE hotel SET location_id='$_POST[location_id]', hotel_name='$_POST[hotel_name]', hotel_type='$_POST[hotel_type]',hotel_description='$_POST[hotel_description]',hotel_address='$_POST[hotel_address]',hotel_map='$_POST[hotel_map]',hotel_pincode='$_POST[hotel_pincode]',hotel_policies='$_POST[hotel_policies]',status='$_POST[status]',contactnumber='$_POST[contactnumber]' WHERE hotel_id='$_GET[editid]'";
		
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Hotel record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		$sql = "INSERT INTO hotel(location_id,hotel_name,hotel_type,hotel_description,hotel_address,hotel_map,hotel_pincode,hotel_policies,status,contactnumber) VALUES('$_POST[location_id]','$_POST[hotel_name]','$_POST[hotel_type]','$_POST[hotel_description]','$_POST[hotel_address]','$_POST[hotel_map]','$_POST[hotel_pincode]','$_POST[hotel_policies]','$_POST[status]','$_POST[contactnumber]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);	
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Hotel record inserted successfully..');</SCRIPT>";
		}
	}
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM hotel WHERE hotel_id='$_GET[editid]'";
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
//include("leftsidebar.php");
?>				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Hotel</h3>
					    <form method="post" action="" onsubmit="return validateform()" >
					    	<div>
						    	<span><label>Location</label></span>
						    	<span>
	<select name="location_id" class="form-control" id="location_id">
	<option value="">Select</option>
	<?php
	//This program links primary key to foreign key
	//Select record from location
	$sqllocation = "SELECT * FROM location WHERE status='Active'";
	$qsqllocation = mysqli_query($con,$sqllocation);
	while($rslocation = mysqli_fetch_array($qsqllocation))
	{
		//if statement executes in the update statement
		if($rslocation[location_id] == $rsedit[location_id])
		{
			echo "<OPTION selected value='$rslocation[location_id]'>$rslocation[location_name]</option>";
		}
		//else statement executes in the else statement
		else
		{
			echo "<OPTION value='$rslocation[location_id]'>$rslocation[location_name]</option>";
		}
	}
	?>
	</select>
								</span>
						    </div>
							<div>
						    	<span><label>Hotel Name</label></span>
						    	<span><input name="hotel_name" id="hotel_name" type="text" class="form-control" value="<?php echo $rsedit[hotel_name]; ?>"></span>
						    </div>
							<div>
						    	<span><label>Hotel Type</label></span>
						    	<span>
<select name="hotel_type" id="hotel_type" class="form-control">
	<option value=''>Select hotel type</option>
	<?php
	$arr = array("Half Star","1 Star","2 Star","3 Star","4 Star","5 Star");
	foreach($arr as $val)
	{
		if($val == $rsedit[hotel_type])
		{
		echo "<option value='$val' selected>$val</option>";
		}
		else
		{
		echo "<option value='$val'>$val</option>";
		}
	}
	?>
</select>
								</span>
						    </div>
							<div> 
						     	<span><label>Hotel Description</label></span>
						    	<span>
								<textarea name="hotel_description" id="hotel_description" class="form-control"><?php
								echo $rsedit[hotel_description]; ?></textarea>
								</span>
						    </div>
							<div> 
						     	<span><label>Hotel Address</label></span>
						    	<span>
								<textarea name="hotel_address" id="hotel_address" class="form-control"><?php
								echo $rsedit[hotel_address]; ?></textarea>
								</span>
						    </div>
						    <div>
						    	<span><label>Hotel Pincode</label></span>
						    	<span><input name="hotel_pincode" id="hotel_pincode" type="text" class="form-control" value="<?php echo $rsedit[hotel_pincode]; ?>"></span>
						    </div>
						    <div>
						    	<span><label>Contact No.</label></span>
						    	<span><input name="contactnumber" id="contactnumber" type="text" class="form-control" value="<?php echo $rsedit[contactnumber]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Hotel Map</label></span>
						    	<span>
								<textarea name="hotel_map" id="hotel_map" class="form-control"><?php
								echo $rsedit[hotel_map]; ?></textarea>
								</span>
						    </div>
							<!-- <div>
				<span><label>Hotel Image</label></span>
				<span><input name="hotel_image" type="file" id="hotel_image" class="form-control" multiple accept = "image/*" ></span>
				
			</div> -->
							<div> 
						     	<span><label>Hotel Policies</label></span>
						    	<span>
								<textarea name="hotel_policies" id="hotel_policies" class="form-control"><?php
								echo $rsedit[hotel_policies]; ?></textarea>
								</span>
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
									if($val == $rsedit[status])
									{
					echo "<option value='$val' selected>$val</option>";
									}
									else
									{
					echo "<option value='$val'>$val</option>";
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
		
	var onlynumbers = /^[0-9]*$/;
	
	var mobno = /^[789]\d{9}$/;
	var mapregex=/(<iframe.*?>.*?<\/iframe>)/g;

	if(document.getElementById("location_id").value == "")
	{
		alert("Kindly select the Location..");
		return false;
	}
	else if(document.getElementById("hotel_name").value == "")
	{
		alert("Kindly select the Hotel Name..");
		return false;
	}
	else if(!document.getElementById("hotel_name").value.match(onlycharacter))
	{
		alert("Hotel Name should contain only Character..");
		return false;contactnumber
	}
	else if(document.getElementById("hotel_type").value == "")
	{
		alert("Kindly select the Hotel type..");
		return false;
	}
	else if(document.getElementById("hotel_description").value == "")
	{
		alert("Kindly enter Hotel Description..");
		return false;
	}
	else if(document.getElementById("hotel_address").value == "")
	{
		alert("Kindly enter Hotel Address....");
		return false;
	}
	else if(document.getElementById("hotel_pincode").value == "")
	{
		alert("Kindly enter Hotel Pincode....");
		return false;
	}
	else if (!document.getElementById("hotel_pincode").value.match(onlynumbers))
	{
		alert("Hotel Pincode Should contain only numbers..");
		return false;
	}
	else if(document.getElementById("hotel_pincode").value.length != 6)
	{
		alert("Hotel PinCode should contain only 6 digits...");
		return false;
	}
	else if(document.getElementById("contactnumber").value == "")
	{
		alert("Kindly enter Mobile No..");
		return false;
	}
	else if (!document.getElementById("contactnumber").value.match(onlynumbers))
	{
		alert("Mobile number should contain only digits..");
		return false;
	}
	else if(document.getElementById("contactnumber").value.length != 10)
	{
		alert("Mobile Number should contain only 10 digits...");
		return false;
	}	
	else if(!document.getElementById("contactnumber").value.match(mobno))
	{
		alert("Mobile number should start with 7 or 8 or 9..");
		return false;
	}
	else if(!document.getElementById("hotel_map").value.match(mapregex))
	{
		alert("Kindly enter valid iframe Hotel Map....");
		return false;
	}
	else if(document.getElementById("hotel_map").value == "")
	{
		alert("Kindly enter Hotel Map....");
		return false;
	}
	else if(document.getElementById("hotel_policies").value == "")
	{
		alert("Kindly enter Hotel Policies....");
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