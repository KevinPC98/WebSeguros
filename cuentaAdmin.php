<?php
	include_once 'encabezado.php';
	include_once 'conectarBD.php';
	session_start();
	if(!isset($_SESSION["User"])){
		session_unset();
        // destroy the session
        session_destroy();
		header("Location: inicio.php");
	}
	$nombreUsuario = $_SESSION["User"];
?>
	<style type="text/css">
		/* Style the tab */
		.tab {
			float: left;
		    border: 1px solid #ccc;
		    width: 10%;
		    height: 570px;
			background-color: rgb(0,0,0,0.8);
		}

		/* Style the buttons inside the tab */
		.tab button {
			display: block;
		    background-color: rgb(0,0,0,0.8);
		    padding: 22px 16px;
		    width: 100%;
		    border: none;
		    outline: none;
		    text-align: left;
		    cursor: pointer;
		    transition: 0.3s;
		    font-size: 17px;
			color: rgb(255,255,255);
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: rgb(78,78,78);
		}

		/* Create an active/current tablink class */
		.tab button.active {
			background-color: rgb(80,80,80);
		}

		/* Style the tab content */
		.tabcontent {
			float: left;
			padding: 22px 22px;
			border: 1px solid #ccc;
			border-top: none;
			overflow: auto;
			background-color: rgb(230,230,230,0.8);
			width: 90%;
			height: 570px;
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

	    .data {
	    	border-collapse: collapse;
	    	text-align: center;
	    	width: 60%;
	    }

	    .data tbody tr td {
	    	padding: 5px;
	    	border-style: solid;
	    	border-color: rgb(0,0,0);
	    }

	    .usuarios {
	    	border-collapse: collapse;
	    	text-align: center;
	    	width: 96%;
	    }

	    .usuarios tbody tr td {
	    	padding: 3px;
	    	border-style: solid;
	    	border-color: rgb(0,0,0);
	    }

	    .tablaSeguros {
			text-align: center;
			border-collapse: collapse;
		}


		.tablaSeguros tbody tr td {
			background-color: rgb(170,170,170,0.4);
			border-style: solid;
	    	border-color: rgb(130,130,130);
			padding: 30px;
		}

		#detalleSeguro {
			float: left;
			padding: 22px 22px;
			border: 1px solid #ccc;
			border-top: none;
			overflow: auto;
			width: 90%;
			height: 570px;
			display: none;
			background-color: rgb(255,255,255,0.6);
		}
	</style>
	<script type="text/javascript">
		function openOption(evt, optionName, idButton) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			document.getElementById("detalleSeguro").style.display = "none";
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
				document.getElementById("pestania"+String(i+1)).style.backgroundColor = "rgb(0,0,0)";
			}
			document.getElementById(optionName).style.display = "block";
			document.getElementById(idButton).style.backgroundColor = "rgb(80,80,80)";
			evt.currentTarget.className += " active";
		}

		function activar(idTabContent, seguro, seguroDescripcion, dirImagen){
			document.getElementById("detalleSeguro").style.display = "block";
			document.getElementById(idTabContent).style.display = "none";
			sessionStorage.setItem('idTC', idTabContent);

			var descripcion = "<div align='center'><img src="+dirImagen+" style='width: 130px; height: 130px;'></div><br><br><h2 align='center'>"+seguro+"</h2><br><br><p style='text-align: justify;'>"+seguroDescripcion+".</p>";
			document.getElementById("contenido").innerHTML = descripcion;
			document.getElementById("hseguro").value = seguro;
		}

		function desactivar(){
			document.getElementById("detalleSeguro").style.display = "none";
			var idTabContent = sessionStorage.getItem('idTC');
			document.getElementById(idTabContent).style.display = "block";
		}
	</script>

	<div class="cuerpo">
		<div class="tab">
			<button class="tablinks" onclick="openOption(event,'inicio', 'pestania1')" id="pestania1">Perfil</button>
			<button class="tablinks" onclick="openOption(event, 'seguros', 'pestania2')" id="pestania2">Seguros</button>
			<button class="tablinks" onclick="openOption(event, 'usuarios', 'pestania3')" id="pestania3">Usuarios</button>
			<button class="tablinks" id="pestania4"><a href="iniciarSesion.php" style="text-decoration: none; color: rgb(255,255,255)">Salir</a></button>
		</div>

		<body onload="openOption(event,'inicio', 'pestania1');">

		<div id="inicio" class="tabcontent" align="center">
			
			<!--Codigo PHP-->
			<?php
				$sql1 = "SELECT * FROM USUARIO WHERE nombreUsuario='$nombreUsuario'";
				$resp1 = mysqli_query($conn, $sql1);
				$array1 = mysqli_fetch_array($resp1);

				$sql2 = "SELECT tipoDoc, numDoc, nombre, apellido FROM PERSONANATURAL WHERE nombreUsuario='$nombreUsuario'";
				$resp2 = mysqli_query($conn, $sql2);
				$array2 = mysqli_fetch_array($resp2);

				$sql3 = "SELECT s.nombre nombre, s.codigo codigo FROM SEGURO s, TIENE t WHERE t.nombreUsuario='$nombreUsuario' AND t.codSeguro = s.codigo";
				$resp3 = mysqli_query($conn, $sql3);
				
				$i=0;
				while ($array3 = mysqli_fetch_array($resp3)) {
					$seguros[$i]["nombre"] = $array3["nombre"];
					$seguros[$i]["codigo"] = $array3["codigo"];
					$i++;
				}

				$html = '<b>BIENVENIDO </b> '.$nombreUsuario.'<br><br>
						<table class="data">
							<tbody>
								<tr>
									<td colspan="3" style="background-color: rgb(0,0,0,0.8); color: rgb(255,255,255);"><b>Información de cuenta</b></td>
								</tr>';

				if(empty($array2)){
					$sql2 = "SELECT ruc, nombre FROM PERSONAJURIDICA WHERE nombreUsuario='$nombreUsuario'";
					$resp2 = mysqli_query($conn, $sql2);
					$array2 = mysqli_fetch_array($resp2);

					$html = $html.'
									<tr>
										<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">R.U.C.:</td>
										<td colspan="2">'.$array2["ruc"].'</td>
									</tr>
									<tr>
						   		   		<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nombre:</td>
								   		<td colspan="2">'.$array2["nombre"].'</td>
						 	      	</tr>';
				}
				else{
					$html = $html.'
									<tr>
										<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Tipo de documento:</td>
										<td colspan="2">'.$array2["tipoDoc"].'</td>
									</tr>
									<tr>
										<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Número de documento:</td>
										<td colspan="2">'.$array2["numDoc"].'</td>
									</tr>
									<tr>
						   		   		<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nombre(s):</td>
								   		<td colspan="2">'.$array2["nombre"].'</td>
						 	      	</tr>
						 	      	<tr>
						 	      		<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Apellidos:</td>
						 	      		<td colspan="2">'.$array2["apellido"].'</td>
						 	      	</tr>';
				}

				$html = $html.'
						<tr>
							<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Dirección:</td>
							<td colspan="2">'.$array1["direccion"].'</td>
						</tr>
						<tr>
							<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Teléfono:</td>
							<td colspan="2">'.$array1["telefono"].'</td>
						<tr>
						</tr>
							<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Correo electrónico:</td>
							<td colspan="2">'.$array1["email"].'</td>
						</tr>';
				if($i==0){
					$html = $html.'
						<tr>
							<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Seguro(s):</td>
							<td colspan="2">Ninguno</td>
						</tr>';
				}
				else{
					$nroSeguros = count($seguros);

					$html = $html.'
						<tr>
							<td rowspan='.$nroSeguros.' style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Seguro(s):</td>
							<td>'.$seguros[0]["nombre"].'</td>
							<td>
							<form action="eliminarSeguro.php" method="post">
								<input type="hidden" name="codigo" value='.$seguros[0]["codigo"].'>
								<button type="submit" style="background-color: rgb(0,0,0,0.6); color: rgb(255,255,255); border-style: none; padding: 5px; font-size: 11px;" name="btnEliminar"><b>Eliminar</b></button>
							</form>
							</td>
						</tr>';
						for ($i=1; $i < $nroSeguros; $i++) { 
							$html .= '
								<tr>
									<td>'.$seguros[$i]["nombre"].'</td>
									<td>
										<form action="eliminarSeguro.php" method="post">
											<input type="hidden" name="codigo" value='.$seguros[$i]["codigo"].'>
											<button type="submit" style="background-color: rgb(0,0,0,0.6); color: rgb(255,255,255); border-style: none; padding: 5px; font-size: 11px;" name="btnEliminar"><b>Eliminar</b></button>
										</form>
									</td>
								</tr>';
						}
				}
				$html = $html.'</tbody>
				</table>';

				echo $html;
			?>
			<!--**********-->

		</div>

		<div id="detalleSeguro">
			<button class="salir" name="salir" style="background-color: rgb(0,45,255); color: rgb(255,255,255); border-style: none; padding: 15px;" onclick="desactivar();"><b>Salir</b></button>
			<form action="adquirirSeguro.php" method="post" style="display: inline;">
				<input type="hidden" id="hseguro" name="seguro">
				<button type="submit" class="adquirir" name="btnAdquirir" style="position: absolute; left: 78.5%; background-color: rgb(0,45,255); color: rgb(255,255,255); border-style: none; padding: 15px;" onclick="desactivar();"><b>Adquirir seguro</b></button>
			</form>
			<br><br>
			<div id="contenido" style="color: rgb(0,0,0);"></div>
		</div>

		<div id="seguros" class="tabcontent" align="center">
			
			<!--Seguros en la base de datos-->
			<?php
				$cantSeguros = 0;
				$sql = "SELECT COUNT(codigo) total FROM SEGURO";
				$resp = mysqli_query($conn,$sql);
				$aux = mysqli_fetch_array($resp);

				if(!empty($aux)){
					$cantSeguros = $aux["total"];

					if(($cantSeguros % 3) == 0){
						$nroFilas = $cantSeguros/3;
					}
					else{
						$nroFilas = ($cantSeguros/3) + 1;
					}

					$sql= "SELECT * FROM SEGURO";
					$resp = mysqli_query($conn, $sql);
					
					$i = 0;
					while ($array = mysqli_fetch_array($resp)) {
						$matrizSeguros[$i] = $array;
						$i++;
					}

					$k = 0;
					$tabla = '<table class="tablaSeguros"><tbody>';
					for ($i=0; $i < $nroFilas; $i++) {
						$tabla .= '
							<tr>';
								for ($j=$k; $j < $k+3 ; $j++) {
									$dirImagen = $matrizSeguros[$j]["dirImagen"];
									$nombreSeguro = $matrizSeguros[$j]["nombre"];
									$descripcionSeguro = $matrizSeguros[$j]["descripcion"];
								 	
								 	$tabla .= "
								 		<td>
								 			<img src=".$dirImagen." style=\"width: 85px; height: 85px;\"><br><br><label><b>".$nombreSeguro."</b></label><br><br>
											<button class=\"verMas\" name=\"verMas\" value=".$nombreSeguro." style=\"background-color: rgb(0,45,255); color: rgb(255,255,255); border-style: none; padding: 15px;\" onclick=\"activar('seguros','$nombreSeguro','$descripcionSeguro','$dirImagen')\";><b>Ver más</b></button>
								 		</td>";
								}
								$k+=3;
						$tabla .= '</tr>';
					}
					$tabla .= '</tbody></table>';
					echo $tabla;
				}
			?>
		</div>

		<div id="usuarios" class="tabcontent" align="center" style="padding: 12px 0px;">
			<table class="usuarios">
				<tbody>
					<tr>
						<td colspan="9" style="background-color: rgb(0,0,0,0.8); color: rgb(255,255,255);">Personas naturales</td>
					</tr>
					<tr>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nombre de usuario</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Tipo de documento</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nro de documento</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nombre(s)</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Apellido(s)</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Dirección</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Teléfono</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Correo electrónico</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Seguro</td>
					</tr>
					<?php
						$seguros = null;
						$var = '';
						$sql = "SELECT * FROM USUARIO NATURAL JOIN PERSONANATURAL";
						$resp = mysqli_query($conn,$sql);
						while ($fila = mysqli_fetch_array($resp)) {
							$username = $fila["nombreUsuario"];
							$sql4 = "SELECT s.nombre nombre FROM SEGURO s, TIENE t WHERE t.nombreUsuario='$username' AND t.codSeguro = s.codigo";
							$resp4 = mysqli_query($conn, $sql4);
							
							$i=0;
							while ($array4 = mysqli_fetch_array($resp4)) {
								$seguros[$i] = $array4["nombre"];
								$i++;
							}
							$nroSeguros = $i;

							$var = $var.'
								<tr>
									<td rowspan='.$nroSeguros.'>'.$fila["nombreUsuario"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["tipoDoc"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["numDoc"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["nombre"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["apellido"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["direccion"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["telefono"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["email"].'</td>';
									if($i == 0) {
										$var .= '<td>&nbsp</td>';
									}
									else {
										$var .= '<td>'.$seguros[0].'</td>';
									}
									

									$var .= 
								'</tr>';
								//$band = true;
								for ($a=1; $a < $nroSeguros; $a++) { 
									$var.= '
										<tr>
											<td>'.$seguros[$a].'</td>
										</tr>';
									//$band = false;
								}
								/*
								if($band) {
									$var .= '
										<tr>
											<td>&nbsp</td>
										</tr>';		
								}*/
						}
						echo $var;
					?>
				</tbody>
			</table><br><br>
			<table class="usuarios">
				<tbody>
					<tr>
						<td colspan="9" style="background-color: rgb(0,0,0,0.8); color: rgb(255,255,255);">Personas jurídicas</td>
					</tr>
					<tr>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nombre de usuario</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">R.U.C.</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Nombre</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Dirección</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Teléfono</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Correo electrónico</td>
						<td style="background-color: rgb(0,0,0,0.5); color: rgb(255,255,255);">Seguro</td>
					</tr>
					<?php
						$var = '';
						$sql = "SELECT * FROM USUARIO NATURAL JOIN PERSONAJURIDICA";
						$resp = mysqli_query($conn,$sql);
						while ($fila = mysqli_fetch_array($resp)) {
							$username = $fila["nombreUsuario"];
							$sql4 = "SELECT s.nombre nombre FROM SEGURO s, TIENE t WHERE t.nombreUsuario='$username' AND t.codSeguro = s.codigo";
							$resp4 = mysqli_query($conn, $sql4);
							
							$i=0;
							while ($array4 = mysqli_fetch_array($resp4)) {
								$seguros[$i] = $array4["nombre"];
								$i++;
							}
							$nroSeguros = $i;

							$var = $var.'
								<tr>
									<td rowspan='.$nroSeguros.'>'.$fila["nombreUsuario"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["ruc"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["nombre"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["direccion"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["telefono"].'</td>
									<td rowspan='.$nroSeguros.'>'.$fila["email"].'</td>
									<td>'.$seguros[0].'</td>
								</tr>';
								for ($i=1; $i < $nroSeguros; $i++) { 
									$var .= '
										<tr>
											<td>'.$seguros[$i].'</td>
										</tr>';
								}
						}
						echo $var;
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>

<?php
	include_once 'pie.php';
?>