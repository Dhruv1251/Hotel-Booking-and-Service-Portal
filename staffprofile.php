<?php
include("header.php");
if(isset($_POST[submit]))
{
		$sql = "UPDATE staff SET staffname='$_POST[staffname]', loginid='$_POST[loginid]' WHERE staffid='$_SESSION[staffid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Staff profile updated successfully..');</SCRIPT>";
		}
}

//2. Update - select record starts here
if(isset($_SESSION[staffid]))
{
	$sqledit= "SELECT * FROM staff WHERE staffid='$_SESSION[staffid]'";
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
						     	<span><label>Login ID</label></span>
						    	<span><input name="loginid" id="loginid" type="text" class="form-control" value="<?php echo $rsedit[loginid]; ?>"></span>
						    </div>
							
						   <div>
						   		<span><input type="submit" name="submit" value="Update profile"></span>
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
	var onlycharacter = /^[a-zA-Z]*$/;
	var emailexpression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
if(document.getElementById("staffname").value == "")
	{
		alert("Kindly enter Staff Name..");
		return false;
	}
	else if(!document.getElementById("staffname").value.match(onlycharacter))
	{
		alert("Staff Name should contain only Character..");
		return false;
	}
	
	else if(document.getElementById("loginid").value == "")
	{
		alert("Kindly enter Login Id..");
		return false;
	}
	else if(!document.getElementById("loginid").value.match(emailexpression))
	{
		alert("Kindly enter valid Login Id..");
		return false;	
	}
	else
	{
		return true;
	}
}
</script>
	
