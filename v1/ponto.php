<?php

if (isset($_GET['CHAVE'])){
    if ($_GET['CHAVE'] == '12345'){
       if ($_GET['CHAMADA']=='CRIARPONTO'){
            include_once './class/Pontos.class.php';
                $ponto = new Pontos(); 
                $ponto->setDescricao($_GET['DESCRICAO']);              
                $ponto->setLatitude($_GET['LATITUDE']);
                $ponto->setLongitude($_GET['LONGETUDE']);
                $ponto->setIdUsuario($_GET['IDUSUARIODTO']);
                $ponto->setLstIDTipoMaterial($_GET['IDTIPOMATERIAL']);
                if ($ponto->salvar()){
                    echo '{"RETORNO":"SUCESSO", "CODIGO":"'.$ponto->getIDPonto().'"}';
                }else{
                    echo '{"RETORNO":"NÃO CADASTADO"}';
                }           
       }elseif ($_GET['CHAMADA']=='UPDATEPONTO') {
            include_once './class/Pontos.class.php';
            $ponto = new Pontos($_GET['IDPONTO']); 
            $ponto->setDescricao($_GET['DESCRICAO']);            
            $ponto->setLatitude($_GET['LATITUDE']);
            $ponto->setLongitude($_GET['LONGITUDE']);
            $ponto->setIdUsuario($_GET['IDUSUARIODTO']);
            if ($ponto->salvar())            
                echo '{"RETORNO":"ATUALIZADO COM SUCESSO"}';
            else
                echo '{"RETORNO":"NãO ATUALIZADO"}';
            
       }elseif ($_GET['CHAMADA']=='GETPONTOS') {             
            include_once './class/Pontos.class.php';
            $ponto = new Pontos();  
            if(isset($_GET['PARAM']))
                $ponto->setParam($_GET['PARAM']);   
            echo $ponto->getPontos();                   
       }elseif ($_GET['CHAMADA']=='DELETEPONTO') {             
            include_once './class/Pontos.class.php';
            $ponto = new Pontos();  
            if ($ponto->deletarPonto($_GET['IDPONTO']))
               echo '{"RETORNO":"PONTO DELETADO"}';
            else 
               echo '{"RETORNO":"PONTO NAO DELETADO"}';    
          
          }elseif ($_GET['CHAMADA']=='SETLIKE') {  
                include_once './class/Pontos.class.php';
                $ponto = new Pontos();
                $ponto->setId($_GET['IDPONTO']);
                if ($_GET['LIKE']=='SETLIKE'){
                    if ($ponto->Gostei()>0)
                       echo '{"RETORNO":"LIKE COM SUCESSO"}';  
                    else
                        echo '{"RETORNO":"LIKE NAO SUCESSO"}';
                }else{                 
                    if ($ponto->naoGostei()>0)
                       echo '{"RETORNO":"NAOLIKE COM SUCESSO"}';  
                    else
                        echo '{"RETORNO":"NAOLIKE NAO SUCESSO"}';
                }              
          }else
            echo '{"RETORNO":"CHAMADA NÃO ENCONTRADA"}';         
    }else 
       echo '{"RETORNO":"CHAVE DE ACESSO INVALIDO"}';
    
}

