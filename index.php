<?php
/* 
    Created on : 06/01/2021, 11:03:52
    Author     : Mare
*/
session_start();
ob_start();
require (__DIR__).'/vendor/autoload.php';
use App\Core\Router;
$url = new Router();

date_default_timezone_set(TIME_ZONE);