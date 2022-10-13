<?php
/*
Clase principal para el sistema
----------------------------------------------------------------- | 
Autor: 
Julian Oswaldo Rios Piedrahita <julianrp89@gmail.com>
----------------------------------------------------------------- | 
*/
class Core
{
	protected $ControladorActual = 'Login';
	protected $MetodoActual = 'index';
	protected $parametros = [];


	function __construct()
	{
		$url = $this->getUrl();
		if (file_exists("../app/Controllers/" . ucwords($url[0]) . ".php")) {
			$this->ControladorActual = ucwords($url[0]);
			unset($url[0]);
		}
	// controlador
		require_once '../app/Controllers/' . $this->ControladorActual . ".php";
		$this->ControladorActual = new $this->ControladorActual;
	// metodos
		if (isset($url[1])) {
			if (method_exists($this->ControladorActual, $url[1])) {
				$this->MetodoActual = $url[1];
				unset($url[1]);
			}
		}
		
		$this->parametros = $url ? array_values($url) : [];
		call_user_func_array([$this->ControladorActual, $this->MetodoActual], $this->parametros);

	}

	public function getUrl()
	{

		$url = $_GET['url'];
		if (isset($url)) {
			$url = rtrim($url, "/");
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode("/", $url);
			return $url;
		}
	}


}