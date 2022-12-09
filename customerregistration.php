<?php
include("header.php");
if(isset($_POST[submit]))
{
		$sql = "INSERT INTO customer(customer_name,address,city,pincode,contact_no,email_id,password,status) VALUES('$_POST[customer_name]','$_POST[address]','$_POST[city]','$_POST[pincode]','$_POST[contact_no]','$_POST[email_id]','$_POST[password]','Active')";
		$qsql = mysqli_query($con,$sql);
			$_SESSION[customer_id]= mysqli_insert_id($con);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Customer Regsitration done successfully..');</SCRIPT>";
			
				if(isset($_GET[btnsearch]))
				{
					echo  "<script>window.location='hotelbooking.php?hotelid=$_GET[hotelid]&room_type=$_GET[room_type]&adults=$_GET[adults]&children=$_GET[children]&checkin=$_GET[checkin]&checkout=$_GET[checkout]&btnsearch=$_GET[btnsearch]';</script>";
				}
				else
				{
					echo "<SCRIPT>window.location='customerlogin.php';</SCRIPT>"; // window.location is the javascript attribute which redirects the from one page to another page.
				}
		}
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM customer WHERE customer_id='$_GET[editid]'";
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
			
				<div class="contact_left">
      			<div class="company_address">
				     	<h3>Existing user:</h3>
						<?php
						if(!isset($_GET[btnsearch]))
						{
						?>
						<p><a href='customerlogin.php'>Click here to Login</a></p>
						<?php						
						}
						else
						{
						?>
						<p><a href='customerlogin.php?hotelid=<?php echo $_GET[hotelid]; ?>&room_type=<?php echo $_GET[room_type]; ?>&adults=<?php echo $_GET[adults]; ?>&children=<?php echo $_GET[children]; ?>&checkin=<?php echo $_GET[checkin]; ?>&checkout=<?php echo $_GET[checkout]; ?>&btnsearch=<?php echo $_GET[btnsearch]; ?>'>Click here to Login</a></p>
						<?php
						}
						?>
				   </div>
				</div>	
				
				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Customer Registration</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	<div>
						    	<span><label>Customer Name</label></span>
						    	<span><input name="customer_name" id="customer_name" type="text" class="form-control" value="<?php echo $rsedit[customer_name]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>E-mail Id</label></span>
						    	<span><input name="email_id" id="email_id" type="text" class="form-control" value="<?php echo $rsedit[email_id]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Password</label></span>
						    	<span><input name="password" id="password" type="Password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Confirm Password</label></span>
						    	<span><input name="cpassword" id="cpassword" type="Password" class="form-control" value="<?php echo $rsedit[password]; ?>"></span>
						    </div>
						    <div>
						    	<span><label>Address</label></span>
						    	<span><textarea name="address" id="address"  class="form-control"></textarea></span>
						    </div>
							<div> 
						     	<span><label>City</label></span>
						    	<span><input name="city" id="city" type="text" class="form-control" value="<?php echo $rsedit[city]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Pin Code</label></span>
						    	<span><input name="pincode" id="pincode" type="text" class="form-control" value="<?php echo $rsedit[pincode]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Mobile No</label></span>
						    	<span><input name="contact_no" id="contact_no" type="text" class="form-control" value="<?php echo $rsedit[contact_no]; ?>"></span>
						    </div>
						   <div>
						   		<span><input type="submit" name="submit" value="Click Here to Register"></span>
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
	
	var emailexpression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	var onlynumbers = /^[0-9]*$/;
	
	var onlycharacter = /^[a-zA-Z\s]*$/;
	
	var mobno = /^[789]\d{9}$/;
	  
	if(document.getElementById("customer_name").value == "")
	{
		alert("Kindly enter Name..");
		return false;
	}
	else if(!document.getElementById("customer_name").value.match(onlycharacter))
	{
		alert("Name should contain only Character..");
		return false;
	}
	
	else if(document.getElementById("email_id").value == "")
	{
		alert("Kindly enter E-mail id..");
		return false;
	}
	else if(!document.getElementById("email_id").value.match(emailexpression))
	{
		alert("Kindly enter valid Email ID..");
		return false;
	}
	else if(document.getElementById("password").value == "")
	{
		alert("Kindly enter Password..");
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
	else if(document.getElementById("password").value  != document.getElementById("cpassword").value)
	{
		alert("Password and confirm password is not matching...");
		return false;
	}
	else if(document.getElementById("city").value == "")
	{
		alert("Kindly enter city..");
		return false;
	}	
	else if(!document.getElementById("city").value.match(onlycharacter))
	{
		alert("City should contain only Character..");
		return false;
	}
	else if(document.getElementById("pincode").value == "")
	{
		alert("Kindly enter Pincode..");
		return false;
	}	
	else if (!document.getElementById("pincode").value.match(onlynumbers))
	{
		alert("Pincode Should contain only numbers..");
		return false;
	}
	else if(document.getElementById("pincode").value.length != 6)
	{
		alert("PIN Code should contain only 6 digits...");
		return false;
	}
	else if(document.getElementById("contact_no").value == "")
	{
		alert("Kindly enter Mobile No..");
		return false;
	}
	else if (!document.getElementById("contact_no").value.match(onlynumbers))
	{
		alert("Kindly enter valid Mobile number..");
		return false;
	}
	else if(document.getElementById("contact_no").value.length != 10)
	{
		alert("Mobile Number should contain only 10 digits...");
		return false;
	}	
	else if(!document.getElementById("contact_no").value.match(mobno))
	{
		alert("Mobile number should start with 7 or 8 or 9..");
		return false;
	}	
	else
	{
		return true;
	}
}
</script>