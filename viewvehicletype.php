<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM vehicle_type WHERE vehicle_typeid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Vehicle Type record deleted successfully...');
		</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Vehicle type</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Vehicle image</th>
							<th>Hotel</th>
							<th>Vehicle Type</th>
							<th>Cost per KM</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
					<?php
					$sql = "SELECT * FROM vehicle_type LEFT JOIN hotel on vehicle_type.hotel_id=hotel.hotel_id";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						echo "<tr>
							<td><img src='imgvehicletype/$rs[vehicle_img]' style='width:150px;height:100px;'></td>
							<td>$rs[hotel_name]</td>
							<td>$rs[vehicle_type]</td>
							<td>Rs. $rs[km_cost]</td>
							<td>$rs[5]</td>
							<td><a href='vehicletype.php?editid=$rs[vehicle_typeid]'>Edit</a> | <a href='viewvehicletype.php?delid=$rs[vehicle_typeid]' onclick='return confirmdelete()'> Delete</a></td>
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
	if(confirm("Are you sure you want to delete this record??") ==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>