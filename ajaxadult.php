<?php
error_reporting(0);
include("connection.php");
$sqlroomtype ="SELECT * FROM room_type where room_typeid='$_GET[room_type]'";
$qsqlroomtype = mysqli_query($con,$sqlroomtype);
$rsroomtype = mysqli_fetch_array($qsqlroomtype);
?>
<select id="adults" name="adults"  class="form-control" style="height:50px;">
	<?php
	for($i=1; $i<=$rsroomtype[max_adult];$i++)
	{
		if($i == $_GET[adults])
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