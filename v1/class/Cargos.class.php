<?php
include_once 'conexao.class.php';
class Cargos {
    private $idcargo;
    private $descr_cargo;
    
    function getIdcargo() {
        return $this->idcargo;
    }

    function getDescr_cargo() {
        return $this->descr_cargo;
    }

    function setIdcargo($idcargo) {
        $this->idcargo = $idcargo;
    }

    function setDescr_cargo($descr_cargo) {
        $this->descr_cargo = $descr_cargo;
    }

    public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM cargos WHERE idcargo= ".$ID;
        //echo'ONSTRUCTOR: '. $this->SQL;
        $result = $this->cnn->Conexao()->prepare($this->SQL);
        $result->execute();
        if($result->rowCount()>=1){
            $this->id= $ID;          
        }else{
            $this->id= '-1';
        }
    }
    
    public function getCargo() {
        $in='';
        if($this->param <>''){          
            foreach ($this->param as $key => $value) {
            $in.= "'$value'," ; 
            }            
            $size = strlen($in);
            $in = substr($in, 0,-1);   
            $where = " WHERE id IN($in)";    
        }else
            $where='';        
         
        $cnn = new conexao();
        $result= $cnn->Conexao()->query("SELECT * FROM cargos ".$where);
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $tr[] = $row;
        }            
        return json_encode($tr,JSON_PRETTY_PRINT); 
    }
    
    public function setParam($param){
        if ($param<>'')
            $this->param = explode(',',$param);
        else
            $this->param = '';
    }
    
    public function salvar() {
        $id_res= 0;
        if ($this->id == '-1'){
              $this->SQL = "INSERT INTO cargos("                
                    . "descr_cargo) VALUES('"                                  
                    . "$this->descr_cargo')";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();                
            $id_res = $result->rowCount(); 
        }else{
            $this->SQL = "UPDATE  cargos SET "
                    . " descr_cargo = '$this->descr_cargo'"                
                    . " WHERE idcargo='.$this->idcargo'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();
            $id_res = $result->rowCount();            
        }        
            return $id_res;
    }
    
    public function getIDGargos(){
        $result = $this->cnn->Conexao()->prepare("SELECT idcargo FROM cargos  ORDER BY idcargo DESC LIMIT 1");
	$result->execute();		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
       return  $codigo->idcargo;    
    }

    public function deletarCargo($IDCargo) {        
        $result= $this->cnn->Conexao()->prepare("DELETE FROM cargos WHERE idcargo = ".$IDCargo);
        $result->execute();
        if ($result->rowCount()>0)
            return true;
        else        
             return false;        
    } 
}
