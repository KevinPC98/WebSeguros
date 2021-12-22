<?php
	$servername = "localhost";
	$database = "SEGURODEVIDA";
	$username = "root";
	$password = "";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
	// Check connection
	if (!$conn) {
	      echo '<script type="text/javascript">
		                alert("No se pudo acceder a la base de datos.");
		                window.location.href="index.html";
		            </script>';
	}
	//echo "Connected successfully";
?>