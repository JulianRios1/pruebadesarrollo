<?php
/*
Archivo de entrada declaracion de las clases
----------------------------------------------------------------- | 
Autor: 
Julian Oswaldo Rios Piedrahita <julianrp89@gmail.com>
----------------------------------------------------------------- | 
*/
require(__DIR__.'../../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'../../');
$dotenv->load();
require_once 'Config/Config.php';
spl_autoload_register(function ($NameClase)
{
   require_once 'Core/' . $NameClase . '.php';
});
