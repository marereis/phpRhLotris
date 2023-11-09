<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * Description of VendaProdutos
 *
 * @author Mare
 */
class Encaminhamentos extends Conn {

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
            $Sql = "SELECT * FROM tb_encaminhamentos WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['encaminhar'] = $this->resultadoBd;
                $this->resultado = true;
                $urlDestino = site("root") . 'encaminhamentos/index';
                header("Location: $urlDestino");
            } else {
                $this->resultado = false;
                unset($_SESSION['encaminhar']);
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
     * @param array $dados
     * @return string
     */
    public function delete($data) {
        try {
            // deletar produtos
            $this->dados = filter_var($data, FILTER_VALIDATE_INT);

            $sql = "DELETE FROM tb_encaminhamentos WHERE PK_COD=:PK_COD LIMIT 1;";
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
     * @param type $dados
     * @return type
     */
    public function pesquisar($dados) {
        $this->dados = $dados;
//        var_dump($this->dados);
//        die();
        try {
            $this->Parametros = $this->dados["Parametros"];
            $this->Opcao = $this->dados["Opcao"];
            $Sql = "SELECT * FROM tb_encaminhamentos where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                echo ajaxResponse("redirect", [
                    "url" => site('root') . 'encaminhamentos/index'
                ]);
                $_SESSION['encarConsult'] = $this->resultadoBd;
            } else {
                $this->resultado = false;
                unset($_SESSION['encarConsult']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Encaminhamentos não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * consulta produto por ID
     * @param type $dado
     * @return type
     */
    public function dadosCartaEnc() {

        try {
            $Sqlid = "SELECT max(PK_COD) AS ID_ULTIMO FROM bdrh.tb_encaminhamentos;";
            $cst1 = $this->conn->prepare($Sqlid);
            $cst1->execute();
            $this->resultadoBd = $cst1->fetch(PDO::FETCH_ASSOC);

            $Sql = "SELECT * FROM tb_encaminhamentos WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->resultadoBd["ID_ULTIMO"], PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['encaminharPDF'] = $this->resultadoBd;
                $this->resultado = true;
                return $this->resultadoBd;
            } else {
                $this->resultado = false;
                unset($_SESSION['encaminharPDF']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Encaminhamento não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * consulta produto por ID
     * @param type $dado
     * @return type
     */
    public function dadosCartaEncEmail($dados) {
        $this->dados = $dados;
        try {
            $Sql = "SELECT * FROM tb_encaminhamentos WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['encaminharPDF'] = $this->resultadoBd;
                $this->resultado = true;
                return $this->resultadoBd;
            } else {
                $this->resultado = false;
                unset($_SESSION['encaminharPDF']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Encaminhamento não encontrado!"
                ]);
                return;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * Cadastro de Venda 
     * @param array $dados
     * @return string
     */
    public function insert(array $dados = null) {
        try {
            $this->dados = $dados;
            $encami_tipo_email = 'carta';
//            var_dump($this->dados);
//            die();
            $Sql = "INSERT INTO tb_encaminhamentos(DATA_EMISSAO, DATA_ENTREVISTA,HORA_ENTREVISTA,FK_CAND,CANDIDATO,TEL_CAND,"
                    . "EMAIL_CAND,FK_VAGA,CARGO_PRETENDIDO,FK_EMPRESA,EMPRESA,CEP,ENDERECO,BAIRRO,CIDADE,UF,NOME_CONTATO,TEL_CONTATO,"
                    . "STATUS_ENCAMI,EMAIL_ENCAM_EMPRE,TIPO_ENCAMI) VALUES (:DATA_EMISSAO, :DATA_ENTREVISTA,:HORA_ENTREVISTA,:FK_CAND,:CANDIDATO,:TEL_CAND,:EMAIL_CAND,:FK_VAGA,"
                    . ":CARGO_PRETENDIDO,:FK_EMPRESA,:EMPRESA,:CEP,:ENDERECO,:BAIRRO,:CIDADE,:UF,:NOME_CONTATO,:TEL_CONTATO,:STATUS_ENCAMI,:EMAIL_ENCAM_EMPRE,:TIPO_ENCAMI);";

            $cst = $this->conn->prepare($Sql);
            // $cst->bindParam(":PK_COD", $this->dados["Pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":DATA_EMISSAO", $this->dados["data_emisssao"], PDO::PARAM_STR);
            $cst->bindParam(":DATA_ENTREVISTA", $this->dados["data_entrev"], PDO::PARAM_STR);
            $cst->bindParam(":HORA_ENTREVISTA", $this->dados["hora_entrev"], PDO::PARAM_STR);
            $cst->bindParam(":FK_CAND", $this->dados["pk_cod_cand"], PDO::PARAM_STR);
            $cst->bindParam(":CANDIDATO", $this->dados["nome_cand"], PDO::PARAM_STR);
            $cst->bindParam(":TEL_CAND", $this->dados["tel_cand"], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL_CAND", $this->dados["email_cand"], PDO::PARAM_STR);
            $cst->bindParam(":FK_VAGA", $this->dados["Codigo_vaga"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO_PRETENDIDO", $this->dados["Cargo_prent"], PDO::PARAM_STR);
            $cst->bindParam(":FK_EMPRESA", $this->dados["pk_cod_empre"], PDO::PARAM_STR);
            $cst->bindParam(":EMPRESA", $this->dados["razao_social"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_CONTATO", $this->dados["responsavel"], PDO::PARAM_STR);
            $cst->bindParam(":TEL_CONTATO", $this->dados["tel_respon"], PDO::PARAM_STR);
            $cst->bindParam(":EMAIL_ENCAM_EMPRE", $this->dados["email_empresa_par"], PDO::PARAM_STR);
            $cst->bindParam(":TIPO_ENCAMI", $encami_tipo_email, PDO::PARAM_STR);

            $cst->bindParam(":STATUS_ENCAMI", $this->dados["Status_encami"], PDO::PARAM_STR);
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

            $Sql = "UPDATE tb_encaminhamentos SET PK_COD=:PK_COD, STATUS_ENCAMI=:STATUS_ENCAMI WHERE PK_COD=:PK_COD;";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados["Pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":STATUS_ENCAMI", $this->dados["Status_encami"], PDO::PARAM_STR);

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
     * ALETRAR O TIPO DE ENVIO DO ENCAMINHAMENTO 
     * @param array $dados
     * @return string
     */
    public function updateTipoEncaminhamento(array $dados = null) {
        try {
            $this->dados = $dados;
            $encami_tipo_email = 'email';

            $Sql = "UPDATE tb_encaminhamentos SET PK_COD=:PK_COD, TIPO_ENCAMI=:TIPO_ENCAMI WHERE PK_COD=:PK_COD;";

            foreach ($this->dados as $value) {
                $cst = $this->conn->prepare($Sql);
                $cst->bindParam(":PK_COD", $value["codEncamCE"], PDO::PARAM_INT);
                $cst->bindParam(":TIPO_ENCAMI", $encami_tipo_email, PDO::PARAM_STR);
                $cst->execute();
            }
            $this->resultado = true;
            return;
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param array $dados
     * @return string
     */
    public function updateAtualizaVaga(array $dados = null) {
        try {
            $this->dados = $dados;
            $novoStatus = "Encaminhados";

            $Sql = "UPDATE tb_vaga SET STATUS_VAGA=:STATUS_VAGA WHERE PK_COD=:PK_COD;";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados["Codigo_vaga"], PDO::PARAM_INT);
            $cst->bindParam(":STATUS_VAGA", $novoStatus, PDO::PARAM_STR);

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
     * UPDATE CANCELADO
     * @param array $dados
     * @return string
     */
    public function updateeeeeeeeeeeeeeeee(array $dados = null) {
        try {
            $this->dados = $dados;

            $Sql = "UPDATE tb_encaminhamentos SET PK_COD=:PK_COD, DATA_EMISSAO=:DATA_EMISSAO,DATA_ENTREVISTA=:DATA_ENTREVISTA, "
                    . "HORA_ENTREVISTA=:HORA_ENTREVISTA,FK_VAGA=:FK_VAGA,CARGO_PRETENDIDO=:CARGO_PRETENDIDO,"
                    . "FK_EMPRESA=:FK_EMPRESA,EMPRESA=:EMPRESA,CEP=:CEP,ENDERECO=:ENDERECO,"
                    . "BAIRRO=:BAIRRO,CIDADE=:CIDADE,UF=:UF,NOME_CONTATO=:NOME_CONTATO,TEL_CONTATO=:TEL_CONTATO "
                    . "WHERE PK_COD=:PK_COD;";

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados["Pk_cod"], PDO::PARAM_INT);
            $cst->bindParam(":DATA_EMISSAO", $this->dados["data_emisssao"], PDO::PARAM_STR);
            $cst->bindParam(":DATA_ENTREVISTA", $this->dados["data_entrev"], PDO::PARAM_STR);
            $cst->bindParam(":HORA_ENTREVISTA", $this->dados["hora_entrev"], PDO::PARAM_STR);
            $cst->bindParam(":FK_VAGA", $this->dados["Codigo_vaga"], PDO::PARAM_STR);
            $cst->bindParam(":CARGO_PRETENDIDO", $this->dados["Cargo_prent"], PDO::PARAM_STR);
            $cst->bindParam(":FK_EMPRESA", $this->dados["pk_cod_empre"], PDO::PARAM_STR);
            $cst->bindParam(":EMPRESA", $this->dados["razao_social"], PDO::PARAM_STR);
            $cst->bindParam(":NOME_CONTATO", $this->dados["responsavel"], PDO::PARAM_STR);
            $cst->bindParam(":TEL_CONTATO", $this->dados["tel_respon"], PDO::PARAM_STR);

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
     * @return type
     */
    public function encaminhadosDia() {

        try {
            $this->dados = dataAtual(3);
            $sql = "SELECT Count(PK_COD) AS QUANT, DATA_EMISSAO FROM tb_encaminhamentos WHERE DATA_EMISSAO=:datadia";
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(':datadia', $this->dados, PDO::PARAM_STR);
            $cst->execute();
            return $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param array $dados
     * @return type
     */
    public function encaminhamentoValidacao(array $dados = null) {
        try {
            $this->dados = $dados;
            $Sql = "SELECT  PK_COD, DATA, FK_CAND,FK_VAGA,FK_EMPRESA FROM  tb_encaminhamentos where FK_CAND=:FK_CAND and FK_VAGA=:FK_VAGA and FK_EMPRESA=:FK_EMPRESA;";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":FK_CAND", $this->dados["pk_cod_cand"], PDO::PARAM_INT);
            $cst->bindParam(":FK_VAGA", $this->dados["Codigo_vaga"], PDO::PARAM_INT);
            $cst->bindParam(":FK_EMPRESA", $this->dados["pk_cod_empre"], PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->resultadoBd;
        }
    }

    /**
     * 
     * @return type
     */
    public function buscarTodos() {
        try {
            $Sql = "SELECT * FROM tb_encaminhamentos ORDER By PK_COD ASC";
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
    public function buscarTodosMesAtual() {
        try {
            $mes = dataAtual(11);
            $Sql = "SELECT * FROM tb_encaminhamentos where month(DATA) = $mes ORDER By PK_COD ASC;";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
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
            $Sql = "SELECT * FROM tb_encaminhamentos where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_encaminhamentos where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['encaminharConsulta'] = $this->resultadoBd;
                $_SESSION['count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "encaminhamentos/relatorioEncaminhar"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['encaminharConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Encaminhamento não encontrado!"
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
            $Sql = "SELECT * FROM tb_encaminhamentos";
            $Sql1 = "SELECT COUNT(PK_COD) as Quant FROM tb_encaminhamentos";

            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(PDO::FETCH_ASSOC);

            $cst = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['encaminharConsulta'] = $this->resultadoBd;
                $_SESSION['count'] = $count;
                $this->resultado = true;
                echo ajaxResponse("redirect", [
                    "url" => site("root") . "encaminhamentos/relatorioEncaminhar"
                ]);
            } else {
                $this->resultado = false;
                unset($_SESSION['encaminharConsulta']);
                echo ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Encaminhamento não encontrado!"
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
    public function encaminhamentoId($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT FK_CAND, CANDIDATO FROM tb_encaminhamentos where FK_CAND = :PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
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
    public function encaminhamentoIdCE($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT * FROM tb_encaminhamentos where PK_COD = $this->dados";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();
            return $cst->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    /**
     * 
     * @param type $dado
     * @return type
     */
    public function buscarIdCurriculo($dado) {
        try {
            $this->dados = $dado;
            $Sql = "SELECT * FROM tb_candidatos WHERE PK_COD=:PK_COD";
            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(":PK_COD", $this->dados, PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['candidatoCurriculo'] = $this->resultadoBd;
                $this->resultado = true;
            } else {
                $this->resultado = false;
                unset($_SESSION['candidatoCurriculo']);
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
     * MONTA O CORPO MA MENSAGEM CONFORME DADOS DO ENCAMINHAMENTO
     * @param type $dados
     */
    public function dadosCartaEmail($dados) {
        $this->dados = $dados;
        try {

            //Recebe dados DO encaminhamento SELECIONADO
            $encaminharCans = $this->dadosCartaEncEmail($this->dados);

            // Pega os dados do Candidato do  canadidatO encaminhado E MONTA O CURRICULO
            $this->buscarIdCurriculo($encaminharCans["FK_CAND"]);
            $curriculo = array();
            if (!empty($_SESSION['candidatoCurriculo']) && $curriculo = $_SESSION['candidatoCurriculo']) {
                unset($_SESSION['candidatoCurriculo']);
            }

            $mensagem = '
            <div>           
            <img src="cid:logo" width="300" height="70" />
            <h3 style="text-align: right">ENCAMINHAMENTO</h3>
            </div>
            <fieldset style="border-radius: 6px; border-top-width: 10px; border-top-color:#000000 ;">
             Prezados Senhores: <br> 
             Envio carta de Encaminhamento  do candidato(a)  : <strong>' . $encaminharCans['CANDIDATO'] . '</strong> <br>
             para a vaga :<strong> ' . $encaminharCans['CARGO_PRETENDIDO'] . ' </strong>
           <hr> 
        <div>
        <p style="text-align: justify">Solicitamos a devolução de presente como resultado deste encaminhamento preenchido, 
        para que possamos efetuar nossos controles continuamos à disposição de V.S. no telefone (21) 98307-3707 </p>
        <p>Atenciosamente</p>
        <strong>RESULTADO DA SELEÇÃO</strong><br>
        (   ) Aceito na ocupação em referência – Data de Admissão:<br>
        (   ) Aceito na ocupação<br>
        (   ) Vaga já preenchida<br>
        (   ) Vaga já cancelada<br>
        (   ) Candidato Recusou a vaga<br>
        (   ) Reprovado no processo seleção<br>
        <p>Tipo de vaga colocada: (   ) aumento de quadro (   ) reposição</p>

        <p>Motivo: ____________________________________________________________________</p>
        </div></fieldset>
        <br> <br> 
<fieldset style="border-radius: 6px; border-top-width: 10px; border-top-color:#000000 ;">
        <P style="text-align: center"> <strong>Segue Curriculo do Candidato: </strong>  </p>     
<hr>
            <h3>' . $curriculo["NOME"] . '</h3>      
         
            <p>Endereço:' . $curriculo["ENDERECO"] . ' -  ' . $curriculo["BAIRRO"] . ' -      		
            CEP : ' . $curriculo["CEP"] . ' -  ' . $curriculo["CIDADE"] . ' - ' . $curriculo["UF"] . ' <br>     	  	
            Tel.: ' . $curriculo["CELULAR"] . ' -  e-mail: ' . $curriculo["EMAIL"] . ' <br>
            Nascido(a) em :' . conversordata($curriculo["DATA_NASC"], 1) . '  -  
            Idade : ' . $curriculo["IDADE"] . '  -  
           Estado civil : ' . $curriculo["ESTADO_CIVIL"] . ' </p>
            
           <p><strong>OBJETIVO: </strong>  ' . $curriculo["CARGO_PRETENDIDO"] . '</p>            
                 
                <strong>EXPERIÊNCIA PROFISSIONAL</strong>
            <p> - ' . $curriculo["EMPRESA1"] . ' <br> ' . $curriculo["CARGO1"] . ' </p>
            <p> - ' . $curriculo["EMPRESA2"] . ' <br> ' . $curriculo["CARGO2"] . ' </p>
            <p> - ' . $curriculo["EMPRESA3"] . ' <br> ' . $curriculo["CARGO3"] . ' </p> 
             
            <strong>FORMAÇÃO ACADÊMICA - CURSO</strong>
            <p> ' . $curriculo["ESCOLARIDADE"] . ' em ' . $curriculo["CURSO"] . ' </p> 
            <p> ' . $curriculo["CURSO_EXTRA1"] . ' <br>
             ' . $curriculo["CURSO_EXTRA2"] . ' <br>
             ' . $curriculo["CURSO_EXTRA3"] . ' </p>
            </fieldset>    
                ';
            $this->resultadoBd = $mensagem;

            if ($this->resultadoBd) {
                $_SESSION["msgEmail"] = $this->resultadoBd;
                $this->resultado = true;
            }
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
