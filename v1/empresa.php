<?php

if (isset($_GET['CHAVE'])){
    if ($_GET['CHAVE'] == '12345'){
       if ($_GET['CHAMADA']=='CRIAREMPRESA'){
            include_once './class/Empresa.class.php';
                $empresa = new Empresa();   
                $empresa->setCNPJ($_GET['CNPJ']);              
                $empresa->setNomeFantasia($_GET['NOMEFANTASIA']);
                $empresa->setRazaoSocial($_GET['RAZAOSOCIAL']);
                $empresa->setEmail($_GET['EMAIL']);
                $empresa->setTelefone($_GET['TELEFONE']);
                $empresa->setSenha($_GET['SENHA']);                
                if ($empresa->salvar()){
                    echo '{"RETORNO":"SUCESSO", "CODIGO":"'.$empresa->getIDEmpresa().'"}';
                }else{
                    echo '{"RETORNO":"NÃO CADASTADO"}';
                }           
       }elseif ($_GET['CHAMADA']=='UPDATEEMPRESA') {
            include_once './class/Empresa.class.php';
            $empresa = new Empresa($_GET['IDEMPRESA']); 
            $empresa->setCNPJ($_GET['CNPJ']);              
            $empresa->setNomeFantasia($_GET['NOMEFANTASIA']);
            $empresa->setRazaoSocial($_GET['RAZAOSOCIAL']);
            $empresa->setEmail($_GET['EMAIL']);
            $empresa->setTelefone($_GET['TELEFONE']);
            $empresa->setSenha($_GET['SENHA']);
            if ($empresa->salvar())            
                echo '{"RETORNO":"ATUALIZADO COM SUCESSO"}';
            else
                echo '{"RETORNO":"NãO ATUALIZADO"}';
            
       }elseif ($_GET['CHAMADA']=='GETEMPRESA') {             
            include_once './class/Empresa.class.php';
            $empresa = new Empresa(); 
            if(isset($_GET['PARAM']))
                $empresa->setParam($_GET['PARAM']);   
            echo $empresa->getEmpresa();   
            
       }elseif ($_GET['CHAMADA']=='DELETEEMPRESA') {             
            include_once './class/Empresa.class.php';
            $empresa = new Empresa(); 
            if ($empresa->deletarEmpresa($_GET['IDEMPRESA']))
               echo '{"RETORNO":"EMPRESA DELETADO"}';
            else 
               echo '{"RETORNO":"EMPRESA NAO DELETADO"}';    
          
          }else
            echo '{"RETORNO":"CHAMADA NÃO ENCONTRADA"}';         
    }else 
       echo '{"RETORNO":"CHAVE DE ACESSO INVALIDO"}';
    
}

