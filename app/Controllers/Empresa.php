<?php

namespace App\Controllers;

use App\Core\View;

/**
 * Description of home.
 *
 * @author Mare
 */
class Empresa
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\Empresa();
    }

    public function index()
    {
        View::renderTemplate('pages\empresa');
    }

    public function deletar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Deletar-se',
            ]);

            return;
        } elseif ($this->objModal->empresaId($this->dados['pk_cod']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Voce nao tem permissao para deletar este Empresa PADRAO= '.$this->dados['razao_social'].' !',
            ]);

            return;
        } else {
            $this->objModal->delete($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'empresa/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Empresa Deletado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    public function Consultar()
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
            $this->objModal->pesquisarRelatorioTodos($this->dados);
        }
    }

    public function ConsultarRelatorio()
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

    public function RelatorioPDF(array $dados = null)
    {
        ob_start();
        require_once './resources/views/pages/RelatProduto.php';
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
            'relatorio_produto.pdf',
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

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra cadastra-se Empresa',
            ]);

            return;
        } elseif ($this->objModal->empresaID($this->dados['pk_cod']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Empresa ja Cadastrado= '.$this->dados['nome_fantasia'].' - '.$this->dados['pk_cod'].' !',
            ]);

            return;
        } else {
            $this->objModal->insert($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'empresa/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Emnpresa Cadastrado com sucesso!</div>';
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
                    'url' => site('root').'empresa/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Empresa Alterado com sucesso!</div>';
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
                'message' => 'Preencha tudos os campo pra deletar-se Empresa',
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
}
