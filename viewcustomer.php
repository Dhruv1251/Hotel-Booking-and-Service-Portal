<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM customer WHERE customer_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Customer</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Customer Name</th>
							<th>Address</th>
							<th>City</th>
							<th>Pincode</th>
							<th>Contact No.</th>
							<th>Email ID</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM customer";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						echo "<tr>
							<td>$rs[customer_name]</td>
							<td>$rs[address]</td>
							<td>$rs[city]</td>
							<td>$rs[pincode]</td>
							<td>$rs[contact_no]</td>
							<td>$rs[email_id]</td>
							<td>$rs[status]</td>
							<td> <a href='customer.php?editid=$rs[customer_id]'>Edit</a> | <a href='viewcustomer.php?delid=$rs[customer_id]' onclick='return confirmdelete()'>Delete</a></td>
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