<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Core\View;

/**
 * Description of EntradaEstoque.
 *
 * @author Mare
 */
class Vagas
{
    private $dados;
    private $objModal;

    /**
     * construtor.
     */
    public function __construct()
    {
        $this->objModal = new \App\Models\Vagas();
    }

    /**
     * renderiza view.
     */
    public function index()
    {
        View::renderTemplate('pages\vagas');
    }

    /**
     * renderiza ralatorio de vagas.
     */
    public function relatorioVagas()
    {
        View::renderTemplate('pages\relatorioVagas');
    }

    /**
     * @return type
     */
    public function deletar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha todos os campos pra Deletar-se',
            ]);

            return;
        } elseif ($this->objModal->encaminhamentosId($this->dados['Codigo_vaga']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Não e possivel excluir, existe Encaminhamento pra esta Vagas !',
            ]);

            return;
        } elseif ($this->objModal->vagasId($this->dados['Status_Vaga']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Não e possivel excluir, existe Processo de Recrutamento pra esta Vagas !',
            ]);

            return;
        } else {
            $this->objModal->delete($this->dados['Pk_cod']);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'vagas/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Vaga Deletada com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * consulta produtos.
     *
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

    /**
     * consulta produtos.
     *
     * @return type
     */
    public function empresaId($data)
    {
        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Consultar-se',
            ]);

            return;
        } else {
            $this->objModal->EmpresaId($this->dados);
        }
    }

    /**
     * consulta produtos.
     *
     * @return type
     */
    public function consultarId($data)
    {
        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Consultar-se',
            ]);

            return;
        } else {
            $this->objModal->ConsultarId($this->dados);
        }
    }

    /**
     * consulta produtos.
     *
     * @return type
     */
    public function lancaEstoque()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
        //        var_dump($data);
        //      die();
        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Consultar-se',
            ]);

            return;
        } else {
            $this->objModal->LancarItens($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'entradaEstoque/index',
                ]);

                return;
            } else {
                $_SESSION['msg'] = '<div class="message error">Produto nao Inserido com sucesso!</div>';
            }
        }
    }

    /**
     * cadastro de produtos.
     *
     * @return type
     */
    public function cadastrar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
        //        var_dump($this->dados );
        //        die();
        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra cadastra-se',
            ]);

            return;
        } else {
            $this->objModal->insert($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'vagas/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Vaga Cadastrada com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }

    /**
     * alterar produtos.
     *
     * @return type
     */
    public function alterar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;
        //        var_dump($this->dados);
        //        die();

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
                    'url' => site('root').'vagas/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Vaga Alterado com sucesso!</div>';
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
    public function deletarId($data)
    {
        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Erro deletar Produto',
            ]);

            return;
        } else {
            $this->objModal->deletaritemcarrinho($this->dados);

            if ($this->objModal->getResultado()) {
                $urlDestino = site('root').'entradaEstoque/index';
                header("Location: $urlDestino");
                $_SESSION['msg'] = '<div class="message success">Produto Deletado com sucesso!</div>';

                return;
            } else {
                $_SESSION['msg'] = '<div class="message error">Produto nao Deletado com sucesso!</div>';
            }
        }
    }

    /**
     * @return type
     */
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
        require_once './resources/views/pages/relatVagasPDF.php';
        $dados = $_SESSION['dados'];
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml(ob_get_clean());
        // orientação e tipo de papel
        $dompdf->setPaper('A4', 'portrait');
        // Renderizar o html
        $dompdf->render();
        // Exibibir a página
        $dompdf->stream(
            'RelatVagasPDF.pdf',
            [
                'Attachment' => false, // Para realizar o download somente alterar para true
            ]
        );
    }
}
