<?php
class Productos extends Controlador{
	function __construct(){
		$this->validarsession();//  realiza la validacion que el  usurio este logeado
        $this->ProductosModel = $this->modelo('ProductosModel');
        $this->CategoriasModel = $this->modelo('CategoriasModel');

	}

    public function index(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $datos=array('titulo'=>'Lista de Productos');
            $this->vista("head",$datos);
            $datos['productos']=$this->ProductosModel->list();
            $datos['categorias']=$this->CategoriasModel->list();
            $this->vista("productos/index", $datos);
            $this->vista("footer");
        }else{
            header("HTTP/1.1 404 Not Found");
        }        
    }

    public function editar(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp=$this->ProductosModel->getId($_REQUEST['idproducto']);
            if($resp){
                $msj='El registro fue actualizado.';
                $data=$_REQUEST;
                $data['categorias']= '{'.implode(',',$_REQUEST['ed_categoria_id']).'}';
                $resp=$this->ProductosModel->update($data);
                if(!$resp)$msj='Prolemas actualizar el registro.';
                $data=array('status'=>$resp,'msj'=>$msj);

            }else   $data=array('status'=>false,'msj'=>'El registro no se puede mod.');
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function validar_referencia(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_REQUEST['referencia'];
            $resp=$this->ProductosModel->getreferencia($data);
            $msj=$resp == true?'La referencia ya existe':'';
            $data=array('status'=>$resp,'msj'=>$msj);
            header("HTTP/1.1 200");
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function crear(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp=$this->ProductosModel->getreferencia($_REQUEST['referencia']);
            if(!$resp){
                $msj='El registro fue creado.';
                $data=$_REQUEST;
                $data['categorias']= '{'.implode(',',$_REQUEST['categoria_id']).'}';
                $resp=$this->ProductosModel->insert($data);
                if(!$resp)$msj='Prolemas no se puedo crear el registro.';
                $data=array('status'=>$resp,'msj'=>$msj);
            }else   $data=array('status'=>false,'msj'=>'El registro ya existe.');

            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function delete(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp=$this->ProductosModel->deletevirtual($_REQUEST);
            $data=array('status'=>$resp);
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }
    

}