<?php
include_once 'conexao.class.php';

class Funcionario {
    private $param ="";
    private $id;
    private $idEmpresa;
    private $Nome;
    private $CPF;
    private $DataDeNascimento;
    private $NomeDaMae;
    private $RG;
    private $Naturalidade;
    private $Foto;
    private $Email;
    private $Senha;
    private $EmpresaIdEmpresa;
    private $idCargo;
    private $CargosIdCargo;
    private $cnn="";
    private $SQL = "";

    public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM funcionarios WHERE idfuncionario = ".$ID;
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

    function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa=$idEmpresa;
    }

    function getCPF() {
        return $this->CPF;
    }

    function getDataDeNascimento() {
        return $this->DataDeNascimento;
    }

    function getNomeDaMae() {
        return $this->NomeDaMae;
    }

    function getFoto() {
        return $this->Foto;
    }

    function getEmail() {
        return $this->Email;
    }

    function setCPF($CPF) {
        $this->CPF = $CPF;
    }

    function setDataDeNascimento($DataDeNascimento) {
        $this->DataDeNascimento = $DataDeNascimento;
    }

    function setNomeDaMae($NomeDaMae) {
        $this->NomeDaMae = $NomeDaMae;
    }

    function setFoto($Foto) {
        $this->Foto = $Foto;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }
    
    function setLogin($login) {
        $this->login = $login;
    }
    
    function getNome() {
        return $this->nome;
    }

    public function setnome($Nome){
        $this->nome=$Nome;
    }

    function getSenha() {
        return $this->senha;
    }

    public function setSenha($Senha){
        $this->senha=$Senha;
    }

    function getEmpresaIdEmpresa() {
        return $this->EmpresaIdEmpresa;
    }

    public function setEmpresaIdEmpresa($EmpresaIdEmpresa){
        $this->EmpresaIdEmpresa=$EmpresaIdEmpresa;
    }

    function getIdCargo() {
        return $this->IdCargo;
    }

    public function setIdCargo($idCargo){
        $this->idCargo=$idCargo;
    }

    function getCargosIdCargo() {
        return $this->CargosIdCargo;
    }

    public function setCargosIdCargo($CargosIdCargo){
        $this->CargosIdCargo=$CargosIdCargo;
    }

    public function getFuncionario() {        
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
         
        $result= $cnn->Conexao()->prepare("SELECT * FROM funcionario ".$where);
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
              $this->SQL = "INSERT INTO funcionario("
                    . "idEmpresa,"
                    . "nome,"
                    . "cpf,"
                    . "data_nascimento,"
                    . "nome_mae,"
                    . "rg,"
                    . "naturalidade,"
                    . "email,"
                    . "foto,"
                    . "senha,"
                    . "empresa_idempresa,"
                    . "idcargo,"
                    . "cargos_idcargo') VALUES('"
                    . "$this->idEmpresa','"
                    . "$this->Nome','"
                    . "$this->CPF','"
                    . "$this->DataDeNascimento','"
                    . "$this->NomeDaMae','"
                    . "$this->RG','"
                    . "$this->Naturalidade','"
                    . "$this->Email','"
                    . "$this->Foto','"
                    . "$this->Senha','"
                    . "$this->EmpresaIdEmpresa','"
                    . "$this->idCargo','"
                    . "$this->CargosIdCargo')";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();                
            $id_res = $result->rowCount(); 
        }else{
            $this->SQL = "UPDATE  funcionarios SET "
                    . " idempresa = '$this->idEmpresa',"
                    . " nome = '$this->Nome',"
                    . " cpf='$this->CPF',"
                    . " data_nascimento='$this->DataDeNascimento',"
                    . " nome_mae='$this->NomeDaMae',"
                    . " rg='$this->RG',"
                    . " naturalidade='$this->Naturalidade',"
                    . " email='$this->Email',"
                    . " foto='$this->Foto',"
                    . " senha='$this->Senha',"
                    . " empresa_idempresa='$this->EmpresaIdEmpresa',"
                    . " idcargo='$this->idCargo',"
                    . " cargos_idcargo='$this->CargosIdCargo'"
                    . " WHERE idfuncionario='$this->idfuncionario'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();
            $id_res = $result->rowCount();            
        }        
            return $id_res;
    }
    public function getIDFuncionario(){
        $result = $this->cnn->Conexao()->prepare("SELECT idfuncionario FROM funcionarios  ORDER BY idfuncionario DESC LIMIT 1");
	    $result->execute();		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
       return  $codigo->idfuncionario;    
    }

    public function deletarFuncionario($IDPonto) {        
        $result= $this->cnn->Conexao()->prepare("DELETE FROM funcionarios WHERE idfuncionario = ".$IDPonto);
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
