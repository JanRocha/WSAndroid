<html lang="PT-BR">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>	
    <body>    
        <div
            <p>Este exemplo é para deletar um cadastro por vez, 
                    este serviço apagará apenas um por vez,
                    caso não passe o último paramentro não apagará.
            </p>
            <form method='POST' action='usuarioDTODelete.php'>
                <label>Chave de acesso: </label>
                <input type="text" name='CHAVE' value='12345'>
                <input type="text" name='CODALUNO' value='' placeholder="">
                <input type='submit' name='deletaAlunos' value='Apagar aluno'></>
            </form>
        </div>
        <div style="border: 1px solid black;height: 300px">
            <?php
                include_once '../endPoint.php';
                if (isset($_POST['deletaAlunos'])){
                    //Consumindo meu web service      
                    $url = "CHAVE=" . $_POST['CHAVE'];                 
                    $url = $url . "&CHAMADA=". "DELETAALUNO"; 
                    $url = $url . "&CODALUNO=" . $_POST["CODALUNO"]; 
                  
                    $path = new EndPoint();
                    $url2= $path->getEndPoint()."ws_app/v1/usuarioDTO.php?".$url;
                    echo "     EXEMPO DE LINK PARA REQUISIÇÃO ".$url2;
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