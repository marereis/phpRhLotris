<?php

/**
 * SITE CONFIG
 */
define("SITE", [
    "name" => "Lotris RH",
    "desc" => "Lotris RH -  Sorfware de Gestao Recursos Humanos",
    "domain" => "lotris",
    "locale" => "pt_BRapp",
    "root" => "https://phprhlotris.up.railway.app/",
    "root1" => "http://localhost:8080/rhlotris/",
    "root1" => "http://localhost:81/rhlotris/",
]);


/**
 * DATABASE CONECT
 */
define("DATA", [
    "driver" => "mysql",
    "host" => "nozomi.proxy.rlwy.net",
    "port" => "42213",
    "dbname" => "bdrh",
    "username" => "root",
     "passwd" => "BsXfUAMkHqCUvfSmTKPAfaOWwhBEVSbA",
   // "passwd" => "",
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



