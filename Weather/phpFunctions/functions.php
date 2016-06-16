<?php

	function connectToDatabase()
	{
		$serverName = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "EmailAddresses";

		$conn = new mysqli($serverName, $username, $password, $dbname);
		return $conn;
	}

	function addEmail($email, $city, $zip)
	{
		$conn = connectToDatabase();

		if ($conn->connect_error) 
		{
	    	die("Connection failed: " . $conn->connect_error);
		} 

		if($conn)
		{
			$sql = "DELETE FROM `emails` WHERE `email`='${email}'";
			$conn->query($sql);
			$sql = assembleSQLForAddingEmail($email, $city, $zip);
			$conn->query($sql);
		}
	}

	function assembleSQLForAddingEmail($email, $city, $zip)
	{
		$sql = "INSERT INTO `emails` (`email`, `lastCity`, `lastZip`) VALUES ('${email}', '${city}', '${zip}')";
		return $sql;
	}

	function validateZipWithCity($city, $zip)
	{
		$city = strToLower($city);
		$returnValue = "FALSE";
		$data = strtolower(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=${zip}&sensor=true"));
		
		if (strpos($data, $city) !== false) 
		{
		    $returnValue = "TRUE";
		}
		
		return $returnValue;
	}
?>