function validateZip(zip)
{
	return /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip);
}

function validateEmail(email) 
{
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function timeStampConverter(timestamp)
{
	var date = new Date(timestamp*1000);
	var hours = date.getHours();

	if(hours > 12)
	{
		hours = hours - 12;
	}

	var minutes = "0" + date.getMinutes();
	var formattedTime = hours + ':' + minutes.substr(-2);

	return formattedTime;
}

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