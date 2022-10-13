<?php
class Usuarios extends Controlador{

	function __construct(){
		$this->UsuariosModel = $this->modelo('UsuariosModel');
	}

	public function iniciar_session(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$datos['usuario'] = trim($_POST['usuario']);
			$datos['clave'] = trim(hash('sha256',$_POST['clave']));
			$datosusuario = $this->UsuariosModel->ValidarUsuario($datos);
			if ($datosusuario) {
				$_SESSION['i_usuario'] = $datosusuario;
				header('Location: ' . RUTA_APP . 'Pedidos/');
                exit();
			} else {
				$this->salir();
			}
		} else {
			$this->salir();
		}
	}

	public function salir(){
		session_destroy();
		header('Location:' . RUTA_APP);
		die('Salir');
	}

}