<?php

namespace App\Models;

use PDO;
use PDOException;

class Empresa extends Conn {

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
     * 
     * @param type $atributo
     * @param type $valor
     * @return $this
     */
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
        return $this;
    }

    /**
     * 
     * @param type $atributo
     * @return type
     */
    public function __get($atributo) {
        return $this->$atributo;
    }

    /**
     * 
     * @param type $dado
     * @return type
     */
    public function buscarId($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT * FROM tb_empresa WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['empresa'] = $this->resultadoBd;
                $this->resultado = true;
                $urlDestino = site("root") . 'empresa/index';
                header("Location: $urlDestino");
            } else {
                $this->resultado = false;
                unset($_SESSION['empresa']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Empresa não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param type $dados
     * @return type
     */
    public function pesquisarRelatorioTodos() {
        try {
            $Sql = "SELECT * FROM tb_loja";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_loja";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['empresa'] = $this->resultadoBd;
                $_SESSION['$count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "empresa/relatorioProdutos"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['empresa']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Produto não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @return type
     */
    public function buscarTodos() {
        try {
            $Sql = "SELECT * FROM tb_empresa ORDER By PK_COD ASC";
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

            $Sql = "INSERT INTO tb_empresa (CNPJ, RAZAO_SOCIAL, NOME_FANTASIA, RESPONSAVEL, CPF_RESPONSAVEL, "
                    . "EMAIL, CELULAR, CEP, ENDERECO, BAIRRO, CIDADE, UF) VALUES(:CNPJ, :RAZAO_SOCIAL, :NOME_FANTASIA, "
                    . ":RESPONSAVEL, :CPF_RESPONSAVEL, :EMAIL, :CELULAR, :CEP, :ENDERECO, :BAIRRO, :CIDADE, :UF);";

            $cst = $this->conn->prepare($Sql);
            // $cst->bindParam(":PK_COD", $this->dados["pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":CNPJ", $this->dados["cnpj"], PDO::PARAM_STR);
            $cst->bindParam(":RAZAO_SOCIAL", $this->dados["razao_social"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_FANTASIA", $this->dados["nome_fantasia"], PDO::PARAM_STR);
            $cst->bindParam(":RESPONSAVEL", $this->dados["responsavel"], PDO::PARAM_STR);
            $cst->bindParam(":CPF_RESPONSAVEL", $this->dados["respcpf"], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL", $this->dados["email"], PDO::PARAM_STR);
            $cst->bindParam(":CELULAR", $this->dados["celular"], PDO::PARAM_STR);
            $cst->bindParam(":CEP", $this->dados["Cep"], PDO::PARAM_STR);
            $cst->bindParam(":ENDERECO", $this->dados["Endereco"], PDO::PARAM_STR);
            $cst->bindParam(":BAIRRO", $this->dados["Bairro"], PDO::PARAM_STR);
            $cst->bindParam(":CIDADE", $this->dados["Cidade"], PDO::PARAM_STR);
            $cst->bindParam(":UF", $this->dados["Uf"], PDO::PARAM_STR);

            if ($cst->execute()) {
                $this->resultado = true;
                return;
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param array $dados
     * @return string
     */
    public function update(array $dados = null) {
        try {
            $this->dados = $dados;

            $Sql = "UPDATE tb_empresa SET CNPJ=:CNPJ, CPF_RESPONSAVEL=:CPF_RESPONSAVEL, EMAIL=:EMAIL, CELULAR=:CELULAR, CEP=:CEP, "
                    . "ENDERECO=:ENDERECO, BAIRRO=:BAIRRO, CIDADE=:CIDADE, UF=:UF, RAZAO_SOCIAL=:RAZAO_SOCIAL, "
                    . "NOME_FANTASIA=:NOME_FANTASIA, RESPONSAVEL=:RESPONSAVEL WHERE PK_COD=:PK_COD;";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados["pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":CNPJ", $this->dados["cnpj"], PDO::PARAM_STR);
            $cst->bindParam(":RAZAO_SOCIAL", $this->dados["razao_social"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_FANTASIA", $this->dados["nome_fantasia"], PDO::PARAM_STR);
            $cst->bindParam(":RESPONSAVEL", $this->dados["responsavel"], PDO::PARAM_STR);
            $cst->bindParam(":CPF_RESPONSAVEL", $this->dados["respcpf"], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL", $this->dados["email"], PDO::PARAM_STR);
            $cst->bindParam(":CELULAR", $this->dados["celular"], PDO::PARAM_STR);
            $cst->bindParam(":CEP", $this->dados["Cep"], PDO::PARAM_STR);
            $cst->bindParam(":ENDERECO", $this->dados["Endereco"], PDO::PARAM_STR);
            $cst->bindParam(":BAIRRO", $this->dados["Bairro"], PDO::PARAM_STR);
            $cst->bindParam(":CIDADE", $this->dados["Cidade"], PDO::PARAM_STR);
            $cst->bindParam(":UF", $this->dados["Uf"], PDO::PARAM_STR);

            if ($cst->execute()) {
                $this->resultado = true;
                return;
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param array $dados
     * @return string
     */
    public function deleteId($dados) {
        try {
            $this->dados = $dados;
            $sql = "DELETE FROM tb_loja WHERE PK_COD=:PK_COD LIMIT 1;";
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
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

    /**
     * 
     * @param array $dados
     * @return string
     */
    public function delete(array $dados = null) {
        try {
            // deletar produtos
            $this->dados = $dados;
            $sql = "DELETE FROM tb_empresa WHERE PK_COD=:PK_COD LIMIT 1;";
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(":PK_COD", $this->dados["pk_cod"], PDO::PARAM_INT);
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

    public function empresaId($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, CNPJ, EMAIL FROM tb_empresa WHERE PK_COD=:PK_COD;";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

    public function produtoCodBarras($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, CODIGO_BARRAS FROM tb_loja WHERE CODIGO_BARRAS = :CODIGO_BARRAS";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":CODIGO_BARRAS", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

}

