<?php
include("header.php");
if(isset($_POST[submit]))
{
		$sql = "UPDATE staff SET  password='$_POST[npassword]' WHERE password='$_POST[opassword]' AND   staffid='$_SESSION[staffid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Staff password updated successfully..');</SCRIPT>";
		}
		else
		{			
			echo "<SCRIPT>alert('Failed to update staff password..');</SCRIPT>";
		}
}
?>

<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="contact">			
			
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Staff change password</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    								  <div>
						     	<span><label>Old Password</label></span>
						    	<span><input name="opassword" id="opassword" type="password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
							
							  <div>
						     	<span><label>New Password</label></span>
						    	<span><input name="npassword" id="npassword" type="password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
														  <div>
						     	<span><label>Confirm Password</label></span>
						    	<span><input name="cpassword" id="cpassword" type="password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
							
						   <div>
						   		<span><input type="submit" name="submit" value="Change password"></span>
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
	var passwordExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	if(document.getElementById("opassword").value == "")
	{
		alert("Kindly enter Old Password..");
		return false;
	}
	else if(document.getElementById("opassword").value.length < 8)
	{
		alert(" Old Password should contain more than 8 characters..");
		return false;
	}
	else if(!document.getElementById("opassword").value.match(passwordExpression))
	{
		alert(" Old Password should contain atleast one digit and one special character..");
		return false;
	}
	else if(document.getElementById("npassword").value == "")
	{
		alert("Kindly enter New Password..");
		return false;
	}
	else if(document.getElementById("npassword").value.length < 8)
	{
		alert(" New Password should contain more than 8 characters..");
		return false;
	}
	else if(!document.getElementById("npassword").value.match(passwordExpression))
	{
		alert(" New Password should contain atleast one digit and one special character..");
		return false;
	}
	else if(document.getElementById("cpassword").value == "")
	{
		alert("Kindly enter Confirm Password..");
		return false;
	}
	else if(document.getElementById("npassword").value  != document.getElementById("cpassword").value)
	{
		alert("New Password and confirm password is not matching...");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
	
	
	
	
