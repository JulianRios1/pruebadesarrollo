<?php
class Pedidos extends Controlador{
	function __construct(){
		$this->validarsession();//  realiza la validacion que el  usurio este logeado
        $this->PedidosModel = $this->modelo('PedidosModel');
        $this->ProductosModel = $this->modelo('ProductosModel');
        $this->UsuariosModel = $this->modelo('UsuariosModel');

	}

    public function index(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $datos=array('titulo'=>'Lista de Pedidos');
            $this->vista("head",$datos);
            $datos['pedidos']=$this->PedidosModel->list();
            $datos['productos']=$this->ProductosModel->list();
            $datos['terceros']=$this->UsuariosModel->list(2);

            $this->vista("pedidos/index", $datos);
            $this->vista("footer");
        }else{
            header("HTTP/1.1 404 Not Found");
        }        
    }

    public function crear(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp = '';
            $count_productos=0;
            $data = $_REQUEST;
            $data['usuario_id'] = $_SESSION['i_usuario']['id'];
            $data['tercero_id'] = $_REQUEST['tercero_id'];
            $idpedido = $this->PedidosModel->insert_head($data);
            $data_body = [];
            if($idpedido){
                $data_body['pedido_id']=$idpedido;
                for ($i=0; $i < count($data['producto_id']); $i++) { 
                    $data_body['producto_id']=$data['producto_id'][$i];
                    $data_body['cantidad']=$data['cantidad'][$i];
                    $data_body['precio']=$data['precio'][$i];
                    $resul = $this->PedidosModel->insert($data_body);
                    $data_producto['producto_id'] = $data['producto_id'][$i];
                    $data_producto['stock'] = $data['cantidad'][$i];
                    $this->ProductosModel->update_stock($data_producto);
                    if($resul) $count_productos++;
                }
                $msj = 'Pedido creado correctamente';
            }else $msj='Prolemas no se puedo crear el registro.';

            $data=array('status'=>$resp,'msj'=>$msj);
        

            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function detallepedido(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_REQUEST;
            $data=$this->PedidosModel->detallepedido($data);
            header("HTTP/1.1 200");
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }
}