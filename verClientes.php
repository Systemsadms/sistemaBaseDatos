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



<style type="text/css">
	
	.show{
		display: block;
	}

	.hidden{
		display: none;
	}
</style>


<script type="text/javascript">

$(function(){ 	
     $("#Dato1").click(function(e){
     	$("#elemento1Arcorderon").css("display", "block");
     	$("#elemento2Arcorderon").css("display", "none");
     	$("#elemento3Arcorderon").css("display", "none");
     	$("#elemento4Arcorderon").css("display", "none");
     });
     $("#Dato2").click(function(e){
     	$("#elemento1Arcorderon").css("display", "none");
     	$("#elemento2Arcorderon").css("display", "block");
     	$("#elemento3Arcorderon").css("display", "none");
     	$("#elemento4Arcorderon").css("display", "none");
     });
     $("#Dato3").click(function(e){
     	$("#elemento1Arcorderon").css("display", "none");
     	$("#elemento2Arcorderon").css("display", "none");
     	$("#elemento3Arcorderon").css("display", "block");
     	$("#elemento4Arcorderon").css("display", "none");
     }); 
});	
</script>


</head>
<body>



<header>
	<img src="images/logo.png">

</header>


<nav>
	<ul>
		<a href="dashboard.php"><li>Tablero</li></a>
		<a href="contactos.php"><li>Contactos</li></a>
		<a href="impContactos.php"><li>Importación de Datos</li></a>
		<a href="usuarios.php"><li>Usuarios</li></a>
		<a href="destruir.php"><li>Cerrar Sesión</li></a>	
	</ul>
</nav>


<div class="breadcrumb">Inicio /  <b>Detalles de Cliente</b></div>



<br><br>




<?php

echo $idAdmind= $_POST['idAdmin'];
?>





	<div class="panel">
	<div class="panel-heading">Detalles del Registro</div>
	<div class="panel-body">

		<div id="headerAcording">
			<div style="width: 200px; display: inline-block;">
				<input type="button" id="Dato1" value="Informacion Personal" class="input_buton" style="width: 200px;">
			</div>
			<div style="width: 230px; display: inline-block;">
				<input type="button" id="Dato2" value="Informacion Corporativa" class="input_buton" style="width: 230px;">
			</div>			
			<div style="width: 200px; display: inline-block;">
				<input type="button" id="Dato3" value="Segmentacion" class="input_buton" style="width: 200px;">
			</div>		
		</div>

		<div id="elemento1Arcorderon" class="show">Informacion Personal</div>
		<div id="elemento2Arcorderon" class="hidden">Informacion Corporativa</div>
		<div id="elemento3Arcorderon" class="hidden">Segmentacion</div>


	</div>
	</div>






</body>
</html>

<?php

}else{
  header("location:index.php");
}

?>