<?php
include("header.php");
if(isset($_SESSION[staffid]))
{
	echo "<script>window.location='dashboardaccount.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql ="SELECT * FROM staff WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	//Mysqli_num_rows function which counts and check how many records retried from query	
	if(mysqli_num_rows($qsql) >= 1) 
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[staffid] = $rs[staffid];
		echo "<script>window.location='dashboardaccount.php';</script>";
		// window.location is the javascript attribute which redirects the from one page to another page.
	}
	else
	{
		echo "<SCRIPT>alert('Failed to login..');</SCRIPT>";
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
				  	<h3>Staffs</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	
						    <div>
						     	<span><label>Login ID</label></span>
						    	<span><input name="loginid" id="loginid" type="text" class="form-control" value="<?php echo $rsedit[loginid]; ?>"></span>
						    </div>
							  <div>
						     	<span><label>Password</label></span>
						    	<span><input name="password" id="password" type="password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
			
							
						   <div>
						   		<span><input type="submit" name="submit" value="Click here to Login"></span>
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
	var emailexpression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
if(document.getElementById("loginid").value == "")
	{
		alert("Kindly enter LoginId..");
		return false;
	}
	else if(!document.getElementById("loginid").value.match(emailexpression))
	{
		alert("Kindly enter valid LoginId..");
		return false;
	}
	else if(document.getElementById("password").value == "")
	{
		alert("Kindly enter Password..");
		return false;
	}	
	else
	{
		return true;
	}
}
</script>