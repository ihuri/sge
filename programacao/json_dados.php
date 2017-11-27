        <?php
        require("../funcoes/conexao.php");
        require("../funcoes/funcoes.php");
        switch($_GET['q']){
        		// Buscar Último Dado de acordo com a escolha

                //JSON com a medida de AMPERAGEM
          case 1:
          $resultado = mysql_query("SELECT irms FROM `dados_arduino` ORDER BY id DESC LIMIT 0,1");
            		//passando os dados para um array
          $sensorarray = array();
          while($linha =mysql_fetch_array($resultado))
          {
              $sensorarray[] = $linha;
          }

          echo json_encode($sensorarray);
          break;

        		//JSON com a medida de Wats
          case 2:
          $resultado = mysql_query("SELECT potencia FROM `dados_arduino` ORDER BY id DESC LIMIT 0,1");
            		//passando os dados para um array
          $sensorarray = array();
          while($linha =mysql_fetch_array($resultado))
          {
              $sensorarray[] = $linha;
          }

          echo json_encode($sensorarray);
          break;

                //JSON com a medida de Segundos
          case 3:
          $resultado = mysql_query("SELECT tempo_s FROM `dados_arduino` ORDER BY id DESC LIMIT 0,1");
                    //passando os dados para um array
          $sensorarray = array();
          while($linha =mysql_fetch_array($resultado))
          {
            $sensorarray[] = $linha;
        }

        echo json_encode($sensorarray);
        break;

                //JSON com a medida de Kwh
        case 4:
        $resultado = mysql_query("SELECT kwh FROM `dados_arduino` ORDER BY id DESC LIMIT 0,1");
                    //passando os dados para um array
        $sensorarray = array();
        while($linha =mysql_fetch_array($resultado))
        {
            $sensorarray[] = $linha;
        }

        echo json_encode($sensorarray);
        break;

        		//JSON com VALOR JÁ GASTO
        case 5:
        $resultado = mysql_query("SELECT round(atual_vl,2) as reais FROM dados_conta ORDER BY id DESC LIMIT 0,1");
                    //passando os dados para um array
        $sensorarray = array();
        while($linha =mysql_fetch_array($resultado))
        {
            $sensorarray[] = $linha;
        }

        echo json_encode($sensorarray);
        break;

        		//JSON com VALOR Da meta
        case 6:
        $meta_array = array();
        $meta_array[] = array('0'=>strval(meta_p()),'porcentagem'=>strval(meta_p()));
        echo json_encode($meta_array);
        break;

        //-------------- JSON PARA AS CONFIGURAÇÕES -------------------------------------------//

        case 7:

        $sql = mysql_query("SELECT bandeira FROM bandeiras WHERE id = '$id_bandeira'");
        $res = array();
        while($linha =mysql_fetch_array($sql))
        {
            $res[] = $linha;
        }

        $id_bandeira = perfil("id_bandeira");
        $resultado = mysql_query("SELECT bandeira FROM bandeiras WHERE id = '$id_bandeira'");
                    //passando os dados para um array
        $sensorarray = array();
        while($linha =mysql_fetch_array($resultado))
        {
            $sensorarray[] = $linha;
        }

        echo json_encode($sensorarray);
        break;

        case 8:

        $id_tarifa = perfil("id_tarifa");
        $resultado = mysql_query("SELECT grupo FROM tarifa WHERE id = '$id_tarifa'");
                    //passando os dados para um array
        $sensorarray = array();
        while($linha =mysql_fetch_array($resultado))
        {
            $sensorarray[] = $linha;
        }

        echo json_encode($sensorarray);
        break;

        case 9:

        $resultado = mysql_query("SELECT meta_mensal as meta FROM perfil WHERE id = 1");
                    //passando os dados para um array
        $sensorarray = array();
        while($linha =mysql_fetch_array($resultado))
        {
            $sensorarray[] = $linha;
        }
        echo json_encode($sensorarray);
        break;
        //-------------- JSON PARA AS PREVISÕES -------------------------------------------//
                //valor reais
        case 10:

        $resultado = mysql_query("SELECT round(atual_vl,2) as reais FROM dados_conta ORDER BY id DESC LIMIT 0,1");
                    //passando os dados para um array
        $sensorarray = array();
        while($linha =mysql_fetch_array($resultado))
        {
            $sensorarray[] = $linha;
        }

        echo json_encode($sensorarray);
        break;

                //previsão para o SEMANA
        case 11:
        $dia = date('d');
        if($dia > 3){
	        $kwh = array();
	
            $resultado = mysql_query("SELECT kwh, max(evento) as data from dados_arduino group by date(evento) DESC limit 3");
    
	        while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
		        $kwh[] = $linha['kwh'];
    	    }
	
	        $kwh_gasto = $kwh[1] - $kwh[2];
	        $kwh_previsão = round(($kwh_gasto * 6 ) + $kwh_gasto, 0);
	
            $previsaoS[0]["semana"] = $kwh_previsão;
            echo json_encode($previsaoS);
        }
        else{
            $previsaoS[0]["semana"] = 0;
            echo json_encode($previsaoS);  
        }
        
        break;

                //previsão para o SEMANA Reais
        case 12:

        $dia = date('d');
        if($dia > 3){
	        $valor = array();
	
            $resultado = mysql_query("SELECT atual_vl as valor, max(evento) from dados_conta group by date(evento) DESC limit 3");
    
	        while($linha =mysql_fetch_array($resultado, MYSQL_ASSOC)){
		        $valor[] = $linha['valor'];
    	    }
	
	        $valor_gasto = $valor[1] - $valor[2];
	        $valor_previsão = round(($valor_gasto * 6 ) + $valor_gasto, 2);
	
            $previsaoSR[0]["sR"] = $valor_previsão;
            echo json_encode($previsaoSR);
        }
        else{
            $previsaoSR[0]["sR"] = 0;
            echo json_encode($previsaoSR);  
        }
        
        //$semanaReais[0]["sR"] = round(vlKw($previsaoSe), 2);
        //echo json_encode($semanaReais);

        break;
        //previsão para o Mes
        case 13:
        $dia = date('d');
        if($dia > 3){
            $diaRestante = ultimoDiaMes() - $dia;

            $valorGasto = diaAnterior_kwh() - d01_kwh();

            $previsao = (gastoDiaAnterior_kwh() * $diaRestante) + $valorGasto;
            $previsaoM[0]["mes"] = round($previsao);
            echo json_encode($previsaoM);
        }
        else{
            $previsaoM[0]["mes"] = 0;
            echo json_encode($previsaoM);
        }
        break;

        //previsão para o Mes Reais
        case 14:
        $dia = date('d');
        if($dia > 3){
            $diaRestante = ultimoDiaMes() - $dia;

            $valorGasto = diaAnterior_kwh() - d01_kwh();

            $previsao = (gastoDiaAnterior_kwh() * $diaRestante) + $valorGasto;
            $mesReais[0]["mR"] = round(vlKw($previsao), 2);
            echo json_encode($mesReais);
        }
        else{
        $mesReais[0]["mR"] = 0;
        echo json_encode($mesReais);
        }
        
        break;
        //JSON com VALOR JÁ GASTO
        
        case 15:
        $gasto = round(valor_h() - valor_m(), 2);
        $gastoMes = array();
        $gastoMes[] = array('0'=>strval($gasto),'gastoMes'=>strval($gasto));
        echo json_encode($gastoMes);
        break;


    }    
?>