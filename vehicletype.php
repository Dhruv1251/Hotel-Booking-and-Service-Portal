<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename = rand().$_FILES["vehicle_img"]["name"];
	move_uploaded_file($_FILES["vehicle_img"]["tmp_name"],"imgvehicletype/".$filename);
	
	//4. Update the record
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE vehicle_type SET hotel_id='$_POST[hotel_id]',vehicle_type='$_POST[vehicle_type]'";
		if($_FILES["vehicle_img"]["name"] != "")
		{
		$sql = $sql . ", vehicle_img='$filename'";
		}
		$sql = $sql . ", km_cost='$_POST[km_cost]', status='$_POST[status]' WHERE vehicle_typeid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Vehicle Type record updated successfully..');</SCRIPT>";
		}
}
else
{
	$sql = "INSERT INTO vehicle_type(hotel_id,vehicle_type,vehicle_img,km_cost,status) VALUES('$_POST[hotel_id]','$_POST[vehicle_type]','$filename','$_POST[km_cost]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<SCRIPT>alert('Vehicle type record inserted successfully..');</SCRIPT>";
	}
}
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM vehicle_type WHERE vehicle_typeid='$_GET[editid]'";
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
				  	<h3>Vehicle Type</h3>
<form method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()">


<div>
	<span>
		<label>Hotel</label>
	</span>
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
			echo "<option selected value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
			}
			//else statement executes in the else statement
			else
			{
			echo "<option value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
			}
		}
		?>
		</select>
	</span>
</div>

	<div>
		<span><label>Vehicle type</label></span>
		<span><input name="vehicle_type" id="vehicle_type" type="text" class="form-control" value="<?php echo $rsedit[vehicle_type]; ?>"></span>
	</div>
	
	<div>
		<span><label>Vehicle image</label></span>
		<span><input name="vehicle_img" id="vehicle_img" type="file" class="form-control"></span>
<?php
if(isset($_GET['editid']))
{
	echo "<img src='imgvehicletype/$rsedit[vehicle_img]' style='width: 150px;height: 100px;'>";
}
?>
	</div>
	
	<div>
		<span><label>Cost per KM</label></span>
		<span><input name="km_cost" type="text" id="km_cost" class="form-control" value="<?php echo $rsedit[km_cost]; ?>"></span>
	</div>
	
	<div>
		<span><label>Status</label></span>
		<span>
		<select name="status" id="status" class="form-control">
				<option value="">Select Status</option>
				<?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
					if($val == $rsedit['status'])
					{
					echo "<option value='$val' selected >$val</option>";
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
<?php
if(isset($_GET[editid]))
{
?>
<script>
function validateform()
{	
	var onlycharacter = /^[a-zA-Z\s]*$/;
	var onlynumbers = /^[0-9]*$/;
	var isDecimal = /^(\d+\.?\d{0,9}|\.\d{1,9})$/;

	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the Hotel..");
		return false;
	}
	else if(document.getElementById("vehicle_type").value == "")
	{
		alert("Kindly enter Vehicle type..");
		return false;
	}
	else if (!document.getElementById("vehicle_type").value.match(onlycharacter))
	{
		alert("Kindly enter valid vehicle type....");
		return false;
	}
	else if(document.getElementById("km_cost").value == "")
	{
		alert("Kindly enter Kilometer Cost..");
		return false;
	}
	else if (!document.getElementById("km_cost").value.match(isDecimal))
	{
		alert("Cost field Should contain only numbers..");
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
<?php
}
else
{
?>
<script>
function validateform()
{	
	var onlycharacter = /^[a-zA-Z\s]*$/;
	var onlynumbers = /^[0-9]*$/;
	var isDecimal = /^(\d+\.?\d{0,9}|\.\d{1,9})$/;

	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the Hotel..");
		return false;
	}
	else if(document.getElementById("vehicle_type").value == "")
	{
		alert("Kindly enter Vehicle type..");
		return false;
	}
	else if (!document.getElementById("vehicle_type").value.match(onlycharacter))
	{
		alert("Kindly enter valid vehicle type....");
		return false;
	}
	else if(document.getElementById("vehicle_img").value == "")
	{
		alert("Kindly select the Vehicle Image..");
		return false;
	}
	else if(document.getElementById("km_cost").value == "")
	{
		alert("Kindly enter Kilometer Cost..");
		return false;
	}
	else if (!document.getElementById("km_cost").value.match(isDecimal))
	{
		alert("Cost field Should contain only numbers..");
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
<?php
}
?>