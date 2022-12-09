<?php
include("header.php");
$sql = "SELECT * FROM hotel LEFT JOIN location ON hotel.location_id = location.location_id WHERE hotel_id='$_GET[hotelid]'";
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
					<h4> Payment panel </h4>
					<p class="para" >
<!--###############################	-->
<!------ Include the above in your HEAD tag ---------->

<div class="col-md-12 well well-sm">
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
	
?>
                <div class="col-md-12">
                    <h4 class="list-group-item-heading"><?php echo $rs[hotel_name]; ?> </h4>
					<p><?php echo $rs[hotel_address]; ?>,</p><p><?php echo $rs[location_name]; ?>. PIN : <?php echo $rs[hotel_pincode]; ?></p><p>
					<b>Mobile No.</b> - <?php echo $rs[contactnumber]; ?>
					<hr>
                </div>
       <?php
	}
	   ?>
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
                <div class="col-md-12">
					<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:blue;">
                    <p class="list-group-item-text" style="width:500px;"><?php echo $rsroomtype[room_type]; ?> - 
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
			</button>
                </div>
                <div class="col-md-6 text-left">				
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:grey;">Check In - <?php echo date("d-M-Y",strtotime($_GET[checkin])); ?></button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:grey;">Check Out - <?php echo date("d-M-Y",strtotime($_GET[checkout])); ?></button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:green;"><?php 
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
 ?></button>
                </div>
				<div class="col-md-6">
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:violet;text-align:left;padding:5px;"><b>Name</b><br><?php echo $_POST[name]; ?></button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:violet;text-align:left;padding:5px;"><b>Mobile No.</b><br><?php echo $_POST[contactnumber]; ?></button>
<button type="button" class="btn btn-primary btn-lg btn-block" style="height:75px;background-color:violet;text-align:left;padding:5px;"><b>Note</b><br><?php echo $_POST[note]; ?></button>
				</div>
       <?php
	}
	   ?>
	   </div>
</div>



<div class="col-md-12 well well-sm">
        <div class="list-group">
			  <?php
	  if(isset($_SESSION[customer_id]))
	  {
	  ?>
<input type='hidden' name='hotelid' id='hotelid' value='<?php echo $_GET[hotelid]; ?>'>
<input type='hidden' name='room_type' id='room_type' value='<?php echo $_GET[room_type]; ?>'>
<input type='hidden' name='adults' id='adults' value='<?php echo $_GET[adults]; ?>'>
<input type='hidden' name='children' id='children' value='<?php echo $_GET[children]; ?>'>
<input type='hidden' name='checkin' id='checkin' value='<?php echo $_GET[checkin]; ?>'>
<input type='hidden' name='checkout' id='checkout' value='<?php echo $_GET[checkout]; ?>'>  
<input type='hidden' name='name' id='name' value='<?php echo $_POST[name]; ?>'>
<input type='hidden' name='contactnumber' id='contactnumber' value='<?php echo $_POST[contactnumber]; ?>'>
<input type='hidden' name='note' id='note' value='<?php echo $_POST[note]; ?>'>
<form method="post" onsubmit="return validateform()">
   <h3>Enter payment details </h3>
   <div class="col-md-12"> 
		<span><label>Payment Type</label></span>
		<span>
			<select name="payment_type" id="payment_type" class="form-control" style="height:40px;"  onchange="loadcardtype(this.value)">
				<option value=''>Select payment type</option>
				<option value='Credit card'>Credit card</option>
				<option value='Debit card'>Debit card</option>
			</select>	
<!--#####Starts here ##### -->
<div class="form-sub-w3" id="divcardtype" ></div>
<!--##### Ends here##### -->			
		</span>
	</div>
	<hr>
	<div class="col-md-6"> 
		<span><label>Card holder</label></span>
		<div><input name="card_holder" id="card_holder" type="text" class="form-control" ></div>
	</div>
	<div class="col-md-6"> 
		<span><label>Card No</label></span>
		<div><input name="card_no" id="card_no" type="text" class="form-control" value="<?php echo $rsedit[card_no]; ?>"></div>
	</div>
	<div class="col-md-6"> 
		<span><label>CVV No</label></span>
		<div><input name="cvv_no" id="cvv_no" type="text" class="form-control" value="<?php echo $rsedit[cvv_no]; ?>"></div>
	</div>
	<div class="col-md-6"> 
		<span><label>Expiry Date</label></span>
		<div><input name="exp_date" id="exp_date" type="month" class="form-control" value="<?php echo $rsedit[exp_date]; ?>" min="<?php echo date("Y-m"); ?>"></div>
	</div>
	  <div class="col-md-12">
	  <hr>
		<input type="button" id="btnpayment" name="btnpayment" class="form-control" value="Make payment" onclick="return validateform()"> 
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

<!--###############################	-->

					</p>
				</div>		
			</div>
<div id="slow_warning" style="display:none">
  Loading...
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
						<th>Total Cost</th><th>Rs. <?php echo $totcost = $rsroomtype[cost] * $nodays; ?></th>
					</tr>
				</table>
<input type="hidden" name="cost" id="cost" value="<?php echo $rsroomtype[cost]; ?>" >
<input type="hidden" name="totcost" id="totcost" value="<?php echo $totcost; ?>" >
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
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script>
$('#btnpayment').bind('click', function(e) {
	
		var onlynumbers = /^[0-9]*$/;
	var onlycharacter = /^[a-zA-Z]*$/;
	var mobno = /^[789]\d{9}$/;
	var onlyspacecharacter = /^[a-zA-Z\s]*$/;
	
	if(document.getElementById("payment_type").value == "")
	{
		alert("Kindly select the Payment Type...");
		return false;
	}
	else if(document.getElementById("card_holder").value == "")
	{
		alert("Kindly enter Card Holder name...");
		return false;
	}
	else if(!document.getElementById("card_holder").value.match(onlyspacecharacter))
	{
		alert("CardHolder Name should contain only Character..");
		return false;
	}
	else if(document.getElementById("card_no").value == "")
	{
		alert("Kindly enter Card No...");
		return false;
	}
	else if(document.getElementById("card_no").value.length != 16)
	{
		alert("Card No should contain only 16 digits...");
		return false;
	}
	else if(document.getElementById("cvv_no").value == "")
	{
		alert("Kindly enter CVV No...");
		return false;
	}
	else if(document.getElementById("cvv_no").value.length != 3)
	{
		alert("CVV No should contain only 3 digits...");
		return false;
	}	
	
	else if(document.getElementById("exp_date").value == "")
	{
		alert("Kindly select the Expiration Date...");
		return false;
	}
	else
	{
	
		var payment_type = $('#payment_type').val();
		var card_holder = $('#card_holder').val();
		var card_no = $('#card_no').val();
		var cvv_no = $('#cvv_no').val();
		var exp_date = $('#exp_date').val();
		var name = $('#name').val();
		var contactnumber = $('#contactnumber').val();
		var note = $('#note').val();
		  
		var hotelid = $('#hotelid').val();
		var room_type = $('#room_type').val();
		var adults = $('#adults').val();
		var children = $('#children').val();
		var checkin = $('#checkin').val();
		var checkout = $('#checkout').val();
		var cost = $('#cost').val();
		var totcost = $('#totcost').val();
		 
			$.post("payment.php",
			{
				'hotelid': hotelid,
				'room_type': room_type,
				'adults': adults,
				'children': children,
				'checkin': checkin,
				'checkout': checkout,
				'payment_type': payment_type,
				'card_holder': card_holder,
				'card_no': card_no,
				'cvv_no': cvv_no,
				'exp_date': exp_date,
				'name': name,
				'contactnumber': contactnumber,
				'note': note,		
				'cost':cost,
				'totcost':totcost,
                'btnhotelbooking': "btnhotelbooking"
			},
			function(data, status){
				alert("Hotel Booking done successfully...");
				window.location='hotelbookingreceipt.php?paymentid='+data;
			});
	}			
});
function loadcardtype(cardtype)
{
	if(cardtype == "")
	{
	document.getElementById("divcardtype").innerHTML = "";
	}
	else
	{
	document.getElementById("divcardtype").innerHTML = '<label><i class="fa fa-picture-o" aria-hidden="true"></i> Select Card Type</label><br><input type="radio" name="cardtype" value="Visa" required>Visa &nbsp;   &nbsp;  &nbsp;  &nbsp;		<input type="radio" name="cardtype" value="Master Card" required>Master Card &nbsp;  &nbsp;  &nbsp;  &nbsp; <input type="radio" name="cardtype" value="Rupay" required>Rupay<br><br>';
	}
}

</script>