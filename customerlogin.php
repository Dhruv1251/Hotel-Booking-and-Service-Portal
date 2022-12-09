<?php
include("header.php");
if(isset($_SESSION[customer_id]))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql ="SELECT * FROM customer WHERE email_id='$_POST[email_id]' AND password='$_POST[password]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	//Mysqli_num_rows function which counts and check how many records retried from query	
	if(mysqli_num_rows($qsql) >= 1) 
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION[customer_id] = $rs[customer_id];
		
		if(isset($_GET[btnsearch]))
		{
			echo  "<script>window.location='hotelbooking.php?hotelid=$_GET[hotelid]&room_type=$_GET[room_type]&adults=$_GET[adults]&children=$_GET[children]&checkin=$_GET[checkin]&checkout=$_GET[checkout]&btnsearch=$_GET[btnsearch]';</script>";
		}
		else
		{
					echo "<script>window.location='index.php';</script>"; // window.location is the javascript attribute which redirects the from one page to another page.
		}		
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
		<div class="contact_left">
      			<div class="company_address">
				     	<h3>Existing user:</h3>
						<?php
						if(!isset($_GET[btnsearch]))
						{
						?>
						<p><a href='customerregistration.php'>Click here to Register</a></p>
						<?php						
						}
						else
						{
						?>
						<p><a href='customerregistration.php?hotelid=<?php echo $_GET[hotelid]; ?>&room_type=<?php echo $_GET[room_type]; ?>&adults=<?php echo $_GET[adults]; ?>&children=<?php echo $_GET[children]; ?>&checkin=<?php echo $_GET[checkin]; ?>&checkout=<?php echo $_GET[checkout]; ?>&btnsearch=<?php echo $_GET[btnsearch]; ?>'>Click here to Register</a></p>
						<?php
						}
						?>
				</div>
		</div>				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Customer</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	
							<div> 
						     	<span><label>E-mail Id</label></span>
						    	<span><input name="email_id" id="email_id" type="text" class="form-control" value="<?php echo $rsedit[email_id]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Password</label></span>
						    	<span><input name="password" id="password" type="Password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
						   
						   <div>
						   		<span><input type="submit" name="submit" value="Click Here to Login"></span>
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
	if(document.getElementById("email_id").value == "")
	{
		alert("Kindly enter Email ID..");
		return false;
	}
	else if(document.getElementById("password").value == "")
	{
		alert("Kindly enter password...");
		return false;
	}
	else if(!document.getElementById("email_id").value.match(emailexpression))
	{
		alert("Kindly enter valid Email ID..");
		return false;
	}
	
	else
	{
		return true;
	}
}
</script>
