<?php

namespace App\Core;

/**
 * Description of ConfigView.
 *
 * @author mare
 */
class View
{
    public static $dados;

    public function __construct()
    {
        self::$dados = [];
    }

    public static function renderTemplate($nome, $dadosModel = [])
    {
        self::$dados = $dadosModel;
        $file        = require 'resources/views/theme/_theme.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function renderViewNoTemplate($nome, $dadosModel = [])
    {
        extract(self::$dados);
        $file = require_once 'resources/views/' . $nome . '.php';
        return file_exists($file) ? file_get_contents($file) : '';
    }
}