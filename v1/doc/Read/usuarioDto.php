<html lang="PT-BR">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
    
    <div
        <p>Este exemplo é para criar  um cadastro</p>
         
        <form method='post' action='usuarioDto.php'>
            <label>Chave de acesso: </label>
            <input type="text" name='CHAVE' value='12345'>          
            <label> ID: </label>
            <input type="text" name='ID' value='' placeholder="">         
            <input type='submit' name='btnLogar' value='Logar'></>
        </form>
    </div>
    <div style="border: 1px solid black;height: 300px">
        <?php
         include_once '../endPoint.php';
         if (isset($_POST['btnLogar'])){
                //Consumindo meu web service                    
                $url = "CHAVE=" . $_POST['CHAVE'];                 
                $url = $url . "&CHAMADA=". "GETUSUARIO";         
                $url = $url . "&ID=". $_POST["ID"];                
                        
               
                $path = new EndPoint();
                $url2= $path->getEndPoint()."ws_app/v1/usuarioDTO.php?".str_replace(' ','+',$url);
                echo "     EXEMPO DE LINK PARA REQUISIÇÃO <br>";
                echo $url2;
                echo '<br><br>';                 
                
                try {
                   $jsonData = file_get_contents($url2);
                     echo $jsonData;
                } catch (Exception $e) {
                    // Deal with it.
                    echo "Error: " . $e->getMessage();
                }                
            }
        ?>
    </div>
    
    
    <a href='../index.php'>Principal</a>   
    </body>
</html>