<?php

namespace App\Models;

use PDO;
use PDOException;

class Usuarios extends Conn {

    private $Parametros;
    private $Opcao;
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

    /**
     * @param type $atributo
     * @param type $valor
     * @return $this
     */
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    /**
     * @param type $atributo
     * @return type
     */
    public function __get($atributo) {
        return $this->$atributo;
    }

    /**
     * @param type $dado
     * @return type
     */
    public function buscarId($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT tb_funcionario.PK_COD, tb_funcionario.NOME, tb_funcionario.ENDERECO, tb_funcionario.BAIRRO, "
                    . "tb_funcionario.CIDADE, tb_funcionario.UF, tb_funcionario.CEP, tb_funcionario.CPF, tb_funcionario.FUNCAO,"
                    . "tb_funcionario.CELULAR,tb_funcionario.EMAIL, tb_funcionario.NIVEL_ACESSO, tb_funcionario.CODIGO,"
                    . "tb_senha.CODIGO, tb_senha.SENHA FROM tb_funcionario join tb_senha "
                    . "on tb_funcionario.CODIGO=tb_senha.CODIGO where tb_funcionario.PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['user'] = $this->resultadoBd;
                $this->resultado = true;
                $urlDestino = site("root") . 'usuarios/index';
                header("Location: $urlDestino");
            } else {
                $this->resultado = false;
                unset($_SESSION['user']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Usuario não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function buscarTodos() {
        try {
            $Sql = "SELECT * FROM tb_funcionario ORDER By PK_COD ASC;";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param array $dados
     * @return string
     */
    public function insert(array $dados = null) {
        try {
            $this->dados = $dados;
            $senha = hast_senhas($this->dados['Senha_Acesso']);
            
            $nivelAcesso = "02";
            $Sql = "INSERT INTO tb_funcionario (CODIGO, NOME, ENDERECO, BAIRRO, CIDADE, UF, CEP, CPF, FUNCAO, CELULAR, "
                    . "EMAIL, NIVEL_ACESSO) VALUES (:CODIGO, :NOME, :ENDERECO, :BAIRRO, :CIDADE, :UF, :CEP, :CPF, "
                    . ":FUNCAO, :CELULAR, :EMAIL, :NIVEL_ACESSO); INSERT INTO tb_senha (CODIGO, SENHA, ACESSOS)"
                    . " VALUES (:CODIGO, :SENHA, :NIVEL_ACESSO)";

            $cst = $this->conn->prepare($Sql);
            //$cst->bindParam(":PK_COD", $this->dados['Pk_cod'], PDO::PARAM_INT);
            $cst->bindParam(":NOME", $this->dados['Nome'], PDO::PARAM_STR);
            $cst->bindParam(":ENDERECO", $this->dados['Endereco'], PDO::PARAM_STR);
            $cst->bindParam(":BAIRRO", $this->dados['Bairro'], PDO::PARAM_STR);
            $cst->bindParam(":CIDADE", $this->dados['Cidade'], PDO::PARAM_STR);
            $cst->bindParam(":UF", $this->dados['Uf'], PDO::PARAM_STR);
            $cst->bindParam(":CEP", $this->dados['Cep'], PDO::PARAM_STR);
            $cst->bindParam(":CPF", $this->dados['Cpf'], PDO::PARAM_STR);
            $cst->bindParam(":CELULAR", $this->dados['Celular'], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL", $this->dados['Email'], PDO::PARAM_STR);
            $cst->bindParam(":FUNCAO", $this->dados['Funcao'], PDO::PARAM_STR);
            $cst->bindParam(":CODIGO", $this->dados['Codigo_Acesso'], PDO::PARAM_STR);
            $cst->bindParam(":SENHA", $senha, PDO::PARAM_STR);
            $cst->bindParam(":NIVEL_ACESSO", $nivelAcesso, PDO::PARAM_STR);
            if ($cst->execute()) {
                $this->resultado = true;
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function update(array $dados = null) {
        try {
            $this->dados = $dados;
            //var_dump($this->dados);
            $senha = hast_senhas($this->dados['Senha_Acesso']);
            
            $nivelAcesso = "02";
            $Sql = " UPDATE tb_funcionario SET CODIGO=:CODIGO, NOME=:NOME, ENDERECO=:ENDERECO, BAIRRO=:BAIRRO, CIDADE=:CIDADE,"
                    . "UF=:UF, CEP=:CEP, CPF=:CPF,FUNCAO=:FUNCAO, CELULAR=:CELULAR, EMAIL=:EMAIL, "
                    . "NIVEL_ACESSO=:NIVEL_ACESSO WHERE PK_COD=:PK_COD; ";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados['Pk_cod'], PDO::PARAM_INT);
            $cst->bindParam(":NOME", $this->dados['Nome'], PDO::PARAM_STR);
            $cst->bindParam(":ENDERECO", $this->dados['Endereco'], PDO::PARAM_STR);
            $cst->bindParam(":BAIRRO", $this->dados['Bairro'], PDO::PARAM_STR);
            $cst->bindParam(":CIDADE", $this->dados['Cidade'], PDO::PARAM_STR);
            $cst->bindParam(":UF", $this->dados['Uf'], PDO::PARAM_STR);
            $cst->bindParam(":CEP", $this->dados['Cep'], PDO::PARAM_STR);
            $cst->bindParam(":CPF", $this->dados['Cpf'], PDO::PARAM_STR);
            $cst->bindParam(":CELULAR", $this->dados['Celular'], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL", $this->dados['Email'], PDO::PARAM_STR);
            $cst->bindParam(":FUNCAO", $this->dados['Funcao'], PDO::PARAM_STR);
            $cst->bindParam(":CODIGO", $this->dados['Codigo_Acesso'], PDO::PARAM_STR);
            $cst->bindParam(":NIVEL_ACESSO", $nivelAcesso, PDO::PARAM_STR);
            if ($cst->execute()) {
                $this->resultado = true;
                return 'ok';
            } else {
                return 'erro';
            }

            $Sql2 = "UPDATE tb_senha SET CODIGO=:CODIGO2, SENHA=:SENHA WHERE CODIGO=:CODIGO2;";

            $cst2 = $this->conn->prepare($Sql2);
            $cst2->bindParam(":CODIGO2", $this->dados['Codigo_Acesso'], PDO::PARAM_STR);
            $cst2->bindParam(":SENHA", $senha, PDO::PARAM_STR);
            if ($cst2->execute()) {
                $this->resultado = true;
                return 'ok';
            } else {
                return 'erro';
            }
            $this->resultado = true;
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function delete(array $dados = null) {
        try {
            // deletar produtos
            $this->dados = $dados;
//            var_dump($this->dados);
//            die();
            $sql = "DELETE FROM tb_funcionario WHERE PK_COD=:PK_COD LIMIT 1;";
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(":PK_COD", $this->dados["Pk_cod"], PDO::PARAM_INT);
            if ($cst->execute()) {
                 $this->resultado = true;
                return;
            } else {
                return 'erro delete';
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function usuariosCad($email, $codigo) {

        try {         
            $Sql = "SELECT PK_COD, CODIGO, EMAIL FROM tb_funcionario WHERE EMAIL=:EMAIL OR CODIGO=:CODIGO ";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":EMAIL", $email, PDO::PARAM_STR);
            $cst->bindParam(":CODIGO", $codigo, PDO::PARAM_STR);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

}
