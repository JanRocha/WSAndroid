<html lang="PT-BR">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
            <form method='POST' action='rankingRead.php'>
            <label>Chave de acesso</label>
            <input type="text" name='CHAVE' value='12345'>
            <label>id Usuario</label>
            <input type="text" name='IDUSUARIO'>    
            <input type='submit' name='getRanking' value='Lista de ranking'></>
        </form>
        </div>
        <div style="border: 1px solid black;min-height: 300px">
            <?php   
                include_once '../endPoint.php';
                if (isset($_POST['getRanking'])){

                    //Consumindo meu web service

                    $url='CHAVE='.$_POST['CHAVE'];                 
                    $url=$url.'&CHAMADA='.'GETRANKING';                   
                    $url=$url.'&PARAM='.$_POST['IDUSUARIO'];                  
                    $path = new EndPoint();
                    $url2= $path->getEndPoint()."ws_app/v1/ranking.php?$url";
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