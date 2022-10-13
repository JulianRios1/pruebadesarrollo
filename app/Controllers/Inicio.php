<?php
/**
 *
 */
class Inicio extends Controlador{

	function __construct(){
		$this->validarsession();//  realiza la validacion que el  usurio este logeado
		
	}
	public function index(){
		$this->vista("head");
		$this->vista("inicio/bloques");
		$this->vista("footer");
	}
}