<?php
	include_once 'conectarBD.php';
	session_start();

	function registrarUsuario($tipo){
		switch ($tipo) {
			case 'persona':
				$passwordA = $_POST["passwordR"];
				$passwordB = $_POST["passwordCR"];

				if($passwordA === $passwordB){
					$nombreUsuario = $_POST["nombreUsuario"];
					$tipoDoc = $_POST["tipoDocumento"];
					$numDoc = $_POST["nroDoc"];
					$nombres = $_POST["txtNombres"];
					$apellidos = $_POST["txtApellidos"];
					$email = $_POST["email"];
					$telefono = $_POST["telefono"];
					$direccion = $_POST["direccion"];

					$sql1 = "INSERT INTO USUARIO VALUES('$nombreUsuario','$direccion','$telefono','$email','$passwordA')";
					$sql2 = "INSERT INTO PERSONANATURAL VALUES('$nombreUsuario','$tipoDoc','$numDoc','$nombres','$apellidos')";

					$resp1 = mysqli_query($GLOBALS["conn"], $sql1);
					$resp2 = mysqli_query($GLOBALS["conn"], $sql2);

					if($resp1 && $resp2){
						echo '<script type="text/javascript">
			                alert("El usuario ha sido registrado exitosamente.");
			                window.location.href="cuenta.php";
			            </script>';
					}
					else{
						echo '<script type="text/javascript">
			                alert("El nombre de usuario y/o el correo electrónico ya están en uso.");
			                window.location.href="registrarUsuario.php";
			            </script>';
					}
				}
				else{
					echo '<script type="text/javascript">
		                alert("Las contraseñas no coinciden.");
		                window.location.href="registrarUsuario.php";
		            </script>';
				}
				break;

			case 'empresa':
				$passwordA = $_POST["passwordR"];
				$passwordB = $_POST["passwordCR"];

				if($passwordA === $passwordB){
					$nombreUsuario = $_POST["nombreUsuario"];
					$numRUC = $_POST["nroRUC"];
					$nombre = $_POST["txtNombre"];
					$email = $_POST["email"];
					$telefono = $_POST["telefono"];
					$direccion = $_POST["direccion"];

					$sql1 = "INSERT INTO USUARIO VALUES('$nombreUsuario','$direccion','$telefono','$email','$passwordA')";
					$sql2 = "INSERT INTO PERSONAJURIDICA VALUES('$nombreUsuario','$numRUC','$nombre')";

					$resp1 = mysqli_query($GLOBALS["conn"], $sql1);
					$resp2 = mysqli_query($GLOBALS["conn"], $sql2);

					if($resp1 && $resp2){
						echo '<script type="text/javascript">
			                alert("El usuario ha sido registrado exitosamente.");
			                window.location.href="persona.php";
			            </script>';
					}
					else{
						echo '<script type="text/javascript">
			                alert("El nombre de usuario y/o el correo electrónico ya están en uso.");
			                window.location.href="persona.php";
			            </script>';
					}
				}
				else{
					echo '<script type="text/javascript">
		                alert("Las contraseñas no coinciden.");
		                window.location.href="persona.php";
		            </script>';
				}
				break;
		}
	}

	function accederUsuario(){
		$nombreUsuario = $_POST["nombreUsuario"];
		$password = $_POST["password"];
		
		$sql1 = "SELECT * FROM USUARIO WHERE nombreUsuario='$nombreUsuario'";
		$resp1 = mysqli_query($GLOBALS["conn"], $sql1);
		$array1 = mysqli_fetch_array($resp1);
		
		if(!empty($array1)){
			if($array1["contrasenia"]==$password){
				$_SESSION["User"] = $array1['nombreUsuario'];
				$sql2 = "SELECT tipoDoc, numDoc, nombre, apellido FROM PERSONANATURAL WHERE nombreUsuario='$nombreUsuario'";
				$resp2 = mysqli_query($GLOBALS["conn"], $sql2);
				$array2 = mysqli_fetch_array($resp2);

				if(!empty($array2)){
					//Se verifica si el acceso es en modo administrador u estándar.
					if($array1['nombreUsuario']==='admin'){
	                    $_SESSION["tipoUser"] = 'administrador';
	                    header("Location: cuentaAdmin.php");
	                }
	                else{
	                    $_SESSION["tipoUser"] = 'estandar';
	                    header("Location: cuenta.php");
	                }
				}
				else{
					$sql2 = "SELECT ruc, nombre FROM PERSONAJURIDICA WHERE nombreUsuario='$nombreUsuario'";
					$resp2 = mysqli_query($GLOBALS["conn"], $sql2);
					
					//Se verifica si el acceso es en modo administrador u estándar.
					if($array1['nombreUsuario']==='admin'){
	                    $_SESSION["tipoUser"] = 'administrador';
	                    header("Location: cuentaAdmin.php");
	                }
	                else{
	                    $_SESSION["tipoUser"] = 'estandar';
	                    header("Location: cuenta.php");
	                }
				}
			}
			else{
				echo '<script type="text/javascript">
		                alert("Contraseña incorrecta.");
		                window.location.href="iniciarSesion.php";
		            </script>';
			}
		}
		else{
			echo '<script type="text/javascript">
	        	    alert("El usuario no existe.");
	            	window.location.href="iniciarSesion.php";
	            </script>';
		}
	}

	function adquirirSeguro($nombreSeguro){
		$tipoUsuario = $_SESSION["tipoUser"];

		$sql = "SELECT codigo FROM SEGURO WHERE nombre='$nombreSeguro'";
		$resp = mysqli_query($GLOBALS["conn"], $sql);
		$resultado = mysqli_fetch_array($resp);

		$band = 0;

		if(!empty($resultado)){
			$codigo = $resultado["codigo"];
			$nombreUsuario = $_SESSION["User"];

			$sql = "INSERT INTO TIENE VALUES('$codigo','$nombreUsuario')";
			$resp = mysqli_query($GLOBALS["conn"], $sql);

			if($resp==false){
				$band = 2;
			}
		}
		else{
			$band = 1;
		}

		switch ($tipoUsuario) {
			case 'administrador':
				if($band == 1){
					echo '<script type="text/javascript">
			        	    alert("Este seguro no existe.");
			        	    window.location.href="cuentaAdmin.php";
			            </script>';
				}
				elseif($band == 2){
					echo '<script type="text/javascript">
		        	    alert("Error al adquirir este seguro. '.mysqli_error($GLOBALS["conn"]).'");
		        	    window.location.href="cuentaAdmin.php";
		            </script>';
				}
				else{
					echo '<script type="text/javascript">
			        	    alert("Este seguro se ha adquirido con éxito.");
			        	    window.location.href="cuentaAdmin.php";
			            </script>';
				}
				break;
			
			case 'estandar':
				if($band == 1){
					echo '<script type="text/javascript">
			        	    alert("Este seguro no existe.");
			        	    window.location.href="cuenta.php";
			            </script>';
				}
				elseif($band == 2){
					echo '<script type="text/javascript">
		        	    alert("Error al adquirir este seguro. '.mysqli_error($GLOBALS["conn"]).'");
		        	    window.location.href="cuenta.php";
		            </script>';
				}
				else{
					echo '<script type="text/javascript">
			        	    alert("Este seguro se ha adquirido con éxito.");
			        	    window.location.href="cuenta.php";
			            </script>';
				}
				break;
		}
	}

	function eliminarSeguro($codigoSeguro){
		$tipoUsuario = $_SESSION["tipoUser"];
		$nombreUsuario = $_SESSION["User"];

		$sql = "DELETE FROM TIENE WHERE codSeguro='$codigoSeguro' AND nombreUsuario='$nombreUsuario'";
		$resp = mysqli_query($GLOBALS["conn"],$sql);

		switch ($tipoUsuario){
			case 'administrador':
				echo '<script type="text/javascript">
			        	    alert("El seguro ha sido retirado de su cuenta.");
			        	    window.location.href="cuentaAdmin.php";
			            </script>';
				break;

			case 'estandar':
				echo '<script type="text/javascript">
			        	    alert("El seguro ha sido retirado de su cuenta.");
			        	    window.location.href="cuenta.php";
			            </script>';
				break;
		}
	}

	function eliminarUsuario(){
		$nombreUsuario = $_SESSION["User"];
		$sql = "DELETE FROM TIENE WHERE nombreUsuario='$nombreUsuario'";
		$resp = mysqli_query($GLOBALS["conn"],$sql);

		$sql = "DELETE FROM PERSONANATURAL WHERE nombreUsuario='$nombreUsuario'";
		$resp = mysqli_query($GLOBALS["conn"],$sql);

		$sql = "DELETE FROM PERSONAJURIDICA WHERE nombreUsuario='$nombreUsuario'";
		$resp = mysqli_query($GLOBALS["conn"],$sql);

		$sql = "DELETE FROM USUARIO WHERE nombreUsuario='$nombreUsuario'";
		$resp = mysqli_query($GLOBALS["conn"],$sql);

		echo '<script type="text/javascript">
        	    alert("Acaba de eliminar su cuenta con éxito.");
        	    window.location.href="iniciarSesion.php";
            </script>';
	}
?>