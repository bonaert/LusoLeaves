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

					Chart.defaults.global.animation = false;

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
					        useUtc: true,
						};

						var dataDefaults = {
							fillColor: "rgba(220,220,220,0.2)",
							strokeColor: "rgba(220,220,220,1)",
							pointColor: "#00693F",
							pointStrokeColor: "#fff",
							pointHighlightFill: "#fff",
							pointHighlightStroke: "rgba(220,220,220,1)",
						};

						var points = [];

						// This should be factored
 						var real = data[item] && data[item]['Real'] || [];
						var generated = data[item] && data[item]['Generated'] || [];

						real = real.map(function (snapshot) {
							return {x: new Date(snapshot.Date * 1000), y: snapshot[item] };
						});
						points.push(extend(extend({}, dataDefaults), {pointColor: "#00693F", data: real}));

						generated = generated.map(function (snapshot) {
							return {x: new Date(snapshot.Date * 1000), y: snapshot[item] };
						});
						points.push(extend(extend({}, dataDefaults), {pointColor: "#45DDBA", data: generated}));
				
						var ctx = document.getElementById(id).getContext("2d");
						var chart = new Chart(ctx).Scatter(points, extend(defaults, options));
					}

					function extend(origin, add) {
						 // Don't do anything if add isn't an object
						if (!add || typeof add !== 'object') return origin;
						var keys = Object.keys(add);
						var i = keys.length;
						while (i--) {
						  origin[keys[i]] = add[keys[i]];
						}
						return origin;
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
							<th>Rain (Today)</th>
							<th>Rain (Yesterday)</th>
							<th>Rain (This month)</th>
							<th>Rain (Last month)</th>
							<th>Rain (This year)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $latest->Date; ?></td>
							<td><?php echo $latest->Temperature; ?>ºC</td>
							<td><?php echo $latest->Humidity; ?>%</td>
							<td><?php echo $latest->Dew; ?></td>
							<td><?php echo sprintf("%.2f", $latest->AtmosphericPressure); ?> kPa</td>
							<td><?php echo round($latest->Rain, 1) ?> mm</td>
							<td><?php echo round($latest->RainYesterday, 1) ?> mm</td>
							<td><?php echo round($latest->RainSinceStartOfMonth, 1) ?> mm</td>
							<td><?php echo round($latest->RainLastMonth, 1) ?> mm</td>
							<td><?php echo round($latest->RainSinceStartOfYear, 1) ?> mm</td>
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

				'WindGust', 'WindSpeed', 'WindDirection'

				<h3>Wind Gust</h3>
				<canvas id="windGustChart" width="800" height="400"></canvas>
				<script>
					generateGraph('windGustChart', snapshots, 'windGust', { scaleLabel: "<%=value%>" });
				</script>

				<h3>Wind Speed</h3>
				<canvas id="windSpeedChart" width="800" height="400"></canvas>
				<script>
					generateGraph('windSpeedChart', snapshots, 'windSpeed', { scaleLabel: "<%=value%>" });
				</script>

				<h3>Wind Direction</h3>
				<canvas id="windDirectionChart" width="800" height="400"></canvas>
				<script>
					generateGraph('windDirectionChart', snapshots, 'windDirection', { scaleLabel: "<%=value%>" });
				</script>
			</div>
		</div>
	</div>
</div>
