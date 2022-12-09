<?php
include("header.php");
if(isset($_POST[submit]))
{
	//4. Update the record
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE customer SET customer_name='$_POST[customer_name]', address='$_POST[address]', city='$_POST[city]',pincode='$_POST[pincode]',contact_no='$_POST[contact_no]',email_id='$_POST[email_id]',password='$_POST[password]',status='$_POST[status]' WHERE customer_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Customer record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		$sql = "INSERT INTO customer(customer_name,address,city,pincode,contact_no,email_id,password,status) VALUES('$_POST[customer_name]','$_POST[address]','$_POST[city]','$_POST[pincode]','$_POST[contact_no]','$_POST[email_id]','$_POST[password]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Customer record inserted successfully..');</SCRIPT>";
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
<?php
include("leftsidebar.php");
?>				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Customer</h3>
					    <form method="post" action="" onsubmit="return validateform()">
					    	<div>
						    	<span><label>Customer Name</label></span>
						    	<span><input name="customer_name" id="customer_name" type="text" class="form-control" value="<?php echo $rsedit[customer_name]; ?>"></span>
						    </div>
						    <div>
						    	<span><label>Address</label></span>
						    	<span><textarea name="address" id="address" class="form-control"></textarea></span>
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
						     	<span><label>Contact No</label></span>
						    	<span><input name="contact_no" id="contact_no" type="text" class="form-control" value="<?php echo $rsedit[contact_no]; ?>"></span>
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
						     	<span><label>Status</label></span>
						    	<span>
								<select name="status" class="form-control" id="status">
								<option value="">Select</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
								</select>
								</span>
						    </div>
							
						   <div>
						   		<span><input type="submit" name="submit" value="submit"></span>
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
	if(document.getElementById("customer_name").value == "")
	{
		alert("Kindly enter Customer Name..");
		return false;
	}
	else if(document.getElementById("contact_no").value == "")
	{
		alert("Kindly enter Contact No..");
		return false;
	}
	else if(document.getElementById("email_id").value == "")
	{
		alert("Kindly enter E-mail id..");
		return false;
	}
	else if(document.getElementById("password").value == "")
	{
		alert("Kindly enter Password..");
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