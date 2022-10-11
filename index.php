<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Validators geolocation stats tool by CRAZYDIMKA &#128640; &#128640; &#128640;</title>
	<meta name="author" content="CRAZYDIMKA">
	<meta name="viewport" content="minimal-ui,width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<meta name="description" content="Validators geolocation stats tool for HAQQ by CRAZYDIMKA &#128640; &#128640; &#128640;">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<style>
		body{
			font-family: 'Roboto', sans-serif;
		}
	</style>
</head>
<body>
<?php
function object_from_file($filename){
	$file = file_get_contents($filename);
	$value = unserialize($file);
	return $value;
}
$country = object_from_file('country.txt');
$city = object_from_file('city.txt');

$count_country = array_count_values($country);
$count_city = array_count_values($city);

$all_country = count($country);
$all_city = count($city);
echo "<h2 style='text-align:center;'>Validators geolocation stats tool for HAQQ by CRAZYDIMKA &#128640;</h2>";
echo "<h4 style='text-align:center;'>The regionality data is updated once a day &#128075;<br> By default, we will search for network peers in a specialized file at: addrbook.json &#128187;</h4>";
echo "<h3>Statistic Countries &#129488;</h3>";
foreach($count_country as $p => $item){
	$result = $item * 100 / $all_country;
	$result = round($result, 4);
	if($result < 5){
		$color = '#E6E6FA';
	}else if($result < 10){
		$color = '#D8BFD8';
	}else if($result < 20){
		$color = '#EE82EE';
	}else if($result < 30){
		$color = '#FF00FF';
	}else if($result < 40){
		$color = '#BA55D3';
	}else if($result < 50){
		$color = '#8A2BE2';
	}else{
		$color = '#4B0082';
	}
	echo 'COUNTRY: <b>"'.$p.'"</b>, Servers: <b>'.$item.'</b>, Current Percent: <b>'.$result.'%</b><br>';
	if($p == 'SG' || $p == 'HK' || $p == 'ID'){
		continue;
	}
	$road .= 'doc.querySelector("[cc='.mb_strtolower($p).']").style.fill = "'.$color.'";';
}

echo "<h3>Statistic Cities &#129488; -> <span style='cursor:pointer;'>show &#128071;</span></h3>";
echo "<div class='country' style='display:none;'>";
foreach($count_city as $p => $item){
	$result = $item * 100 / $all_country;
	$result = round($result, 4);
	echo 'CITY: <b>"'.$p.'"</b>, Servers: <b>'.$item.'</b>, Current Percent: <b>'.$result.'%</b><br>';
}
echo "</div>";
echo '<br>';
echo '<div style="text-align:center;"><embed style="cursor:pointer;" src="map.svg" type="image/svg+xml" id="world" width="80%"></div>';
?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
var world = document.getElementById("world");

world.addEventListener("load", function () {
	var doc = world.getSVGDocument();

	// Colour Canada red
	<?php echo $road; ?>

	// Alert the ISO3166 code of clicked countries
	doc.addEventListener("click", function (e) {
		var target = e.target,
		cc = target.getAttribute("cc");
		if (cc) {
			alert("My country code is " + cc);
		}
	});
});

$('h3 span').click(function(){
	$('.country').show();
});
</script>
</body>
</html>