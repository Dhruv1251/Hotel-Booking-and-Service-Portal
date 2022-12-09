<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename = rand().$_FILES["item_img"]["name"];
	move_uploaded_file($_FILES["item_img"]["tmp_name"],"imgitem/".$filename);
	$item_name = mysqli_real_escape_string($con,$_POST['item_name']);
	$item_description = mysqli_real_escape_string($con,$_POST['item_description']);
	
	//4. Update the record
	if(isset($_GET[editid]))
	{ 
		$sql = "UPDATE item SET item_name='$item_name', food_category_id='$_POST[food_category_id]', item_description='$item_description',item_cost='$_POST[item_cost]',status='$_POST[status]'";
		if($_FILES["item_img"]["name"] != "")
		{
		$sql = $sql . ",item_img='$filename'";
		}
		$sql = $sql . ",hotel_id='$_POST[hotel_id]' WHERE item_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Item record updated successfully..');</SCRIPT>";
		}
	}
	else
	{
		$sql = "INSERT INTO item(hotel_id,item_name,food_category_id,item_description,item_cost,status,item_img) VALUES('$_POST[hotel_id]','$item_name','$_POST[food_category_id]','$item_description','$_POST[item_cost]','$_POST[status]','$filename')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) ==1 )
		{
			echo "<SCRIPT>alert('Item record inserted successfully..');</SCRIPT>";
		}
	}
}
//2. Update - select record starts here
if(isset($_GET['editid']))
{
	$sqledit= "SELECT * FROM item WHERE item_id='$_GET[editid]'";
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
				  	<h3>Item</h3>
					    <form method="post" action="" onsubmit="return validateform()"  enctype="multipart/form-data">
					    	<div>
						    	<span><label>Hotel</label></span>
						    	<span>
	<select name="hotel_id" id="hotel_id" class="form-control">
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
	</select>
								</span>
						    </div>
					    	<div>
						    	<span><label>Item Name</label></span>
						    	<span><input name="item_name" id="item_name" type="text" class="form-control" value="<?php echo $rsedit[item_name]; ?>"></span>
						    </div>
							
							<div>
						    	<span><label>Food Category</label></span>
						    	<span><select name="food_category_id" id="food_category_id" class="form-control">
								<option value="">Select</option>
								<?php
	//This program links primary key to foreign key
	//Select record from food_category
	$sqlfoodcategory = "SELECT * FROM food_category WHERE status='Active'";
	$qsqlfoodcategory = mysqli_query($con,$sqlfoodcategory);
	while($rsfoodcategory = mysqli_fetch_array($qsqlfoodcategory))
	{
		//if statement executes in the update statement
		if($rsfoodcategory[food_category_id] == $rsedit[food_category_id])
		{
			echo "<OPTION selected value='$rsfoodcategory[food_category_id]'>$rsfoodcategory[food_category]</option>";
		}
		//else statement executes in the else statement
		else
		{
			echo "<OPTION value='$rsfoodcategory[food_category_id]'>$rsfoodcategory[food_category]</option>";
		}
	}
	?>
								</select></span>
						    </div>
							<div>
						    	<span><label>Item image</label></span>
						    	<span><input name="item_img" id="item_img" type="file" class="form-control" ></span>
<?php
if(isset($_GET['editid']))
{
	echo "<img src='imgitem/$rsedit[item_img]' style='width: 100px;height: 125px;'>";
}
?>
						    </div>
							<div>
						    	<span><label>Item Description</label></span>
						    	<span><textarea name="item_description" id="item_description" class="form-control"><?php echo $rsedit[item_description]; ?></textarea></span>
						    </div>
							<div>
						    	<span><label>Item Cost</label></span>
						    	<span><input name="item_cost" id="item_cost" type="text" class="form-control" value="<?php echo $rsedit[item_cost]; ?>"></span>
						    </div>
						    <div>
						     	<span><label>Status</label></span>
						    	<span>
<select name="status" id="status" class="form-control">
<option value="">Select</option>
<?php
$arr = array("Active","Inactive");
foreach($arr as $val)
{
	if($val == $rsedit['status'])
	{
	echo "<option value='$val' selected>$val</option>";
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
?>
<?php
if(isset($_GET['editid']))
{
?>
<script>
function validateform()
{
	var onlynumbers = /^[0-9]*$/;
	var onlycharacter = /^[a-zA-Z\s]*$/;
	var isDecimal = /^(\d+\.?\d{0,9}|\.\d{1,9})$/;
	
	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the Hotel..");
		return false;
	}	
	if(document.getElementById("item_name").value == "")
	{
		alert("Kindly enter the Item Name..");
		return false;
	}
	else if (!document.getElementById("item_name").value.match(onlycharacter))
	{
		alert("Entered Item name is not valid....");
		return false;
	}
	else if(document.getElementById("food_category_id").value == "")
	{
		alert("Kindly enter Food Category..");
		return false;
	}
	else if(document.getElementById("item_cost").value == "")
	{
		alert("Kindly enter Item Cost..");
		return false;
	}
	else if (!document.getElementById("item_cost").value.match(isDecimal))
	{
		alert("Kindly enter valid Cost for item..");
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
	var onlynumbers = /^[0-9]*$/;
	var onlycharacter = /^[a-zA-Z\s]*$/;
	var isDecimal = /^(\d+\.?\d{0,9}|\.\d{1,9})$/;
	
	if(document.getElementById("hotel_id").value == "")
	{
		alert("Kindly select the Hotel..");
		return false;
	}	
	if(document.getElementById("item_name").value == "")
	{
		alert("Kindly enter the Item Name..");
		return false;
	}
	else if (!document.getElementById("item_name").value.match(onlycharacter))
	{
		alert("Entered Item name is not valid....");
		return false;
	}
	else if(document.getElementById("food_category_id").value == "")
	{
		alert("Kindly enter Food Category..");
		return false;
	}
	else if(document.getElementById("item_img").value == "")
	{
		alert("Item image should not be empty...");
		return false;
	}
	else if(document.getElementById("item_cost").value == "")
	{
		alert("Kindly enter Item Cost..");
		return false;
	}
	else if (!document.getElementById("item_cost").value.match(isDecimal))
	{
		alert("Kindly enter valid Cost for item..");
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