<?php

include_once 'conexao.class.php';
class TipoMaterial {
    private $id;
    private $descricao;
    private $param;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM tipoMaterial WHERE id = ".$ID;
        //echo $this->SQL;
        $result = $this->cnn->Conexao()->prepare($this->SQL);
        $result->execute();
        if($result->rowCount()>=1){
            $this->id= $ID;          
        }else{
            $this->id= '-1';
        }
    }
    
     public function getTipoMaterial() {
         $in='';
        if($this->param <>''){          
            foreach ($this->param as $key => $value) {
            $in.= "'$value'," ; 
            }            
            $size = strlen($in);
            $in = substr($in, 0,-1);   
           // $where = " WHERE id IN($in)";    
        }else
            $where='';        
         
        $cnn = new conexao();
        $result= $cnn->Conexao()->query("SELECT * FROM TipoMaterial");
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $tr[] = $row;
        }            
        return json_encode($tr,JSON_PRETTY_PRINT);    
    }

}
