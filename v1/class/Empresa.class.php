<?php
include_once 'conexao.class.php';

class Empresa {
    private $idempresa;
    private $CNPJ;
    private $NomeFantasia;
    private $RazaoSocial;
    private $Email;
    private $Telefone;
    private $Senha;
    private $param;
    private $SQL; 
    
    function getId() {
        return $this->id;
    }

    function getCNPJ() {
        return $this->CNPJ;
    }

    function getNomeFantasia() {
        return $this->NomeFantasia;
    }

    function getRazaoSocial() {
        return $this->RazaoSocial;
    }

    function getEmail() {
        return $this->Email;
    }

    function getTelefone() {
        return $this->Telefone;
    }

    function getSenha() {
        return $this->Senha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCNPJ($CNPJ) {
        $this->CNPJ = $CNPJ;
    }

    function setNomeFantasia($NomeFantasia) {
        $this->NomeFantasia = $NomeFantasia;
    }

    function setRazaoSocial($RazaoSocial) {
        $this->RazaoSocial = $RazaoSocial;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setTelefone($Telefone) {
        $this->Telefone = $Telefone;
    }

    function setSenha($Senha) {
        $this->Senha = $Senha;
    }

        public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM empresa WHERE id = ".$ID;
        //echo $this->SQL;
        $result = $this->cnn->Conexao()->prepare($this->SQL);
        $result->execute();
        if($result->rowCount()>=1){
            $this->id= $ID;          
        }else{
            $this->id= '-1';
        }
    }
    
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
    public function getEmpresa() {
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
        $result= $cnn->Conexao()->query("SELECT * FROM empresa ".$where);
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
              $this->SQL = "INSERT INTO empresa("
                    . "idempresa,"
                    . "cnpj,"
                    . "nome_fantasia,"
                    . "razao_social,"
                    . "email,"
                    . "telefone,"
                    . "senha) VALUES('-1','"
                    . "$this->CNPJ','"
                    . "$this->NomeFantasia','"
                    . "$this->RazaoSocial',"
                    . "$this->Email, "
                    . "$this->Telefone,"
                    . "$this->Senha)";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();                
            $id_res = $result->rowCount(); 
        }else{
            $this->SQL = "UPDATE  empresa SET "
                    . " cnpj = '$this->CNPJ',"
                    . " nome_fantasia='$this->NomeFantasia',"
                    . " razao_social='$this->RazaoSocial',"
                    . " email=$this->Email "
                    . " telefone=$this->Telefone "
                    . " senha=$this->Senha "
                    . " WHERE idempresa='$this->id'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();
            $id_res = $result->rowCount();            
        }        
            return $id_res;
    }
    public function getIDEmpresa(){
        $result = $this->cnn->Conexao()->prepare("SELECT ID FROM empresa  ORDER BY id DESC LIMIT 1");
	$result->execute();		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
       return  $codigo->ID;    
    }

    public function deletarEmpresa($IDPonto) {        
        $result= $this->cnn->Conexao()->prepare("DELETE FROM Empresa WHERE id = ".$IDPonto);
        $result->execute();
        if ($result->rowCount()>0)
            return true;
        else        
             return false;        
    }  
}
