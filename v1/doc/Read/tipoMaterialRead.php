<html lang="PT-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
            <form method='POST' action='tipoMaterialRead.php'>
                <label>Chave de acesso</label>
                <input type="text" name='CHAVE' value='12345'>	
                <input type='submit' name='getTipoMaterial' value='Listar tipos de Material'></>
            </form>
        </div>
         <a href='../index.php'>Principal</a> 
        <div style="border: 1px solid black;min-height:  300px">
            <?php
                include_once '../endPoint.php';
                if (isset($_POST['getTipoMaterial'])){

                    //Consumindo meu web service
                
                    $url = 'CHAVE='.$_POST['CHAVE'];                 
                    $url = $url.'&CHAMADA='.'GETTIPOMATERIAL';                     

                    $path = new EndPoint();
                    $url2= $path->getEndPoint()."ws_app/v1/tipoMaterial.php?$url";
                    echo "     EXEMPO DE LINK PARA REQUISIÇÃO ".$url2;
                    echo '<br><br>';                 

                    try {
                       $jsonData = file_get_contents($url2);
                       echo '<pre>';
                       echo $jsonData;                       
                       echo '</pre>';  
                    } catch (Exception $e) {
                            // Deal with it.
                            echo "Error: " , $e->getMessage();
                    }               
                }
                ?>
        </div>
        
	</body>		
</html>