<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM hotel_facility WHERE hotel_facilityid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Hotel Facility record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Hotel Facility</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Hotel </th>
							<th>Room Type</th>
							<th>Facility Image</th>
							<th>Facility Type</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM hotel_facility LEFT JOIN hotel ON hotel_facility.hotel_id=hotel.hotel_id LEFT JOIN room_type ON hotel_facility.room_typeid=room_type.room_typeid";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
if(file_exists("imghotelfacility/".$rs[facility_img]))
{
	$imgname = "imghotelfacility/".$rs[facility_img];
}
else
{
	$imgname = "images/noimage.png";
}
						echo "<tr>
							<td>$rs[hotel_name]</td>
							<td>$rs[room_type]</td>
	<td><img src='$imgname' style='width:150px;height:100px;' ></td>
							<td>$rs[facility_type]</td>
							<td>$rs[status]</td>
							<td> <a href='hotelfacility.php?editid=$rs[hotel_facilityid]'>Edit</a> | <a href='viewhotelfacility.php?delid=$rs[hotel_facilityid]' onclick='return confirmdelete()'>Delete</a></td>
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