<?php
function object2file($value, $filename){
	$str_value = serialize($value);
	$f = fopen($filename, 'w');
	fwrite($f, $str_value);
	fclose($f);
}
//
$file = 'addrbook.json';
$file_get = file_get_contents($file);
$file_ar = json_decode($file_get);
$country = [];
$city = [];
foreach ($file_ar->addrs as $v){
	$now_ip = $v->addr->ip;
	//
	$ch = curl_init('https://ipinfo.io/'.$now_ip.'?token=bc0ada9378890e');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$html = curl_exec($ch);
	curl_close($ch);
	$decode_info_ar = json_decode($html);
	$country_item = $decode_info_ar->country;
	$city_item = $decode_info_ar->city;
	$country[] = $country_item;
	$city[] = $city_item;
}
object2file($country, 'country.txt');
object2file($city, 'city.txt');
?>