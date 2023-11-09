<?php

namespace App\Controllers;

use App\Core\View;

/**
 * Description of home.
 *
 * @author Mare
 */
class ControllerSenhas
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\Senhas();
    }

    public function index()
    {
        View::renderTemplate('pages\cadastroSenha');
    }

    public function deletar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra deletar-se',
            ]);

            return;
        } else {
            $this->objModal->delete($this->dados);
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
            $this->objModal->Consultarsenha($this->dados);
        }
    }

    public function cadastrar()
    {
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra cadastra-se',
            ]);

            return;
        } elseif ($this->dados['senha'] !== $this->dados['confi_senha']) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Atenção ao digitar as senhas! ',
            ]);

            return;
        } else {
            $this->objModal->insert($this->dados);
        }
    }

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
        }
    }
}
