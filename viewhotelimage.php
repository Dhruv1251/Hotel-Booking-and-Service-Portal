<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM hotel_image WHERE hotel_imageid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Hotel Image record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Hotel Image</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Hotel</th>
							<th>Room Type</th>
							<th>Hotel Image</th>
							<th>Image Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM hotel_image LEFT JOIN hotel ON hotel_image.hotel_id=hotel.hotel_id LEFT JOIN room_type ON hotel_image.room_typeid=room_type.room_typeid";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						echo "<tr>
							<td>$rs[hotel_name]</td>
							<td>$rs[room_type]</td>
							<td><img src='imghotel/$rs[hotel_image]' width='150' height='155' ></td>
							<td>$rs[image_description]</td>
							<td>$rs[5]</td>
							<td> <a href='hotelimage.php?editid=$rs[hotel_imageid]'>Edit</a> | <a href='viewhotelimage.php?delid=$rs[hotel_imageid]' onclick='return confirmdelete()'>Delete</a></td>
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