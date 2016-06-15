<?php
	
	include 'phpFunctions/functions.php';

	$city = $_GET['city'];
	$zip  = $_GET['zip'];
	$email = $_GET['email'];

	if($email != "")
	{
		addEmail($email, $city, $zip);
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Weather App</title>
		<script src="js/jquery-3.0.0.js"></script>
		<script src="js/jsFunctions.js"></script>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
		<link rel="stylesheet" type="text/css" href="css/defaults.css">
	</head>

	<body>

		<script>
			
			function processWeatherData(zip)
			{
				var openWeatherMapKey = "68a43d6f89f83e20ab0f5222d0fe958f";
				var requestString     = "http://api.openweathermap.org/data/2.5/weather?zip=" + zip + "&units=imperial&APPID=68a43d6f89f83e20ab0f5222d0fe958f";
				
				$.getJSON(requestString, function(data) {
					var weather  = data.weather;
					var tempData = data.main;
					var sunrise  = timeStampConverter(data.sys.sunrise);
					var sunset   = timeStampConverter(data.sys.sunset);

					var icon = weather[0].icon;
					var description = weather[0].description.toString();
					var temperature = tempData.temp.toString();

					description = capitalizeWords(description);

					document.getElementById("weatherIcon").innerHTML = "<img height=150 width=150 src='images/" + icon + ".png'/>";
					document.getElementById("description").innerHTML = "<p id='info'>" + description + "</p>";
					document.getElementById("temp").innerHTML = "Current Temp: " + temperature + "&deg;";

					document.getElementById("sunrise").innerHTML = sunrise;
					document.getElementById("sunset").innerHTML  = sunset;

		        });
			}

		</script>

		<div id="container">
			<h1><h1 id="cityName"></h1></h1>

			<hr style="width: 80%">

			<div id="weather">
				<div id = "weatherIcon"></div>
				<div id = "description"></div><br>
				<h2  id = "temp"></h2>

				<table style="margin: auto">
					<tr>
						<td><h2 style = "margin: 0px">Sunrise: </h2></td>
						<td><h2 id="sunrise"></h2></td>
					</tr>

					<tr>
						<td><h2 style = "margin: 0px">Sunrise: </h2></td>
						<td><h2 id="sunset"></h2></td>
					</tr>
				</table>
			</div><br>

			<hr style="width: 80%"><br>

			<div style="width: 70%; margin: auto">
				<p>The following information represents the state of weather for your city AT THE TIME YOU ENTERED IT.  Please refresh the page to get current weather information.</p>
			</div><br>

			<input type="button" class="button" value="New City" onclick = "returnHome()"/><br><br><br>

		</div>

		<script>

			var city = <?php echo json_encode($city); ?>;
			city     = city.toLowerCase();

			var zip  = <?php echo json_encode($zip); ?>;
			
			document.getElementById("cityName").innerHTML = "Current Weather For " + capitalizeWords(city);
			processWeatherData(zip);

			function returnHome()
			{
				window.location.href = "weatherAppDemo.html";
			}
			
		</script>
	</body>
</html>