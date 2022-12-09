<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM feedback WHERE feedback_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Feedback record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Feedback</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Customer</th>
							<th>Hotel</th>
							<th>Feedback</th>
							<th>Ratings</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM feedback LEFT JOIN customer ON feedback.customer_id=customer.customer_id LEFT JOIN hotel ON feedback.hotel_id=hotel.hotel_id";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						echo "<tr>
							<td>$rs[customer_name]</td>
							<td>$rs[hotel_name]</td>
							<td>$rs[feedback]</td>
							<td>$rs[ratings]</td>
							<td> <a href='viewfeedback.php?delid=$rs[feedback_id]' onclick='return confirmdelete()'>Delete</a></td>
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