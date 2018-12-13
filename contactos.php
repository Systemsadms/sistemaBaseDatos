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


<div class="breadcrumb">Inicio /  <b>Busqueda de Contactos</b></div>



<div style="text-align: right; margin-right: 2%;">
<a href="busqueda.php">
	<input type="button" name="buscar" value="Busqueda Avanzada" class="input_buton" style="width: 300px; background-color: #25313E;">
</a>
</div>
<div class="panel">
			<div class="panel-heading">Busqueda Rapida</div>
			<div class="panel-body">
				<form method="post" action="#">
				<table>
					<tr>
						<td>Empresa</td>
						<td><input type="text" name="empresa"></td>
						<td>Pais</td>
						<td>
							<select name="pais">
									<option value="none" selected></option>
									<option value="ARG">Argentina</option>
									<option value="BOL">Bolivia</option>
									<option value="BRA">Brasil</option>
									<option value="CHL">Chile</option>
									<option value="COL">Colombia</option>
									<option value="ECU">Ecuador</option>
									<option value="GY">Guyana</option>
									<option value="PAN">Panama</option>
									<option value="PER">Peru</option>
									<option value="PRY">Paraguay</option>
									<option value="TRI">Trinidad y Tobago</option>
									<option value="URY">Uruguay</option>
									<option value="VEN">Venezuela</option>	
								</select>
						</td>
						<td style="text-align: right;">Fecha de Registro</td>	
						<td class="test"><select name="month">
											<option value="none" selected></option>
											<option value="01">Enero</option>
											<option value="02">Febrero</option>
											<option value="03">Marzo</option>
											<option value="04">Abril</option>
											<option value="05">Mayo</option>
											<option value="06">Junio</option>
											<option value="07">Julio</option>
											<option value="08">Agosto</option>
											<option value="09">Septiembre</option>
											<option value="10">Octubre</option>
											<option value="11">Noviembre</option>
											<option value="12">Diciembre</option>		
										</select>
						</td>
						<td class="test"><select name="year">
											<option value="none" selected></option>
											<option>2014</option>
											<option>2015</option>
											<option>2016</option>
											<option>2017</option>
											<option>2018</option>			
										</select>
						</td>
						<td class="test"><input type="submit" name="buscar" value="Buscar" class="input_buton"></td>
					</tr>

				</table>
	</form>
			</div>
</div>


	


<div>
<?php


if(isset($_POST['buscar'])){

	$const ="cont_id > '1'";
	$queryConsulta= $const;

	$empresa =$_POST['empresa'];
	$pais =$_POST['pais'];
	$year =$_POST['year'];
	$month =$_POST['month'];

	if($empresa != ""){
		$consultaEmpresa  =" and cont_companyname LIKE '%$empresa%'";
		$queryConsulta = $queryConsulta . $consultaEmpresa;
	}

	if($pais != "none"){
		$consultaPais  =" and cont_country = '$pais'";
		$queryConsulta = $queryConsulta . $consultaPais;
	}


	if($year != "none" && $month != "none"){
		
		$consultaYearMonth  =" and YEAR (cont_dateadded) = '$year' AND MONTH (cont_dateadded) = '$month'";
		$queryConsulta = $queryConsulta . $consultaYearMonth;

	}else if($year != "none" && $month =="none"){

		$consultaYear  =" and YEAR (cont_dateadded) = '$year'";
		$queryConsulta = $queryConsulta . $consultaYear;
	}



//Este if es importante ya que determina si los datos post estan vacios o no para hacerla consulta 
	if($year == "none" && $month !="none"){
		echo "Tienes que seleccionar el año para realizar consulta<br>";
	}else{
		if($empresa =="" && $pais=="none" && $year== "none")
		{
			echo "Debes seleccionar al menos un caracter de busqueda";
		}else{
			
			 $consulta = "SELECT * FROM contacts WHERE $queryConsulta  ";


			 		?>
			 		<div style="width: 90%; margin:0 auto; font-size: 13px;" >
					<div style="text-align: right;">
						<form action="exportarFecha.php" method="post" target="_blank">	
							<input type="hidden" name="consulta" value="<?php echo $consulta; ?>">			
							<input type='image' name='imageField' src='images/exportxls.gif' />
						</form>	
					</div>
					<?php

					$hacerconsulta=mysql_query ($consulta,$conexion);
							 //$hacerconsulta=mysql_query ($consulta,$conexion);
									
							echo "<table class='table-sm table-striped' style='width:100%;'>";
							echo "<tr>";
							echo "<td align='center' bgcolor='#e8e8e8'><b><font color='black'>Codigo</b></font></td>";
							echo "<td align='center' bgcolor='#e8e8e8'><b><font color='black'>Primer Nombre</b></td>";
							echo "<td align='center' bgcolor='#e8e8e8'><b><font color='black'>Primer Apellido</b></td>";
							echo "<td align='center' bgcolor='#e8e8e8'><b><font color='black'>Correo Electronico</b></td>";
							echo "<td align='center' bgcolor='#e8e8e8'><b><font color='black'>Empresa</b></td>";
							echo "<td align='center' bgcolor='#e8e8e8'><b><font color='black'>Pais</b></td>";
							echo "<td align='center' bgcolor='#e8e8e8'style='border: inset 0pt;'></td>";
							echo "<td align='center' bgcolor='#e8e8e8'style='border: inset 0pt;'></td>";
							echo "</tr>";
							
							
							$reg = mysql_fetch_array($hacerconsulta,MYSQL_BOTH);
							
							while ($reg)
							{
							echo "<tr>";
							echo "<td align='center' >".$reg[30]."</td>";
							echo "<td align='center' >".utf8_decode($reg[5])."</td>";
							echo "<td align='center' >".utf8_decode($reg[7])."</td>";
							echo "<td align='center' >".$reg[10]."</td>";
							echo "<td align='center' >".utf8_decode($reg[11])."</td>";
							echo "<td align='center' >".$reg[18]."</td>";


							echo "<td  align='center' style='border: inset 0pt'>				
								<form action='verClientes.php' method='post'>			
									<input type='hidden' name='idAdmin' value=".$reg[0].">
									<input type='image' name='imageField' src='images/view.gif' />
								</form>				
							</td>";//FIN DEL echo

							echo "<td  align='center' style='border: inset 0pt'>				
								<form action='editarClientes.php' method='post'>			
									<input type='hidden' name='idAdmin' value=".$reg[0].">
									<input type='image' name='imageField' src='images/edit.gif' />
								</form>				
							</td>";//FIN DEL echo
							


							$reg = mysql_fetch_array($hacerconsulta,MYSQL_BOTH);
							echo "</tr>";
							}
							echo "</table>";
							mysql_close($conexion);

							?>
								</div>
							<?php

		}// Fin del else $empresa =="" && $pais=="none" && $year== "none"	
		
	}//Fin de else $year == "none" && $month !="none"


}// Fin if isset post buscar


?>
</div>
























</body>
</html>

<?php

}else{
  header("location:index.php");
}

?>