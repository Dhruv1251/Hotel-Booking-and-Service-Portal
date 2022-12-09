<?php
session_start();
error_reporting(0);
$dt = date("Y-m-d");
 $tim= date("H:i:s");
$minmonth=date("Y-m");
include("connection.php");
if(isset($_SESSION['staffid']))
{
	$sqlstaffprofile ="SELECT * FROM staff WHERE staffid='$_SESSION[staffid]'";
	$qsqlstaffprofile = mysqli_query($con,$sqlstaffprofile);
	$rsstaffprofile = mysqli_fetch_array($qsqlstaffprofile);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>FindMyStay  | Smart Booking Solution</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css"  crossorigin="anonymous">
<script src="js/bootstrap.min.js"  crossorigin="anonymous"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script>
<!--start slider -->
<link rel="stylesheet" href="css/fwslider.css" media="all">
<script src="js/jquery-ui.min.js"></script>
<script src="js/css3-mediaqueries.js"></script>
<script src="js/fwslider.js"></script>
<!--end slider -->
<!---strat-date-piker---->
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-ui.js"></script>
		  <script>
				  $(function() {
				    $( "#datepicker,#datepicker1" ).datepicker();
				  });
		  </script>
<!---/End-date-piker---->
<link type="text/css" rel="stylesheet" href="css/JFGrid.css" />
<link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css" />
		<script type="text/javascript" src="js/JFCore.js"></script>
		<script type="text/javascript" src="js/JFForms.js"></script>
		<!-- Set here the key for your domain in order to hide the watermark on the web server -->
		<script type="text/javascript">
			(function() {
				JC.init({
					domainKey: ''
				});
				})();
		</script>
<!--nav-->
<script>
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
</script>
</head>
<body>

<?php
include("topmenu.php");
?>

<!-- start header -->
<div class="header_bg">
<div class="wrap">
	<div class="header">
		<div class="logo">
			<a href="index.php"><img src="images/findmystaylogo.png" alt="" width="250px;" style="height:75px;"></a>
		</div>
		<div class="h_right">
			<!--start menu -->
			<ul class="menu">
				<?php
				include("menu.php");
				?>
				<div class="clear"></div>
			</ul>
			<!-- start profile_details -->
					<form class="style-1 drp_dwn">
						<div class="row">
							<div class="grid_3 columns">
<select class="custom-select" id="dynamic_select"  onchange="if (this.value) window.location.href=this.value" >
	<?php
	if(isset($_SESSION[customer_id]))
	{
	?>
		<option selected="selected">Account</option>
		<option value='customerprofile.php'>Profile</option>
		<option value='customerchangepassword.php'>Change Password</option>
		<option value='logout.php'>Logout</option>
	<?php
	}
	else if(isset($_SESSION[staffid]))
	{
	?>
		<option value='dashboardaccount.php' selected>Dashboard</option>
		<option value='staffprofile.php'>Profile</option>
		<option value='staffchangepassword.php'>Change Password</option>
		<option value='logout.php'>Logout</option>
	<?php
	}
	else
	{
	?>
		<option value='' selected="selected">Account</option>
		<option value='customerlogin.php'>Log-in</option>
		<option value='customerregistration.php'>Register</option>
	<?php
	}
	?>
</select>
							</div>		
						</div>		
					</form>
		</div>
		<div class="clear"></div>
		<div class="top-nav">
		<nav class="clearfix">
				<ul>
				<?php
				include("menu.php");
				?>
				</ul>
				<a href="#" id="pull">Menu</a>
			</nav>
		</div>
	</div>
</div>
</div>

<script>
    $(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>