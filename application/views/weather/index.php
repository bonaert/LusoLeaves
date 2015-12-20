<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2><?php echo $this->lang->line("weather"); ?></h2>

				<script>
					setTimeout(function () {
						location.reload(true);
					}, 5 * 60 * 1000);
					var snapshots = <?php echo json_encode($snapshots); ?>;
					Chart.defaults.global.animation = !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));
				</script>

				<h3>Latest</h3>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Date</th>
							<th>Temperature</th>
							<th>Humidity</th>
							<th>Dew</th>
							<th>Atmospheric Pressure</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $latest->Date; ?></td>
							<td><?php echo $latest->Temperature; ?>ºC</td>
							<td><?php echo $latest->Humidity; ?>%</td>
							<td><?php echo $latest->Dew; ?></td>
							<td><?php echo sprintf("%.2f", $latest->AtmosphericPressure); ?></td>
						</tr>
					</tbody>
				</table>

				<h3>Temperature</h3>
				<canvas id="temperatureChart" width="800" height="200"></canvas>
				<script>
				    var realTemperatureDataPoints = snapshots['Temperature']['Real'];
					var generatedTemperatureDataPoints = snapshots['Temperature']['Generated'];
					var data = [];
					if (realTemperatureDataPoints){
						var realTemperatureData = realTemperatureDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.Temperature };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: realTemperatureData
						})
					}

					if (generatedTemperatureDataPoints){
						var generatedTemperatureData = generatedTemperatureDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.Temperature };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#45ddba",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: generatedTemperatureData
						})
					}


					var ctx = document.getElementById("temperatureChart").getContext("2d");
					var temperatureChart = new Chart(ctx).Scatter(data, {
				        bezierCurve: true,
				        showTooltips: true,
				        scaleShowLabels: true,
				        scaleType: "date",
				        scaleLabel: "<%=value%>ºC",
				        scaleDateFormat: "dd/mm",
				        scaleTimeFormat: "HH:MM",
				        scaleDateTimeFormat: "HH:MM dd/mm",
					scaleGridLineColor: "#ccc",
				        useUtc: false,
					});
				</script>

				<h3>Rain</h3>
				<canvas id="rainChart" width="800" height="200"></canvas>
				<script>
					rainData = snapshots.map(function (snapshot) {
						return {x: new Date(snapshot.Date), y: snapshot.Rain };
					});
					var data = [
						{
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: rainData,
						},
					];

					var ctx = document.getElementById("rainChart").getContext("2d");
					var temperatureChart = new Chart(ctx).Scatter(data, {
						bezierCurve: true,
						showTooltips: true,
						scaleShowLabels: true,
						scaleType: "date",
						scaleLabel: "<%=value%>mm",
						scaleDateFormat: "dd/mm",
						scaleTimeFormat: "HH:MM",
						scaleDateTimeFormat: "HH:MM dd/mm",
						scaleGridLineColor: "#ccc",
						useUtc: false,
					});
				</script>

				<h3>Humidity</h3>
				<canvas id="humidityChart" width="800" height="200"></canvas>
				<script>
					var realHumidityDataPoints = snapshots['Humidity']['Real'];
					var generatedHumidityDataPoints = snapshots['Humidity']['Generated'];
					var data = [];
					if (realHumidityDataPoints){
						var realHumidityData = realHumidityDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.Humidity };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: realHumidityData
						})
					}

					if (generatedHumidityDataPoints){
						var generatedHumidityData = generatedHumidityDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.Humidity };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#45ddba",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: generatedHumidityData
						})
					}

					var ctx = document.getElementById("humidityChart").getContext("2d");
					var HumidityChart = new Chart(ctx).Scatter(data, {
						bezierCurve: true,
						showTooltips: true,
						scaleShowLabels: true,
						scaleType: "date",
						scaleLabel: "<%=value%>mm",
						scaleDateFormat: "dd/mm",
						scaleTimeFormat: "HH:MM",
						scaleDateTimeFormat: "HH:MM dd/mm",
						scaleGridLineColor: "#ccc",
						useUtc: false,
					});
				</script>

				<h3>Dew</h3>
				<canvas id="dewChart" width="800" height="200"></canvas>
				<script>
					var realDewDataPoints = snapshots['Dew']['Real'];
					var generatedDewDataPoints = snapshots['Dew']['Generated'];
					var data = [];
					if (realDewDataPoints){
						var realDewData = realDewDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.Dew };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: realDewData
						})
					}

					if (generatedDewDataPoints){
						var generatedDewData = generatedDewDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.Dew };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#45ddba",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: generatedDewData
						})
					}

					var ctx = document.getElementById("dewChart").getContext("2d");
					var DewChart = new Chart(ctx).Scatter(data, {
						bezierCurve: true,
						showTooltips: true,
						scaleShowLabels: true,
						scaleType: "date",
						scaleLabel: "<%=value%>mm",
						scaleDateFormat: "dd/mm",
						scaleTimeFormat: "HH:MM",
						scaleDateTimeFormat: "HH:MM dd/mm",
						scaleGridLineColor: "#ccc",
						useUtc: false,
					});
				</script>

				<h3>Atmospheric Pressure</h3>
				<canvas id="atmosphericPressureChart" width="800" height="400"></canvas>
				<script>
					var realAtmosphericPressureDataPoints = snapshots['AtmosphericPressure']['Real'];
					var generatedAtmosphericPressureDataPoints = snapshots['AtmosphericPressure']['Generated'];
					var data = [];
					if (realAtmosphericPressureDataPoints){
						var realAtmosphericPressureData = realAtmosphericPressureDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.AtmosphericPressure };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: realAtmosphericPressureData
						})
					}

					if (generatedAtmosphericPressureDataPoints){
						var generatedAtmosphericPressureData = generatedAtmosphericPressureDataPoints.map(function (snapshot) {
							return {x: new Date(snapshot.Date), y: snapshot.AtmosphericPressure };
						});

						data.push({
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#45ddba",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: generatedAtmosphericPressureData
						})
					}

					var ctx = document.getElementById("atmosphericPressureChart").getContext("2d");
					var AtmosphericPressureChart = new Chart(ctx).Scatter(data, {
						bezierCurve: true,
						showTooltips: true,
						scaleShowLabels: true,
						scaleType: "date",
						scaleLabel: "<%=value%>mm",
						scaleDateFormat: "dd/mm",
						scaleTimeFormat: "HH:MM",
						scaleDateTimeFormat: "HH:MM dd/mm",
						scaleGridLineColor: "#ccc",
						useUtc: false,
					});
				</script>
			</div>
		</div>
	</div>
</div>
