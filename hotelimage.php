<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename = rand().$_FILES["hotel_image"]["name"];
	move_uploaded_file($_FILES["hotel_image"]["tmp_name"],"imghotel/".$filename);
	
	//4. Update the record
	if(isset($_GET[editid]))
	{
		$sql = "UPDATE hotel_image SET hotel_id='$_POST[hotel_id]',room_typeid='$_POST[room_typeid]'";
		if($_FILES["hotel_image"]["name"] != "")
		{
		$sql  =$sql . ",hotel_image='$filename'";
		}
		$sql = $sql . ",image_description='$_POST[image_description]',status='$_POST[status]' WHERE hotel_imageid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Hotel Image record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		$sql = "INSERT INTO hotel_image(hotel_id,room_typeid,hotel_image,image_description,status) VALUES('$_POST[hotel_id]','$_POST[room_typeid]','$filename','$_POST[image_description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Hotel Image record inserted successfully..');</SCRIPT>";
		}
	}
}
//2. Update - select record starts here
if(isset($_GET['editid']))
{
	$sqledit= "SELECT * FROM hotel_image WHERE hotel_imageid='$_GET[editid]'";
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
//include("leftsidebar.php");
?>				
				<div class="contact_right">
				  <div class="contact-form">
				  	<h3>Hotel Image</h3>
					    <form method="post" action="" onsubmit="return validateform()" enctype="multipart/form-data">
					    	<div>
						    	<span><label>Hotel</label></span>
						    	<span><select name="hotel_id" id="hotel_id" class="form-control" onchange="loadroomtype(this.value)">
								<option value="">Select</option>
								<?php
	//This program links primary key to foreign key
	//Select record from hotel
	$sqlhotel = "SELECT * FROM hotel WHERE status='Active'";
	$qsqlhotel = mysqli_query($con,$sqlhotel);
	while($rshotel = mysqli_fetch_array($qsqlhotel))
	{
		//if statement executes in the update statement
		if($rshotel[hotel_id] == $rsedit[hotel_id])
		{
			echo "<OPTION selected value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
		}
		//else statement executes in the else statement
		else
		{
			echo "<OPTION value='$rshotel[hotel_id]'>$rshotel[hotel_name]</option>";
		}
	}
	?>
								</select></span>
						    </div>
							<div id="divroomtype">
						    	<span><label>Room Type</label></span>
						    	<span><select name="room_typeid" id="room_typeid" class="form-control">
								<option value="">Select</option>
								<?php
	//This program links primary key to foreign key
	//Select record from room_type
	$sqlroomtype = "SELECT * FROM room_type WHERE status='Active'";
	$qsqlroomtype = mysqli_query($con,$sqlroomtype);
	while($rsroomtype = mysqli_fetch_array($qsqlroomtype))
	{
		//if statement executes in the update statement
		if($rsroomtype[room_typeid] == $rsedit[room_typeid])
		{
			echo "<OPTION selected value='$rsroomtype[room_typeid]'>$rsroomtype[room_type]</option>";
		}
		//else statement executes in the else statement

	}
	?>
								</select></span>
						    </div>
			<div>
				<span><label>Hotel Image</label></span>
				<span><input name="hotel_image" type="file" id="hotel_image" class="form-control" ></span>
				<?php
if(isset($_GET['editid']))
{
	echo "<img src='imghotel/$rsedit[hotel_image]' style='width: 100px;height: 100px;'>";
}
?>
			</div>
							<div>
						    	<span><label>Image Description</label></span>
						    	<span><textarea name="image_description"  class="form-control"><?php echo $rsedit['image_description'] ?></textarea></span>
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
?><script>
function loadroomtype(hotelid)
{
	if (hotelid == "") 
	{
        document.getElementById("divroomtype").innerHTML = '<span><label>Room Type</label></span>	<span><select name="room_typeid" class="form-control">								<option value="">Select</option></select></span>';
        return;
    } 
	else 
	{
		//XML code which is helps to execute ajax code
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		//XML code which is helps to execute ajax code ends here
				
        xmlhttp.open("GET","ajaxroomtype.php?hotelid="+hotelid,true);
        xmlhttp.send();		
		
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divroomtype").innerHTML = this.responseText;
            }
        };
    }
}
</script>
<?php
if(isset($_GET[editid]))
{
?>
<script>
function validateform()
{
	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the hotel name..");
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
<?php
}
else
{
?>
<script>
function validateform()
{
	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the hotel name..");
		return false;
	}
	else if(document.getElementById("hotel_image").value == "")
	{
		alert("Kindly select the Hotel images.");
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
<?php
}
?>