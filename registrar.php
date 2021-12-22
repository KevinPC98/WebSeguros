<?php
	include_once 'mantenedorDeUsuarios.php';

	if(isset($_POST["btnRegistrar"])){
		$tipoUsuario = $_POST["tipoUsuario"];
		echo $tipoUsuario;
		registrarUsuario($tipoUsuario); //Método invocado del mantenedor de usuarios.
	}
?>