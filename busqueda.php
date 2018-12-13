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
		<a href="contactos.php"><li>Contactos</li></a>
		<a href="impContactos.php"><li>Importación de Datos</li></a>
		<a href="usuarios.php"><li>Usuarios</li></a>
		<a href="destruir.php"><li>Cerrar Sesión</li></a>	
	</ul>
</nav>


<div class="breadcrumb">Inicio /  <b>Busqueda Avanzada</b></div>
























<?php

if(isset($_POST['buscarContactos'])){
 
 $cont_id = $_POST['id'];
 $cont_code = $_POST['code'];

 $cont_dateadded =$_POST['addYear']."-".$_POST['addMonth'];
 $year_dateadded =$_POST['addYear'];
 $month_dateadded =$_POST['addMonth'];

 $cont_addedby =$_POST['addedby'];
 $cont_updatedby =$_POST['updatedby'];

 $cont_lastupdate =$_POST['updateYear'].$_POST['updateMonth'];
 $year_lastupdate =$_POST['updateYear'];
 $month_lastupdate=$_POST['updateMonth'];

 $cont_firstname =$_POST['nombre'];
 $cont_middlename =$_POST['segundoNombre'];
 $cont_lastname1 =$_POST['apellido'];
 $cont_lastname2 =$_POST['segundoApellido'];
 $cont_jobtitle =$_POST['posicion'];
 $cont_email =$_POST['email'];
 $cont_companyname =$_POST['empresa'];
 $cont_workphone =$_POST['telefonoTrabajo'];
 $cont_cellphone =$_POST['telefonoMovil'];
 $cont_homephone =$_POST['telefonoCasa'];
 $cont_addressline1 =$_POST['direccion'];
 $cont_addressline2 =$_POST['direccion2'];
 $cont_addressline3 =$_POST['direccion3'];
 $cont_country =$_POST['pais'];
 //$cont_city =$_POST['ciudad'];
 $cont_zip =$_POST['zipCode'];
 $cont_website1 =$_POST['website'];
 $cont_website2 =$_POST['website2'];
 //$cont_employees =$_POST['empleados'];
 //$cont_birthday =$_POST['cumpleanos'];
 //$cont_sale_volume =$_POST['ventas'];

 

if(isset($_POST["grupo"]))
						{
	$cont_group =$_POST['grupo'];
	$cont_group2 = implode(', ', $cont_group);

	}else{
	 	$cont_group2 ="";
	}


if(isset($_POST["sector"]))
	{
	    $cont_sector =$_POST['sector'];
	    $cont_sector2 = implode(', ', $cont_sector);

	}else{
	    $cont_sector2 ="";
	}

if(isset($_POST["producto"]))
	{
	    $cont_producto =$_POST['producto'];
	    $cont_producto2 = implode(', ', $cont_producto);

	}else{
	    $cont_producto2 ="";
	}

if(isset($_POST["insdustria"]))
	{
							
		$cont_industria =$_POST['insdustria'];
		$cont_industria2 = implode(', ', $cont_industria);

	}else{
		$cont_industria2 ="";
	}

    


//ELABORACION DEL QUERY DE BUSQUEDA

	$const ="cont_id > '1'";
	$queryConsulta= $const;


if($cont_id != ""){
		
		$consultaId  =" and cont_id = '$cont_id'";
		$queryConsulta = $queryConsulta . $consultaId;
	}
//-------------------------------
if($cont_code != ""){
		
		$consultaCode  =" and cont_code LIKE '%$cont_code%'";
		$queryConsulta = $queryConsulta . $consultaCode;
	}
//-------------------------------
if($cont_dateadded != ""){

	if($year_dateadded != "none" && $month_dateadded != "none"){

		$consultaDateadded  =" and YEAR (cont_dateadded) = '$year_dateadded' AND MONTH (cont_dateadded) = '$month_dateadded'";
		$queryConsulta = $queryConsulta . $consultaDateadded;

	}elseif($year_dateadded != "none" && $month_dateadded =="none"){

		$consultaDateadded  =" and YEAR (cont_dateadded) = '$year_dateadded'";
		$queryConsulta = $queryConsulta . $consultaDateadded;

	}
}
//-------------------------------
if($cont_addedby != "none"){
		
		$consultaAddedby =" and cont_addedby = '$cont_addedby'";
		$queryConsulta = $queryConsulta . $consultaAddedby;
	}		
//-------------------------------
if($cont_updatedby != "none"){
		
		$consultaupdatedby =" and cont_updatedby = '$cont_updatedby'";
		$queryConsulta = $queryConsulta . $consultaupdatedby;
	}			
//-------------------------------
if($cont_lastupdate != ""){

	if($year_lastupdate != "none" && $month_lastupdate != "none"){

		$consultaLastupdate  =" and YEAR (cont_dateadded) = '$year_lastupdate' AND MONTH (cont_dateadded) = '$month_lastupdate'";
		$queryConsulta = $queryConsulta . $consultaLastupdate;

	}elseif($year_lastupdate != "none" && $month_lastupdate =="none"){

		$consultaLastupdate  =" and YEAR (cont_dateadded) = '$year_lastupdate'";
		$queryConsulta = $queryConsulta . $consultaLastupdate;

	}
}
//-------------------------------
if($cont_firstname != ""){
		
		$consultaFirstname  =" and cont_firstname = '$cont_firstname'";
		$queryConsulta = $queryConsulta . $consultaFirstname;
	}
//-------------------------------
if($cont_middlename != ""){
		
		$consultaMiddlename  =" and cont_middlename = '$cont_middlename'";
		$queryConsulta = $queryConsulta . $consultaMiddlename;
	}
//-------------------------------
if($cont_lastname1 != ""){
		
		$consultaLastname1  =" and cont_lastname1 = '$cont_lastname1'";
		$queryConsulta = $queryConsulta . $consultaLastname1;
	}
//-------------------------------
if($cont_lastname2 != ""){
		
		$consultaLastname2  =" and cont_lastname2 = '$cont_lastname2'";
		$queryConsulta = $queryConsulta . $consultaLastname2;
	}
//-------------------------------
if($cont_jobtitle != ""){
		
		$consultaJobtitle  =" and cont_jobtitle LIKE '%$cont_jobtitle%'";
		$queryConsulta = $queryConsulta . $consultaJobtitle;
	}
//-------------------------------
if($cont_email != ""){
		
		$consultaEmail  =" and cont_email = '$cont_email'";
		$queryConsulta = $queryConsulta . $consultaEmail;
	}
//-------------------------------
if($cont_companyname != ""){
		
		$consultaCompanyname  =" and cont_companyname LIKE '%$cont_companyname%'";
		$queryConsulta = $queryConsulta . $consultaCompanyname;
	}
//-------------------------------
if($cont_workphone != ""){
		
		$consultaWorkphone  =" and cont_workphone LIKE '%$cont_workphone%'";
		$queryConsulta = $queryConsulta . $consultaWorkphone;
	}
//-------------------------------
if($cont_cellphone != ""){
		
		$consultaCellphone  =" and cont_cellphone LIKE '%$cont_cellphone%'";
		$queryConsulta = $queryConsulta . $consultaCellphone;
	}
//-------------------------------
if($cont_homephone != ""){
		
		$consultaHomephone  =" and cont_homephone LIKE '%$cont_homephone%'";
		$queryConsulta = $queryConsulta . $consultaHomephone;
	}
//-------------------------------
if($cont_addressline1 != ""){
		
		$consultaAddressline1  =" and cont_addressline1 LIKE '%$cont_addressline1%'";
		$queryConsulta = $queryConsulta . $consultaAddressline1;
	}
//-------------------------------
if($cont_addressline2 != ""){
		
		$consultaAddressline2  =" and cont_addressline2 LIKE '%$cont_addressline2%'";
		$queryConsulta = $queryConsulta . $consultaAddressline2;
	}
//-------------------------------
if($cont_addressline3 != ""){
		
		$consultaAddressline3  =" and cont_addressline3 LIKE '%$cont_addressline3%'";
		$queryConsulta = $queryConsulta . $consultaAddressline3;
	}
//-------------------------------
if($cont_country != "none"){
		
		$consultaContry =" and cont_country = '$cont_country'";
		$queryConsulta = $queryConsulta . $consultaContry;
	}
//-------------------------------
if($cont_zip != ""){
		
		$consultaZip =" and cont_zip = '$cont_zip'";
		$queryConsulta = $queryConsulta . $consultaZip;
	}
//-------------------------------
if($cont_website1 != ""){
		
		$consultaWebsite1  =" and cont_website1 LIKE '%$cont_website1%'";
		$queryConsulta = $queryConsulta . $consultaWebsite1;
	}
//-------------------------------
if($cont_website2 != ""){
		
		$consultaWebsite2  =" and cont_website2 LIKE '%$cont_website2%'";
		$queryConsulta = $queryConsulta . $consultaWebsite2;
	}
//-------------------------------
	
if($cont_group2 != ""){
		
		//$consultaGroup  =" and cont_group LIKE '%$cont_group2%'";
		//$queryConsulta = $queryConsulta . $consultaGroup;

		$array = explode(",", $cont_group2);
		print_r($array);
		echo "<br>";		
		$grupos = count($array);
		$grupos--;

		$contador=-1;
		$test = "";

		for ($i=0; $i<=$grupos; $i++)
		{
			$contador++;
			//echo $contador."<br>";
			$consultaGroup  =" or cont_group LIKE '%$array[$contador]%'";
			$test = $test. $consultaGroup;
			

		}

		echo $test;
		$test = substr($test, 3);
		echo "<br>";
		$queryConsulta=$test;
	}
	
//-------------------------------
/*if($cont_group2 != ""){
		
		$consultaGroup  =" and cont_group LIKE '%$cont_group2%'";
		$queryConsulta = $queryConsulta . $consultaGroup;
	}

*/
//-------------------------------
if($cont_sector2 != ""){
		
		$consultaSector  =" and cont_sector LIKE '%$cont_sector2%'";
		$queryConsulta = $queryConsulta . $consultaSector;
	}	
//-------------------------------
if($cont_producto2 != ""){
		
		$consultaProducto  =" and cont_products LIKE '%$cont_producto2%'";
		$queryConsulta = $queryConsulta . $consultaProducto;
	}	
//-------------------------------
if($cont_industria2 != ""){
		
		$consultaIndustria  =" and cont_industries LIKE '%$cont_industria2%'";
		$queryConsulta = $queryConsulta . $consultaIndustria;
	}	








 $consultaBusqueda = "SELECT * FROM contacts WHERE" . $queryConsulta;

	/*
	if ($consultaBusqueda == "SELECT * FROM contacts WHEREcont_id > '1'"){
		echo "<div style='text-align:center; color:red;'>La consulta que esta intentado hacer no esta permitida, por favor verifique los datos</div>";
	}else{
*/
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

//}//FIn else la la consulta esta permitida

}//Fin if isset buscar contactos
?>



































































<div id="elemento1Arcorderon" class="show">
			<div class="panel">
			<div class="panel-heading">Buscar contactos por los siguientes datos</div>
			<div class="panel-body">

				<form method="post" action="#">
					<table>
						<tr>
							<td style="text-align: right;">ID</td>				
							<td><input type="text" name="id" class="input_text"></td>
							<td style="text-align: right;">Code</td>				
							<td><input type="text" name="code" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Nombre</td>				
							<td><input type="text" name="nombre" class="input_text"></td>
							<td style="text-align: right;">Segundo Nombre</td>				
							<td><input type="text" name="segundoNombre" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Primer Apellido</td>				
							<td><input type="text" name="apellido" class="input_text"></td>
							<td style="text-align: right;">Segundo apellido</td>				
							<td><input type="text" name="segundoApellido" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Fecha de Cumpleaños</td>				
							<td>
							<select name="addMonth">
									<option value="none" selected></option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>		
								</select>							
								<select name="addMonth">
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
								<select name="addYear">
									<option value="none" selected></option>
									<option>1980</option>
									<option>1981</option>
									<option>1982</option>
									<option>1983</option>
									<option>1984</option>
									<option>1985</option>			
								</select>
							</td>
							<td style="text-align: right;">Empresa</td>				
							<td><input type="text" name="empresa" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Posicion</td>				
							<td><input type="text" name="posicion" class="input_text"></td>
							<td style="text-align: right;">Correo Electronico</td>				
							<td><input type="text" name="email" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Empleados</td>				
							<td>
								<select name="empleados">
									<option value="none" selected></option>
									<option value="1-50">1 a 50</option>
									<option value="50-100">50 a 100</option>
									<option value="100-500">100 a 500</option>
									<option value="500-1000">500 a 1000</option>
									<option value="+1000">Mas de 1000</option>	
								</select>
							</td>
							<td style="text-align: right;">Volumen de Ventas</td>				
							<td>
								<select name="ventas">
									<option value="none" selected></option>
									<option value="0-1000">$0 - $1.000</option>
									<option value="1000-10000">$1.000 a $10.000</option>
									<option value="10000-20000">$10.000 a $20.000</option>
									<option value="20000-50000">$20.000 a $50.000</option>
									<option value="50000-100000">$50.000 a $100.000</option>
									<option value="+100000">Mas de $100.000</option>	
								</select>
							</td>
						</tr>
						<tr>
							<td style="text-align: right;">Pais</td>				
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
							<td style="text-align: right;">Ciudad</td>				
							<td><input type="text" name="ciudad" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Telefono Trabajo</td>				
							<td><input type="text" name="telefonoTrabajo" class="input_text"></td>
							<td style="text-align: right;">Telefono Movil</td>				
							<td><input type="text" name="telefonoMovil" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Telefono Casa</td>				
							<td><input type="text" name="telefonoCasa" class="input_text"></td>
							<td style="text-align: right;">Direccion</td>				
							<td><input type="text" name="direccion" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Direccion 2</td>				
							<td><input type="text" name="direccion2" class="input_text"></td>
							<td style="text-align: right;">Direccion 3</td>				
							<td><input type="text" name="direccion3" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Codigo Postal</td>				
							<td><input type="text" name="zipCode" class="input_text"></td>
							<td style="text-align: right;">Web Site 1</td>				
							<td><input type="text" name="website" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Web Site 2</td>				
							<td><input type="text" name="website2" class="input_text"></td>

						</tr>						
					</table>
<hr>
						<table>
						<tr>
							<td style="text-align: right;">Agregado Por</td>	
							<td>
								<select name="addedby">
									<option value="none" selected></option>
									<option>admin</option>
									<option>beliro7</option>
									<option>daniel</option>			
								</select>
							</td>
							<td style="text-align: right;">Actualizado Por</td>				
							<td>
								<select name="updatedby">
									<option value="none" selected></option>
									<option>admin</option>
									<option>beliro7</option>
									<option>daniel</option>			
								</select>
							</td>
						</tr>
						<tr>
							<td style="text-align: right;">Fecha de Creacion</td>				
							<td>
								<select name="addMonth">
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
								<select name="addYear">
									<option value="none" selected></option>
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>			
								</select>
							</td>
							<td style="text-align: right;">Ultima Actualizacion</td>				
							<td>
								<select name="updateMonth">
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
								<select name="updateYear">
									<option value="none" selected></option>
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>			
								</select>
							</td>
						</tr>					
						</table>
<hr>
						<table>
						<tr>
							<td style="text-align: center;">Grupos:</td>		
							
							<td>
								<table>
									<tr>
										<td><input type="checkbox" name="grupo[]" value="70"> --Sin Grupo--</td>
										<td><input type="checkbox" name="grupo[]" value="88"> ATS</td>
										<td><input type="checkbox" name="grupo[]" value="73"> Cliente CS</td>
										<td><input type="checkbox" name="grupo[]" value="84"> Cliente SI</td>
										<td><input type="checkbox" name="grupo[]" value="86"> Prospectos CS</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="grupo[]" value="85"> Prospectos SI</td>
										<td><input type="checkbox" name="grupo[]" value="87"> TCI</td>
									</tr>

								</table>
							</td>
						</tr>
						</table>
<hr>
					<table>
						<tr>
							<td style="text-align: center;">Sectores:</td>		
							
							<td>
								<table>
									<tr>
										<td><input type="checkbox" name="sector[]" value="69"> --Sin Sector--</td>
										<td><input type="checkbox" name="sector[]" value="70"> Aerospace</td>
										<td><input type="checkbox" name="sector[]" value="87"> Alimentos</td>
										<td><input type="checkbox" name="sector[]" value="77"> Automotriz</td>
										<td><input type="checkbox" name="sector[]" value="86"> Bancario o Financiero</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="sector[]" value="88"> Ciencias Ambientales</td>
										<td><input type="checkbox" name="sector[]" value="89"> Clinicas</td>
										<td><input type="checkbox" name="sector[]" value="75"> Defensa Militar y Seguridad</td>
										<td><input type="checkbox" name="sector[]" value="84"> Electronica y Comunicaciones</td>
										<td><input type="checkbox" name="sector[]" value="73"> Energia y Servicios Municipales</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="sector[]" value="83"> Especialistas Consultores Calidad SDO'S</td>
										<td><input type="checkbox" name="sector[]" value="74"> Firmas de Ingeniería, Civil y Construcción</td>
										<td><input type="checkbox" name="sector[]" value="78"> Manufacturas en General y Metal-Mecánica</td>
										<td><input type="checkbox" name="sector[]" value="82"> Logística y Traders</td>
										<td><input type="checkbox" name="sector[]" value="79"> Minería</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="sector[]" value="71"> Oil and Gas</td>
										<td><input type="checkbox" name="sector[]" value="76"> Puertos, Astilleros, Administraciones Maritimas, Transportadoras Marítimas, Logísticas</td>
										<td><input type="checkbox" name="sector[]" value="72"> Química y Petroquímica</td>
										<td><input type="checkbox" name="sector[]" value="85"> Tecnología</td>
										<td><input type="checkbox" name="sector[]" value="81"> Universidad Tecnológica</td>
									</tr>
								</table>
								

							</td>
						</tr>
					</table>
<hr>
					<table>
						<tr>
							<td style="text-align: center;">Productos:</td>		
							
							<td>
								<table>
									<tr>
										<td><input type="checkbox" name="producto[]" value="13"> --Sin Producto--</td>
										<td><input type="checkbox" name="producto[]" value="16"> Access Engineering</td>
										<td><input type="checkbox" name="producto[]" value="20"> Caps, 4 D Online</td>
										<td><input type="checkbox" name="producto[]" value="18"> Esdu</td>
										<td><input type="checkbox" name="producto[]" value="19"> Fairplay</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="producto[]" value="17"> Gold Fire</td>
										<td><input type="checkbox" name="producto[]" value="21"> Haystack</td>
										<td><input type="checkbox" name="producto[]" value="23"> Janes</td>
										<td><input type="checkbox" name="producto[]" value="15"> Knowledge Collection</td>
										<td><input type="checkbox" name="producto[]" value="24"> Product Desing</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="producto[]" value="22"> Smart PM</td>
										<td><input type="checkbox" name="producto[]" value="14"> Standards</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>									
								</table>
								

							</td>
						</tr>
					</table>
<hr>
					<table>
						<tr>
							<td style="text-align: center;">Industrias:</td>		
							
							<td>
								<table>
									<tr>
										<td><input type="checkbox" name="insdustria[]" value="26"> --Sin Función--</td>
										<td><input type="checkbox" name="insdustria[]" value="39"> Bibliotecario</td>
										<td><input type="checkbox" name="insdustria[]" value="28"> Director</td>
										<td><input type="checkbox" name="insdustria[]" value="32"> Especialista</td>
										<td><input type="checkbox" name="insdustria[]" value="30"> Gerente</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="insdustria[]" value="33"> Ingeniero</td>
										<td><input type="checkbox" name="insdustria[]" value="37"> Ministro de Defensa</td>
										<td><input type="checkbox" name="insdustria[]" value="27"> Presidente</td>
										<td><input type="checkbox" name="insdustria[]" value="31"> Sub-Gerente</td>
										<td><input type="checkbox" name="insdustria[]" value="29"> Subdirector</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="insdustria[]" value="34"> Vicepresidente</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>									
								</table>
								

							</td>
						</tr>
					</table>
<hr>
					<div style="text-align: center;"><input style ="width: 200px;" type="submit" name="buscarContactos" value="Buscar Contactos" class="input_buton"></div>
				</form>
			</div>
		</div>




















































</body>
</html>

<?php

}else{
  header("location:index.php");
}

?>