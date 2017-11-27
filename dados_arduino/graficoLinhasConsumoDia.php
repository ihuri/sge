<html>
  <head>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript">
    	$(function(){
    		var refreshAutomatico = setInterval(function(){
    			$('div_chart').load(desenhaGraficoDadosArduino());
    		},10000);
    	});
    </script>
  </head>

  <body>

    <div id="chart_div"></div>
    
    <script type="text/javascript">
    google.charts.load('visualization','1', {'packages':['corechart'], 'language': 'pt-BR'});
   
    google.charts.setOnLoadCallback(desenhaGraficoDadosArduino);
      
    function desenhaGraficoDadosArduino() {
      var jsonData = $.ajax({
          url: "getAllDadosArduino.php",
          dataType: "json",
          async: false
          }).responseText;
          
      var dados = new google.visualization.DataTable(jsonData);

      var options = {
      	title: 'Consumo de Dados em Tempo Real'
      }

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(dados, options);
    }

    </script>
  </body>
</html>