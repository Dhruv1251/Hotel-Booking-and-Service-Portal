<?php
include("header.php");
$sql = "SELECT * FROM hotel_image LEFT JOIN location ON hotel.location_id = location.location_id WHERE hotel_id='$_GET[hotelid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);

$sqlhotel_image = "SELECT * FROM hotel_image WHERE hotel_id='$_GET[hotelid]'";
$qsqlhotel_image = mysqli_query($con,$sqlhotel_image);
$rshotel_image = mysqli_fetch_array($qsqlhotel_image);
?>
<!--start main -->
<div class="main_bg">
	<div class="wrap">
		<div class="main">
			<div class="content">
				<div class="room">
					<h4> Review Your Booking </h4>
					<p class="para" >
<!--###############################	-->
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="width:100%;">
    <div class="row" style="width:100%;">
		<div class="well">
        <div class="list-group">
<?php
	$i =0;
	$sqlroomtype ="SELECT * FROM room_type where room_type.status='Active' AND room_type.hotel_id='$_GET[hotelid]'  ";
	if($_GET[room_type])
	{
	$sqlroomtype = $sqlroomtype . " AND room_typeid='$_GET[room_type]'";
	}
	$qsqlroomtype = mysqli_query($con,$sqlroomtype);
	while($rsroomtype = mysqli_fetch_array($qsqlroomtype))
	{
		$sqlroomtypeimg ="SELECT * FROM hotel_image where status='Active' AND room_typeid='$rsroomtype[0]'";
		$qsqlroomtypeimg = mysqli_query($con,$sqlroomtypeimg);
		$rsroomtypeimg = mysqli_fetch_array($qsqlroomtypeimg);
		
		if(mysqli_num_rows($qsqlroomtypeimg) == 0)
		{
			$imgname = "images/noimage.png";
		}
		else
		{
			if(file_exists("imghotel/$rsroomtypeimg[hotel_image]"))
			{
				$imgname = "imghotel/$rsroomtypeimg[hotel_image]";				
			}
			else
			{
				$imgname = "images/noimage.png";
			}
		}
?>
   <a href="#" class="list-group-item" >
                <div class="media col-md-5">
                    <figure class="pull-left">
                        <img class="media-object img-rounded img-responsive" src="<?php echo "imghotel/". $rshotel_image[hotel_image]; ?>" style="width:500px;height:205px;">
                    </figure>
                </div>
                <div class="col-md-7">
                    <h4 class="list-group-item-heading"><?php echo $rs[hotel_name]; ?> </h4>
                    
					<p><?php echo $rs[hotel_address]; ?>,<br><?php echo $rs[location_name]; ?><br>PIN : <?php echo $rs[hotel_pincode]; ?></p>
					<hr>
					<p><b>Mobile No.</b> - <?php echo $rs[contactnumber]; ?></p>
			
			</p>
                </div>
                
          </a>
       <?php
	}
	   ?>
	   </div>
        </div>
	</div>
</div>


<div class="container" style="width:100%;">
    <div class="row" style="width:100%;">
		<div class="well">
        <div class="list-group">
<?php
	$i =0;
	$sqlroomtype ="SELECT * FROM room_type where room_type.status='Active' AND room_type.hotel_id='$_GET[hotelid]'  ";
	if($_GET[room_type])
	{
	$sqlroomtype = $sqlroomtype . " AND room_typeid='$_GET[room_type]'";
	}
	$qsqlroomtype = mysqli_query($con,$sqlroomtype);
	$rsroomtype = mysqli_fetch_array($qsqlroomtype);
	{
		$sqlroomtypeimg ="SELECT * FROM hotel_image where status='Active' AND room_typeid='$rsroomtype[0]'";
		$qsqlroomtypeimg = mysqli_query($con,$sqlroomtypeimg);
		$rsroomtypeimg = mysqli_fetch_array($qsqlroomtypeimg);
		
		if(mysqli_num_rows($qsqlroomtypeimg) == 0)
		{
			$imgname = "images/noimage.png";
		}
		else
		{
			if(file_exists("imghotel/$rsroomtypeimg[hotel_image]"))
			{
				$imgname = "imghotel/$rsroomtypeimg[hotel_image]";				
			}
			else
			{
				$imgname = "images/noimage.png";
			}
		}
?>
   <a href="#" class="list-group-item" >
                <div class="media col-md-3">
                    <figure class="pull-left">
                        <img class="media-object img-rounded img-responsive" src="<?php echo $imgname; ?>" style="width:350px;height:175px;">
                    </figure>
                </div>
                <div class="col-md-6">
                    <h4 class="list-group-item-heading"> <?php echo $rsroomtype[room_type]; ?> </h4>
                    <p class="list-group-item-text" style="width:500px;">
					<?php 
					if($_GET[adults] == 1)
					{
					echo $_GET[adults] . " Adult"; 
					}
					else
					{
						echo $_GET[adults] . " Adults"; 
					}
					?>
					<?php 
					if($_GET[adults] != 0)
					{
						if($_GET[adults] == 1)
						{
							echo " and  ".$rsroomtype[max_children] ." Child"; 
						}
						else
						{
							echo " and  ".$rsroomtype[max_children] . " Children"; 
						}
					}
					?><br>
			
			</p>
			<p class="list-group-item-text" style="width:500px;">
			<hr>
			<b>Facilities:</b> 
	<?php
	$hotelfacility = "";
	$sqlhotel_facility ="SELECT * FROM hotel_facility where  room_typeid='$rsroomtype[0]'";
	$qsqlhotel_facility = mysqli_query($con,$sqlhotel_facility);
	while($rshotel_facility = mysqli_fetch_array($qsqlhotel_facility))
	{
		$hotelfacility =  $hotelfacility . $rshotel_facility[facility_type] . ",";
	}
	echo rtrim($hotelfacility,", ");
	?>
			</p>
                </div>
                <div class="col-md-3 text-center">				
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:grey;">Check In <br><?php echo date("d-M-Y",strtotime($_GET[checkin])); ?></button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:grey;">Check Out <br><?php echo date("d-M-Y",strtotime($_GET[checkout])); ?></button>
<p><?php 
$checkin = strtotime($_GET[checkin]);
$checkout = strtotime($_GET[checkout]);
$datediff = $checkout - $checkin;
 $nodays = round($datediff / (60 * 60 * 24));
 $nodays = $nodays +1;
if($nodays == 1 )
{
	echo $nodays . " Day"; 
}
else
{
	echo $nodays . " Days"; 
}
 ?></p>
                </div>
          </a>
       <?php
	}
	   ?>
	   </div>
        </div>
	</div>
</div>


<div class="col-md-12 well well-sm">
	<div class="box ng-scope" ng-controller="productTravellerController" style="width:750px;">
		<div class="box-content">
		  
		  <?php
		  if(isset($_SESSION[customer_id]))
		  {
		  ?>
	<form method="post" onsubmit="return validateform()" action="hotelbookingpayment.php?hotelid=<?php echo $_GET[hotelid]; ?>&room_type=<?php echo $_GET[room_type]; ?>&adults=<?php echo $_GET[adults]; ?>&children=<?php echo $_GET[children]; ?>&checkin=<?php echo $_GET[checkin]; ?>&checkout=<?php echo $_GET[checkout]; ?>&btnsearch=<?php echo $_GET[btnsearch]; ?>">
			<h2>Enter Traveller Details </h2>
			  <div class="col-md-12">
				Name : <input type="text" id="name" name="name" class="form-control">
			  </div> 
			  <div class="col-md-12">
				Contact No. : <input type="text" id="contactnumber" name="contactnumber" class="form-control">
			  </div>	  
			  <div class="col-md-12">
				Any Note : 
				<textarea class="form-control" name="note"></textarea>
			  <hr>
			  </div>
			  <div class="col-md-6">
				<input type="submit" class="form-control" value="Continue" >
			  </div>
	</form>	  
		  <?php
		  }
		  else
		  {
			?>
			
				<h3>Enter Traveller Details </h3>
				<div class="col-md-12">
					New Customer
					<input type="submit" class="form-control" value="Click here to Register" style="width:200px;" onclick="window.location='customerregistration.php?hotelid=<?php echo $_GET[hotelid]; ?>&room_type=<?php echo $_GET[room_type]; ?>&adults=<?php echo $_GET[adults]; ?>&children=<?php echo $_GET[children]; ?>&checkin=<?php echo $_GET[checkin]; ?>&checkout=<?php echo $_GET[checkout]; ?>&btnsearch=<?php echo $_GET[btnsearch]; ?>';" >
					<hr>
				</div>
				  
				<div class="col-md-12">
				Existing customer
					<input type="submit" class="form-control" value="Click here to Login" style="width:200px;" onclick="window.location='customerlogin.php?hotelid=<?php echo $_GET[hotelid]; ?>&room_type=<?php echo $_GET[room_type]; ?>&adults=<?php echo $_GET[adults]; ?>&children=<?php echo $_GET[children]; ?>&checkin=<?php echo $_GET[checkin]; ?>&checkout=<?php echo $_GET[checkout]; ?>&btnsearch=<?php echo $_GET[btnsearch]; ?>'" >
				</div>
			<?php
		  }
		  ?>
		</div>   
	</div>
</div>


					</p>
				</div>		
			</div>
			<div class="sidebar">		
				<h4 style="color:#32A2E3;"> Tariff details<hr></h4>
				<table class="table table-striped table-bordered">
					<tr>
						<th>Cost per day</th><td>Rs. <?php echo $rsroomtype[cost]; ?></td>
					</tr>
					<tr>
						<th>No. of days</th><td><?php 
if($nodays == 1 )
{
	echo $nodays . " Day"; 
}
else
{
	echo $nodays . " Days"; 
} 
?></td>
					</tr>
					<tr>
						<th>Total Cost</th><th>Rs. <?php echo $rsroomtype[cost] * $nodays; ?></th>
					</tr>
				</table>
				<hr>
					<p><b>Hotel policies:</b><br>
					<?php echo $rs[hotel_policies]; ?>,</p>
				<hr>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>		
<!--start main -->


<style>
/*
essential styles:
these make the slideshow work
*/
#slides{
	position: relative;
	height: 350px;
	padding: 0px;
	margin: 0px;
	list-style-type: none;
}

.slide{
	position: absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	opacity: 0;
	z-index: 1;

	-webkit-transition: opacity 1s;
	-moz-transition: opacity 1s;
	-o-transition: opacity 1s;
	transition: opacity 1s;
}

.showing{
	opacity: 1;
	z-index: 2;
}
/*
non-essential styles:
just for appearance; change whatever you want
*/

.slide{
	font-size: 40px;
	padding: 4px;
	box-sizing: border-box;
	background: #333;
	color: #fff;
}

.slide:nth-of-type(1){
	background: red;
}
.slide:nth-of-type(2){
	background: orange;
}
.slide:nth-of-type(3){
	background: green;
}
.slide:nth-of-type(4){
	background: blue;
}
.slide:nth-of-type(5){
	background: purple;
}
</style>
<script>
var slides = document.querySelectorAll('#slides .slide');
var currentSlide = 0;
var slideInterval = setInterval(nextSlide,2000);

function nextSlide(){
	slides[currentSlide].className = 'slide';
	currentSlide = (currentSlide+1)%slides.length;
	slides[currentSlide].className = 'slide showing';
}
</script>
<script>
function validateform()
{
	var onlynumbers = /^[0-9]*$/;
	
	var onlycharacter = /^[a-zA-Z]*$/;
	
	var mobno = /^[789]\d{9}$/;
	
	if(document.getElementById("name").value == "")
	{
		alert("Kindly enter Name..");
		return false;
	}
	else if(!document.getElementById("name").value.match(onlycharacter))
	{
		alert("Name should contain only Character..");
		return false;
	}
	else if(document.getElementById("contactnumber").value == "")
	{
		alert("Kindly enter Contact Number...");
		return false;
	}
	else if(!document.getElementById("contactnumber").value.match(onlynumbers))
	{
		alert("Contact Number should contain only digits..");
		return false;
	}
	else if(document.getElementById("contactnumber").value.length != 10)
	{
		alert("Contact Number should contain only 10 digits...");
		return false;
	}	
	else if(!document.getElementById("contactnumber").value.match(mobno))
	{
		alert("Contact number should start with 7 or 8 or 9..");
		return false;
	}	
	
	else
	{
		return true;
	}
}
</script>


<?php
include("footer.php");
?>

<style>
a.list-group-item {
    height:auto;
    min-height:220px;
}
a.list-group-item.active small {
    color:#fff;
}
.stars {
    margin:20px auto 1px;    
}
</style>