<html>
<head>
    <link rel="stylesheet" type="text/css" href="/web/css/style.css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="page">
<a class="btn btn-default" href="/" role="button">Main</a>
<a class="btn btn-default" href="/statistics" role="button">Statistics</a>
<div id="chart" style="height: 400px;"></div>

<script type="text/javascript">
            var info = JSON.parse(<?php var_export(json_encode($data['info'])); ?>);
            var columns = JSON.parse(<?php var_export(json_encode($data['columns'])); ?>);
            var title = JSON.parse(<?php var_export(json_encode($data['title'])); ?>);

            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Day');
				for (var column in columns) {
					data.addColumn('number', columns[column]);
				}

                for (var day in info){
                    var row = [day];
					for (var column in columns) {
						if (!info[day][columns[column]]) {
							row.push(0);
						} else {
							row.push(parseInt(info[day][columns[column]]));
						}
					}
					console.log(row);
                    data.addRow(row);
                }
                var options = {
                    'title': title,
                    height: '400',
                    pieSliceText: 'label',
                    legend: { position: 'bottom' },
                    width: '100%',
                    chartArea: {left:0,top:50,width:'100%',},
                };  
                var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
                chart.draw(data, options); 
            } 
        </script>
</div>
</body>
</html>
