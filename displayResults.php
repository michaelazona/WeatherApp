<?php
	
	$city = $_GET['city'];
	$zip  = $_GET['zip'];
	$email = $_GET['email'];

?>

<!DOCTYPE html>
<html>
	<head>
		<script src="js/jquery-3.0.0.js"></script>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito">
		<link rel="stylesheet" type="text/css" href="css/defaults.css">
	</head>

	<body>

		<script>

			function capitalizeWords(phrase)
			{
				phrase = phrase.split(" ");

				for(var i = 0; i < phrase.length; i++)
				{
					phrase[i] = phrase[i].charAt(0).toUpperCase() + phrase[i].slice(1);
				}

				phrase = phrase.join().replace(",", " ");
				return phrase;
			}
			
			function processWeatherData(zip)
			{
				var openWeatherMapKey = "68a43d6f89f83e20ab0f5222d0fe958f";
				var requestString     = "http://api.openweathermap.org/data/2.5/weather?q=" + city + "&units=imperial&APPID=68a43d6f89f83e20ab0f5222d0fe958f";
				
				$.getJSON(requestString, function(data) {
					var weather  = data.weather;
					var tempData = data.main;

					var icon = weather[0].icon;
					var description = weather[0].description.toString();
					var temperature = tempData.temp.toString();

					description = capitalizeWords(description);

					document.getElementById("weatherIcon").innerHTML = "<img height=150 width=150 src='images/" + icon + ".png'/>";
					document.getElementById("description").innerHTML = "<p id='info'>" + description + "</p>";
					document.getElementById("temp").innerHTML = "Current Temp: " + temperature;
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
			</div>

			<hr style="width: 80%"><br>

			<div style="width: 70%; margin: auto">
				<p>The following information represents the state of weather for your city AT THE TIME YOU ENTERED IT.  Please refresh the page to get current weather information.</p>
			</div>

		</div>

		<script>
			var city = <?php echo json_encode($city); ?>;
			var zip  = <?php echo json_encode($zip); ?>;

			document.getElementById("cityName").innerHTML = "Current Weather For " + capitalizeWords(city);
			processWeatherData(zip);

			function submit()
			{
				var zip = document.getElementById("zip").value;
				var email = document.getElementById("email").value;
				var city  = document.getElementById("city").value;

				if(city == "")
				{
					alert("You didn't enter a city name.  Please fix and try again.");
				}

				else if(!validateZip(zip) && (!validateEmail(email) && email.length > 0))
				{
					alert("Both your zip code and your email address are invalid.  Please fix and try again."); 

				}
				else if(!validateZip(zip))  
				{
					alert("Your zip code is invalid.  Please fix and try again.");
				}

				else if(!validateEmail(email) && email.length > 0)
				{
					alert("Your email address is invalid.  Please fix and try again."); 
				}

				else
				{
					window.location.href = "displayResults.php?city=" + city + "&zip=" + zip + "&email=" + email;
				}
			}
		</script>
	</body>
</html>