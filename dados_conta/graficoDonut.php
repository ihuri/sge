<?php
	require("../funcoes/funcoes.php");
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Meta', 'Consumo'],
          ['Consumido',     <?php echo meta_p();?>],
          ['Livre',      <?php echo 100 - meta_p();?>]

        ]);

        var options = {
          //title: 'Meta de Consumo Mensal',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 400px; height: 300px;"></div>
  </body>
</html>