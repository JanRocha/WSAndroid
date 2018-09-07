<?php

if (isset($_GET['CHAVE'])){
    if ($_GET['CHAVE'] == '12345'){
       if ($_GET['CHAMADA']=='CRIARRANKING'){
            include_once './class/ranking.class.php';
            $ranking = new ranking();
            $ranking->setIdUsuario($_GET['IDUSUARIO']);
            $ranking->setPontuacao($_GET['PONTUACAO']);
            if ($ranking->salvar())
                echo '{"RETORNO":"SUCESSO"}';
            else
                echo '{"RETORNO":"NÃO CADASTADO"}';
           
       }elseif ($_GET['CHAMADA']=='UPDATERANKING') {
           include_once './class/ranking.class.php';
            $ranking = new ranking();
            if ($ranking->salvar()>0)
                echo '{"RETORNO":"ATUALIZADO COM SUCESSO"}';
            else
                echo '{"RETORNO":"NãO ATUALIZADO"}';
            
       }elseif ($_GET['CHAMADA']=='GETRANKING') {             
            include_once './class/ranking.class.php';
            $ranking = new ranking();
            $ranking->setParam($_GET['PARAM']);
            echo $ranking->getRanking();
       }elseif ($_GET['CHAMADA']=='DELETERANKING') {
           include_once './class/ranking.class.php';
            $ranking = new ranking();            
           if( $ranking->deletar($_GET['IDUSUARIO'],$_GET['PONTUACAO'])){
               echo '{"RETORNO":"DELETADO COM SUCESSO"}';
           } else
                echo '{"RETORNO":"NãO DELETADO"}';                   
       }else{
        echo '{"RETORNO":"CHAMADA NÃO ENCONTRADA"}';   
       }
    } else {
        echo '{"RETORNO":"CHAVE DE ACESSO INVALIDO"}';
    }
}

