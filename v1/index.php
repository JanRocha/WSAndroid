<?php		 
if (isset($_GET['action'])){
    $CALL = urldecode($_GET['action']);
    $CALLDecode = json_decode($CALL);  

    
    if ($CALLDecode->CHAVE =='12345'){
        switch ($CALLDecode->CHAMADA) {
            //CRUD DO PONTO
            case "GETUSUARIOSDTO":    
                include_once './class/usuariosDTO.class.php';
                $usuarioDTO = new usuariosDTO();
                if(isset($CALLDecode->PARAM))
                $usuarioDTO->setParam($CALLDecode->PARAM);    
                 echo $usuarioDTO->getusuariosDTO();
                break;                
            case "CRIARUSUARIODTO":
                include_once './class/usuariosDTO.class.php';                
                $usuarioDTO = new usuariosDTO('0');                
                if(isset($CALLDecode->NOME))
                   $usuarioDTO->setNome($CALLDecode->NOME); 
                 if(isset($CALLDecode->LOGIN))
                   $usuarioDTO->setLogin($CALLDecode->LOGIN);
                 
                if(isset($CALLDecode->SENHA))
                   $usuarioDTO->setSenha($CALLDecode->SENHA);
               
                if ($usuarioDTO->salvar()>0)
                    echo '{"RETORNO":"SUCESSO", "ID":"'.$usuarioDTO->getIDUsuario().'"}';
                else
                    echo '{"RETORNO":"NÃO CADASTADO"}';
                break;
            case "UPDATEUSUARIODTO":
                include_once './class/usuariosDTO.class.php'; 
                $usuarioDTO = new usuariosDTO($CALLDecode->IDUSUARIO);
                if(isset($CALLDecode->NOMEUSUARIO))
                   $usuarioDTO->setNome($CALLDecode->NOMEUSUARIO); 
                if(isset($CALLDecode->LOGINUSUARIO))
                   $usuarioDTO->setLogin($CALLDecode->LOGINUSUARIO);
                if(isset($CALLDecode->SENHAUSUARIO))
                   $usuarioDTO->setSenha($CALLDecode->SENHAUSUARIO);
                if ($usuarioDTO->salvar()>0)
                    echo '{"RETORNO":"ATUALIZADO COM SUCESSO"}';
                else
                    echo '{"RETORNO":"NãO ATUALIZADO"}';
                break;
            case "":
                include_once './class/usuariosDTO.class.php';
                $usuarioDTO = new usuariosDTO();
                if ($usuarioDTO->deletarAluno($CALLDecode->ID))
                    echo '{"RETORNO":"SUCESSO","CODIGO":"'.$CALLDecode->ID.'"}';
                else
                    echo'{"RETORNO":"N�O DELETADO","CODIGO":"'.$CALLDecode->ID.'"}';               
                break;
                                
            //CRUD USUARIODTO    
            case "GETPONTOS":
                include_once './class/Pontos.class.php';
                $ponto = new $pontos();            
                echo $ponto->getPontos();
                break;
            case "CRIARPONTO":
                include_once './class/Pontos.class.php';
                $ponto = new pontos(); 
                $ponto->setDescricao($_POST[$CALLDecode->DESCICAO]);
                $ponto->setLatitude($_POST[$CALLDecode->LATITUDE]);
                $ponto->setLongitude($_POST[$CALLDecode->LONGITUDE]);
                if ($ponto->salvar()){
                    echo '{"RETORNO":"SUCESSO", "CODIGO":"'.$ponto->getNovoCodigo().'"}';
                }else{
                    echo '{"RETORNO":"N�O CADASTADO"}';
                }
                break;
            case "UPDATEPONTO":
              include_once './class/Pontos.class.php';
                break;
            case "DELETAPONTO":
                include_once './class/Pontos.class.php';
                break;
            
            //CRUD  RANKING 
            case "GETRANKING":
                include_once './class/ranking.class.php';
                $ranking = new ranking();
                echo $ranking->getRanking();
                break;
            case "UPDATERANKING":
                include_once './class/ranking.class.php';
                break;
            case "CRIARRANKING":
                include_once './class/ranking.class.php';
                break;
            case "DELETERANKING":
                include_once './class/ranking.class.php';
                break;
            
            case "GETTIPOMATERIAL":
                include_once './class/TipoMaterial.php';
                $material = new TipoMaterial();
                echo $material->getTipoMaterial();
                break;
            default:
                echo 'A chamada '. $CALLDecode->CHAMADA .' não foi encontrada';
                break;
        }
        
        
    }
    
}