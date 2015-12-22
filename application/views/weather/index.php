<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2><?php echo $this->lang->line("weather"); ?></h2>

				<script>
					// Reload the page every 5 minutes
					setTimeout(function () {
						location.reload(true);
					}, 5 * 60 * 1000);
					var snapshots = <?php echo json_encode($snapshots); ?>;

					Chart.defaults.global.animation = !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent));

					function generateGraph(id, data, item, options) {
						options = options || {};
						
						var defaults = {
					        bezierCurve: true,
					        showTooltips: true,
					        scaleShowLabels: true,
					        scaleType: "date",
					        scaleLabel: "<%=value%>",
					        scaleDateFormat: "dd/mm",
					        scaleTimeFormat: "HH:MM",
					        scaleDateTimeFormat: "HH:MM dd/mm",
						    scaleGridLineColor: "#ccc",
					        useUtc: false,
						};

						var dataDefaults = {
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
							data: realTemperatureData
						};

						var points = [];

						// This should be factored
 						var real = data[item] && data[item]['Real'] || [];
						var generated = data[item] && data[item]['Generated'] || [];

						real = real.map(function (snapshot) {
							return {x: new Date(snapshot.Date * 1000), y: snapshot[item] };
						});
						points.push(real, extend(dataDefaults, {pointColor: "#00693F"}));

						generated = generated.map(function (snapshot) {
							return {x: new Date(snapshot.Date * 1000), y: snapshot[item] };
						});
						points.push(generated, extend(dataDefaults, {pointColor: "#45DDBA"}));

						var ctx = document.getElementById(id).getContext("2d");
						var chart = new Chart(ctx).Scatter(points, extend(defaults, options));
					}

					function extend(defaults, options) {
						var extented = {};
						for (var key in options) {
							extented = options[key] || defaults[key];						
						}
						return extented;
					}
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
					generateGraph('temperatureChart', snapshots, 'Temperature', { scaleLabel: "<%=value%>ºC" }); 
				</script>

				<h3>Rain</h3>
				<canvas id="rainChart" width="800" height="200"></canvas>
				<script>
					generateGraph('rainChart', snapshots, 'Rain', { scaleLabel: "<%=value%>mm" }); 
				</script>

				<h3>Humidity</h3>
				<canvas id="humidityChart" width="800" height="200"></canvas>
				<script>
					generateGraph('humidityChart', snapshots, 'Humidity', { scaleLabel: "<%=value%>%" }); 
				</script>

				<h3>Dew</h3>
				<canvas id="dewChart" width="800" height="200"></canvas>
				<script>
					generateGraph('dewChart', snapshots, 'Dew', { scaleLabel: "<%=value%>ºC" });
				</script>

				<h3>Atmospheric Pressure</h3>
				<canvas id="atmosphericPressureChart" width="800" height="400"></canvas>
				<script>
					generateGraph('atmosphericPressureChart', snapshots, 'AtmosphericPressure', { scaleLabel: "<%=value%>" });
				</script>
			</div>
		</div>
	</div>
</div>
