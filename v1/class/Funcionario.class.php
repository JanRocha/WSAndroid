<?php
include_once 'conexao.class.php';

class Funcionario {
    private $param ="";
    private $id;
    private $Nome;
    private $CPF;
    private $DataDeNascimento;
    private $NomeDaMae;
    private $Foto;
    private $Email;
    private $Senha;
    private $cnn="";
    private $SQL = "";
    
    function getId() {
        return $this->id;
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

    
    public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM UsuarioDTO WHERE id = ".$ID."";
       // echo $this->SQL;
        $result = $this->cnn->Conexao()->prepare($this->SQL);
        $result->execute();
        if($result->rowCount()>=1){
            $this->id= $ID;
           /* while ($row =$result->fetch(PDO::FETCH_OBJ)){
                $this->login = $row->lOGIN;
                $this->senha = $row->SENHA;
                $this->nome = $row->NOME;
                $this->id= $row-ID;
            }*/
        }else{
            $this->id= '-1';
        }
    }
    
    function setLogin($login) {
        $this->login = $login;
    }
    public function setnome($Nome){
      $this->nome=$Nome;
    }
    
    public function setSenha($Senha){
        $this->senha=$Senha;
    }

    public function getusuariosDTO() {        
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
         
        $result= $this->cnn->Conexao()->prepare("SELECT * FROM UsuarioDTO ".$where);
		 $result->execute();
		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $tr[] = $row;
        }
        return json_encode($tr, true);
    }
    public function setParam($param){
        if ($param<>'')
            $this->param = explode(',',$param);
        else
            $this->param = '';
    }
    
    public function salvar() {
        if ($this->id == '-1'){ 
            $count  = -1; 
            if ($this->getLoginn()== FALSE){
                $this->SQL = "INSERT INTO UsuarioDTO(id,nome,login,senha,foto) VALUES('-1','$this->nome','$this->login','$this->senha','$this->foto')";
                //echo $this->SQL;
                $result = $this->cnn->Conexao()->prepare($this->SQL);
                $result->execute();  
                $count=  $result->rowCount();
            }
                     
        }else{
            $this->SQL = "UPDATE  UsuarioDTO SET NOME = '$this->nome', SENHA='$this->senha', LOGIN='$this->login', FOTO = '$this->foto' WHERE ID='$this->id'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();
        }        
            return $count;
    }
    public function getIDUsuario(){
       
         $result= $this->cnn->Conexao()->prepare("SELECT ID FROM UsuarioDTO  ORDER BY id DESC LIMIT 1");
		 $result->execute();
		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
       return  $codigo->ID;    
    }
    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
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
    private function getLoginn(){
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
    public function deletarUsuario($idUsuario) {
        $result= $this->cnn->Conexao()->prepare("DELETE FROM UsuarioDTO WHERE id = ".$idUsuario);
        $result->execute();
        if ($result->rowCount()>0)
            return true;
        else        
             return false;
        
    }
    
}
