<?php
/*
CategoriasModel
----------------------------------------------------------------- | 
Autor: 
Julian Oswaldo Rios Piedrahita <julianrp89@gmail.com>
----------------------------------------------------------------- | 
*/
class CategoriasModel{

   	private $db;
	public function list(){
		global $db;
		$sql = "select cat.id,cat.nombre,cat.descripcion,cat.estado,to_char(cat.fecha_creacion,'YYYY-MM-DD HH24:SS') as fecha_creacion ";
		$sql.=" from categorias cat";
		$sql.=" where cat.estado not in (9) ";
		$rs=$db->getAll($sql);
		if(count($rs)>0){
			return $rs;
		}else{
			return false;
		}
	}
	public function getId($id){
		global $db;
		$sql = "select cat.*";
		$sql.=" from categorias cat";
		$sql.=" where cat.id=?";
		$bindVars = array($id);
		$rs=$db->execute($sql,$bindVars);
		if(!$rs->EOF){
			return $rs->fields;
		}else{
			return false;
		}
	}
	public function getNombre($nombre){
		global $db;
		$sql = "select cat.*";
		$sql.=" from categorias cat";
		$sql.=" where cat.nombre =?";
		$bindVars = array($nombre);
		$rs=$db->execute($sql,$bindVars);
		if(!$rs->EOF){
			return $rs->fields;
		}else{
			return false;
		}
	}
	public function delete($data){
		global $db;
		$sql = "DELETE FROM categorias WHERE id=?";
		$bindVars = array($data['id']);
		if($db->execute($sql,$bindVars)){
			return true;
		}else return false;
	}
	public function deletevirtual($data){
		global $db;
		$sql = " update categorias set estado=9 where id=? ";
		$bindVars = array($data['id']);
		if($db->execute($sql,$bindVars)){
			return true;
		}else return false;

	}
	public function updatecategoria($datos){
		global $db;
		$sql = " UPDATE categorias SET nombre= ? ,descripcion= ? , estado= ? ";
		$sql .= ",slug= ?  WHERE id= ?";
		$bindVars =array();
		$bindVars[]= $datos['ed_nombre'];
		$bindVars[]= $datos['ed_descripcion'];
		$bindVars[]= $datos['ed_estado'];
		$bindVars[]= $datos['slug'];
		$bindVars[]= $datos['idcategoria'];
		if ($db->execute($sql,$bindVars)) {
			return true;
		} else {
			return false;
		}
	}
	public function insertcategoria($data){
		global $db;
		$sql = "INSERT INTO categorias(nombre,descripcion,estado ,slug,fecha_creacion)";
		$sql .= " Values (?,?,?,?,?)";
		$bindVars = array($data['nombre'],$data['descripcion'],$data['estado'],$data['slug'],'now()');
		if ($db->execute($sql,$bindVars)) {
			return true;
		} else {
			return false;
		}
	}
}