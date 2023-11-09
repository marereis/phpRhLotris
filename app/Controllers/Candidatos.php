<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Core\View;

/**
 * Description of Produtos
 *
 * @author Mare
 */
class Candidatos
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\Candidatos();
    }

    /**
     * renderiza candidatos
     */
    public function index()
    {
        View::renderTemplate('pages\candidatos');
    }

    /**
     * renderiza ralatorio de candidatos
     */
    public function relatorioCandidatos()
    {
        View::renderTemplate('pages\relatorioCandidatos');
    }

    /**
     * metodo de cadastramento
     */
    public function cadastrar()
    {
        $data        = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        $camposObrigatorios = array($this->dados["Nome"], $this->dados["Data_nasc"],
            $this->dados["Idade"], $this->dados["Filhos"], $this->dados["Nome_mae"],
            $this->dados["Deficiente"], $this->dados["Cep"], $this->dados["Endereco"],
            $this->dados["Bairro"], $this->dados["Cidade"], $this->dados["Email"],
            $this->dados["Celular"], $this->dados["Identidade"], $this->dados["CPF"],
            $this->dados["Curso"], $this->dados["Escolaridade"]);

        if (in_array("", $camposObrigatorios)) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Preencha os campos (Dados Pessoais, Endereço/contatos e Formação) pra cadastra-se"
            ]);
            return;
        }
        elseif ($this->objModal->candidatosCPF($this->dados["CPF"]) > 0) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Candidato ja Cadastrado= ".$this->dados["Nome"]." - ".$this->dados["CPF"]." !"
            ]);
            return;
        }
        else {
            $this->objModal->insert($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect",
                    [
                    "url" => site('root').'candidatos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Candidato Cadastrado com sucesso!</div>';
            }
            else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * metodo de alteração
     */
    public function alterar()
    {
        $data        = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        $camposObrigatorios = array($this->dados["Nome"], $this->dados["Data_nasc"],
            $this->dados["Idade"], $this->dados["Filhos"], $this->dados["Nome_mae"],
            $this->dados["Deficiente"], $this->dados["Cep"], $this->dados["Endereco"],
            $this->dados["Bairro"], $this->dados["Cidade"], $this->dados["Email"],
            $this->dados["Celular"], $this->dados["Identidade"], $this->dados["CPF"],
            $this->dados["Curso"], $this->dados["Escolaridade"]);

        if (in_array("", $camposObrigatorios)) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Preencha os campos (Dados Pessoais, Endereço/contatos e Formação) pra Alterar-se"
            ]);
            return;
        }
        else {
            $this->objModal->update($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect",
                    [
                    "url" => site('root').'candidatos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Candidato Alterado com sucesso!</div>';
            }
            else {
                $this->dados['form'] = $this->dados;
            }
        }
    }
    /**
     * 
     * @return type
     */
    public function deletar()
    {
        $data        = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        $camposObrigatorios = array($this->dados["Pk_cod"], $this->dados["Nome"],
            $this->dados["Data_nasc"], $this->dados["Idade"], $this->dados["Filhos"],
            $this->dados["Nome_mae"], $this->dados["Deficiente"], $this->dados["Cep"],
            $this->dados["Endereco"], $this->dados["Bairro"], $this->dados["Cidade"],
            $this->dados["Email"], $this->dados["Celular"], $this->dados["Identidade"],
            $this->dados["CPF"], $this->dados["Curso"], $this->dados["Escolaridade"]);

        if (in_array("", $camposObrigatorios)) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Preencha os campos (Dados Pessoais, Endereço/contatos e Formação) pra Deletar-se"
            ]);
            return;
        }
        elseif ($this->objModal->candidatoId($this->dados["Pk_cod"]) > 0) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Não e possivel excluir CANDIDATO = ".$this->dados["Nome"]." ** EXISTE ENCAMINHAMENTO! **"
            ]);
            return;
        }
        else {

            $this->objModal->delete($this->dados["Pk_cod"]);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse("redirect",
                    [
                    "url" => site('root').'candidatos/index'
                ]);
                $_SESSION['msg'] = '<div class="message success">Candidato Deletado com sucesso!</div>';
            }
            else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * consulta candidatos
     */
    public function consultar()
    {
        $data        = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Consultar-se"
            ]);
            return;
        }
        else {
            $this->objModal->Pesquisar($this->dados);
        }
    }

    /**
     * consulta candidatos
     */
    public function consultarRelatorio()
    {
        $data        = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array("", $this->dados)) {
            $this->objModal->PesquisarRelatorioTodos();
            return;
        }
        else {
            $this->objModal->PesquisarRelatorio($this->dados);
        }
    }

    /**
     * relatorio de candidatos PDF
     */
    public function relatorioPDF()
    {
        $dompdf = new Dompdf();

        ob_start();
        require_once './resources/views/pages/RelatCandidatosPDF.php';
        $dompdf->loadHtml(ob_get_clean());

        $dompdf->set_options(["isRemoteEnabled" => true]);

        //orientação e tipo de papel
        $dompdf->setPaper('A4', 'portrait');
        //Renderizar o html
        $dompdf->render();
        //Exibibir a página
        $dompdf->stream(
            "Relat_Candidatos_PDF.pdf",
            [
                "Attachment" => false //Para realizar o download somente alterar para true
            ]
        );
    }

    /**
     * consulta todos
     */
    public function consultarAll()
    {
        $this->objModal->BuscarTodos();
    }

    /**
     * consultar por id
     * @param type $data
     * @return type
     */
    public function consultarId($data)
    {
        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse("message",
                [
                "type" => "info",
                "message" => "Preencha tudos os campo pra Consulta-se ProdutoID"
            ]);
            return;
        }
        else {
            $this->objModal->BuscarId($this->dados);
        }
    }

    /**
     * Curiculo de candidatos
     */
    public function curriculoCandPDF(array $dados = null)
    {
        ob_start();
        require_once './resources/views/pages/CurriculoCandidatoPDF.php';
        $dados  = $_SESSION['encaminhar'];
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml(ob_get_clean());
        //orientação e tipo de papel
        $dompdf->setPaper('A4');
        //Renderizar o html
        $dompdf->render();
        //Exibibir a página
        $dompdf->stream(
            "CurriculoCandidato.pdf",
            [
                "Attachment" => false //Para realizar o download somente alterar para true
            ]
        );
    }
}