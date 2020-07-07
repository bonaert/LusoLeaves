<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center no-margin-top"><?php echo $this->lang->line("weather"); ?></h2>

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
                            useUtc: true
                        };

                        var dataDefaults = {
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "#00693F",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)"
                        };

                        var points = [];

                        // This should be factored
                        var real = data[item] && data[item]['Real'] || [];
                        var generated = data[item] && data[item]['Generated'] || [];

                        real = real.map(function (snapshot) {
                            return {x: new Date(snapshot.Date * 1000), y: snapshot[item]};
                        });
                        points.push(extend(extend({}, dataDefaults),
                            {
                                pointColor: "#00693F",
                                data: real
                            }
                        ));

                        generated = generated.map(function (snapshot) {
                            return {x: new Date(snapshot.Date * 1000), y: snapshot[item]};
                        });
                        points.push(extend(extend({}, dataDefaults),
                            {
                                pointColor: "#45DDBA",
                                data: generated,
                                bezierCurve: false,
                                datasetStroke: false,
                                datasetStrokeWidth: 2,
                                showLine: false
                            }
                        ));

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
                        <th>Wind Speed</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $latest->Date; ?></td>
                        <td><?php echo $latest->Temperature; ?>ºC</td>
                        <td><?php echo $latest->Humidity; ?>%</td>
                        <td><?php echo $latest->Dew; ?></td>
                        <td><?php echo sprintf("%.2f", $latest->AtmosphericPressure); ?> kPa</td>
                        <td><?php echo $latest->WindSpeed ?> km/h</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Rain (Today)</th>
                        <th>Rain (Yesterday)</th>
                        <th>Rain (This month)</th>
                        <th>Rain (Last month)</th>
                        <th>Rain (Since last september)</th>
                        <th>Rain (Same but for year before)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo round($latest->Rain, 1) ?> mm</td>
                        <td><?php echo round($latest->RainYesterday, 1) ?> mm</td>
                        <td><?php echo round($latest->RainSinceStartOfMonth, 1) ?> mm</td>
                        <td><?php echo round($latest->RainLastMonth, 1) ?> mm</td>
                        <td><?php echo round($latest->RainSinceLastSeptember, 1) ?> mm</td>
                        <td><?php echo round($latest->RainSincePreviousSeptember, 1) ?> mm</td>
                    </tr>
                    </tbody>
                </table>

                <script>
                    function updateTimeInterval(numDays) {
                        var search = location.search;
                        var index = search.indexOf('timeInterval');
                        if (index == -1) {
                            location.search += 'timeInterval=' + numDays.toString();
                        } else {
                            var ampersandIndex = search.indexOf('&', index);
                            if (ampersandIndex == -1) {
                                var textBefore = location.search.slice(0, index);
                                var newText = 'timeInterval=' + numDays.toString();
                                location.search = textBefore + newText;
                            } else {
                                var textBefore = location.search.slice(0, index);
                                var newText = 'timeInterval=' + numDays.toString();
                                var textAfter = location.search.slice(ampersandIndex);
                                location.search = textBefore + newText + textAfter;
                            }
                        }
                    }
                </script>

                <div>
                    <strong>Interval: </strong>
                    <button onclick="updateTimeInterval(1)" class="btn btn-success btn-sm">One Day</button>
                    <button onclick="updateTimeInterval(2)" class="btn btn-success btn-sm">Two Days</button>
                    <button onclick="updateTimeInterval(7)" class="btn btn-success btn-sm">One Week</button>
                    <button onclick="updateTimeInterval(31)" class="btn btn-success btn-sm">One Month</button>
                </div>

                <h3>Temperature</h3>
                <canvas id="temperatureChart" width="800" height="200"></canvas>
                <script>
                    generateGraph('temperatureChart', snapshots, 'Temperature', {scaleLabel: "<%=value%>ºC"});
                </script>

                <h3>Temperature (Anemometer)</h3>
                <canvas id="windTemperatureChart" width="800" height="200"></canvas>
                <script>
                    generateGraph('windTemperatureChart', snapshots, 'WindTemperature', {scaleLabel: "<%=value%>ºC"});
                </script>

                <h3>Rain</h3>
                <canvas id="rainChart" width="800" height="200"></canvas>
                <script>
                    generateGraph('rainChart', snapshots, 'RainCumulative', {scaleLabel: "<%=value%>mm"});
                </script>

                <h3>Humidity</h3>
                <canvas id="humidityChart" width="800" height="200"></canvas>
                <script>
                    generateGraph('humidityChart', snapshots, 'Humidity', {scaleLabel: "<%=value%>%"});
                </script>

                <h3>Dew</h3>
                <canvas id="dewChart" width="800" height="200"></canvas>
                <script>
                    generateGraph('dewChart', snapshots, 'Dew', {scaleLabel: "<%=value%>ºC"});
                </script>

                <h3>Atmospheric Pressure</h3>
                <canvas id="atmosphericPressureChart" width="800" height="400"></canvas>
                <script>
                    generateGraph('atmosphericPressureChart', snapshots, 'AtmosphericPressure', {scaleLabel: "<%=value%>"});
                </script>

                <h3>Wind Gust</h3>
                <canvas id="windGustChart" width="800" height="400"></canvas>
                <script>
                    generateGraph('windGustChart', snapshots, 'WindGust', {scaleLabel: "<%=value%>"});
                </script>

                <h3>Wind Speed</h3>
                <canvas id="windSpeedChart" width="800" height="400"></canvas>
                <script>
                    generateGraph('windSpeedChart', snapshots, 'WindSpeed', {scaleLabel: "<%=value%>"});
                </script>

                <h3>Wind Direction</h3>
                <canvas id="windDirectionChart" width="800" height="400"></canvas>
                <script>
                    options = {
                        // Boolean - If we want to override with a hard coded y scale
                        scaleOverride: true,

                        // ** Required if scaleOverride is true **
                        // Number - The number of steps in a hard coded y scale
                        scaleSteps: 8,

                        // Number - The value jump in the hard coded y scale
                        scaleStepWidth: 45,

                        // Number - The y scale starting value
                        scaleStartValue: 0,
                        scaleLabel: "<%=value%>"
                    };
                    generateGraph('windDirectionChart', snapshots, 'WindDirection', options);
                </script>
            </div>
        </div>
    </div>
</div>
