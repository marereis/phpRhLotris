<?php

/**
 * SITE CONFIG
 */
define("SITE", [
    "name" => "Lotris RH",
    "desc" => "Lotris RH -  Sorfware de Gestao Recursos Humanos",
    "domain" => "lotris",
    "locale" => "pt_BR",
    "root" => "http://localhost",
    "root1" => "http://localhost:8080/",
    "root1" => "http://localhost:",
]);

/**
 * DATABASE CONECT
 */
define("DATA", [
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "port" => "3306",
    "dbname" => "",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * PASSWORD
 */
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONFI_PASSWD_OPTION", ["cost" => 10]);

/**
 * Time Zone
 */
define("TIME_ZONE", "America/Sao_Paulo");



