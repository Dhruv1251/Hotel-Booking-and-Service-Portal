<?php
include("header.php");
if(isset($_POST[submit]))
{
	//4. Update the record
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE staff SET staffname='$_POST[staffname]', stafftype='$_POST[stafftype]', loginid='$_POST[loginid]', password='$_POST[password]', status='$_POST[status]' WHERE staffid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Staff record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		$sql = "INSERT INTO `staff`( `staffname`, `stafftype`, `loginid`, `password`, `status`) VALUES('$_POST[staffname]','$_POST[stafftype]','$_POST[loginid]','$_POST[password]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Staff record inserted successfully..');</SCRIPT>";
		}
	}
}

//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM staff WHERE staffid='$_GET[editid]'";
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
				  	<h3>Staffs</h3>
<form method="post" action="" onsubmit="return validateform()">
	<div>
		<span><label>Staff Name</label></span>
		<span><input name="staffname" id="staffname" type="text" class="form-control" value="<?php echo $rsedit[staffname]; ?>"></span>
	</div>
	<div>
		<span><label>Staff Type</label></span>
		<select name="stafftype" id="stafftype" class="form-control">
		<option value="">Select</option>
		<?php
		$arr = array("Administrator","Employee");
		foreach($arr as $val)
		{
			if($val == $rsedit['stafftype'])
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
	</div>
	<div>
		<span><label>Login ID</label></span>
		<span><input name="loginid" id="loginid" type="text" class="form-control" value="<?php echo $rsedit[loginid]; ?>"></span>
	</div>
	
	<div>
		<span><label>Password</label></span>
		<span><input name="password" id="password" type="password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
	</div>
	
	<div>
		<span><label>Confirm Password</label></span>
		<span><input name="cpassword" id="cpassword" type="password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
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
		<span><input type="submit" name="submit" value="Submit"></span>
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
	var namevalidation = /^(([A-Za-z]+[\-\']?)*([A-Za-z]+)?\s)+([A-Za-z]+[\-\']?)*([A-Za-z]+)?$/;
	var onlycharacter = /^[a-zA-Z]*$/;
	
	var passwordExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	
	var emailexpression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	if(document.getElementById("staffname").value == "")
	{
		alert("Kindly enter Staff Name..");
		return false;
	}
	else if(!document.getElementById("staffname").value.match(namevalidation))
	{
		alert("Staff Name should contain only Character..");
		return false;
	}
	else if(document.getElementById("stafftype").value == "")
	{
		alert("Kindly select the Staff Type..");
		return false;
	}
	else if(document.getElementById("loginid").value == "")
	{
		alert("Kindly enter Login Id..");
		return false;
	}
	else if(!document.getElementById("loginid").value.match(emailexpression))
	{
		alert("Kindly enter valid Login ID..");
		return false;
	}
	
	else if(document.getElementById("password").value == "")
	{
		alert("Password should not be empty..");
		return false;
	}
	else if(document.getElementById("password").value.length < 8)
	{
		alert("Password should contain more than 8 characters..");
		return false;
	}
	else if(!document.getElementById("password").value.match(passwordExpression))
	{
		alert("Password should contain atleast one digit and one special character..");
		return false;
	}
	else if(document.getElementById("cpassword").value == "")
	{
		alert("Confirm Password should not be empty..");
		return false;
	}
	else if(document.getElementById("password").value  != document.getElementById("cpassword").value)
	{
		alert("Password and confirm password is not matching...");
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