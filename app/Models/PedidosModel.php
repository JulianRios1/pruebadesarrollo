<?php
/*
PedidosModel
----------------------------------------------------------------- | 
Autor: 
Julian Oswaldo Rios Piedrahita <julianrp89@gmail.com>
----------------------------------------------------------------- | 
*/
class PedidosModel{

   	private $db;
	public function list(){
		global $db;
		$sql = "select p.*,concat(tu.nombres,' ',tu.apellidos) as usuario,concat(tr.nombres,' ',tr.apellidos) as tercero,";
		$sql.="pb.total as total,pb.cant_productos as cant_productos ";
		$sql.=" from pedidos p ";
        $sql.=" join terceros tu on tu.id = p.usuario_id ";
        $sql.=" join terceros tr on tr.id = p.tercero_id ";
        $sql.=" left join lateral (select sum(cantidad*precio) as total,sum(cantidad) as cant_productos from pedidos_body pd where pd.pedidos_id = p.id ) pb on true";
		$sql.=" where p.fecha_creacion::date = now()::date ";
		$rs=$db->getAll($sql);
		if(count($rs)>0){
			return $rs;
		}else{
			return false;
		}
	}

	

	public function insert_head($data){
		global $db;
		$sql = "INSERT INTO pedidos(usuario_id,tercero_id,fecha_creacion)";
		$sql .= " Values (?,?,?) RETURNING id ";
		$bindVars = array($data['usuario_id'],$data['tercero_id'],'now()');
		$resint = $db->execute($sql,$bindVars);
		if (!$resint->EOF) {
			return $resint->fields['id'];
		} else {
			return false;
		}
	}
	public function insert($data){
		global $db;
		$sql = "INSERT INTO pedidos_body(pedidos_id,producto_id,cantidad,precio,fecha_creacion)";
		$sql .= " Values (?,?,?,?,?) RETURNING id ";
		$bindVars = array($data['pedido_id'],$data['producto_id'],$data['cantidad'],$data['precio'],'now()');
		$resint = $db->execute($sql,$bindVars);
		if (!$resint->EOF) {
			return $resint->fields['id'];
		} else {
			return false;
		}
	}

	public function detallepedido($data){
		global $db;
		$sql = "select pr.id,pr.nombre,pr.referencia,pd.cantidad,pd.precio from	pedidos_body pd	";
		$sql.= " join productos pr on pd.producto_id = pr.id ";
		$sql.= " where pd.pedidos_id = ? ";
		$bindVars = array($data['pedido_id']);
		$rs=$db->getAll($sql,$bindVars);
		if(count($rs)>0){
			return $rs;
		}else{
			return false;
		}
	}
}
