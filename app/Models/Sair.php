<?php

namespace App\Models;

/**
 * Description of Sair
 *
 * @author Mare
 */
class Sair extends Conn {

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

    public function Redirecionar() {
        try {
            $urlDestino = site("root") . 'login/index';
            header("Location: $urlDestino");
            session_destroy();          
            
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
