<html lang="PT-BR">
	 <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
	<body>
    <div>
        <form method='POST' action='rankingCreate.php'>
        <label>Chave de acesso</label>
        <input type="text" name='CHAVE' value='12345'>
            
        <label>idUsuario</label>
	<input type='text' name='IDUSUARIO' value='' placeholder="">
	<label> Pontuacao: </label>
        <input type="text" name='PONTUACAO' value='' placeholder="">
        <input type='submit' name='createPontuacao' value='Criar pontuação'></>
    </form>
    </div>
    <div style="border: 1px solid black;min-height: 300px">
        <?php          
            include_once '../endPoint.php';
            if (isset($_POST['createPontuacao'])){
               
                //Consumindo meu web service    
		$url = "CHAVE=" . $_POST['CHAVE'];                 
                $url = $url . "&CHAMADA=". "CRIARRANKING"; 
                $url = $url . "&IDUSUARIO=" . $_POST["IDUSUARIO"]; 
                $url = $url . "&PONTUACAO=". $_POST["PONTUACAO"];            
           
                    
                $path = new EndPoint();
                $url2= $path->getEndPoint()."ws_app/v1/ranking.php?$url";
                echo "     EXEMPO DE LINK PARA REQUISIÇÃO <br>";
                echo $url2;
                echo '<br><br>';                 

                try {
                   $jsonData = file_get_contents($url2);
                   echo $jsonData;
                } catch (Exception $e) {
                    // Deal with it.
                    echo "Error: " , $e->getMessage();
                }                
            }
            ?>
    </div>
    <a href='../index.php'>Principal</a>
	</body>		
</html>