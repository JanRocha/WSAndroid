<html lang="PT-BR">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
	<body>
            <div>
                <form method='POST' action='rankingDelete.php'>
                <label>Chave de acesso</label>
                <input type="text" name='CHAVE' value='12345'>
                <label>Id Usuario</label>
                <input type="text" name='IDUSUARIO'>
                <label>Pontuacao</label>
                <input type="text" name='PONTUACAO'>  
                <input type='submit' name='deleteRanking' value='deletarRanking'></>
            </form>
            </div>
            <div style="border: 1px solid black;min-height: 300px">
                <?php  
                    include_once '../endPoint.php';
                    if (isset($_POST['deleteRanking'])){

                        //Consumindo meu web service
                        $url='CHAVE='.$_POST['CHAVE'];                 
                        $url=$url.'&CHAMADA='. 'DELETERANKING';   
                        $url=$url.'&IDUSUARIO='.$_POST['IDUSUARIO'];   
                        $url=$url.'&PONTUACAO='.$_POST['PONTUACAO'];   
                       
                        $path = new EndPoint();
                        $url2= $path->getEndPoint()."ws_app/v1/ranking.php?$url";
                        echo "     EXEMPO DE LINK PARA REQUISIÇÃO ".$url;
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