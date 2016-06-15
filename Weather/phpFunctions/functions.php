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
			$sql = "INSERT INTO `emails` (`email`, `lastCity`, `lastZip`) VALUES ('${email}', '${city}', '${zip}')";
			$conn->query($sql);
		}
	}

	
?>