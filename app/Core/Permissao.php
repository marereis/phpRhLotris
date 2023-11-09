<?php

namespace App\Core;

/**
 * Description of Permissões.
 * @author mare
 */
class Permissao
{
    private $urlController;
    private $pgPublica;
    private $pgRestrita;
    private $resultado;

    public function getResultado(): string
    {
        return $this->resultado;
    }

    public function index($urlController): void
    {
        $this->urlController = $urlController;

        $this->pgPublica = ['login', 'erro'];

        if (in_array($this->urlController, $this->pgPublica)) {
            $this->resultado = $this->urlController;
        } else {
            $this->pgRestrita();
        }
    }

    private function pgRestrita(): void
    {
        $this->pgRestrita = ['controller', 'empresa', 'produtos', 'usuarios', 'candidatos', 'relatorioCandidatos',
            'encaminhamentos', 'relatorioEncaminhar', 'vagas', 'relatorioVagas', 'empresasParceiras', 'relatorioEmpresasParceiras'];

        if (in_array($this->urlController, $this->pgRestrita)) {
            $this->verificarLogin();
        } else {
            if (in_array($this->urlController, $this->pgPublica)) {
                $this->resultado = $this->urlController;
                echo ajaxResponse('redirect', [
                    'url' => site('root').'login/index',
                ]);
            }
        }
    }

    private function verificarLogin(): void
    {
        if (isset($_SESSION['login'])) {
            $this->resultado = $this->urlController;
        } else {
            $urlDestino = site('root').'login/index';
            header("Location: $urlDestino");
        }
    }
}
