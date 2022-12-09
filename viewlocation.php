<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM location WHERE location_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Location record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Location</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Location Image</th>
							<th>Location Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM location";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						if(file_exists("imglocation/".$rs[location_img]))
						{
							$imgname=  "imglocation/".$rs[location_img];
						}
						else
						{
							$imgname = "images/noimage.png";
						}
						echo "<tr>
							<td><img src='$imgname' width='100' height='100'></td>
							<td>$rs[location_name]</td>
							<td>$rs[description]</td>
							<td>$rs[status]</td>
							<td> <a href='location.php?editid=$rs[location_id]'>Edit</a> | <a href='viewlocation.php?delid=$rs[location_id]' onclick='return confirmdelete()'>Delete</a></td>
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