<?php
	include_once('encabezado.php');
	function getSeguro($seguro, $dirImagen, $textoResumen){
		$html = '
			<div class="encabezadoSeguro" style="width: 100%; height: 400px; background-color: rgb(214,214,214);">
				<br><br><img src='.$dirImagen.' style="width: 200px; height: 200px;" align="center"><br>
				<br><label style="margin: 60px 0px; font-family: Arial; font-weight: bold; font-size: 25px;">'.$seguro.'</label>
				<br><br><p style="text-align: justify; font-family:Arial; padding: 20px;">
					'.$textoResumen.'
				</p>
			</div><br><br>
			<label style="font-family: Arial;">Para adquirir un seguro debe iniciar sesión <a href="iniciarSesion.php">aquí</a></label>';
		return $html;
	}

	if(isset($_POST["acceder"])){
		switch ($_POST["acceder"]) {
			case 'seguroFamiliar':
				$seguro = getSeguro('Seguro familiar', 'imagenes/seguroFamiliar.png', 'El seguro familiar  le permite dejarle a sus seres queridos dinero para hacer frente a obligaciones que se generen en caso que usted o algun miembro de su familia (pareja e hijos) llegue a faltar.');
				break;
			case 'seguroVehicular':
				$seguro = getSeguro('Seguro vehicular', 'imagenes/seguroVehicular.png', 'Este seguro no te va a librar del trafico, pero vamos a cuidar tu vehiculo y mucho mas. Te guiamos para que puedas tomar la mejor decision y hacer uso completo de todas las asistencias que ofrecemos.');
				break;
			case 'seguroDeVida':
				$seguro = getSeguro('Seguro de vida', 'imagenes/seguroVida.png', 'El seguro de vida es contratado para proteger economicamente a las personas que dependan de ti en caso de tu fallecimiento, pues estos contaran con una indemnizacion que permita cubrir temporalmente sus necesidades economicas.');
				break;
			case 'seguroDeSalud':
				$seguro = getSeguro('Seguro de salud', 'imagenes/seguroSalud.png', 'El seguro de salud es una poliza de pago mensual, contratado a una aseguradora con el fin de costear de forma total o parcial diversos gastos medicos en los que se incluyen consultas, medicamentos, emergencias, entre otros beneficios.');
				break;
			case 'seguroDeViajes':
				$seguro = getSeguro('Seguro de viajes', 'imagenes/seguroViajes.png', 'El seguro de viajes es un servicio de asistencia que cubre cualquier circunstancia ocurrida durante el viaje. Tambien puedes contar con un seguro solo para un viaje en especifico o por un periodo de tiempo, cubriendo cualquier viaje que se realice en ese lapso.');
				break;
			case 'seguroDeAccidentes':
				$seguro = getSeguro('Seguro de accidentes', 'imagenes/seguroAccidentes.png', 'El seguro de accidentes cubre toda lesion corporal producida por la accion imprevista fortuita y/o ocasional de una fuerza externa que obra subita y violentamente sobre la persona independientemente de su voluntad y que pueda ser determinada por los medicos de una manera cierta.');
				break;
			default:
				# code...
				break;
		}
	}
?>

	<div class="cuerpo" align="center">
		<?php echo $seguro; ?>
	</div><br>
</body>
<?php include_once('pie.php');?>