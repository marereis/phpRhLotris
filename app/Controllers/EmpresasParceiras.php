<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Core\View;

/**
 * Description of home.
 *
 * @author Mare
 */
class EmpresasParceiras
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\EmpresasParceiras();
    }

    /**
     * renderiza empresas parceira.
     */
    public function index()
    {
        View::renderTemplate('pages\empresasParceiras');
    }

    /**
     * renderiza ralatorio de empresas parceira.
     */
    public function relatorioEmpresasPar()
    {
        View::renderTemplate('pages\relatorioEmpresasParceiras');
    }

    /**
     * @return type
     */
    public function consultar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Consultar-se',
            ]);

            return;
        } else {
            $this->objModal->Pesquisar($this->dados);
        }
    }

    public function consultarRelatorio()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            $this->objModal->PesquisarRelatorioTodos();

            return;
        } else {
            $this->objModal->PesquisarRelatorio($this->dados);
        }
    }

    public function relatorioPDF(array $dados = null)
    {
        ob_start();
        require_once './resources/views/pages/relatEmpresasParceirasPDF.php';
        $dados = $_SESSION['dados'];
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml(ob_get_clean());
        // orientação e tipo de papel
        $dompdf->setPaper('A4');
        // Renderizar o html
        $dompdf->render();
        // Exibibir a página
        $dompdf->stream(
            'relatorioEmpresasParceiras.pdf',
            [
                'Attachment' => false, // Para realizar o download somente alterar para true
            ]
        );
    }

    /**
     * cadastrar empresa.
     *
     * @return type
     */
    public function cadastrar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
        // var_dump($this->dados);

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra cadastra-se Empresa',
            ]);

            return;
        } elseif ($this->objModal->empresaIdcads($this->dados['cnpj']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Empresa parceira ja Cadastrado= '.$this->dados['razao_social'].' - '.$this->dados['cnpj'].' !',
            ]);

            return;
        } else {
            $this->objModal->insert($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'empresasParceiras/index',
                ]);
                $_SESSION['msg'] = '<div class="message success"> Empresa parceira Cadastrado com sucesso! </div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * Controller alterar empresa.
     *
     * @return type
     */
    public function alterar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Alterar-se',
            ]);

            return;
        } else {
            $this->objModal->update($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'empresasParceiras/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Empresa parceira Alterado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * deletar produtos direto ada tebela.
     *
     * @param type $data
     *
     * @return type
     */
    public function DeletarTabela($data)
    {
        $this->dados = $data;

        if ($this->dados <= 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra deletar-se Empresas Parceiras',
            ]);

            return;
        } else {
            $this->objModal->deleteId($this->dados);
        }
    }

    /**
     * consulta todos.
     */
    public function ConsultarAll()
    {
        $this->objModal->BuscarTodos();
    }

    /**
     * consultar por id.
     *
     * @param type $data
     *
     * @return type
     */
    public function ConsultarId($data)
    {
        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Consulta-se EmpresaID',
            ]);

            return;
        } else {
            $this->objModal->BuscarId($this->dados);
        }
    }

    /**
     * @return type
     */
    public function deletar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
        //        var_dump($this->dados);
        //        die();

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha os campos pra Deletar-se',
            ]);

            return;
        } elseif ($this->objModal->empresaId($this->dados['cnpj']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Não e possivel excluir EMPRESA PARCEIRAS = '.$this->dados['razao_social'].' ** EXISTE VAGA CADASTRADA! **',
            ]);

            return;
        } else {
            $this->objModal->delete($this->dados['pk_cod']);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'empresasParceiras/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Empresa Parceira Deletada com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }
}
