<?php

if (isset($_GET['CHAVE'])){
    if ($_GET['CHAVE'] == '12345'){
       if ($_GET['CHAMADA']=='CRIARFUNCIONARIO'){
            include_once './class/Funcionario.class.php'; 
                $funcionario = new Funcionario(); 
                $funcionario->setNome($GET['NOME']);
                $funcionario->setCPF($GET['CPF']);
                $funcionario->setData($GET['DATANASCIMENTO']);
                $funcionario->setNomeMae($GET['NOMEMAE']);
                $funcionario->setRg($GET['RG']);
                $funcionario->setNaturalidade($GET['NATURALIDADE']);
                $funcionario->setEmail($GET['EMAIL']);
                $funcionario->setFoto($GET['FOTO']);
                $funcionario->setSenha($GET['SENHA']);
                                
                if ($funcionario->salvar()){
                    echo '{"RETORNO":"SUCESSO", "CODIGO":"'.$funcionario->getIDFuncionarios().'"}';
                }else{
                    echo '{"RETORNO":"NÃO CADASTADO"}';
                }           
       }elseif ($_GET['CHAMADA']=='UPDATEFUNCIONARIO') {
        include_once './class/Funcionario.class.php'; 
        $funcionario = new Funcionario(); 
        $funcionario->setNome($GET['NOME']);
        $funcionario->setCPF($GET['CPF']);
        $funcionario->setData($GET['DATANASCIMENTO']);
        $funcionario->setNomeMae($GET['NOMEMAE']);
        $funcionario->setRg($GET['RG']);
        $funcionario->setNaturalidade($GET['NATURALIDADE']);
        $funcionario->setEmail($GET['EMAIL']);
        $funcionario->setFoto($GET['FOTO']);
        $funcionario->setSenha($GET['SENHA']);           
                  
            if ($funcionario->salvar())            
                echo '{"RETORNO":"ATUALIZADO COM SUCESSO"}';
            else
                echo '{"RETORNO":"NãO ATUALIZADO"}';
            
       }elseif ($_GET['CHAMADA']=='GETFUNCIONARIO') {             
            include_once './class/Funcionario.class.php';
            $funcionario = new Funcionario(); 
            if(isset($_GET['PARAM']))
                $funcionario->setParam($_GET['PARAM']);   
            echo $funcionario->getFuncionario();   
            
       }elseif ($_GET['CHAMADA']=='DELETEFUNCIONARIO') {             
            include_once './class/Funcionario.class.php';
            $funcionario = new Funcionario(); 
            if ($funcionario->deletarFuncionario($_GET['IDFUNCIONARIO']))
               echo '{"RETORNO":"FUNCIONARIO DELETADO"}';
            else 
               echo '{"RETORNO":"FUNCIONARIO NAO DELETADO"}';    
          
          }else
            echo '{"RETORNO":"CHAMADA NÃO ENCONTRADA"}';         
    }else 
       echo '{"RETORNO":"CHAVE DE ACESSO INVALIDO"}';
    
}

