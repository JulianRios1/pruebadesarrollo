<?php
class Categorias extends Controlador{
	function __construct(){
		$this->validarsession();//  realiza la validacion que el  usurio este logeado
        $this->CategoriasModel = $this->modelo('CategoriasModel');
	}

    public function index(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $datos=array('titulo'=>'Lista de Categorías');
            $this->vista("head",$datos);
            $datos['categorias']=$this->CategoriasModel->list();
            $this->vista("categorias/index", $datos);
            $this->vista("footer");
        }else{
            header("HTTP/1.1 404 Not Found");
        }        
    }

    public function getListJson(){
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data=$this->CategoriasModel->list();
            header("HTTP/1.1 200");
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function delete(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp=$this->CategoriasModel->deletevirtual($_REQUEST);
            $data=array('status'=>$resp);
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }
    
    public function crear(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp=$this->CategoriasModel->getNombre($_REQUEST['nombre']);
            if(!$resp){
                $msj='El registro fue creado.';
                $data=$_REQUEST;
                $data['slug']=strtolower(preg_replace('([^A-Za-z0-9])','', $_REQUEST['nombre']));
                $resp=$this->CategoriasModel->insertcategoria($data);
                if(!$resp)$msj='Prolemas no se puedo crear el registro.';
                $data=array('status'=>$resp,'msj'=>$msj);
            }else   $data=array('status'=>false,'msj'=>'El registro ya existe.');

            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }
    
    public function editar(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resp=$this->CategoriasModel->getId($_REQUEST['idcategoria']);
            if($resp){
                $msj='El registro fue actualizado.';
                $data=$_REQUEST;
                $data['slug']=strtolower(preg_replace('([^A-Za-z0-9])','', $_REQUEST['ed_nombre']));// se valida que no tenga caracteres especiales
                $resp=$this->CategoriasModel->updatecategoria($data);
                if(!$resp)$msj='Prolemas actualizar el registro.';
                $data=array('status'=>$resp,'msj'=>$msj);
            }else   $data=array('status'=>false,'msj'=>'El registro no se puede mod.');
            header("Content-type:application/json");
            echo json_encode($data);
        }else{
            header("HTTP/1.1 404 Not Found");
        }
    }

}