<?php
	session_start();

	if(isset($_SESSION["User"])){
		if($_SESSION["User"]==='admin'){
            header("Location: cuentaAdmin.php");
        }
        else{
            header("Location: cuenta.php");
        }
    }
    else{
    	session_unset();
        // destroy the session
        session_destroy();
        header("Location: inicio.php");
    }
?>