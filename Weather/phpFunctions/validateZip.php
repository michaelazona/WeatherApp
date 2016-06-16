<?php

	include 'functions.php';

	$city = $_GET['city'];
	$zip  = $_GET['zip'];

	echo validateZipWithCity($city, $zip);
	
?>