<?php

namespace App\Models;

use PDO;
use PDOException;

class Candidatos extends Conn {

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
            $Sql = "SELECT * FROM tb_candidatos WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['candidato'] = $this->resultadoBd;
                $_SESSION['curriculo'] = $this->resultadoBd;
                $this->resultado = true;
                $urlDestino = site("root") . 'candidatos/index';
                header("Location: $urlDestino");
            } else {
                $this->resultado = false;
                unset($_SESSION['candidatos']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Candidato não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }
    
        public function buscarCandidatoEncaminhar($dado){
        try{
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, NOME, DATA_NASC, CELULAR, EMAIL, CPF FROM tb_candidatos "
                    . "WHERE PK_COD = $this->dados";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * 
     * @param array $dados
     * @return type
     */
    public function consultarPainel($dados) {

        try {
            $this->dados = $dados;
            $sql = "SELECT * FROM tb_candidatos where pk_cod=:pk_cod";
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(":pk_cod", $this->dados['nomepesq'], PDO::PARAM_STR);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['paciente'] = $this->resultadoBd;

                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "home_/pacienteid"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['paciente']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Candidato não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

        /**
     * 
     * @param type $dado
     * @return type
     */
    public function selecaoProduto($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT * FROM tb_candidatos where COD_DEPART =:COD_DEPART ORDER By DESCRICAO ASC";
            $cst = $this->conn->prepare($Sql);

            $cst->bindParam(":COD_DEPART", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function totalProdutos($dados) {
        try {
            $this->Parametros = ($dados["dtfinal"]);
            $this->Opcao = ($dados["dtincio"]);
            $sql = "SELECT COUNT(QTDE) AS QUANT, SUM(VALOR) AS TOTAL FROM VENDAS WHERE DATA between '$this->Opcao' and '$this->Parametros';";
            $cst = $this->conn->prepare($sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function produtosEstoqueBaixo() {
        try {
            $sql = "SELECT PK_COD, CODIGO_BARRAS, DESCRICAO, QTDE_LOJA FROM tb_produto WHERE QTDE_LOJA <=20";
            $cst = $this->conn->prepare($sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
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
            $Sql = "SELECT * FROM tb_candidatos where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['candidatosConsulta'] = $this->resultadoBd;

                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "candidatos/index"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['candidatos']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Candidato não encontrado!"
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
            $Sql = "SELECT * FROM tb_candidatos where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_candidatos where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['candConsulta'] = $this->resultadoBd;
                $_SESSION['count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "candidatos/relatorioCandidatos"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['candConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Candidato não encontrado!"
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
            $Sql = "SELECT * FROM tb_candidatos";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_candidatos";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['candConsulta'] = $this->resultadoBd;
                $_SESSION['count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "candidatos/relatorioCandidatos"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['candConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Candidato não encontrado!"
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
            $Sql = "SELECT * FROM tb_candidatos ORDER By PK_COD ASC";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @return type
     */
    public function buscarGRAFICOS() {
        try {
            $Sql = "SELECT TOP(10) DESCRICAO, VLR_PRECO, PK_COD,QTDE_LOJA,CODIGO_BARRAS FROM tb_candidatos ORDER By PK_COD ASC";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }

    /**
     * PERIODO1_2,PERIODO2_2,PERIODO3_2,:PERIODO1_2,:PERIODO2_2,:PERIODO3_2,
     * @param array $dados
     * @return string
     */
    public function insert(array $dados = null) {
        try {
            $this->dados = $dados;
            $Sql = " INSERT INTO tb_candidatos (NOME, SEXO, DATA_NASC, IDADE, ESTADO_CIVIL, NOME_CONJUGE, QTD_FILHOS, "
                    . "NOME_MAE, CEP, ENDERECO, BAIRRO, CIDADE, UF, EMAIL, CELULAR, FACEBOOK, INSTAGRAN, "
                    . "ESCOLARIDADE, CURSO, CURSO_EXTRA1, CURSO_EXTRA2, CURSO_EXTRA3, "
                    . "CARGO_PRETENDIDO, IDENTIDADE, CPF, PIS, CTPS, TITULO_ELEITOR, "
                    . "EMPRESA1, CARGO1, SALARIO1, PERIODO1_1,  ATIVIDADES1, "
                    . "EMPRESA2, CARGO2, SALARIO2, PERIODO2_1,  ATIVIDADES2, "
                    . "EMPRESA3, CARGO3, SALARIO3, PERIODO3_1,  ATIVIDADES3, "
                    . "OBS_ENTREVISTADOR, DEFICIENTE) "
                    . "VALUES(:NOME, :SEXO, :DATA_NASC, :IDADE, :ESTADO_CIVIL, :NOME_CONJUGE, :QTD_FILHOS, :NOME_MAE, "
                    . ":CEP, :ENDERECO, :BAIRRO, :CIDADE, :UF, :EMAIL, :CELULAR, :FACEBOOK, :INSTAGRAN, "
                    . ":ESCOLARIDADE, :CURSO, :CURSO_EXTRA1, :CURSO_EXTRA2, :CURSO_EXTRA3, "
                    . ":CARGO_PRETENDIDO,:IDENTIDADE, :CPF, :PIS, :CTPS, :TITULO_ELEITOR, "
                    . ":EMPRESA1, :CARGO1, :SALARIO1, :PERIODO1_1,  :ATIVIDADES1, "
                    . ":EMPRESA2, :CARGO2, :SALARIO2, :PERIODO2_1,  :ATIVIDADES2, "
                    . ":EMPRESA3, :CARGO3, :SALARIO3, :PERIODO3_1,  :ATIVIDADES3, "
                    . ":OBS_ENTREVISTADOR, :DEFICIENTE);";

            $cst = $this->conn->prepare($Sql);
           // $cst->bindParam(":PK_COD", $this->dados["Pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":NOME", $this->dados["Nome"], PDO::PARAM_STR);
            $cst->bindParam(":SEXO", $this->dados["Gênero"], PDO::PARAM_STR);
            $cst->bindParam(":DATA_NASC", $this->dados["Data_nasc"], PDO::PARAM_STR);
            $cst->bindParam(":IDADE", $this->dados["Idade"], PDO::PARAM_STR);
            $cst->bindParam(":ESTADO_CIVIL", $this->dados["Estado_Civil"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_CONJUGE", $this->dados["Nome_conj"], PDO::PARAM_STR);
            $cst->bindParam(":QTD_FILHOS", $this->dados["Filhos"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_MAE", $this->dados["Nome_mae"], PDO::PARAM_STR);
            $cst->bindParam(":DEFICIENTE", $this->dados["Deficiente"], PDO::PARAM_STR);

            $cst->bindParam(":CEP", $this->dados["Cep"], PDO::PARAM_STR);
            $cst->bindParam(":ENDERECO", $this->dados["Endereco"], PDO::PARAM_STR);
            $cst->bindParam(":BAIRRO", $this->dados["Bairro"], PDO::PARAM_STR);
            $cst->bindParam(":CIDADE", $this->dados["Cidade"], PDO::PARAM_STR);
            $cst->bindParam(":UF", $this->dados["Uf"], PDO::PARAM_STR);
            $cst->bindParam(":FACEBOOK", $this->dados["Facebook"], PDO::PARAM_STR);
            $cst->bindParam(":INSTAGRAN", $this->dados["Instagran"], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL", $this->dados["Email"], PDO::PARAM_STR);
            $cst->bindParam(":CELULAR", $this->dados["Celular"], PDO::PARAM_STR);
            
            $cst->bindParam(":CARGO_PRETENDIDO", $this->dados["Cargo_pretend"], PDO::PARAM_STR);
            $cst->bindParam(":IDENTIDADE", $this->dados["Identidade"], PDO::PARAM_STR);
            $cst->bindParam(":CPF", $this->dados["CPF"], PDO::PARAM_STR);
            $cst->bindParam(":PIS", $this->dados["PIS"], PDO::PARAM_STR);
            $cst->bindParam(":CTPS", $this->dados["ctps"], PDO::PARAM_STR);
            $cst->bindParam(":TITULO_ELEITOR", $this->dados["titulo"], PDO::PARAM_STR);

            $cst->bindParam(":ESCOLARIDADE", $this->dados["Escolaridade"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO", $this->dados["Curso"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO_EXTRA1", $this->dados["Curso_extra1"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO_EXTRA2", $this->dados["Curso_extra2"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO_EXTRA3", $this->dados["Curso_extra3"], PDO::PARAM_STR);

            $cst->bindParam(":EMPRESA1", $this->dados["Empresa1"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO1", $this->dados["Função1"], PDO::PARAM_STR);
            $cst->bindParam(":SALARIO1", $this->dados["Salario1"], PDO::PARAM_STR);
            $cst->bindParam(":PERIODO1_1", $this->dados["Periodo1"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADES1", $this->dados["Atividades1"], PDO::PARAM_STR);

            $cst->bindParam(":EMPRESA2", $this->dados["Empresa2"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO2", $this->dados["Função2"], PDO::PARAM_STR);
            $cst->bindParam(":SALARIO2", $this->dados["Salario2"], PDO::PARAM_STR);
            $cst->bindParam(":PERIODO2_1", $this->dados["Periodo2"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADES2", $this->dados["Atividades2"], PDO::PARAM_STR);

            $cst->bindParam(":EMPRESA3", $this->dados["Empresa3"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO3", $this->dados["Função3"], PDO::PARAM_STR);
            $cst->bindParam(":SALARIO3", $this->dados["Salario3"], PDO::PARAM_STR);
            $cst->bindParam(":PERIODO3_1", $this->dados["Periodo3"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADES3", $this->dados["Atividades3"], PDO::PARAM_STR);

            $cst->bindParam(":OBS_ENTREVISTADOR", $this->dados["Parecer"], PDO::PARAM_STR);

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

            $Sql = "UPDATE tb_candidatos SET NOME=:NOME, SEXO=:SEXO, DATA_NASC=:DATA_NASC, IDADE=:IDADE, ESTADO_CIVIL=:ESTADO_CIVIL,"
                    . "NOME_CONJUGE=:NOME_CONJUGE, QTD_FILHOS=:QTD_FILHOS, NOME_MAE=:NOME_MAE, "
                    . "CEP=:CEP, ENDERECO=:ENDERECO, BAIRRO=:BAIRRO, CIDADE=:CIDADE, UF=:UF, "
                    . "EMAIL=:EMAIL, CELULAR=:CELULAR, FACEBOOK=:FACEBOOK, INSTAGRAN=:INSTAGRAN, "
                    . "ESCOLARIDADE=:ESCOLARIDADE, CURSO=:CURSO, CURSO_EXTRA1=:CURSO_EXTRA1, CURSO_EXTRA2=:CURSO_EXTRA2, CURSO_EXTRA3=:CURSO_EXTRA3, "
                    . "CARGO_PRETENDIDO=:CARGO_PRETENDIDO, IDENTIDADE=:IDENTIDADE, CPF=:CPF, PIS=:PIS, CTPS=:CTPS, TITULO_ELEITOR=:TITULO_ELEITOR, "
                    . "EMPRESA1=:EMPRESA1, CARGO1=:CARGO1, SALARIO1=:SALARIO1, PERIODO1_1=:PERIODO1_1, ATIVIDADES1=:ATIVIDADES1, "
                    . "EMPRESA2=:EMPRESA2, CARGO2=:CARGO2, SALARIO2=:SALARIO2, PERIODO2_1=:PERIODO2_1, ATIVIDADES2=:ATIVIDADES2, "
                    . "EMPRESA3=:EMPRESA3, CARGO3=:CARGO3, SALARIO3=:SALARIO3, PERIODO3_1=:PERIODO3_1, ATIVIDADES3=:ATIVIDADES3, "
                    . "OBS_ENTREVISTADOR=:OBS_ENTREVISTADOR, DEFICIENTE=:DEFICIENTE  WHERE PK_COD=:PK_COD;";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados["Pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":NOME", $this->dados["Nome"], PDO::PARAM_STR);
            $cst->bindParam(":SEXO", $this->dados["Gênero"], PDO::PARAM_STR);
            $cst->bindParam(":DATA_NASC", $this->dados["Data_nasc"], PDO::PARAM_STR);
            $cst->bindParam(":IDADE", $this->dados["Idade"], PDO::PARAM_STR);
            $cst->bindParam(":ESTADO_CIVIL", $this->dados["Estado_Civil"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_CONJUGE", $this->dados["Nome_conj"], PDO::PARAM_STR);
            $cst->bindParam(":QTD_FILHOS", $this->dados["Filhos"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_MAE", $this->dados["Nome_mae"], PDO::PARAM_STR);
            $cst->bindParam(":DEFICIENTE", $this->dados["Deficiente"], PDO::PARAM_STR);

            $cst->bindParam(":CEP", $this->dados["Cep"], PDO::PARAM_STR);
            $cst->bindParam(":ENDERECO", $this->dados["Endereco"], PDO::PARAM_STR);
            $cst->bindParam(":BAIRRO", $this->dados["Bairro"], PDO::PARAM_STR);
            $cst->bindParam(":CIDADE", $this->dados["Cidade"], PDO::PARAM_STR);
            $cst->bindParam(":UF", $this->dados["Uf"], PDO::PARAM_STR);
            $cst->bindParam(":FACEBOOK", $this->dados["Facebook"], PDO::PARAM_STR);
            $cst->bindParam(":INSTAGRAN", $this->dados["Instagran"], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL", $this->dados["Email"], PDO::PARAM_STR);
            $cst->bindParam(":CELULAR", $this->dados["Celular"], PDO::PARAM_STR);
            
            $cst->bindParam(":CARGO_PRETENDIDO", $this->dados["Cargo_pretend"], PDO::PARAM_STR);
            $cst->bindParam(":IDENTIDADE", $this->dados["Identidade"], PDO::PARAM_STR);
            $cst->bindParam(":CPF", $this->dados["CPF"], PDO::PARAM_STR);
            $cst->bindParam(":PIS", $this->dados["PIS"], PDO::PARAM_STR);
            $cst->bindParam(":CTPS", $this->dados["ctps"], PDO::PARAM_STR);
            $cst->bindParam(":TITULO_ELEITOR", $this->dados["titulo"], PDO::PARAM_STR);

            $cst->bindParam(":ESCOLARIDADE", $this->dados["Escolaridade"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO", $this->dados["Curso"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO_EXTRA1", $this->dados["Curso_extra1"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO_EXTRA2", $this->dados["Curso_extra2"], PDO::PARAM_STR);
            $cst->bindParam(":CURSO_EXTRA3", $this->dados["Curso_extra3"], PDO::PARAM_STR);

            $cst->bindParam(":EMPRESA1", $this->dados["Empresa1"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO1", $this->dados["Função1"], PDO::PARAM_STR);
            $cst->bindParam(":SALARIO1", $this->dados["Salario1"], PDO::PARAM_STR);
            $cst->bindParam(":PERIODO1_1", $this->dados["Periodo1"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADES1", $this->dados["Atividades1"], PDO::PARAM_STR);

            $cst->bindParam(":EMPRESA2", $this->dados["Empresa2"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO2", $this->dados["Função2"], PDO::PARAM_STR);
            $cst->bindParam(":SALARIO2", $this->dados["Salario2"], PDO::PARAM_STR);
            $cst->bindParam(":PERIODO2_1", $this->dados["Periodo2"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADES2", $this->dados["Atividades2"], PDO::PARAM_STR);

            $cst->bindParam(":EMPRESA3", $this->dados["Empresa3"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO3", $this->dados["Função3"], PDO::PARAM_STR);
            $cst->bindParam(":SALARIO3", $this->dados["Salario3"], PDO::PARAM_STR);
            $cst->bindParam(":PERIODO3_1", $this->dados["Periodo3"], PDO::PARAM_STR);
            $cst->bindParam(":ATIVIDADES3", $this->dados["Atividades3"], PDO::PARAM_STR);

            $cst->bindParam(":OBS_ENTREVISTADOR", $this->dados["Parecer"], PDO::PARAM_STR);

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
            $sql = "DELETE FROM tb_candidatos WHERE PK_COD=:PK_COD LIMIT 1;";
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
    public function delete($data) {
        try {
            // deletar produtos
            $this->dados = filter_var($data, FILTER_VALIDATE_INT);

            $sql = "DELETE FROM tb_candidatos WHERE PK_COD=:PK_COD LIMIT 1;";
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

    public function candidatoId($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT FK_CAND, CANDIDATO FROM tb_encaminhamentos where Fk_CAND = :PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }
/**
 * 
 * @param type $dado
 * @return type
 */
    public function candidatosCPF($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT PK_COD, CPF, NOME  FROM tb_candidatos WHERE CPF = :CPF";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":CPF", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

    public function totalCadastrados() {

        try {
            $Sql = "SELECT COUNT(PK_COD) AS QUANT FROM tb_candidatos";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function cadastroCandDia() {

        try {
            $this->dados = dataAtual(3);
            $sql = "SELECT Count(PK_COD) AS QUANT, DATE_FORMAT(DATA,'%d/%m/%Y') AS DATA_FOR FROM tb_candidatos WHERE DATE_FORMAT(DATA,'%d/%m/%Y')=:datadia";
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(':datadia', $this->dados, PDO::PARAM_STR);
            $cst->execute();
            return $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

        public function buscarGrafico() {

        try {
            $sql = "SELECT COUNT(PK_COD) AS QUANT, MONTH(DATA) AS MES FROM tb_candidatos "
                . "GROUP BY MES ORDER By MONTH(DATA) ASC";
            $cst = $this->conn->prepare($sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }
    
            public function buscarGrafico1() {

        try {
            $sql = "SELECT COUNT(PK_COD) AS QUANT, SEXO FROM tb_candidatos GROUP BY SEXO";
            $cst = $this->conn->prepare($sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }
    
     public function buscarGrafico2() {

        try {
            $sql = "SELECT COUNT(PK_COD) AS QUANT, month(DATA) as MES FROM tb_encaminhamentos GROUP BY MES ORDER By MES ASC;";
            $cst = $this->conn->prepare($sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }
    
    
}
