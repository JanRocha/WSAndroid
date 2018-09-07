<?php
include_once 'conexao.class.php';

class Pontos {
    private $id;
    private $descricao;
    private $latitude;
    private $longitude;
    private $idUsuario;
    private $gostei;
    private $lstIDTipoMaterial;
    private $param;
    private $SQL;
    
    function getLstIDTipoMaterial() {
        return $this->lstIDTipoMaterial;
    }

    function setLstIDTipoMaterial($lstIDTipoMaterial) {
        $this->lstIDTipoMaterial = $lstIDTipoMaterial;
    }

        function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
        
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }   
    
    function getGostei() {
        return $this->gostei;
    }

    function setGostei($gostei) {
        $this->gostei = $gostei;
    }

    public function __construct($ID = "") {
        $this->cnn = new conexao();

        $this->SQL = "SELECT * FROM Pontos WHERE id = ".$ID;
        //echo $this->SQL;
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
    
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
    public function getPontos() {
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
        $result= $cnn->Conexao()->query("SELECT * FROM Pontos ".$where);
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
            $this->SQL = "INSERT INTO Pontos(id,descricao,latitude,longitude,idUsuarioDTO,gostei) VALUES('-1','$this->descricao','$this->latitude','$this->longitude',$this->idUsuario, 0)";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute(); 
             $id_res = $this->getIDPonto();
            //GRAVANDO O RANKING
            $this->SQL ="INSERT INTO Ranking(idUsuario, pontuacao) VALUES($this->idUsuario,1)";
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();       
             
            //GRAVANDO TIPO MATERIAL
            $id = explode(',',$this->lstIDTipoMaterial);
            //print_r($id);
            for ($index = 0; $index < count($id); $index++) {                
                $this->SQL ="INSERT INTO pontosTipoMaterial(idPonto, idTipoMaterial) VALUES( $id_res,$id[$index])";
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();  
            }
             
        }else{
            $this->SQL = "UPDATE  Pontos SET descricao = '$this->descricao', latitude='$this->longitude', longitude='$this->latitude', idUsuarioDTO=$this->idUsuario WHERE ID='$this->id'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();
            $id_res = $result->rowCount();            
        }        
            return $id_res;
    }
    public function getIDPonto(){
        $result = $this->cnn->Conexao()->prepare("SELECT ID FROM Pontos  ORDER BY id DESC LIMIT 1");
	$result->execute();		 
        //resut set alimentado para retornar o json
        while($row = $result->fetch(PDO::FETCH_OBJ)){
            $codigo= $row;
        }    
       return  $codigo->ID;    
    }

    public function deletarPonto($IDPonto) {        
        $result= $this->cnn->Conexao()->prepare("DELETE FROM Pontos WHERE id = ".$IDPonto);
        $result->execute();
        if ($result->rowCount()>0)
            return true;
        else        
             return false;        
    }
    public function gostei(){
         $this->SQL = "UPDATE  Pontos SET gostei= gostei + 1  WHERE ID='$this->id'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();              
            return $result->rowCount();    
    }
     public function naoGostei(){
         $this->SQL = "UPDATE  Pontos SET gostei= gostei - 1  WHERE ID='$this->id'";
            //echo $this->SQL;
            $result = $this->cnn->Conexao()->prepare($this->SQL);
            $result->execute();              
            return $result->rowCount();    
    }
}
