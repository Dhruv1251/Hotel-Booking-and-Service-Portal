<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM hotel WHERE hotel_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Hotel record deleted successfully...');</script>";
	}
}
?>
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Hotels</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Hotel Name</th>
							<th>Hotel Type</th>
							<th>Hotel Address</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM hotel LEFT JOIN location ON hotel.location_id=location.location_id";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						echo "<tr>
							<td>$rs[hotel_name]</td>
							<td>$rs[hotel_type]</td>
							<td>$rs[hotel_address], <br>$rs[location_name], PIN - $rs[hotel_pincode]</td>
							<td>$rs[status]</td>
							<td> <a href='hotelmodule.php?editid=$rs[hotel_id]'>Edit</a> | <a href='viewhotelmodule.php?delid=$rs[hotel_id]' onclick='return confirmdelete()'>Delete</a><br>
							<a href='hoteldetails.php?hotelid=$rs[hotel_id]' target='_blank' >View More</a>
							</td>
						</tr>";
					}
					?>	
					</tbody>
				</table>
				
				
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
function confirmdelete()
{
	if(confirm("Are you sure you want to delete this record??") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>