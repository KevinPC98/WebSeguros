<?php
	include_once 'encabezado.php';
?>
	<div class="cuerpo" align="center">
		<table class="tablaPrincipal" align="center">
			<tbody>
				<tr>
					<td>
						<img src="imagenes/seguroFamiliar.png"><br><br>
						<label>Seguro familiar</label><br><br>
						<form action="seguro.php" method="post">
							<button id="acceder" type="submit" name="acceder" value="seguroFamiliar"><b>Acceder</b></button>
						</form>
					</td>
					<td>
						<img src="imagenes/seguroVehicular.png"><br><br>
						<label>Seguro vehicular</label><br><br>
						<form action="seguro.php" method="post">
							<button id="acceder" type="submit" name="acceder" value="seguroVehicular"><b>Acceder</b></button>
						</form>
					</td>
					<td>
						<img src="imagenes/seguroVida.png"><br><br>
						<label>Seguro de vida</label><br><br>
						<form action="seguro.php" method="post">
							<button id="acceder" type="submit" name="acceder" value="seguroDeVida"><b>Acceder</b></button>
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<img src="imagenes/seguroSalud.png"><br><br>
						<label>Seguro de salud</label><br><br>
						<form action="seguro.php" method="post">
							<button id="acceder" type="submit" name="acceder" value="seguroDeSalud"><b>Acceder</b></button>
						</form>
					</td>
					<td>
						<img src="imagenes/seguroViajes.png"><br><br>
						<label>Seguro de viajes</label><br><br>
						<form action="seguro.php" method="post">
							<button id="acceder" type="submit" name="acceder" value="seguroDeViajes"><b>Acceder</b></button>
						</form>
					</td>
					<td>
						<img src="imagenes/seguroAccidentes.png"><br><br>
						<label>Seguro de accidentes</label><br><br>
						<form action="seguro.php" method="post">
							<button id="acceder" type="submit" name="acceder" value="seguroDeAccidentes"><b>Acceder</b></button>
						</form>
					</td>
				</tr>
			</tbody>

		</table>
		<br>
	</div>
</body>
<?php
	include_once 'pie.php';
?>