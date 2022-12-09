<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM room_type WHERE room_typeid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Room Type record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Room Type</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Hotel</th>
							<th>Room Type</th>
							<th>No. of <br>Adults</th>
							<th>No. of <br>Children</th>
							<th>No. of Rooms</th>
							<th>Cost</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM room_type LEFT JOIN hotel ON room_type.hotel_id=hotel.hotel_id";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						echo "<tr>
							<td>$rs[hotel_name]</td>
							<td>$rs[room_type]</td>
							<td>$rs[max_adult]</td>
							<td>$rs[max_children]</td>
							<td>$rs[no_of_room]</td>
							<td>Rs. $rs[cost]</td>
							<td>$rs[status]</td>
							<td> <a href='roomtype.php?editid=$rs[room_typeid]'>Edit</a> | <a href='viewroomtype.php?delid=$rs[room_typeid]' onclick='return confirmdelete()'>Delete</a></td>
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