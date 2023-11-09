<?php

namespace App\Core;


use App\Core\Permissao;

/**
 * classe reposnsavel pelo rotas.
 */
class Router
{
    private $urlController;
    private $urlAction;
    private array $urlParams;

    public function __construct()
    {
        $this->rumUrl();
    }

    public function rumUrl(): mixed
    {
        $this->splitUrl();

        // uri vazia - pagina inicial
        if (!$this->urlController) {
            $page = new \App\Controllers\Login();

            return $page->index();

            if (!file_exists('app\Controllers\\' . ucfirst($this->urlController) . '.php')) {
                $page = new \App\Controllers\Erro();

                return $page->index();
            }
        }
        # permissao para acessar a pagina
        $permisao = new Permissao;
        $permisao->index($this->urlController);

        $controller = 'App\Controllers\\' . ucfirst($this->urlController);
        $this->urlController = new $controller();

        if (
            !method_exists($this->urlController, $this->urlAction)
            && !is_callable([$this->urlController, $this->urlAction])
        ) {
            $page = new \App\Controllers\Erro();

            return $page->index();
        }

        if (!empty($this->urlParams)) {
            return call_user_func_array([$this->urlController, $this->urlAction], $this->urlParams);
        }

        return $this->urlController->{$this->urlAction}();
    }

    public function splitUrl(): void
    {
        $uri = $_SERVER['REQUEST_URI'];

        $url = trim($uri, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        //    $this->urlController = isset($url[0]) ? $url[0] : "";
        //    $this->urlAction = isset($url[1]) ? $url[1] : "";
        //    unset($url[0], $url[1]);

        $this->urlController = isset($url[1]) ? $url[1] : '';
        $this->urlAction = isset($url[2]) ? $url[2] : '';
        unset($url[0], $url[1], $url[2]);

        $this->urlParams = array_values($url);
    }
}
