		<hr>
<?php
error_reporting(0);
include("connection.php");
$sqlspa_service = "SELECT * FROM spa_service WHERE status='Active' AND hotel_id='$_GET[hotel_id]'";
if($_GET[gender] != "")
{
	$sqlspa_service = $sqlspa_service . " AND gender='$_GET[gender]'";
}
$qsqlspa_service = mysqli_query($con,$sqlspa_service);
while($rssqlspa_service = mysqli_fetch_array($qsqlspa_service))
{
			if(file_exists("imgspa/$rssqlspa_service[service_images]"))
			{
				$imgname = "imgspa/$rssqlspa_service[service_images]";				
			}
			else
			{
				$imgname = "images/noimage.png";
			}
?>		
<div class="well">
  <div class="media">
			<a class="pull-left" href="" onclick="return false;">
				<img style="width:200px;height:200px;" class="media-object" src="<?php echo $imgname; ?>">
			</a>
		<div class="media-body">
			<h4 class="media-heading" style="color:blue;font-size:25px;"><?php echo $rssqlspa_service[service_type]; ?></h4>
			<p class="text-left" style="color:red;">For <?php echo $rssqlspa_service[gender]; ?></p>
			<p style="min-height:100px;"><?php echo $rssqlspa_service[service_description]; ?></p>
		  <ul class="list-inline list-unstyled">
			<span> Cost : ₹<?php echo $rssqlspa_service[service_cost]; ?></span>
			<li>|</li>
			<li>
			   <input type="button" name="btn" value="Add this service" class="form-control" onclick="insertspaservice('<?php echo $rssqlspa_service[0]; ?>','<?php echo $rssqlspa_service[service_cost]; ?>')">
			</li>
			</ul>
		</div>
	</div>
</div>
<?php
}
?>