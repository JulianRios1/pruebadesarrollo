<?php
/*
ProductosModel
----------------------------------------------------------------- | 
Autor: 
Julian Oswaldo Rios Piedrahita <julianrp89@gmail.com>
----------------------------------------------------------------- | 
*/
class ProductosModel{

   	private $db;
	public function list(){
		global $db;
		$sql = "SELECT p.id, p.nombre, p.referencia, p.precio, p.peso, to_char(p.fecha_creacion,'YYYY-MM-DD HH24:SS') fecha_creacion, p.fecha_update, cat.categorias_id,p.estado,p.stock,cat.categorias ";
		$sql.=" from productos p ";
        $sql.= "left join lateral (select string_agg(c.nombre , ' | ')as categorias,string_agg(c.id::text,',') as categorias_id from categorias c where p.categorias_id @> ARRAY[c.id])as cat on true ";
		$sql.=" where p.estado not in (9) ";
		$rs=$db->getAll($sql);
		if(count($rs)>0){
			return $rs;
		}else{
			return false;
		}
	}
	public function getId($id){
		global $db;
		$sql = "select p.*";
		$sql.=" from productos p";
		$sql.=" where p.id=?";
		$bindVars = array($id);
		$rs=$db->execute($sql,$bindVars);
		if(!$rs->EOF){
			return $rs->fields;
		}else{
			return false;
		}
	}
	public function getReferencia($id){
		global $db;
		$sql = "select p.*";
		$sql.=" from productos p";
		$sql.=" where p.referencia=?";
		$bindVars = array($id);
		$rs=$db->execute($sql,$bindVars);
		if(!$rs->EOF){
			return true;
		}else{
			return false;
		}
	}

	
	public function update($datos){
		global $db;
		$sql = " UPDATE productos SET nombre= ? ,referencia= ? , estado= ? ,precio= ?,peso= ?,stock= ?,fecha_update = now(),categorias_id= ? ";
		$sql .= " WHERE id= ?";
		$bindVars =array();
		$bindVars[]= $datos['ed_nombre'];
		$bindVars[]= $datos['ed_referencia'];
		$bindVars[]= $datos['ed_estado'];
		$bindVars[]= $datos['ed_precio'];
		$bindVars[]= $datos['ed_peso'];
		$bindVars[]= $datos['ed_stock'];
		$bindVars[]= $datos['categorias'];
		$bindVars[]= $datos['idproducto'];
		if ($db->execute($sql,$bindVars)) {
			return true;
		} else {
			return false;
		}
	}

	public function insert($data){
		global $db;
		$sql = "INSERT INTO productos(nombre,referencia,estado,precio,peso,categorias_id,stock,fecha_creacion)";
		$sql .= " Values (?,?,?,?,?,?,?,?)";
		$bindVars = array($data['nombre'],$data['referencia'],$data['estado'],$data['precio'],$data['peso'],$data['categorias'],$data['stock'],'now()');
		if ($db->execute($sql,$bindVars)) {
			return true;
		} else {
			return false;
		}
	}

	public function deletevirtual($data){
		global $db;
		$sql = " update productos set estado=9 where id=? ";
		$bindVars = array($data['id']);
		if($db->execute($sql,$bindVars)){
			return true;
		}else return false;

	}

	public function update_stock($datos){
		global $db;
		$sql = " UPDATE productos SET stock= (stock - ?),fecha_update = now() ";
		$sql .= " WHERE id= ?";
		$bindVars =array();
		$bindVars[]= $datos['stock'];
		$bindVars[]= $datos['producto_id'];
		if ($db->execute($sql,$bindVars)) {
			return true;
		} else {
			return false;
		}
	}
}