<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <div>
            <form method='POST' action='usuarioDTORead.php'>
                <label>Chave de acesso: </label>
                <input type="text" name='CHAVE' value='12345'>
                <label>informe um ID: </label>
                <input type="text" name='PARAM' value='' placeholder="1,2,3">
                <input type='submit' name='getUsuarios' value='Lista de Usuarios'></>
            </form>
        </div>
        <div style="border: 1px solid black;min-height: 300px">
            <?php
                include_once '../endPoint.php';
                if (isset($_POST['getUsuarios'])){
                    //Consumindo meu web service                    
                    $url = 'CHAVE='.$_POST['CHAVE'];                 
                    $url = $url.'&CHAMADA='.'GETUSUARIOSDTO'; 
                    $url = $url.'&PARAM=' . $_POST['PARAM'];                                 

                    $path = new EndPoint();
                    $url2= $path->getEndPoint()."ws_app/v1/usuarioDTO.php?".str_replace(' ','+',$url);
                    echo "     EXEMPO DE LINK PARA REQUISIÇÃO <br>".$url2;
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