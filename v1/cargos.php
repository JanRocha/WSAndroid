<?php

if (isset($_GET['CHAVE'])){
    if ($_GET['CHAVE'] == '12345'){
       if ($_GET['CHAMADA']=='CRIARCARGO'){
            include_once './class/Cargos.class.php'; 
                $cargo = new Cargos();   
                $cargo->setDescr_cargo($_GET['DESCR_CARGO']);   
                                
                if ($cargo->salvar()){
                    echo '{"RETORNO":"SUCESSO", "CODIGO":"'.$cargo->getIDGargos().'"}';
                }else{
                    echo '{"RETORNO":"NÃO CADASTADO"}';
                }           
       }elseif ($_GET['CHAMADA']=='UPDATECARGO') {
            include_once './class/Cargos.class.php';
            $cargo = new Cargos($_GET['IDCARGO']); 
            $cargo->setDescr_cargo($_GET['DESCR_CARGO']);             
                  
            if ($cargo->salvar())            
                echo '{"RETORNO":"ATUALIZADO COM SUCESSO"}';
            else
                echo '{"RETORNO":"NãO ATUALIZADO"}';
            
       }elseif ($_GET['CHAMADA']=='GETCARGO') {             
            include_once './class/Cargos.class.php';
            $empresa = new Cargos(); 
            if(isset($_GET['PARAM']))
                $cargo->setParam($_GET['PARAM']);   
            echo $cargo->getCargo();   
            
       }elseif ($_GET['CHAMADA']=='DELETECARGO') {             
            include_once './class/Cargos.class.php';
            $cargo = new Cargos(); 
            if ($cargo->deletarCargo($_GET['IDCARGO']))
               echo '{"RETORNO":"CARGO DELETADO"}';
            else 
               echo '{"RETORNO":"CARGO NAO DELETADO"}';    
          
          }else
            echo '{"RETORNO":"CHAMADA NÃO ENCONTRADA"}';         
    }else 
       echo '{"RETORNO":"CHAVE DE ACESSO INVALIDO"}';
    
}

