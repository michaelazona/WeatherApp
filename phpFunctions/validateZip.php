<?php

	$city = $_GET['city'];
	$zip  = $_GET['zip'];

	$city = strToLower($city);
	$returnValue = "FALSE";
	$data = strtolower(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=${zip}&sensor=true"));

	if (strpos($data, $city) !== false) 
	{
	    $returnValue = "TRUE";
	}
	
	echo $returnValue;
	
?>