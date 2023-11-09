<?php

namespace App\Controllers;

use App\Core\View;
/**
 * Description of Login.
 *
 * @author Mare
 */
class Login
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\AdmLogin();
    }

    public function index()
    {
        View::renderTemplate('pages\login');
    }

    public function logar()
    {
        $data        = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->dados = $data;

        if (in_array('', $this->dados)) {
            echo ajaxResponse('message',
                [
                'type' => 'info',
                'message' => 'Preencha tudos os campo pra cadastra-se',
            ]);

            return;
        }
        else {
            $this->objModal->login($this->dados);

            if ($this->objModal->getResultado()) {
                echo ajaxResponse('redirect',
                    [
                    'url' => site('root').'controller/index/',
                ]);
            }
            else {
                $this->dados['form'] = $this->dados;
            }
        }
    }
}