<?php
/**
 * Classe Controler.
 */

namespace App\Controllers;

use App\Core\View;

class Controller
{
    private $dados;
    private $objModal;

    public function __construct()
    {
        $this->objModal = new \App\Models\BackupBd();
    }

    /**
     * mostra pagima inical a dashboard.
     */
    public function index()
    {
        return View::renderTemplate('pages\dashboard');
    }

    /**
     * mostra pagina de geraçã de backup.
     */
    public function backupBdMysql()
    {
        View::renderTemplate('pages\backupBD');
    }

    /**
     * Gera Backup completo do banco de Dados.
     *
     * @return type
     */
    public function gerarBackup()
    {
        try {
            $this->objModal->backupBdMysql();

            return;
        }
        catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}