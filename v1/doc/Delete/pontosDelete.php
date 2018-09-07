<html lang="PT-BR">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
            <form method='POST' action='pontosDelete.php'>
            <label>Chave de acesso</label>
            <input type="text" name='CHAVE' value='12345'>
            <label>ID</label>
            <input type="text" name='IDPONTO'>
            <input type='submit' name='deletePontos' value='deletar pontos'></>
        </form>
        </div>
        <div style="border: 1px solid black;height: 300px">
            <?php
                include_once '../endPoint.php';
                if (isset($_POST['deletePontos'])){

                //Consumindo meu web service

                $url = 'CHAVE='.$_POST['CHAVE'];                 
                $url=$url.'&CHAMADA='.'DELETEPONTO';                   
                $url=$url.'&IDPONTO='.$_POST['IDPONTO'];                   
            

                $path = new EndPoint();
                $url2= $path->getEndPoint()."ws_app/v1/ponto.php?$url";
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