<?php
include("header.php");
$sqlpayment = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN room_booking ON room_booking.room_booking_id = payment.room_booking_id  WHERE payment_id='$_GET[paymentid]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
$rspayment = mysqli_fetch_array($qsqlpayment);
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">			
			<div>				

<div >
	<div >
		
        <div class="col-md-12" id="divprintarea">
         
		
			
            <div>
			
<table class="table table-bordered">
	<thead>
		<tr>
			<th colspan="2">
				<center>
				<img src="images/findmystay.png" alt="" width="250px;" style="height:150px;"><br>
				FindMyStay<br>
				3rd floor, city light building<br>
				Mangalore
				</center>
			</th>
		</tr>
		<tr>
			<th style="width:50%">Name : <?php echo $rspayment[customer_name]; ?></td>
			<th style="width:50%">Bill No. <?php echo $rspayment[payment_id]; ?></th>
		</tr>
		<tr>
			<th style="width:50%">
			Address:<br>  <?php echo $rspayment[address]; ?>, <?php echo $rspayment[city]; ?>, <?php echo $rspayment[pincode]; ?><br>
			Contact No.   <?php echo $rspayment[contact_no]; ?><br>
			Email ID.   <?php echo $rspayment[email_id]; ?>
			</th>
			<th style="width:50%;">
			Bill Date: <?php echo date("d-M-Y",strtotime($rspayment[payment_date])); ?>
			<hr>
			Note: <br>
			<?php echo $rspayment[note]; ?>
			</th>
		</tr>
	</tbody>
</table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:75%;">Description</th>
                            <th style="width:25%;">Amount</th>
                        </tr>
                    </thead>
<tbody>
	<tr>
		<td>
		
		<?php
// #### Room booking detail starts here..	
if($rspayment[room_booking_id] != 0 && $rspayment[spa_service_bookingid]==0 && $rspayment[food_order_id] == 0  && $rspayment[food_order_id] == 0)
{
	$sqlroom_booking = "SELECT * FROM room_booking LEFT JOIN hotel ON room_booking.hotel_id=hotel.hotel_id LEFT JOIN room_type ON room_booking.room_typeid=room_type.room_typeid LEFT JOIN customer ON room_booking.customer_id=customer.customer_id LEFT JOIN payment ON payment.room_booking_id=room_booking.room_booking_id LEFT JOIN location ON location.location_id = hotel.location_id WHERE room_booking.status='Active' AND room_booking.room_booking_id='$rspayment[room_booking_id]' ";
	$qsqlroom_booking = mysqli_query($con,$sqlroom_booking);
	$rsroom_booking = mysqli_fetch_array($qsqlroom_booking);
	if(mysqli_num_rows($qsqlroom_booking) >= 1)
	{
		echo "Hotel Room booking<br>";
		echo "Hotel Name: ".$rsroom_booking[hotel_name].", ";
		echo  $rsroom_booking[location_name]."<br>";
		echo "Check-In : ". date("d-M-Y",strtotime($rsroom_booking[check_in]))." | ";
		echo "Check-Out : ". date("d-M-Y",strtotime($rsroom_booking[check_out]));
		echo " | ";
$checkin = strtotime($rsroom_booking[check_in]);
$checkout = strtotime($rsroom_booking[check_out]);
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
		
	}
}
// #### Room booking detail ends here...
		?>
		
		</td>
		<td>Rs. <?php echo $rspayment[total_amt]; ?></td>
	</tr>
	<tr>
	   
		<td class="text-right"><h2><strong>Total: </strong></h2></td>
		<td class="text-left text-danger">
		<h2>Rs. <?php echo $rspayment[total_amt]; ?></strong></h2>
		
		</td>
	</tr>
</tbody>
                </table>
				<hr>
<center><input type="button" class="form-control" value="Print" style="width:500px;" onclick="PrintElem('divprintarea')"></center>
				
            </div>
			
			
        </div>    
	</div>
</div>
				
				<div class="clear"></div>
			</div>
	</div>
</div>
</div>		
<!--start main -->
<?php
include("datatable.php");
include("footer.php");
?>
<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>