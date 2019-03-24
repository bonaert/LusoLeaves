var dBaseFile = require('bodhi-dbf')();
var http = require('https');

var hostname = process.argv[2];
var port = process.argv[3];
var path = process.argv[4];
var key = process.argv[5];
var file = process.argv[6];

var snapshots = [];
var lastWeek = getLastWeek(1);

function getLastWeek(weeks) {
	weeks = weeks || 1;
	var today = new Date();
	return new Date(today.getFullYear(), today.getMonth(), today.getDate() - (weeks * 7));
}

var WeatherProperties = {
		  CHN1_DEG: "Temperature",
		  CHN1_RF:  "Humidity",
		  CHN1_DEW: "Dew",
		  PRES_ABS: "AtmosphericPressure",
		  W_CHILL:  "WindChill",
		  W_TEMP:   "WindTemperature",
		  W_GUST:   "WindGust",
		  W_SPEED:  "WindSpeed",
		  DIRECTION:"WindDirection",
		  RAIN_SUM: "RainSum",
};

/**
 * Weather snapshot
 * @constructor
 */
function WeatherSnapshot () {}


var dbf = new dBaseFile.Parser(file);
dbf.on('record', function (record) {
	var snapshot = new WeatherSnapshot();

	for (var property in WeatherProperties) {
		snapshot[WeatherProperties[property]] = record[property];
	}
	snapshot.Date = dBaseDateToDate(record['DATE_TIME']);

	if (snapshot.Date.getTime() > lastWeek.getTime()) {
		console.log(snapshot.Date);
		snapshots.push(snapshot);
	}

	function dBaseDateToDate(dBaseDate) {
		var daysSinceCentury = Math.floor(dBaseDate);
		var minutesSinceDay = (((dBaseDate - daysSinceCentury) * 1000000000) / 694500) + 1;
		return new Date(1900,0,(daysSinceCentury - 1) ,0, minutesSinceDay,0);
	}

});

dbf.on('end', function () {
	var opts = {
		'hostname': hostname,
		'port': port,
		'path': path,
		'method': 'POST',
		'headers': {
			'Content-Type': 'application/json'
		}
	}
	var request = http.request(opts, function (response) {
		var buff = '';
		response.on('data', function (chunk) {
			buff += chunk;
		});
		response.on('end', function () {
			console.log('Uploaded ', snapshots.length, ' snapshots' , buff, response.statusCode);
		});
	});
	console.log(snapshots);
	request.write(JSON.stringify({
		upload_key: key,
		snapshots: snapshots
	}));
	request.end();
});

dbf.parse();