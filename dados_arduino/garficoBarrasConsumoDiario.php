<html>
  <head>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  </head>

  <body>

    <div id="div_desenhaGraficoBarras"></div>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(desenhaGraficoBarras);
    function desenhaGraficoBarras() {
       var jsonData = $.ajax({
          url: "getConsumoKW.php",
          dataType: "json",
          async: false
          }).responseText;
          
      var dados = new google.visualization.DataTable(jsonData);

      var options = {
        title: "Gasto total de Kw por Dia",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("div_desenhaGraficoBarras"));
      chart.draw(dados, options);
  }
  </script>
  </body>
</html>