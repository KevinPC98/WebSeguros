<?php
	include_once 'mantenedorDeUsuarios.php';

	if(isset($_POST["btnAcceder"])){
		accederUsuario(); //Método invocado del mantenedor de usuarios.
	}
?>