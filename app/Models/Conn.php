<?php
namespace App\Models;
use PDO;
use PDOException;

/**
 * Description of Conn
 *
 * @author mare
 */
class Conn {
    private  $db =  DATA["driver"];
    private  $host = DATA["host"];
    private  $user = DATA["username"];
    private  $pass = DATA["passwd"];
    private  $dbname = DATA["dbname"];
    private  $port = DATA["port"];
    private  $options= DATA["options"];
    public static $connect;
    /**
     * 
     * @return type
     */
    protected function connect() {
        try {
            If(!isset(self::$connect)){
            self::$connect = new PDO($this->db . ': host=' . $this->host . '; port=' . $this->port . '; dbname=' . $this->dbname, $this->user, $this->pass, $this->options);
           // self::$connect = new PDO($this->db .':'. $this->host.$this->dbname);   // "sqlite:c:/pagina/databases/imasters.db"
            self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
            return self::$connect ;
        } catch (PDOException $e) {
            die('Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador adm@empresa.com - ' . $e->getMessage());
        
        }

        
    }
}

//$host="127.0.0.1";
//$port=3307;
//$socket="";
//$user="root";
//$password="";
//$dbname="bdrh";
//
//$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
//	or die ('Could not connect to the database server' . mysqli_connect_error());
//
////$con->close();



