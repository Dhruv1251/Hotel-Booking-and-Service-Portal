<div class="online_reservation">
<div class="b_room">
	<div class="booking_room" >
		<h4>Search room type</h4>
		<p>Search Room type by entering following detail</p>
	</div>
<form method="get" action="" >
<input type="hidden" name="hotelid" value="<?php echo $_GET[hotelid]; ?>" >
	<div  class="reservation contact-form">	
		<ul>
			<li class="span1_of_1 left">
				<h5>Type of room:</h5>
				<!----------start section_room----------->
				<div class="section_room">
<select id="room_type" name="room_type" class="form-control" style="height:50px;" onchange="loadadults(this.value)">
	<option value=''>Select Room type</option>
	<?php
		$sqlroomtype ="SELECT * FROM room_type LEFT JOIN hotel_image ON room_type.room_typeid=hotel_image.room_typeid where room_type.status='Active' AND room_type.hotel_id='$_GET[hotelid]'";
		$qsqlroomtype = mysqli_query($con,$sqlroomtype);
		while($rsroomtype = mysqli_fetch_array($qsqlroomtype))
		{
			if($rsroomtype[room_typeid] == $_GET[room_type])
			{
				echo "<OPTION VALUE='$rsroomtype[room_typeid]' selected>$rsroomtype[room_type]</option>";
			}
			else
			{
				echo "<OPTION VALUE='$rsroomtype[room_typeid]'>$rsroomtype[room_type]</option>";
			}
		}
	?>
</select>
				</div>	
			</li>
			<li class="span1_of_2 left">
				<h5>Adults:</h5>
				<!----------start section_room----------->
	<div class="section_room" id="divadults">
<?php
include("ajaxadult.php");
?>
	</div>					
			</li>
			<li class="span1_of_2 left">
				<h5>Children:</h5> 
				<!----------start section_room----------->
				<div class="section_room"  id="divchildren">
<?php
include("ajaxchildren.php");
?>
				</div> 				
			</li>
			<li  class="span1_of_1 left">
				<h5>check-in-date:</h5>
				<div class="book_date">
						<input id="checkin" name="checkin" type="date"  class="form-control" value="<?php 
						if(isset($_GET[btnsearch]))
						{
							echo $checkindt = $_GET[checkin]; 
						}
						else
						{
							echo $checkindt = date("Y-m-d"); 
						}
						?>" min="<?php echo date("Y-m-d"); ?>" style="height:50px;">

				</div>					
			</li>
			<li  class="span1_of_1 left">
				<h5>check-out-date:</h5>
				<div class="book_date">
<input id="checkout" name="checkout" type="date"  min="<?php echo date("Y-m-d"); ?>" class="form-control" value="<?php 
if(isset($_GET[btnsearch]))
{
	echo $checkoutdt = $_GET[checkout]; 
}
else
{
	echo $checkoutdt = date("Y-m-d"); 
}
?>" style="height:50px;">
				</div>		
			</li>		


<li  class="span1_of_1 left">
	<div class="book_date">
		<input type="submit" name="btnsearch" value="Check Availability" style="float: left;width:550px;" onclick="return validatesearchform()" />
	</div>		
</li>			
			
			<div class="clear"></div>
		</ul>
	</div>
</form>		
	<div class="clear"></div>
	</div>
</div>
<script>
//divadults divchildren onchange="showUser(this.value)"
function loadadults(roomtypeid) 
{
    if (roomtypeid == "") 
	{
        document.getElementById("divadults").innerHTML = '<select id="adults" name="adults"  class="form-control" style="height:50px;"><?php $arr = array("1","2","3","4"); foreach($arr as $val){ if($val == $_GET[adults])
			{ echo "<option value=`$val` selected>$val</option>"; }	else {	echo "<option value=`$val`>$val</option>";}}?></select>';
        return;
    } 
	else 
	{ 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divadults").innerHTML = this.responseText;
				loadchildren(roomtypeid); 
            }
        };
        xmlhttp.open("GET","ajaxadult.php?room_type="+roomtypeid,true);
        xmlhttp.send();
    }
}
function loadchildren(roomtypeid) 
{
    if (roomtypeid == "") {
        document.getElementById("divchildren").innerHTML = '<select id="children" name="children" class="form-control" style="height:50px;"><?php
		$arr = array("0","1","2","3","4");	foreach($arr as $val)	{	if($val == $_GET[adults])	{		echo "<option value=`$val` selected>$val</option>";		}		else		{		echo "<option value=`$val`>$val</option>";		}	}	?></select>';
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divchildren").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxchildren.php?room_type="+roomtypeid,true);
        xmlhttp.send();
    }
}
</script>
<script>
function validatesearchform()
{
	
	if(document.getElementById("room_type").value == "")
	{
		alert("Kindly select the Room Type..");
		return false;
	}
	else if(document.getElementById("divadults").value == "")
	{
		alert("Kindly enter the number of Adults...");
		return false;
	}
	else if(document.getElementById("checkin").value == "")
	{
		alert("Kindly select the Check-in Date...");
		return false;
	}
	else if(document.getElementById("checkout").value == "")
	{
		alert("Kindly select the Checkout date...");
		return false;
	}
	else
	{
		return true;
	}

}
</script>
