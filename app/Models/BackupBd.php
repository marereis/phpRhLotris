<?php

namespace App\Models;

/**
 * Description of BackupBd
 *
 * @author Mare
 */
class BackupBd extends Conn {

    private $dados;
    private $resultado = false;
    private $resultadoBd;
    private $conn;

    /**
     * 
     * @return bool
     */
    function getResultado(): bool {
        return $this->resultado;
    }

    /**
     * construtor
     */
    public function __construct() {
        $this->conn = $this->connect();
    }

    public function backupBdMysql() {
        try {

            //faz backup 
            $outpu1 = shell_exec('C:\Program Files\MySQL\MySQL Server 8.0\bin\mysqldump -u root --password=mare127601aA --databases --single-transaction --triggers --routines bdrh > C:\Apache24\htdocs\rhLotris\src\Services\BackupMySQL\bdrh_backup11.sql');
            $output = shell_exec('C:\xampp\mysql\bin\mysqldump -u root --databases --single-transaction --triggers --routines bdrh > C:\Site\rhLotris\src\Services\BackupMySQL\bdrh_backup.sql');

//            $origem = 'C:\Program Files\MySQL\MySQL Server 8.0\bin';
//            $dir = 'C:\Apache24\htdocs\rhLotris\src\Services\BackupMySQL\bdrh_backupapache.sql';
//            $host = DATA["host"];
//            $bd = DATA["dbname"];
//            $user = DATA["username"];
//            $pass = DATA["passwd"];
//
//            $command = "$origem\mysqldump --host=$host --user=$user --password=$pass --databases $bd > $dir ";
//            echo $command;
//           // system($command);
//            $output1 = shell_exec($command);

            $urlDestino = site("root") . 'controller/backupBdMysql';
            header("Location: $urlDestino");
            return;
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
