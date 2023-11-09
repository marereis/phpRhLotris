<?php

namespace App\Controllers;

use App\Core\View;

/**
 * Description of Erro.
 *
 * @author Mare
 */
class Erro
{
    private $dados;

    public function index()
    {
        View::renderTemplate('pages\erro');
        // session_destroy();
    }
}
