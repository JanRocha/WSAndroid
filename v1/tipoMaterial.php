<?php
if (isset($_GET['CHAVE'])){
    if ($_GET['CHAVE'] == '12345'){
         if ($_GET['CHAMADA']=='GETTIPOMATERIAL'){         
            include_once './class/TipoMaterial.class.php';
            $material = new TipoMaterial();
            echo $material->getTipoMaterial();
         }else{       
            echo 'A chamada '.$_GET['CHAMADA'] .' não foi encontrada';
          
         }
    }
    
}

