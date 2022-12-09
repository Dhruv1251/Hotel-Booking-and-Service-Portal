<?php
include("header.php");
if(isset($_POST[submit]))
{
		$sql = "UPDATE customer SET customer_name='$_POST[customer_name]', address='$_POST[address]', city='$_POST[city]',pincode='$_POST[pincode]',contact_no='$_POST[contact_no]',email_id='$_POST[email_id]' WHERE customer_id='$_SESSION[customer_id]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Customer profile updated successfully..');</SCRIPT>";
		}
}
//2. Update - select record starts here
if(isset($_SESSION[customer_id]))
{
	$sqledit= "SELECT * FROM customer WHERE customer_id='$_SESSION[customer_id]'";
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
				  	<h3>Customer Profile</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	<div>
						    	<span><label>Customer Name</label></span>
						    	<span><input name="customer_name" id="customer_name"  type="text" class="form-control" value="<?php echo $rsedit[customer_name]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>E-mail ID</label></span>
						    	<span><input name="email_id" type="text" id="email_id"class="form-control" value="<?php echo $rsedit[email_id]; ?>"></span>
						    </div>
						    <div>
						    	<span><label>Address</label></span>
						    	<span><textarea name="address"  id="address"class="form-control"><?php echo $rsedit[address]; ?></textarea></span>
						    </div>
							<div> 
						     	<span><label>City</label></span>
						    	<span><input name="city" type="text" id="city" class="form-control" value="<?php echo $rsedit[city]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Pin Code</label></span>
						    	<span><input name="pincode" id="pincode" type="text" class="form-control" value="<?php echo $rsedit[pincode]; ?>"></span>
						    </div>
							<div> 
						     	<span><label>Contact No</label></span>
						    	<span><input name="contact_no" id="contact_no" type="text" class="form-control" value="<?php echo $rsedit[contact_no]; ?>"></span>
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