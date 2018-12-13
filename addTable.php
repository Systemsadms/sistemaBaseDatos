<?php




$mysqli=new mysqli("localhost","root","","ptglatin_base"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

	//$consulta = "ALTER TABLE contacts DROP COLUMN clienteProspecto";
	$consulta1 = "ALTER TABLE contacts ADD aniversario date";
	$consulta2 = "ALTER TABLE contacts ADD cliente_prospecto text";
	$consulta3 = "ALTER TABLE contacts ADD ejecutivo text";
	$consulta4 = "ALTER TABLE contacts ADD monto_compra int";
	$consulta5 = "ALTER TABLE contacts ADD fecha_renovacion date";
	$consulta6 = "ALTER TABLE contacts ADD linea_negocio text";
	$consulta7 = "ALTER TABLE contacts ADD producto text";
	$consulta8 = "ALTER TABLE contacts ADD grupo text";
	$consulta13 = "ALTER TABLE contacts ADD sector text";
	$consulta9 = "ALTER TABLE contacts ADD genero text";
	$consulta10 = "ALTER TABLE contacts ADD fuente_bd text";
	$consulta11 = "ALTER TABLE contacts ADD ciudad text";
	$consulta12 = "ALTER TABLE contacts ADD pais text";
	

	//$sql = $mysqli->query($consulta);
	//$sql = $mysqli->query($consulta1);
	//$sql = $mysqli->query($consulta2);
	//$sql = $mysqli->query($consulta3);
	//$sql = $mysqli->query($consulta4);
	//$sql = $mysqli->query($consulta5);
	//$sql = $mysqli->query($consulta6);
	//$sql = $mysqli->query($consulta7);
	//$sql = $mysqli->query($consulta8);
	//$sql = $mysqli->query($consulta13);
	//$sql = $mysqli->query($consulta9);
	//$sql = $mysqli->query($consulta10);
	//$sql = $mysqli->query($consulta11);
	//$sql = $mysqli->query($consulta12);
	
	

	echo "Se agrego el sector";

?>