<?php

namespace App\Models;

use PDO;

/**
 * Description of EntradaEstoque.
 *
 * @author Mare
 */
class Vagas extends Conn
{
    private $Parametros;
    private $Opcao;
    private $dados;
    private $resultado = false;
    private $resultadoBd;
    private $conn;

    public function getResultado(): bool
    {
        return $this->resultado;
    }

    /**
     * construtor.
     */
    public function __construct()
    {
        $this->conn = $this->connect();
    }

    /**
     * @param type $atributo
     * @param type $valor
     *
     * @return $this
     */
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
        return $this;
    }

    /**
     * @param type $atributo
     *
     * @return type
     */
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    /**
     * @param type $dados
     *
     * @return type
     */
    public function pesquisar($dados)
    {
        $this->dados = $dados;
        try {
            $this->Parametros  = $this->dados['Parametros'];
            $this->Opcao       = $this->dados['Opcao'];
            $Sql               = "SELECT * FROM tb_vaga where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $cst               = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(\PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                echo ajaxResponse('redirect',
                    [
                    'url' => site('root').'vagas/index',
                ]);
                $_SESSION['vagaPesquis'] = $this->resultadoBd;
            }
            else {
                $this->resultado = false;
                unset($_SESSION['vagaPesquis']);
                echo ajaxResponse('message',
                    [
                    'type' => 'error',
                    'message' => 'Vaga não encontrada!',
                ]);

                return;
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @param type $dado
     *
     * @return type
     */
    public function empresaId($dado)
    {
        $this->dados = $dado;
        try {
            $Sql               = 'SELECT * FROM tb_empresas_parceiras WHERE PK_COD=:PK_COD';
            $cst               = $this->conn->prepare($Sql);
            $cst->bindParam(':PK_COD', $this->dados, \PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(\PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['Empresa'] = $this->resultadoBd;
                $this->resultado     = true;
                $urlDestino          = site('root').'vagas/index';
                header("Location: $urlDestino");
            }
            else {
                $this->resultado = false;
                unset($_SESSION['Empresa']);
                echo ajaxResponse('message',
                    [
                    'type' => 'error',
                    'message' => 'Empresa não encontrada!',
                ]);

                return;
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @return string
     */
    public function delete($data)
    {
        try {
            // deletar produtos
            $this->dados = filter_var($data, FILTER_VALIDATE_INT);

            $sql = 'DELETE FROM tb_vaga WHERE PK_COD=:PK_COD LIMIT 1;';
            $cst = $this->conn->prepare($sql);
            $cst->bindParam(':PK_COD', $this->dados, \PDO::PARAM_INT);
            if ($cst->execute()) {
                $this->resultado = true;

                return;
            }
            else {
                return 'erro delete';
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @param type $dado
     *
     * @return type
     */
    public function encaminhamentosId($dado)
    {
        try {
            $this->dados       = $dado;
            $Sql               = 'SELECT FK_VAGA, EMPRESA FROM tb_encaminhamentos where FK_VAGA = :PK_COD';
            $cst               = $this->conn->prepare($Sql);
            $cst->bindParam(':PK_COD', $this->dados, \PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
        finally {
            return $this->resultadoBd;
        }
    }

    /**
     * @param type $dado
     *
     * @return type
     */
    public function vagasId($dado)
    {
        try {
            $this->dados       = $dado;
            $Sql               = 'SELECT PK_COD, STATUS_VAGA FROM tb_vaga where PK_COD=:PK_COD;';
            $cst               = $this->conn->prepare($Sql);
            $cst->bindParam(':PK_COD', $this->dados, \PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
        }
        finally {
            return $this->resultadoBd;
        }
    }

    /**
     * @param type $dado
     *
     * @return type
     */
    public function ConsultarId($dado)
    {
        $this->dados = $dado;
        try {
            $Sql               = 'SELECT * FROM tb_vaga WHERE PK_COD=:PK_COD';
            $cst               = $this->conn->prepare($Sql);
            $cst->bindParam(':PK_COD', $this->dados, \PDO::PARAM_INT);
            $cst->execute();
            $this->resultadoBd = $cst->fetch(\PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['vaga'] = $this->resultadoBd;
                $this->resultado  = true;
                $urlDestino       = site('root').'vagas/index';
                header("Location: $urlDestino");
            }
            else {
                $this->resultado = false;
                unset($_SESSION['vaga']);
                echo ajaxResponse('message',
                    [
                    'type' => 'error',
                    'message' => 'Vaga não encontrada!',
                ]);

                return;
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * Cadastro de Nota e Atualização do Estoque e compras.
     *
     * @return string
     */
    public function insert(array $dados = null)
    {
        try {
            $this->dados = $dados;
            $Sql         = 'INSERT INTO tb_vaga (CARGO, SALARIO, FORMACAO, LOCAL_VAGA, EXPERIENCIA, ATIVIDADES, FK_EMPRESA, EMPRESA,'
                .' CNPJ, STATUS_VAGA, DATA_ABERTURA, DATA_FECHAMENTO, QTD_VAGA) '
                .' VALUES(:CARGO, :SALARIO, :FORMACAO, :LOCAL_VAGA, :EXPERIENCIA, :ATIVIDADES, :FK_EMPRESA, :EMPRESA,'
                .' :CNPJ, :STATUS_VAGA, :DATA_ABERTURA, :DATA_FECHAMENTO, :QTD_VAGA);';

            $cst = $this->conn->prepare($Sql);
            // $cst->bindParam(":PK_COD", $this->dados["Codigo_vaga"], PDO::PARAM_INT);
            $cst->bindParam(':EMPRESA', $this->dados['Descricaoempre'],
                \PDO::PARAM_STR);
            $cst->bindParam(':CNPJ', $this->dados['CNPJempre'], \PDO::PARAM_STR);
            $cst->bindParam(':FK_EMPRESA', $this->dados['Codigo_emp'],
                \PDO::PARAM_STR);
            $cst->bindParam(':DATA_ABERTURA', $this->dados['Data_abertura'],
                \PDO::PARAM_STR);
            $cst->bindParam(':DATA_FECHAMENTO', $this->dados['Data_fechar'],
                \PDO::PARAM_STR);
            $cst->bindParam(':STATUS_VAGA', $this->dados['Status_Vaga'],
                \PDO::PARAM_STR);
            $cst->bindParam(':QTD_VAGA', $this->dados['Qtda_vaga'],
                \PDO::PARAM_STR);
            $cst->bindParam(':LOCAL_VAGA', $this->dados['Local_trab'],
                \PDO::PARAM_STR);
            $cst->bindParam(':CARGO', $this->dados['Cargo_prent'],
                \PDO::PARAM_STR);
            $cst->bindParam(':SALARIO', $this->dados['Salario'], \PDO::PARAM_STR);
            $cst->bindParam(':FORMACAO', $this->dados['Formacao'],
                \PDO::PARAM_STR);
            $cst->bindParam(':EXPERIENCIA', $this->dados['Qualificaçoes'],
                \PDO::PARAM_STR);
            $cst->bindParam(':ATIVIDADES', $this->dados['Atividades'],
                \PDO::PARAM_STR);
            $cst->execute();

            $this->resultado = true;

            return;
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @return string
     */
    public function update(array $dados = null)
    {
        try {
            $this->dados = $dados;

            $Sql = 'UPDATE tb_vaga SET CARGO=:CARGO, SALARIO=:SALARIO, FORMACAO=:FORMACAO, LOCAL_VAGA=:LOCAL_VAGA, EXPERIENCIA=:EXPERIENCIA, '
                .'ATIVIDADES=:ATIVIDADES, FK_EMPRESA=:FK_EMPRESA, EMPRESA=:EMPRESA, CNPJ=:CNPJ, STATUS_VAGA=:STATUS_VAGA, '
                .'DATA_ABERTURA=:DATA_ABERTURA, DATA_FECHAMENTO=:DATA_FECHAMENTO, QTD_VAGA=:QTD_VAGA WHERE PK_COD=:PK_COD;';

            $cst = $this->conn->prepare($Sql);
            $cst->bindParam(':PK_COD', $this->dados['Codigo_vaga'],
                \PDO::PARAM_INT);
            $cst->bindParam(':EMPRESA', $this->dados['Descricaoempre'],
                \PDO::PARAM_STR);
            $cst->bindParam(':CNPJ', $this->dados['CNPJempre'], \PDO::PARAM_STR);
            $cst->bindParam(':FK_EMPRESA', $this->dados['Codigo_emp'],
                \PDO::PARAM_STR);
            $cst->bindParam(':DATA_ABERTURA', $this->dados['Data_abertura'],
                \PDO::PARAM_STR);
            $cst->bindParam(':DATA_FECHAMENTO', $this->dados['Data_fechar'],
                \PDO::PARAM_STR);
            $cst->bindParam(':STATUS_VAGA', $this->dados['Status_Vaga'],
                \PDO::PARAM_STR);
            $cst->bindParam(':QTD_VAGA', $this->dados['Qtda_vaga'],
                \PDO::PARAM_STR);
            $cst->bindParam(':LOCAL_VAGA', $this->dados['Local_trab'],
                \PDO::PARAM_STR);
            $cst->bindParam(':CARGO', $this->dados['Cargo_prent'],
                \PDO::PARAM_STR);
            $cst->bindParam(':SALARIO', $this->dados['Salario'], \PDO::PARAM_STR);
            $cst->bindParam(':FORMACAO', $this->dados['Formacao'],
                \PDO::PARAM_STR);
            $cst->bindParam(':EXPERIENCIA', $this->dados['Qualificaçoes'],
                \PDO::PARAM_STR);
            $cst->bindParam(':ATIVIDADES', $this->dados['Atividades'],
                \PDO::PARAM_STR);

            if ($cst->execute()) {
                $this->resultado = true;

                return;
            }
            else {
                return 'erro';
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @return type
     */
    public function buscarTodos()
    {
        try {
            $Sql = 'SELECT * FROM tb_vaga ORDER By PK_COD ASC';
            $cst = $this->conn->prepare($Sql);
            $cst->execute();

            return $cst->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    public function totalCadastrados()
    {
        try {
            $Sql = 'SELECT COUNT(PK_COD) AS QUANT FROM tb_vaga';
            $cst = $this->conn->prepare($Sql);
            $cst->execute();

            return $cst->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function buscarVagaEncaminhar($dado)
    {
        try {
            $this->Cod_prod = $dado;
            $Sql            = 'SELECT tb_vaga.PK_COD, tb_vaga.CARGO, tb_vaga.FK_EMPRESA, tb_vaga.EMPRESA, tb_vaga.CNPJ,'
                .'tb_empresas_parceiras.CNPJ, tb_empresas_parceiras.RESPONSAVEL, tb_empresas_parceiras.TEL_RESPONS, tb_empresas_parceiras.EMAIL, '
                .'tb_empresas_parceiras.CEP, tb_empresas_parceiras.ENDERECO, tb_empresas_parceiras.BAIRRO, '
                .'tb_empresas_parceiras.CIDADE, tb_empresas_parceiras.UF FROM tb_vaga '
                .'JOIN tb_empresas_parceiras ON tb_empresas_parceiras.CNPJ=tb_vaga.CNPJ '
                ."WHERE tb_vaga.PK_COD LIKE '%$this->Cod_prod%';";
            $cst            = $this->conn->prepare($Sql);
            $cst->execute();

            return $cst->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @param type $dados
     *
     * @return type
     */
    public function pesquisarRelatorio($dados)
    {
        try {
            $this->dados      = $dados;
            $this->Parametros = $this->dados['Parametros'];
            $this->Opcao      = $this->dados['Opcao'];
            $Sql              = "SELECT * FROM tb_vaga where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";
            $Sql1             = "SELECT COUNT(PK_COD) as Quant FROM tb_vaga where $this->Opcao LIKE '%$this->Parametros%' ORDER By PK_COD ASC";

            $cst               = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(\PDO::FETCH_ASSOC);

            $cst   = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(\PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['vagasConsulta'] = $this->resultadoBd;
                $_SESSION['count']         = $count;
                $this->resultado           = true;
                echo ajaxResponse('redirect',
                    [
                    'url' => site('root').'vagas/relatorioVagas',
                ]);
            }
            else {
                $this->resultado = false;
                unset($_SESSION['vagasConsulta']);
                echo ajaxResponse('message',
                    [
                    'type' => 'error',
                    'message' => 'Vaga não encontrado!',
                ]);

                return;
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @return type
     */
    public function pesquisarRelatorioTodos()
    {
        try {
            $Sql  = 'SELECT * FROM tb_vaga';
            $Sql1 = 'SELECT COUNT(PK_COD) as Quant FROM tb_vaga';

            $cst               = $this->conn->prepare($Sql);
            $cst->execute();
            $this->resultadoBd = $cst->fetchAll(\PDO::FETCH_ASSOC);

            $cst   = $this->conn->prepare($Sql1);
            $cst->execute();
            $count = $cst->fetch(\PDO::FETCH_ASSOC);

            if ($this->resultadoBd) {
                $_SESSION['vagasConsulta'] = $this->resultadoBd;
                $_SESSION['count']         = $count;
                $this->resultado           = true;
                echo ajaxResponse('redirect',
                    [
                    'url' => site('root').'vagas/relatorioVagas',
                ]);
            }
            else {
                $this->resultado = false;
                unset($_SESSION['vagasConsulta']);
                echo ajaxResponse('message',
                    [
                    'type' => 'error',
                    'message' => 'Vaga não encontrado!',
                ]);

                return;
            }
        }
        catch (\PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    /**
     * @return type
     */
    public function vagasAbertas()
    {
        try {
            $Sql = "SELECT * FROM tb_vaga where STATUS_VAGA='Aberta';";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();

            return $cst->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    /**
     * @return type
     */
    public function vagasEmSelecao()
    {
        try {
            $Sql = "SELECT * FROM tb_vaga where STATUS_VAGA='Em Selecao';";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();

            return $cst->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    /**
     * @return type
     */
    public function vagasEncaminhadas()
    {
        try {
            // $mes = dataAtual(11);
            // $Sql = "SELECT * FROM tb_vaga where STATUS_VAGA='Encaminhados' and month(DATA) = $mes";
            $Sql = "SELECT * FROM tb_vaga where STATUS_VAGA='Encaminhados'";
            $cst = $this->conn->prepare($Sql);
            $cst->execute();

            return $cst->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }

    public function buscarGrafico()
    {
        try {
            $sql = 'SELECT COUNT(PK_COD) AS QUANT, MONTH(DATA) AS MES '
                .'FROM tb_vaga GROUP BY MES ORDER By MONTH(DATA) ASC';
            $cst = $this->conn->prepare($sql);
            $cst->execute();

            return $cst->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }
}