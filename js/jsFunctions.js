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
	phrase = phrase.toLowerCase()
	phrase = phrase.split(" ");

	for(var i = 0; i < phrase.length; i++)
	{
		phrase[i] = phrase[i].charAt(0).toUpperCase() + phrase[i].slice(1);
	}

	phrase = phrase.join().replace(new RegExp(',', 'g'), ' ');
	return phrase;
}

function removeCommas(phrase)
{
	return phrase.replace(new RegExp(',', 'g'), '');
}


////////////////////////////////////////////////////////////////////////////////////////////////////////

//UNIT TESTS - USING MOCHA//

var assert = require('chai').assert;

describe('validateZip', function() {
    it('it should return true if the zip code is valid', function () {
      assert.equal(true, validateZip("55431"));
      assert.equal(false, validateZip("554319"));
    });
});

describe('validateEmail', function() {
    it('it should return true if the email is valid', function () {
      assert.equal(true, validateEmail("email@sample.com"));
      assert.equal(false, validateEmail("email.sample@com"));
      assert.equal(false, validateEmail("email.com"));
      assert.equal(false, validateEmail("email@sample"));
      assert.equal(false, validateEmail("gibberish"));
    });
});

describe('timeStampConverter', function() {
    it('it should return a valid formatted time when given a unix time stamp', function () {
      assert.equal("5:25", timeStampConverter("1465986347"));
      assert.equal("9:02", timeStampConverter("1466042522"));
      assert.notEqual("5:24", timeStampConverter("1465986347"));
      assert.notEqual("9:03", timeStampConverter("1466042522"));
    });
});

describe('capitalizeWords', function() {
    it('it should take any phrase and capitalize the first letter of words, and make all others lower case', function () {
      assert.equal("Hello World", capitalizeWords("hello world"));
      assert.equal("Hello World", capitalizeWords("hELLO WORLD"));
      assert.equal("Hello World How Are You?", capitalizeWords("hELLO wORLD how ARE YoU?"));
    });
});

describe('removeCommas', function() {
    it('it should take any string and remove the comma', function () {
      assert.equal("Hello World", removeCommas("H,e,l,l,o W,o,r,l,d"));
      assert.equal("Hello World", removeCommas("H,,ell,,o ,Wo,rl,d,,"));
    });
});
