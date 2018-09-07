<?php
    $url2="http://janjrs.000webhostapp.com/ws_app/v1/ponto.php?CHAVE=12345&CHAMADA=GETPONTOS&PARAM=";
    try {
        $jsonData = file_get_contents($url2);
        $f = json_decode($jsonData);
        echo '<pre>';
       // echo var_dump($f) ;                       
        echo '</pre>';
    } catch (Exception $e) {
        // Deal with it.
        echo "Error: " , $e->getMessage();
    }   
?>
<html lang="PT-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        
        <div>
            <form method='POST' action='pontoLike.php'>
                <label>Chave de acesso</label>
                <input type="text" name='CHAVE' value='12345'>	
                <label>Pontos cadastrados</label>
                <select name="PONTOS">
                    <?php 
                    foreach ( $f as $e ){
                    ?>
                    <option value="<?php echo $e->id?>"><?php echo $e->descricao?></option>
                    <?php 
                    }
                    ?>
                </select>
                <input type="radio" name="LIKE" value="SETLIKE"> LIKE
                <input type="radio" name="LIKE" value="SETDISLIKE"> DISLAKE
                <input type='submit' name='LIKEPONTO' value='Listar pontos'></>
            </form>
        </div>
        
        <div style="border: 1px solid black;min-height:  300px;">
            <?php
                include_once '../endPoint.php';
                if (isset($_POST['LIKEPONTO'])){
                    
                    $idPonto = $_POST["PONTOS"];
                    $like = $_POST["LIKE"];
                    
                    

                    //Consumindo meu web service

                
                    $url = 'CHAVE='.$_POST['CHAVE'];                 
                    $url = $url.'&CHAMADA='.'SETLIKE'; 
                    $url = $url.'&LIKE=' . $like; 
                    $url = $url.'&IDPONTO=' . $idPonto; 

                    $path = new EndPoint();
                    $url2= $path->getEndPoint()."ws_app/v1/ponto.php?$url";
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
         <a href='../index.php'>Principal</a> 
	</body>		
</html>