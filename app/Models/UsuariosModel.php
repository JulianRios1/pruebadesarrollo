<?php 
/*
UsuariosModel
----------------------------------------------------------------- | 
Autor: 
Julian Oswaldo Rios Piedrahita <julianrp89@gmail.com>
----------------------------------------------------------------- | 
*/
class UsuariosModel{
	private $db;
	function __construct(){
	}

	public function ValidarUsuario($datos){
		global $db;

		$sql = " select u.* from terceros u  ";
		$sql.=" where u.estado = 1 and  u.login=? and u.clave=? ";
		$bindVars =array($datos['usuario'],$datos['clave']);
		$db->setFetchMode(ADODB_FETCH_ASSOC);
		$res=$db->Execute($sql,$bindVars);
		
		if(!$res->EOF){
			echo "Ingreso";
			print_r($res->fields);
			return $res->fields;
		}else{
			echo "Falser";
			return false;
		}
	}

	public function list($tipo=2){
		global $db;
		$sql = "select * from terceros where tipo = ".$tipo;
		$rs=$db->getAll($sql);
		if(count($rs)>0){
			return $rs;
		}else{
			return false;
		}
	}	
}