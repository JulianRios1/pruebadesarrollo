<?php
class Controlador{

	public function modelo($modelo){
		require_once '../app/Models/'.$modelo.".php";
		return new $modelo();
	}

	public function vista($vista,$datos=[]){
		if(file_exists('../app/Views/'.$vista.".php")){
		require_once '../app/Views/'.$vista.".php";
		}else{
			die(" La Vista no fue encontrada");
		}
	}

	public function validarsession(){
		if (count($_SESSION['i_usuario'])== 0) {	
			header('location:/');
			exit();
		}
	}
}