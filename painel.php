<?php 

require("funcoes/conexao.php"); 

require("funcoes/funcoes.php");  



atualBandeira();

?>

<?php 

session_start();

if (!isset($_SESSION["userName"]) || !isset($_SESSION["password"])) {

	header("Location: index.html");

	exit;

}

?>

<!DOCTYPE html>

<html lang="pt-br">



<head>



  <meta http-equiv="Content-Type" content="type=text/html" charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">

  <meta name="author" content="">



  <title>SGE - Sistema de Gerenciamento de Energia</title>


  <!-- Bootstrap Core CSS -->

  <link href="layout/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">



  <!-- Custom Fonts -->

  <link href="layout/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>



    <!-- Plugin CSS 

    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  -->

  <!-- Theme CSS -->

  <link href="layout/css/creative.min.css" rel="stylesheet">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

        <![endif]-->


      </head>



      <body id="page-top">



        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

          <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>

              </button>

              <a class="navbar-brand page-scroll" href="#page-top">SGE</a>

            </div>



            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

              <ul class="nav navbar-nav navbar-right">

                <li>

                  <a class="page-scroll" href="#consumoR">Consumo</a>

                </li>

                <li>

                  <a class="page-scroll" href="#previsao">Previsão</a>

                </li>

                <li>

                  <a class="page-scroll" href="#configuracoes">Configurações</a>

                </li>

                <li>

                  <a class="page-scroll" href="#contact">Contato</a>

                </li>

                <li>

                  <a class="page-scroll" href="funcoes/logout.php">Sair</a>

                </li>

              </ul>

            </div>

            <!-- /.navbar-collapse -->

          </div>

          <!-- /.container-fluid -->

        </nav>



        <!--Tela inicial -->

        <header>

          <div class="header-content">

            <!-- titulo -->

            <div class="header-content-inner">

              <h1 id="homeHeading">Sistema de Gerenciamento de Energia</h1>

              <hr>

              <br>

              <h2><label id="lpag-top"></label></h2>

              <br>

              <a href="#consumoR" class="btn btn-primary btn-xl page-scroll">Ver Consumo</a>

            </div>

          </div>

        </header>

        <!--Tela 2 -->

        <section class="bg-white no-padding" id="consumoR">

         <!-- titulo -->

         <div class="container">

          <div class="row">

            <div class="col-lg-12 text-center">

              <br>

              <br>

              <h2 class="section-heading">Consumo</h2>

              <br>

              <br>

              <hr class="primary">

            </div>

          </div>

        </div>

        <div class="container-fluid">

          <div class="row">

            <!-- DIV paotencia -->

            <div class="col-lg-4 col-md-6 text-center">
            
            <h4>Potência</h4>
              <div class="service-box">

              <div id="gauge_div" style="width: 400px; height: 120px;"></div>
             
              </div>

           
            </div>

            <!-- DIV tempo -->

            <!--

            <div class="col-lg-3 col-md-6 text-center">

              <div class="service-box">

                <h1 style="color:#000000"><label id="tempo">0</label>s</h1>

                <h4>Tempo</h4>

              </div>

            </div>

            -->

            <!-- DIV Gasto Mes-->

            <div class="col-lg-4 col-md-6 text-center">
            <h4>Gasto Mensal</h4>

              <div class="service-box">

                <h1 style="color:#09A024">R$: <label id="gastoMes">0,00</label></h1>

                <p>Gasto do mês de <?php $mes = date('M'); echo $mes;?></p>

              </div>

            </div>

            <!-- DIV meta -->

            <div class="col-lg-4 col-md-6 text-center">
            
            <h4>Meta de Consumo Mensal</h4>
              <div class="service-box">
                <!-- <h1 style="color:#2B1BB4"><label id="meta">0</label>%</h1> -->
                <div id="donutchart" style="width: 400px; height: 300px;"></div>

               

              </div>

            </div>

          </div>

          <div class="row">

           <!-- DIV Kwh -->

           <div class="col-lg-12 text-center">

             <br>

             <br>

             <br>

             <hr class="primary">

             <h2 class="section-heading" style="color:#F30206"><label id="kwh">0,00000</label>Kwh</h2>
             <p>Total já Gasto em Kw</p>

             <br>        

           </div>

         </div>
         <!-- DIV Total -->

         <div class="col-lg-12 text-center">

             <br>

             <br>

             <hr class="primary">

             <h2 class="section-heading" style="color:#09A024">R$: <label id="reais">0,00</label></h2>
                <p>Total já Gasto em Reais</p>
             <br>        

           </div>

         </div>
        </div>
         <!-- DIV Grafigo de Consumo de Watts -->

         <div class="row">
           
           <div id="chart_div" style="width: 100%; height: 500px;"></div>

         </div>

         <!-- Grafico de KWD

         <div class="row">
         <div class="col-lg-12 col-md-06 text-center">

           <div id="div_desenhaGraficoBarras" style="width: 900px; height: 300px;"></div>
           
        
        <div class="col-lg-12 col-md-06 text-center">

        <div id="div_desenhaGraficoBarrasMes"></div>
           
        </div>
         </div>

       </div>
       -->
       <div class="container-fluid">
       
                 <div class="row">
       
                   <!-- DIV Grafico Barras Semana -->
       
                   <div class="col-lg-6 col-md-6 text-center">
                   
                   
                     <div class="service-box">
       
                     <div id="div_desenhaGraficoBarras"></div>
                    
                     </div>
       
                  
                   </div>

                   <!-- DIV Grafico Barras Mes -->
       
                   <div class="col-lg-6 col-md-6 text-center">
                   
                   
                     <div class="service-box">
                     <div id="div_desenhaGraficoBarrasMes"></div>  
              
                     </div>
       
                   </div>
       
                 </div>
       </div>
     </section>



     <!-- Pagina 3 - previsão -->

     <section id="previsao">

      <div class="container-fluid">

        <div class="row">

          <div class="col-lg-12 text-center">

            <br>

            <br>

            <h2 class="section-heading">Previsão</h2>

            <br>

            <hr class="primary">

          </div>

        </div>

        <div class="row text-center">

        <div class="col-lg-6">

          <h3>Semana:</h3>

          <h4>No ritmo de ontem você terá consumido: <label id="semana">0.0</label> Kw, em uma Semana.</h4>

          <p style="color:#09A024">R$: <label id="sR">0,00</label></p>

        </div>

        <div class="col-lg-6">

          <h3>Mês:</h3>

          <h4>Nesse ritmo será gasto: <label id="mes">0.0</label> Kw, em um Mes.</h4>

          <p style="color:#09A024">R$: <label id="mR">0,00</label></p>

        </div>

      </div>

    </div>

    

  </section>

  <!-- pagina do formulario 4 para definir as configurações do usuario -->  

  <section class="no-padding" id="configuracoes">

    <div class="container-fluid text-center">

     <div class="row">

      <div class="col-lg-12 text-center">

        <br>

        <br>

        <h2 class="section-heading">Configurações</h2>

        <br>

        <hr class="primary">

      </div>

      <form id="form" method="post" action="programacao/salvar_perfil.php">

       <div class="row">

        <!--

        <div class="col-lg-4 text-center">

         <h3>Bandeira em Uso:</h3>

         <?php $query = mysql_query("SELECT id, bandeira FROM bandeiras"); ?>

         <select name="id_bandeira" class="selectpicker">

          <option>Selecione uma Bandeira</option> 

          <?php while($row = mysql_fetch_array($query)) { ?>

          <option value="<?php echo $row['id'] ?>"><?php echo $row['bandeira'] ?></option>

          <?php } ?> 

        </select>

      </div>

      -->



      <div class="col-lg-6">

        <h3>Grupo de Energia:</h3>

        <?php $query = mysql_query("SELECT id, grupo FROM tarifa"); ?>

        <select name="id_tarifa" class="selectpicker">

          <option>Selecione seu grupo</option> 

          <?php while($row = mysql_fetch_array($query)) { ?>

          <option value="<?php echo $row['id'] ?>"><?php echo $row['grupo'] ?></option>

          <?php } ?> 

        </select>

      </div>



      <div class="col-lg-6">

       <h3>Meta Mensal:</h3>

       <input type="float" name="meta_mensal" placeholder="50.00"/>
       <p>Definir meta em Reais</p>

     </div>



   </div>

   

   <div class="row">

    <div class="col-lg-12 text-center">

      <br>

      <input class="btn btn-primary btn-xl page-scroll" type="submit" value="Salvar Configurações"/>

    </div>

  </div>  

</form> 

<br>

<br>

<!-- Campo de exibição das configurações salvas -->

<div class="row bg-dark">

  <div class="col-lg-12 text-center">



   <h4>Configurações Atuais:</h4>

   <p>Bandeira definida: <label id="bandeira_definida">Verde</label></p>

   <p>Tarifa definida: <label id="tarifa_definida">B1-RESIDENCIAL</label></p>

   <p>Meta definida: <label id="meta_definida">0,00</label></p>

 </div>

</div>

</div>

</section>



<section id="contact">

  <div class="container">

    <div class="row">

      <div class="col-lg-8 col-lg-offset-2 text-center">

        <h2 class="section-heading">Entre em Contato</h2>

        <hr class="primary">

        <p>Projeto TCC 1, sistema para gerenciamento de custo de energia eletrica residencial.</p>

      </div>

      <div class="col-lg-4 col-lg-offset-2 text-center">

        <i class="fa fa-phone fa-3x sr-contact"></i>

        <p>(11)97595-0277</p>

      </div>

      <div class="col-lg-4 text-center">

        <i class="fa fa-envelope-o fa-3x sr-contact"></i>

        <p><a href="mailto:your-email@your-domain.com">ihuri@outlook.com.br</a></p>

      </div>

    </div>

  </div>

</section>



<!-- jQuery -->

<script src="layout/vendor/jquery/jquery.min.js"></script>



<!-- Bootstrap Core JavaScript -->

<script src="layout/vendor/bootstrap/js/bootstrap.min.js"></script>



<!-- Plugin JavaScript -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script src="layout/vendor/scrollreveal/scrollreveal.min.js"></script>

<script src="layout/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Theme JavaScript -->

<script src="layout/js/creative.min.js"></script>



<!-- Graafico de Barras Consumo de KwD -->

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(desenhaGraficoBarras);
    function desenhaGraficoBarras() {
       var jsonData = $.ajax({
          url: "/dados_arduino/getConsumoKW.php",
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

<!-- Graafico de Barras Consumo de KwD Mes-->

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(desenhaGraficoBarrasMes);
    function desenhaGraficoBarrasMes() {
       var jsonData = $.ajax({
          url: "/dados_arduino/getConsumoMes.php",
          dataType: "json",
          async: false
          }).responseText;
          
      var dados = new google.visualization.DataTable(jsonData);

      var options = {
        title: "Gasto total de Kw por Mes",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("div_desenhaGraficoBarrasMes"));
      chart.draw(dados, options);
  }
  </script>

<!-- Grafico de Consumo em Watts -->



  <script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(desenhaGraficoDadosArduino);



    function desenhaGraficoDadosArduino() {
      var jsonData = $.ajax({
          url: "/dados_arduino/getAllDadosArduino.php",
          dataType: "json",
          async: false
          }).responseText;
          
      var dados = new google.visualization.DataTable(jsonData);

      var options = {
        title: 'Tempo Real -  dia <?php $data = date('d/m'); echo $data; ?>',

        hAxis: {title: 'Consumo em Watts',  titleTextStyle: {color: '#333'}},

        vAxis: {minValue: 0}
      }

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
      //var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(dados, options);
    }




  </script>

<!-- Grafico de Meta de Consumo -->
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

<!-- Grafico de Gauge Potencia -->

<script type="text/javascript">
  google.charts.load('current', {'packages':['gauge']});
  google.charts.setOnLoadCallback(desenhaGraficoGauge);

    function desenhaGraficoGauge() {
     var jsonData = $.ajax({
        url: "/dados_arduino/getPotencia.php",
         dataType: "json",
        async: false
        }).responseText;

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

<!-- JavaScript Para mudar valor de potencia -->
<!--
<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 2

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].potencia);

       $("#potencia").text(data[0].potencia);

     }

   }

 });

  });



 },60000);





</script>
-->


<!-- JavaScript Para mudar valor do tempo -->
<!--
<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 3

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].tempo_s);

       $("#tempo").text(data[0].tempo_s);

     }

   }

 });

  });



 },1300);

</script>
-->


<!-- JavaScript Para mudar valor de Kwh -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 4

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].kwh);

       $("#kwh").text(data[0].kwh);

     }

   }

 });

  });



 },60000);

</script>



<!-- JavaScript Para mudar valor de Reais -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 5

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].reais);

       $("#reais").text(data[0].reais);

     }

   }

 });

  });



 },60000);

</script>

<!-- JavaScript Para mudar valor de Gasto Mes -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 15

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].gastoMes);

       $("#gastoMes").text(data[0].gastoMes);

     }

   }

 });

  });



 },60000);

</script>


<!-- JavaScript Para mudar valor de meta

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 6

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].porcentagem);

       $("#meta").text(data[0].porcentagem);

     }

   }

 });

  });



 },1300);

</script>

 -->





<!-- JAVASCRIPTs para o campo de configurações -->

<!-- Envio de formulario de Configuração -->

<script type="text/javascript">

	$('#form').submit(function() {

    var form = $(this);

    $.post(form.attr('action'), form.serialize(), function(retorno) {

      alert(retorno);

    });

    return false;

  });

</script>



<!-- JavaScript Para mudar valor do campo bandeira definida -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 7

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].bandeira);

       $("#bandeira_definida").text(data[0].bandeira);

     }

   }

 });

  });



 },80000);

</script>



<!-- JavaScript Para mudar valor do campo tarifa definida -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 8

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].grupo);

       $("#tarifa_definida").text(data[0].grupo);

     }

   }

 });

  });



 },75000);

</script>



<!-- JavaScript Para mudar valor do campo meta definida -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 9

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].meta);

       $("#meta_definida").text(data[0].meta);

     }

   }

 });

  });



 },74000);

</script>

<!-- JAVASCRIPTs para o campo de previsões -->



<!-- JavaScript Para prever a semana -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 11

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].semana);

       $("#semana").text(data[0].semana);

     }

   }

 });

  });



 },1000);

</script>



<!-- JavaScript Para prever a semana Reais-->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 12

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].sR);

       $("#sR").text(data[0].sR);

     }

   }

 });

  });



 },1000);

</script>



<!-- JavaScript Para prever a Mes -->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 13

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].mes);

       $("#mes").text(data[0].mes);

     }

   }

 });

  });



 },1000);

</script>



<!-- JavaScript Para prever a Mes Reais-->

<script type="text/javascript">



  setInterval(function() {

   $(document).ready(function () {

    $.ajax({

     async: true,

     contentType: 'application/json, charset=utf-8',

     dataType: 'json',

     type: 'GET',

     url: '/programacao/json_dados.php',

     data: {

      q: 14

    },

    success: function (data) {

      if(data.length == 1){

       console.log(data[0].mR);

       $("#mR").text(data[0].mR);

     }

   }

 });

  });



 },1000);

</script>

</body>



</html>