<hr>
<div class="col-md-12" style="background-color:white;">
<h2 style="font-size:25px;color:green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Feedback & Reviews<h2>
<?php
if(isset($_POST[submit]))
{
	$sql = "INSERT INTO feedback(customer_id,hotel_id,feedback,ratings,status) VALUES('$_SESSION[customer_id]','$_GET[hotelid]','$_POST[feedback]','$_POST[ratings]','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<SCRIPT>alert('Feedback record inserted successfully..');</SCRIPT>";
	}
}
//2. Update - select record starts here
if(isset($_GET[editid]))
{
	$sqledit= "SELECT * FROM feedback WHERE feedback_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Update - select record ends here

?>
<?php
if(isset($_SESSION[customer_id]))
{
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="contact">				
			
				<div class="contact_right">
				  <div class="contact-form">
					    <form method="post" action="" onsubmit="return validateform()">
					    	
						    <div>
						    	<span><label>Feedback</label></span>
						    	<span><textarea name="feedback"  class="form-control" id="feedback" ></textarea></span>
						    </div>
	<div> 
		<span><label>Ratings</label></span>
		<span>
		<select name="ratings" id="ratings">
			<option value=''>Select</option>
			<?php
			$arr = array("0","1","2","3","4","5");
			foreach($arr as $val)
			{
				echo "<option value='$val'>$val</option>";
			}
			?>
		</select>	
		</span>
	</div>
							
							
						   <div>
						   		<span><input type="submit" name="submit" value="Post Feedback"></span>
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
}
else
{
	echo "<centeR><h2 style='font-size:25px;color:blue;'><a href='customerlogin.php'>Login to post feedback</h2></h2></center>";
}
?>


<hr>

<div class="main_bg">
<div class="wrap">
<div class="span8">
<center><u><h2 style="font-size:25px;color:blue;">View feedbacks & Reviews</h2></u></center>
<?php
					$sql = "SELECT * FROM feedback LEFT JOIN customer ON feedback.customer_id=customer.customer_id LEFT JOIN hotel ON feedback.hotel_id=hotel.hotel_id WHERE hotel.hotel_id='$_GET[hotelid]' order by feedback.feedback_id DESC";
					$qsql = mysqli_query($con,$sql);
					if(mysqli_num_rows($qsql) == 0)
					{
			echo "<center><h2>Feedback not published yet</h2></center>";
					}
					else
					{
			while($rs = mysqli_fetch_array($qsql))
			{
?>
<h1 style="font-size:25px;color:red;">Posted by <?php echo $rs[customer_name]; ?></h1>
<p><?php echo $rs[feedback]; ?></p>
<div>
<span class="badge badge-success">Ratings : <?php echo $rs[ratings]; ?></span><div class="pull-right badge badge-success"></div>
</div> 
<hr>
<?php
			}
					}
?>
	
</div>
</div>
</div>

<!--start main -->
</div>




<script>
function validateform()
{
	
	
     if(document.getElementById("feedback").value == "")
	{
		alert("Feedback should not be empty..");
		return false;
	}
	else if(document.getElementById("ratings").value == "")
	{
		alert("Kindly enter Ratings..");
		return false;
	}
	else
	{
		return true;
	}
}
</script>