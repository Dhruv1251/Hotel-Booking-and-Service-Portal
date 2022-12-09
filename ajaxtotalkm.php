<?php
error_reporting(0);
$pincode=$_POST[pincode];
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$pincode."&sensor=false";
$details=file_get_contents($url);
$result = json_decode($details,true);

$lat=$result['results'][0]['geometry']['location']['lat'];
$lng=$result['results'][0]['geometry']['location']['lng'];
/*
    echo "Latitude :" .$lat;
    echo '<br>';
    echo "Longitude :" .$lng;
	*/
//echo $_POST[latitude]. ",".$_POST[longitude];
	
$point1 = array("lat" => $lat, "long" => $lng); // Paris (France)
$point2 = array("lat" => $_POST[latitude], "long" => $_POST[longitude]); // Mexico City (Mexico)
$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calculate distance in kilometres (default)
/*
$mi = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'], 'mi'); // Calculate distance in miles
$nmi = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'], 'nmi'); // Calculate distance in nautical miles
*/
echo "$km";
?>
<?php
function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Calculate the distance in degrees
	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
	}
	return round($distance, $decimals);
}
?>
<?php
/*
$address = 'Bengaluru'; // Address

// Get JSON results from this request
$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
$geo = json_decode($geo, true); // Convert the JSON to an array

if (isset($geo['status']) && ($geo['status'] == 'OK')) {
 echo  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
  echo $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
}
*/
?>