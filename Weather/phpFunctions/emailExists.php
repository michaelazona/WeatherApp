<?php
	
	include 'functions.php';

	$email = $_GET['email'];

	$conn = connectToDatabase();

	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	} 

	if($conn)
	{
		$sql = "SELECT * FROM emails WHERE email = '" . $email . "'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) 
		{
			if(isset($row["lastCity"]))
			{
				$lastCity = $row["lastCity"];
        		$lastZip  = $row["lastZip"];
        		echo $lastCity . "," . $lastZip;
			}	
    	}
	}

	echo "";

?>