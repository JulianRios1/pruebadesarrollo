<?php
// valirables para la conexion con la db 
define("_DB_HOST",$_ENV['DB_HOST']);
define("_DB_USER",$_ENV['DB_USERNAME']);
define("_DB_PASSWORD",$_ENV['DB_PASSWORD']);
define("_DB_NAME_BASE",$_ENV['DB_DATABASE']);
define("_DB_TYPE",$_ENV['DB_TYPE']);
define("_DB_PORT",$_ENV['DB_PORT']);

// ruta  de la aplicacion y nombre semilla de la aplicacion 
define("RUTA_APP",$_ENV['RUTA_APP']);
define("RUTA_URL","/");
define("NOMBRE_SITIO",$_ENV['NOMBRE_SITIO']);

$db = NewADOConnection(_DB_TYPE);
$db->setConnectionParameter('port',_DB_PORT);
$db->Connect(_DB_HOST, _DB_USER, _DB_PASSWORD,_DB_NAME_BASE);
$db->setFetchMode(ADODB_FETCH_ASSOC);
