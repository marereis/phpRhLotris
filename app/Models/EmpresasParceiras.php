<?php

namespace App\Models;

use PDO;
use PDOException;

class EmpresasParceiras extends Conn {

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
            $Sql = "SELECT * FROM tb_empresas_parceiras WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['empresapar'] = $this->resultadoBd;
                $this->resultado = true;
                $urlDestino = site("root") . 'empresasParceiras/index';
                header("Location: $urlDestino");
            } else {
                $this->resultado = false;
                unset($_SESSION['empresapar']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Empresas Parceiras não encontrado!"
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
    public function pesquisar($dados) {
        try {
            $this->dados = $dados;
            $this->Parametros = $this->dados["Parametros"];
            $this->Opcao = $this->dados["Opcao"];
            $Sql = "SELECT * FROM tb_empresas_parceiras where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['empresas_parConsulta'] = $this->resultadoBd;

                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "empresasParceiras/index"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['empresas_parConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Empresas Parceiras não encontrado!"
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
    public function pesquisarRelatorio($dados) {
        try {
            $this->dados = $dados;
            $this->Parametros = $this->dados["Parametros"];
            $this->Opcao = $this->dados["Opcao"];
            $Sql = "SELECT * FROM tb_empresas_parceiras where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_empresas_parceiras where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['empre_parConsulta'] = $this->resultadoBd;
                $_SESSION['count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "empresasParceiras/relatorioEmpresasPar"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['empre_parConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Empresas Parceiras não encontrado!"
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
            $Sql = "SELECT * FROM tb_empresas_parceiras";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_empresas_parceiras";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['empre_parConsulta'] = $this->resultadoBd;
                $_SESSION['count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "empresasParceiras/relatorioEmpresasPar"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['empre_parConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Empresas Parceiras não encontrado!"
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
            $Sql = "SELECT * FROM tb_empresas_parceiras ORDER By PK_COD ASC";
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

            $Sql = "INSERT INTO tb_empresas_parceiras (CNPJ, RAZAO_SOCIAL, NOME_FANTASIA, ATIVIDADE_EMPRESA, RESPONSAVEL, "
                    . "TEL_RESPONS, EMAIL, CELULAR, CEP, ENDERECO, BAIRRO, CIDADE, UF) VALUES"
                    . "(:CNPJ, :RAZAO_SOCIAL, :NOME_FANTASIA, :ATIVIDADE_EMPRESA, :RESPONSAVEL, :TEL_RESPONS, "
                    . ":EMAIL, :CELULAR, :CEP, :ENDERECO, :BAIRRO, :CIDADE, :UF);";

            $cst = $this->conn->prepare($Sql);
//            $cst->bindParam(":PK_COD", $this->dados["pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":CNPJ", $this->dados["cnpj"], PDO::PARAM_STR);
            $cst->bindParam(":RAZAO_SOCIAL", $this->dados["razao_social"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_FANTASIA", $this->dados["nome_fantasia"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADE_EMPRESA", $this->dados["atividade"], PDO::PARAM_STR);
            $cst->bindParam(":RESPONSAVEL", $this->dados["responsavel"], PDO::PARAM_STR);
            $cst->bindParam(":TEL_RESPONS", $this->dados["Tel_respon"], PDO::PARAM_STR);
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

            $Sql = "UPDATE tb_empresas_parceiras SET CNPJ=:CNPJ, RAZAO_SOCIAL=:RAZAO_SOCIAL, NOME_FANTASIA=:NOME_FANTASIA, "
                    . "ATIVIDADE_EMPRESA=:ATIVIDADE_EMPRESA, RESPONSAVEL=:RESPONSAVEL, TEL_RESPONS=:TEL_RESPONS, "
                    . "EMAIL=:EMAIL, CELULAR=:CELULAR, "
                    . "CEP=:CEP, ENDERECO=:ENDERECO, BAIRRO=:BAIRRO, CIDADE=:CIDADE, UF=:UF WHERE PK_COD=:PK_COD;";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados["pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":CNPJ", $this->dados["cnpj"], PDO::PARAM_STR);
            $cst->bindParam(":RAZAO_SOCIAL", $this->dados["razao_social"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_FANTASIA", $this->dados["nome_fantasia"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADE_EMPRESA", $this->dados["atividade"], PDO::PARAM_STR);
            $cst->bindParam(":RESPONSAVEL", $this->dados["responsavel"], PDO::PARAM_STR);
            $cst->bindParam(":TEL_RESPONS", $this->dados["Tel_respon"], PDO::PARAM_STR);
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
            $sql = "DELETE FROM tb_empresas_parceiras WHERE PK_COD=:PK_COD LIMIT 1;";
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
            $this->dados = $dados;
            $sql = "DELETE FROM tb_empresas_parceiras WHERE PK_COD=:PK_COD LIMIT 1;";
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
            $Sql = "SELECT FK_EMPRESA, CNPJ FROM tb_vaga WHERE CNPJ=:CNPJ;";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":CNPJ", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }
    
        public function empresaIdCads($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, CNPJ FROM tb_empresas_parceiras WHERE CNPJ=:CNPJ;";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":CNPJ", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

    public function produtoCodBarras($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, CODIGO_BARRAS FROM tb_empresas_parceiras WHERE CODIGO_BARRAS = :CODIGO_BARRAS";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":CODIGO_BARRAS", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

    public function totalCadastrados() {

        try {
            $Sql = "SELECT COUNT(PK_COD) AS QUANT FROM tb_empresas_parceiras";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function buscarEmpresaEncaminhar($dado) {
        try {
            $this->Cod_prod = $dado;
            $Sql = "SELECT PK_COD, CNPJ, RAZAO_SOCIAL, RESPONSAVEL, CARGO_RESPONS, "
                    . "CEP, ENDERECO, BAIRRO, CIDADE, UF FROM tb_empresas_parceiras WHERE PK_COD = '$this->Cod_prod'";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }
    
    public function buscarEmpresaVaga($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, RAZAO_SOCIAL, CNPJ FROM tb_empresas_parceiras where PK_COD  = '$this->dados'";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

}
