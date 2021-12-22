<?php
	include_once ('encabezado.php');
	if(isset($_SESSION["User"])){
        session_unset();
        // destroy the session
        session_destroy();
    }
?>

<style type="text/css">
	body {
        background-image: url("imagenes/paisaje1.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        -o-background-size: cover;
        color: rgb(0,0,0);
        font-family: Arial;
    }
	/* Style the tab */
	.tab {
		width: 50%;
		overflow: hidden;
		border: 1px solid #ccc;
		background-color: rgb(0,0,0);
	}

	/* Style the buttons inside the tab */
	.tab button {
		background-color: inherit;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 14px 16px;
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
		display: none;
		border: 1px solid #ccc;
		border-top: none;
		width: 50%;
	}

	.regPersona {
		width: 50%;
	}

	.registrarPersona tbody tr td {
		padding: 5px;
	}

	.regEmpresa {
		width: 50%;
	}

	.registrarEmpresa tbody tr td {
		padding: 5px;
	}
</style>

<div class="cuerpo" align="center">

	<div class="tab">
		<button class="tablinks" onclick="openOption(event,'Persona', 'button1')" id="button1">Persona</button>
		<button class="tablinks" onclick="openOption(event, 'Empresa', 'button2')" id="button2">Empresa</button>
	</div>

	<body onload="openOption(event,'Persona', 'button1');">

	<div id="Persona" class="tabcontent">
		<div class="regPersona" style="background-color: rgb(207,208,232); width: 100%;">
			<form action="registrar.php" method="post">
				<div style="width: 100%; padding: 9px;">
					<table class="registrarPersona" style="width: 100%; font-family: Arial;">
						<tbody>
							<tr>
								<td style="width: 40%;">
									Tipo de documento:
								</td>
								<td>
									<select name="tipoDocumento" style="width: 100%; padding: 7px;" required="true">
										<option value="dni">D.N.I</option>
										<option value="ce">C.E.</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Número de documento: 
								</td>
								<td>
									<input type="number" name="nroDoc" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Nombres:
								</td>
								<td>
									<input type="text" name="txtNombres" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Apellidos:
								</td>
								<td>
									<input type="text" name="txtApellidos" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Correo electrónico:  
								</td>
								<td>
									<input type="email" name="email" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Teléfono: 
								</td>
								<td>
									<input type="number" name="telefono" style="width: 100%; padding: 7px;" required="true" max="999999999" min="999999999">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Dirección: 
								</td>
								<td>
									<input type="text" name="direccion" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Nombre de usuario: 
								</td>
								<td>
									<input type="text" name="nombreUsuario" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Contraseña:
								</td>
								<td>
									<input type="password" name="passwordR" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Confirmar contraseña: 
								</td>
								<td>
									<input type="password" name="passwordCR" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="hidden" name="tipoUsuario" value="persona">
									<button type="submit" name="btnRegistrar" style="border-style: none; background-color: rgb(0,0,255);color: rgb(255,255,255); padding: 10px;"><b>Registrar</b></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>

	<div id="Empresa" class="tabcontent">
		<div class="regEmpresa" style="background-color: rgb(207,208,232); width: 100%;">
			<form action="registrar.php" method="post">
				<div style="width: 100%; padding: 10px;">
					<table class="registrarEmpresa" style="width: 100%; font-family: Arial;">
						<tbody>
							<tr>
								<td style="width: 35%;">
									Número de R.U.C.: 
								</td>
								<td>
									<input type="number" name="nroRUC" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Nombre:
								</td>
								<td>
									<input type="text" name="txtNombre" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Correo electrónico:  
								</td>
								<td>
									<input type="email" name="email" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Teléfono: 
								</td>
								<td>
									<input type="number" name="telefono" style="width: 100%; padding: 7px;" required="true" max="999999999" min="999999999">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Dirección: 
								</td>
								<td>
									<input type="text" name="direccion" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Nombre de usuario: 
								</td>
								<td>
									<input type="text" name="nombreUsuario" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Contraseña: 
								</td>
								<td>
									<input type="password" name="passwordR" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td style="width: 35%;">
									Confirmar contraseña: 
								</td>
								<td>
									<input type="password" name="passwordCR" style="width: 100%; padding: 7px;" required="true">
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="hidden" name="tipoUsuario" value="empresa">
									<button type="submit" name="btnRegistrar" style="border-style: none; background-color: rgb(0,0,255);color: rgb(255,255,255); padding: 10px;"><b>Registrar</b></button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div> 
	</div>

	<script>
		function openOption(evt, optionName, idButton) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
			document.getElementById("button"+String(i+1)).style.backgroundColor = "rgb(0,0,0)";
			}
			document.getElementById(optionName).style.display = "block";
			document.getElementById(idButton).style.backgroundColor = "rgb(80,80,80)";
			evt.currentTarget.className += " active";
		}
	</script>
</div>
</body>
<?php include_once('pie.php');?>