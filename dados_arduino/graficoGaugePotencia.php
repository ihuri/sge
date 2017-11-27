<html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    	$(function(){
    		var refreshAutomatico = setInterval(function(){
    			$('gauge_div').load(desenhaGraficoGauge());
    		},60000);
    	});
    </script>
  </head>
  <body>
    <div id="gauge_div" style="width: 400px; height: 120px;"></div>
    
       <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(desenhaGraficoGauge);

      function desenhaGraficoGauge() {
       var jsonData = $.ajax({
          url: "getPotencia.php",
          dataType: "json",
          async: false
          }).responseText;

  // be sure to use the 'new' keyword here...
  var data = new google.visualization.DataTable(jsonData);

  var chart = new google.visualization.Gauge(document.getElementById('gauge_div'));
  var options = {
    width: 600,
    height: 190,
    redFrom: 5000,
    redTo: 10000,
    greenFrom: 0,
    greenTo: 1000,
    yellowFrom: 1000,
    yellowTo: 5000,
    minorTicks: 0,
    min: 0,
    max: 10000,
    majorTicks: ["",""],
    animation: {
      duration: 100
    }
  };
  chart.draw(data, options);
}

    </script>
  </body>
</html>