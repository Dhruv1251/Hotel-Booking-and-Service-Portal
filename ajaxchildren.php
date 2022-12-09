<?php
error_reporting(0);
include("connection.php");
$sqlroomtype ="SELECT * FROM room_type where room_typeid='$_GET[room_type]'";
$qsqlroomtype = mysqli_query($con,$sqlroomtype);
$rsroomtype = mysqli_fetch_array($qsqlroomtype);
?>
<select id="children" name="children"  class="form-control" style="height:50px;">
	<?php
	for($i=0; $i<=$rsroomtype[max_children];$i++)
	{
		if($i == $_GET[children])
		{
			echo "<option value='$i' selected>$i</option>";
		}
		else
		{
			echo "<option value='$i' >$i</option>";
		}
	}
	?>
</select>