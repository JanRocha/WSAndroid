<html lang="PT-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
    <div>
        <form method='POST' action='rankingUpdate.php'>
        <label>Chave de acesso</label>
        <input type="text" name='CHAVE' value='12345'>

        <input type='hidden' name='valor' value='{"LOGIN":"JAN","SENHA":1234}' >
        <input type='submit' name='rankingUpdate' value='Atualização de ranking'></>
    </form>
    </div>
    <div style="border: 1px solid black;min-height: 300px">
    <?php  
        include_once '../endPoint.php';
        if (isset($_POST['rankingUpdate'])){
            //Consumindo meu web service

            $arr='CHAVE='.$_POST['CHAVE'];                 
            $arr='CHAMADA='. 'UPDATERANKING'; 

            $path = new EndPoint();
            $url2= $path->getEndPoint()."/ws_app/v1/ranking.php?$url";
            echo "     EXEMPO DE LINK PARA REQUISIÇÃO ".$url2;
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