<?php
	include_once 'mantenedorDeUsuarios.php';

	if(isset($_POST["btnEliminar"])){
		$codigoSeguro = $_POST["codigo"];
		eliminarSeguro($codigoSeguro); //Método invocado del mantenedor de usuarios.
	}
?>