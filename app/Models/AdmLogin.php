<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * Description of AdmLogin
 * @author adm
 */
class AdmLogin extends Conn
{
    private $dados;
    private $resultado = false;
    private $resultadoBd;
    private $conn;

    /**
     * 
     * @return bool
     */
    function getResultado(): bool
    {
        return $this->resultado;
    }

    /**
     * construtor
     */
    public function __construct()
    {
        $this->conn = $this->connect();
    }

    /**
     * @param  $atributo
     * @return $atributo
     */
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
        return $this;
    }

    /**
     * 
     * @param  $atributo
     * @return $atributo
     */
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    /**
     * 
     * @param array $dados
     */
    public function login($dados = array())
    {
        try {
            $this->dados = $dados;

            $sql = "SELECT tb_funcionario.PK_COD, tb_funcionario.NOME, tb_funcionario.CODIGO, tb_funcionario.EMAIL, "
                ."tb_senha.CODIGO, tb_senha.SENHA FROM tb_funcionario JOIN tb_senha "
                ."ON tb_funcionario.CODIGO = tb_senha.CODIGO WHERE tb_funcionario.CODIGO=:PK_COD;";

            $cst               = $this->conn->prepare($sql);
            $cst->bindParam(":PK_COD", $this->dados["login"], PDO::PARAM_STR);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $this->validarSenha();
            }
            else {
                $this->resultado = false;
                echo ajaxResponse("message",
                    [
                    "type" => "error",
                    "message" => "Usuário ou a senha incorreta"
                ]);
                return;
            }
        }
        catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * validarSenha
     */
    private function validarSenha()
    {
        try {
            if (hast_senhas($this->dados["senha"]) == $this->resultadoBd["SENHA"]) {
                $_SESSION["login"] = $this->resultadoBd;
                $this->resultado   = true;
            }
            else {
                $this->resultado = false;
                echo ajaxResponse("message",
                    [
                    "type" => "error",
                    "message" => "Usuário ou a senha incorreta"
                ]);
                return;
            }
        }
        catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
}