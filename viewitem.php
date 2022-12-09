<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM item WHERE item_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Item record deleted successfully...');</script>";
	}
}
?>
<!--start main -->
<div class="main_bg">
<div class="wrap">
	<div class="main">
		<div class="res_online">
			<h4>View Item</h4>
		</div>			
			<div class="span_of_2">
				
				<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Image</th>
							<th>Hotel</th>
							<th>Item Name</th>
							<th>Food Category</th>
							<th>Item Description</th>
							<th>Item Cost</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sql = "SELECT * FROM item LEFT JOIN food_category ON item.food_category_id=food_category.food_category_id LEFT JOIN hotel on hotel.hotel_id=item.hotel_id";
					$qsql = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($qsql))
					{
						if($rs[item_img] == "")
						{
							$imgname = "images/noimage.png";
						}
						else
						{
							if(file_exists("imgitem/".$rs[item_img]))
							{
								$imgname=  "imgitem/".$rs[item_img];
							}
							else
							{
								$imgname = "images/noimage.png";
							}
						}
						echo "<tr>
							<td><img src='$imgname' style='width:100px;height:100px;'></td>
							<td>$rs[hotel_name]</td>
							<td>$rs[item_name]</td>
							<td>$rs[food_category]</td>
							<td>$rs[item_description]</td>
							<td>₹$rs[item_cost]</td>
							<td>$rs[7]</td>
							<td> <a href='item.php?editid=$rs[item_id]'>Edit</a> | <a href='viewitem.php?delid=$rs[item_id]' onclick='return confirmdelete()'>Delete</a></td>
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