<?php
	include_once 'encabezado.php';
	include_once 'mantenedorDeUsuarios.php';
	
	if(isset($_SESSION["User"])){
        session_unset();
        // destroy the session
        session_destroy();
    }
?>

<style type="text/css">
    .login {
        border-collapse: collapse;
        background-color: rgb(255,255,255,1.0);
    }

    .login tbody {
        border-style: solid;
        border-width: 20px;
        border-color: rgb(255,255,255);
    }

    .login tbody tr td {
        padding: 10px;
    }

    .login tbody tr td label {
        color: rgb(0,0,0);
    }
    body {
        background-image: url("imagenes/paisaje3.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        -o-background-size: cover;
        color: rgb(0,0,0);
        font-family: Arial;
    }
</style>

	<div align="center" style="margin: 130px 0px;">
	    <form method="post">
	        <table class="login">
	            <tbody>
	                <tr>
	                    <td colspan="2">
	                        <div align="center"><h1>Iniciar sesión</h1></div>
	                    </td>
	                </tr>
	                <tr>
	                    <td><label>Nombre de usuario:</label></td>
	                    <td><input type="text" required name="nombreUsuario" style="width: 97%; padding: 5px;"></td>
	                </tr>
	                <tr>
	                    <td><label>Contraseña:</label></td>
	                    <td><input type="password" required name="password" style="width: 97%; padding: 5px;"></td>
	                </tr>
	                <tr>
	                    <td colspan="2" align="center">
	                        <br><input type="submit" name="btnAcceder" style="padding: 10px; border: none; background-color: rgb(0,13,84); color: rgb(255,255,255); font-weight: bold;" value="Acceder">
	                    </td>
	                </tr>
	                <tr>
	                    <td colspan="2" align="center">
	                        <label>Si no tiene una cuenta debe registrarse <a style="color: rgb(0,13,84);" href="registrarUsuario.php">aquí</a></label>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </form>
	</div>
</body>
<?php include_once('pie.php');
	
	if(isset($_POST["btnAcceder"])){
		accederUsuario(); //Método invocado del mantenedor de usuarios.
	}

?>