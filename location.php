<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filename = rand().$_FILES["location_img"]["name"];
	move_uploaded_file($_FILES["location_img"]["tmp_name"],"imglocation/".$filename);
	$location_name = mysqli_real_escape_string($con,$_POST[location_name]);
	$location = mysqli_real_escape_string($con,$_POST[description]);
		//4. Update the record
	if(isset($_GET['editid']))
	{
		$sql = "UPDATE location SET location_name='$location_name'";
		if($_FILES["location_img"]["name"] != "")
		{
		$sql = $sql . ", location_img='$filename'";
		}
		$sql = $sql . ", description='$location',status='$_POST[status]' WHERE location_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Location record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
	$sql = "INSERT INTO location(location_name,location_img,description,status) VALUES('$location_name','$filename','$location','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<SCRIPT>alert('Location record inserted successfully..');</SCRIPT>";
	}
	}
}
//2. Update - select record starts here
if(isset($_GET['editid']))
{
	$sqledit= "SELECT * FROM location WHERE location_id='$_GET[editid]'";
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
				  	<h3>Location</h3>
					    <form method="post" action="" onsubmit="return validateform()" enctype="multipart/form-data">
					    	<div>
						    	<span><label>Location Name</label></span>
						    	<span><input name="location_name" id="location_name" type="text" class="form-control" value="<?php echo $rsedit['location_name']; ?>"></span>
						    </div>
							<div>
						    	<span><label>Location Image</label></span>
						    	<span><input name="location_img" id="location_img" type="file" class="form-control" accept="image/*" ></span>
<?php
if(isset($_GET['editid']))
{
	echo "<img src='imglocation/$rsedit[location_img]' style='width: 100px;height: 100px;'>";
}
?>	
						    </div>
							<div>
						    	<span><label>Description</label></span>
						    	<span><textarea name="description" id="description" class="form-control"><?php echo $rsedit['description']; ?></textarea></span>
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
<script>
function validateform()
{
	var namevalidation =  /^[a-zA-Z\s]*$/;
	var onlycharacter = /^[a-zA-Z]*$/;
	if(document.getElementById("location_name").value == "")
	{
		alert("Kindly enter the Location Name..");
		return false;
	}
	else if(!document.getElementById("location_name").value.match(namevalidation))
	{
		alert("Location Name should contain only Character..");
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