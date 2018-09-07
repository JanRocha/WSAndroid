<html lang="PT-BR">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
            <form method='POST' action='pontosUpdate.php'>
            <label>Chave de acesso</label>
            <input type="text" name='CHAVE' value='12345'>
            <label>Descricao</label>
            <input type="text" name='DESCRICAO'>
            <label>Latitude</label>
            <input type="text" name='LATITUDE'>
            <label>Longitude</label>
            <input type="text" name='LONGITUDE'>
            <label>idUsuarioDTO:</label>
            <input type="text" name="IDUSUARIODTO" value="" placeholder="">
            <label>ID</label>
            <input type="text" name='IDPONTO'>
            <input type='submit' name='updatePontos' value='Atualizar'></>
        </form>
    </div>
    <div style="border: 1px solid black;height: 300px">
    <?php
        include_once '../endPoint.php';
    if (isset($_POST['updatePontos'])){

        //Consumindo meu web service

        $url='CHAVE='.$_POST['CHAVE'];                 
        $url = $url.'&CHAMADA='.'UPDATEPONTO';                   
        $url = $url.'&DESCRICAO='.$_POST['DESCRICAO'];                   
        $url = $url.'&LATITUDE='.$_POST['LATITUDE'];                   
        $url = $url.'&LONGITUDE='.$_POST['LONGITUDE'];                   
        $url = $url.'&IDUSUARIODTO='.$_POST['IDUSUARIODTO'];                   
        $url = $url.'&IDPONTO='.$_POST['IDPONTO'];                   
       
        $path = new EndPoint();
        $url2= $path->getEndPoint()."ws_app/v1/ponto.php?".str_replace(' ','+',$url);
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