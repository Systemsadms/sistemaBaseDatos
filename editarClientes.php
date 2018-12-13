<?php

  session_start();
  if ($_SESSION['login'])
    {

    	require('cnx.php');
         
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inteligencia de Mercado</title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="UTF-8"/>

	<script  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>




</head>
<body>



<header>
	<img src="images/logo.png">

</header>


<nav>
	<ul>
		<a href="dashboard.php"><li>Tablero</li></a>
		<li>Contactos</li>
		<a href="impContactos.php"><li>Importación de Datos</li></a>
		<a href="usuarios.php"><li>Usuarios</li></a>
		<a href="destruir.php"><li>Cerrar Sesión</li></a>	
	</ul>
</nav>


<div class="breadcrumb">Inicio /  <b>Usuarios</b></div>



<br><br>

<div style="text-align: center; color:red;">SECCION EN CONSTRUCCION</div>










</body>
</html>

<?php

}else{
  header("location:index.php");
}

?>