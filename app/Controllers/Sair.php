<?php

namespace App\Controllers;

use App\Core\View;

/**
 * Description of Sair
 *
 * @author mare
 */
class Sair {

    
    private $objModal;

    public function __construct() {
        $this->objModal = new \App\Models\Sair();
    }

    public function index() {
        $this->objModal->Redirecionar();
    }

}
