<?php

namespace App\Controllers;

use App\Core\View;
/**
 * Description of home.
 *
 * @author Mare
 */
class Usuarios
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\Usuarios();
    }

    public function index()
    {
        View::renderTemplate('pages\usuarios');
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

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'usuarios/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Usuário Deletado com sucesso!</div>';
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
            $this->objModal->BuscarTodos($this->dados);
        }
    }

    public function ConsultarId($data)
    {
        $this->dados = filter_var($data, FILTER_VALIDATE_INT);

        if (empty($this->dados)) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra Consultar-se',
            ]);

            return;
        } else {
            $this->objModal->BuscarId($this->dados);
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
        } elseif ($this->objModal->UsuariosCad($this->dados['Email'], $this->dados['Codigo_Acesso']) > 0) {
            echo ajaxResponse('message', [
                'type' => 'info',
                'message' => 'Usuario ja Cadastrado com email = '.$this->dados['Email'].' e o codigo = '.$this->dados['Codigo_Acesso'].' !',
            ]);

            return;
        } else {
            $this->objModal->insert($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'usuarios/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Usuario Cadastrado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
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

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect', [
                    'url' => site('root').'usuarios/index',
                ]);
                $_SESSION['msg'] = '<div class="message success">Produto Alterado com sucesso!</div>';
            } else {
                $this->dados['form'] = $this->dados;
            }
        }
    }
}
