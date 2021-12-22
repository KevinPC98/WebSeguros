<?php
	include_once 'mantenedorDeUsuarios.php';

	if(isset($_POST["btnAdquirir"])){
		$nombreSeguro = $_POST["seguro"];
		adquirirSeguro($nombreSeguro); //Método invocado del mantenedor de usuarios.
	}
?>