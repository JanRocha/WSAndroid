<?php


class conexao {
    private $user= 'id5683820_hoot';
    private $pass= '123456';
    private $dbname ='id5683820_ws_app';
    private $servidor='localhost';
    private $dns = '';
    public function Conexao() {
		try {
			$pdo = new PDO("mysql:host=$this->servidor;dbname=$this->dbname;charset=UTF8;",  $this->user,  $this->pass);
			return $pdo;
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}       
	}
}

/*
class conexao {

    private $user = 'azure';
    private $pass = '6#vWHD_$';
    private $dbname = 'app';
    private $servidor = 'https://ecoloc.azurewebsites.net';
    private $dns = '';

    public function Conexao() {
        //echo 'aqui0';
        try {
            //Establishes the connection
            $conn = mysqli_init();
            mysqli_real_connect($conn, $this->servidor, $this->user, $this->pass, $this->dbname, 3306);
            if (mysqli_connect_errno($conn)) {
                die('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

            echo 'aqui0';
        } catch (mysqli_sql_exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

}

/*
 * https://ecoloc.azurewebsites.net

FTP SERVER => ftp://waws-prod-dm1-053.ftp.azurewebsites.windows.net
Login: ecoloc\fabricau9
Senha: F@brica2018

Database = localdb;
Data Source = 127.0.0.1:56218;
User Id = azure;
Password = 6#vWHD_$;Port=53376
 *
 */