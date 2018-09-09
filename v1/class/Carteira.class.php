<?php
include_once 'conexao.class.php';

class Carteira {
    private $param ="";
    private $id;
    private $idFuncionario;
    private $DataDeAdmissao;
    private $DataDeDemissao;
    private $Salario;
    private $Pcd;
    private $PcdDetalhes;
    private $FuncionariosIdFuncionario;
    private $cnn="";
    private $SQL = "";

    public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM carteira WHERE idcarteira = ".$ID;
       // echo $this->SQL;
        $result = $this->cnn->Conexao()->prepare($this->SQL);
        $result->execute();
        if($result->rowCount()>=1){
            $this->id= $ID;          
        }else{
            $this->id= '-1';
        }
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getIdFuncionario() {
        return $this->$idFuncionario;
    }

    function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    function getDataDeAdmissao() {
        return $this->$DataDeAdmissao;
    }

    function setDataDeAdmissao($DataDeAdmissao) {
        $this->DataDeAdmissao = $DataDeAdmissao;
    }

    function getDataDeDemissao() {
        return $this->$DataDeDemissao;
    }

    function setDataDeDemissao($DataDeDemissao) {
        $this->DataDeDemissao = $DataDeDemissao;
    }

    function getSalario() {
        return $this->$Salario;
    }

    function setSalario($Salario) {
        $this->Salario = $Salario;
    }

    function getPcd() {
        return $this->$Pcd;
    }

    function setPcd($Pcd) {
        $this->Pcd = $Pcd;
    }

    function getPcdDetalhes() {
        return $this->$PcdDetalhes;
    }

    function setPcdDetalhes($PcdDetalhes) {
        $this->PcdDetalhes = $PcdDetalhes;
    }

    function getFuncionariosIdFuncionario() {
        return $this->FuncionariosIdFuncionario;
    }

    function setFuncionariosIdFuncionario($FuncionariosIdFuncionario) {
        $this->FuncionariosIdFuncionario = $FuncionariosIdFuncionario;
    }

    public function getCarteira() {        
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
         
        $result= $cnn->Conexao()->prepare("SELECT * FROM carteira ".$where);
		$result->execute();
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
              $this->SQL = "INSERT INTO carteira("
                    . "idfuncionario,"
                    . "data_admissao,"
                    . "data_demissao,"
                    . "salario,"
                    . "pcd,"
                    . "pcd_detalhes,"
                    . "funcionarios_idfuncionario) VALUES('"
                    . "$this->idFuncionario','"
                    . "$this->DataDeAdmissao','"
                    . "$this->DataDeDemissao','"
                    . "$this->Salario','"
                    . "$this->Pcd','"
                    . "$this->PcdDetalhes','"
                    . "$this->FuncionariosIdFuncionario')";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();                
            $id_res = $result->rowCount(); 
        }else{
            $this->SQL = "UPDATE  carteira SET "
                    . " idfuncionario = '$this->idFuncionario'"
                    . " data_admissao = '$this->DataDeAdmissao',"
                    . " data_demissao='$this->DataDeDemissao',"
                    . " salario='$this->Salario',"
                    . " pcd='$this->Pcd',"
                    . " pcd_detalhes='$this->PcdDetalhes',"
                    . " naturalidade='$this->Naturalidade' "
                    . " funcionarios_idfuncionario='$this->FuncionariosIdFuncionario' "
                    . " WHERE idcarteira='$this->idcarteira'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();
            $id_res = $result->rowCount();            
        }        
            return $id_res;
    }
    public function getIDCarteira(){
        $result = $this->cnn->Conexao()->prepare("SELECT idcarteira FROM carteira  ORDER BY idcarteira DESC LIMIT 1");
	    $result->execute();		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
       return  $codigo->idcarteira;    
    }

    public function deletarCarteira($IDPonto) {        
        $result= $this->cnn->Conexao()->prepare("DELETE FROM carteiras WHERE idcarteira = ".$IDPonto);
        $result->execute();
        if ($result->rowCount()>0)
            return true;
        else        
             return false;        
    } 
    

    public function getLogar(){
         $result= $this->cnn->Conexao()->prepare("SELECT ID, NOME, LOGIN,SENHA, FOTO FROM UsuarioDTO WHERE login='$this->login' and senha='$this->senha' ORDER BY id DESC LIMIT 1");
	 $result->execute();
		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
        if (isset($codigo->ID)){
            $this->setId($codigo->ID);
            $this->setnome($codigo->NOME);
            $this->setLogin($codigo->LOGIN);
            $this->setSenha($codigo->SENHA);
            $this->setFoto($codigo->FOTO);
            return TRUE;
        }else
            return FALSE;
    }
    private function getLogin(){
         $result= $this->cnn->Conexao()->prepare("SELECT ID FROM UsuarioDTO WHERE login='$this->login' ORDER BY id DESC LIMIT 1");
	 $result->execute();
		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }          
        if (isset( $codigo)){
            $this->setId($codigo->ID);
            return TRUE;
        }else
            return FALSE;
    }
    
}
