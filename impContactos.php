<?php

  session_start();
  if ($_SESSION['login'])
    {

    	require("cnx.php");
         
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
		<li>Importación de Datos</li>
		<a href="usuarios.php"><li>Usuarios</li></a>
		<a href="destruir.php"><li>Cerrar Sesión</li></a>	
	</ul>
</nav>


<div class="breadcrumb">Inicio /  <b>Importar Contactos</b></div>















<?php
//-----------------------Carga de Archivos-------------------------//
				//
					/////RECUERDA LOS PERMISOS DE ESCRITURA EN CARPETA PARA SUBIR ARCHIVOS AL SERVIDOR
				//
if(isset($_POST['subir'])){




if ($_FILES['archivo']["error"] > 0)
			  {
			  echo "Error: " . $_FILES['archivo']['error'] . "<br>";
			  }
			else
			  {
			  /*
			  echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";			  
			  echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
			  echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
			  echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name']."<br>";
				*/

			  if($_FILES['archivo']['type']=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){

			  	move_uploaded_file($_FILES['archivo']['tmp_name'], "upload/" . $_FILES['archivo']['name']);

			  	echo "<div class='guardado'>El Archivo Se Cargo con exito</div><br><br>";


			  	require 'Classes/PHPExcel/IOFactory.php'; //Agregamos la librería 
				require 'conexion.php'; //Agregamos la conexión
				
				//Variable con el nombre del archivo
				$archivoUpload = $_FILES['archivo']['name'];
				$nombreArchivo = "upload/" . $archivoUpload;
				// Cargo la hoja de cálculo
				$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
				
				//Asigno la hoja de calculo activa
				$objPHPExcel->setActiveSheetIndex(0);
				//Obtengo el numero de filas del archivo
				$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


				echo '
				<div style="text-align:center;">Resumen de contactos Guardados</div>			
				<table border="1" align="center">				
				<tr>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Correo</td>
				<td>Empresa</td>
				<td>Log</td>
				</tr>
				';
				
				for ($i = 2; $i <= $numRows; $i++) {
					
					 date_default_timezone_set('America/Caracas');
					 $cont_dateadded =date('Y-m-d G:i:s');
					 $cont_addedby =$_SESSION['login'];
					 $cont_updatedby ="";
					 $cont_lastupdate ="";
					 $cont_firstname =		$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
					 $cont_middlename =	"";
					 $cont_lastname1 =		$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
					 $cont_lastname2 ="";
					 $cont_birthday =		$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
					 $aniversario =			$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
					 $cont_jobtitle =		$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
					 $cont_email =			$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
					 $cont_companyname =	$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
					 $cont_workphone =		$objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
					 $cont_cellphone =		$objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
					 $cont_homephone ="";
					 $cont_addressline1 =	$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
					 $cont_addressline2 ="";
					 $cont_addressline3 ="";
					 $cont_country = 		"";
					 $pais = 				$objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
					 $sector = 				$objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
					 $clienteProspecto = 	$objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
					 $cont_website1 =		$objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
					 $cont_website2 = "";
					 $ejecutivo = 			$objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
					 $lineaNegocios = 		$objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
					 $productos = 			$objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();
					 $montoCompra = 		$objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue();
					 $fechaRenovacion =		$objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue();
					 $fuenteBd = 			$objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue();
					 $cont_employees =		$objPHPExcel->getActiveSheet()->getCell('U'.$i)->getCalculatedValue();
					 $grupos =				$objPHPExcel->getActiveSheet()->getCell('V'.$i)->getCalculatedValue();
					 $genero =				$objPHPExcel->getActiveSheet()->getCell('W'.$i)->getCalculatedValue();
					 $ciudad =				$objPHPExcel->getActiveSheet()->getCell('X'.$i)->getCalculatedValue();
					 $cont_city = "";
					 $cont_zip ="";			
					 $cont_sale_volume ="";


					 

					  if(isset($_POST["grupo"]))
						{
						    //$cont_group =$_POST['grupo'];
						     //$cont_group2 = implode(', ', $cont_group);
							$cont_group2 ="";

						}else{
						     $cont_group2 ="";
						}

					if(isset($_POST["sector"]))
						{
						    //$cont_sector =$_POST['sector'];
						    //$cont_sector2 = implode(', ', $cont_sector);
						    $cont_sector2 ="";

						}else{
						     $cont_sector2 ="";
						}

					if(isset($_POST["producto"]))
						{
						    //$cont_producto =$_POST['producto'];
						    //$cont_producto2 = implode(', ', $cont_producto);
						    $cont_producto2 ="";

						}else{
						     $cont_producto2 ="";
						}

					if(isset($_POST["insdustria"]))
						{
						    //$cont_industria =$_POST['insdustria'];
						    //$cont_industria2 = implode(', ', $cont_industria);
						    $cont_industria2 ="";

						}else{
						     $cont_industria2 ="";
						}


						$rs = mysql_query("SELECT MAX(cont_code) AS cont_code FROM contacts");
					                if ($row = mysql_fetch_row($rs)) {
					                $code = trim($row[0]);
					                }

					                $code = ereg_replace("[^0-9]", "", $code);
					                $code++;
					                $count_code = "CODE-".$code;


					     $ssql = mysql_query("SELECT * FROM contacts WHERE cont_email='$cont_email'");
					      if (mysql_num_rows($ssql)>0){



					      	$consulta="UPDATE contacts SET 
								cont_firstname = '$cont_firstname',
								cont_lastname1 = '$cont_lastname1',
								cont_birthday  = '$cont_birthday',
								genero 		   = '$genero',
								cont_jobtitle  = '$cont_jobtitle',	
								cont_workphone = '$cont_workphone',
								cont_cellphone = '$cont_cellphone',
								cont_companyname = '$cont_companyname',
								aniversario    = '$aniversario',
								pais 		   = '$pais',
								ciudad  	   = '$ciudad',
								cont_addressline1 = '$cont_addressline1',
								linea_negocio  = '$lineaNegocios',
								grupo 		   = '$grupos',
								sector 		   = '$sector',
								producto 	   = '$productos',
								cliente_prospecto = '$clienteProspecto',
								ejecutivo 	   = '$ejecutivo',
								monto_compra    = '$montoCompra',
								fecha_renovacion = '$fechaRenovacion',
								cont_employees = '$cont_employees',
								fuente_bd	   = '$fuenteBd',
								cont_website1  = '$cont_website1'
								WHERE cont_email = '$cont_email'";
							$sql = mysql_query($consulta, $conexion);

















					      	$log ="<font color='red'>Datos Actualizados</font>";
					      }else{
					      	$log= "<font color='green'>Contacto Registrado</font>";


					      	//Aqui va el query donde se reemplazan los datos


					      }
					      

					if ($cont_email == ""){						
					}else{
					
						echo '<tr>';
						echo '<td>'. $cont_firstname.'</td>';
						echo '<td>'. $cont_lastname1.'</td>';
						echo '<td>'. $cont_email.'</td>';
						echo '<td>'. $cont_companyname.'</td>';
						echo '<td>'. $log.'</td>';
						echo '</tr>';
					}
					
					
					$sql = "INSERT INTO contacts (
					cont_dateadded, 
					cont_addedby, 
					cont_updatedby, 
					cont_lastupdate,
					cont_firstname,
					cont_middlename,
					cont_lastname1,
					cont_lastname2,
					cont_jobtitle,
					cont_email,
					cont_companyname,
					cont_workphone,
					cont_cellphone,
					cont_homephone,
					cont_addressline1,
					cont_addressline2,
					cont_addressline3,
					cont_country,
					cont_zip,
					cont_website1,
					cont_website2,
					cont_group,
					cont_sector,
					cont_birthday,
					cont_products,
					cont_industries,
					cont_code,
					aniversario,
					sector,
					cliente_prospecto,
					ejecutivo,
					linea_negocio,
					producto,
					monto_compra,
					fecha_renovacion,
					fuente_bd,
					cont_employees,
					grupo,
					genero,
					ciudad,
					pais
					) VALUES(
					'$cont_dateadded',
					'$cont_addedby',
					'$cont_updatedby',
					'$cont_lastupdate',
					'$cont_firstname',
					'$cont_middlename',
					'$cont_lastname1',
					'$cont_lastname2',
					'$cont_jobtitle',
					'$cont_email',
					'$cont_companyname',
					'$cont_workphone',
					'$cont_cellphone',
					'$cont_homephone',
					'$cont_addressline1',
					'$cont_addressline2',
					'$cont_addressline3',
					'$cont_country',
					'$cont_zip',
					'$cont_website1',
					'$cont_website2',
					'$cont_group2',
					'$cont_sector2',
					'$cont_birthday',
					'$cont_producto2',
					'$cont_industria2',
					'$count_code',
					'$aniversario',
					'$sector',
					'$clienteProspecto',
					'$ejecutivo',
					'$lineaNegocios',
					'$productos',
					'$montoCompra',
					'$fechaRenovacion',
					'$fuenteBd',
					'$cont_employees',
					'$grupos',
					'$genero',
					'$ciudad',
					'$pais'
					)";
					$result = $mysqli->query($sql);
					
				} //Fin del ciclo For
				
				echo '<table>';				

			  }else{
			  	echo "El formato de archivo no es el correcto ";
			  }
			}

}
?>














































<?php
//-----------------------Carga de Contacto-------------------------//


if(isset($_POST['guardarContacto'])){

 date_default_timezone_set('America/Caracas');
 $cont_dateadded =date('Y-m-d G:i:s');
 $cont_addedby =$_SESSION['login'];
 $cont_updatedby ="";
 $cont_lastupdate ="";
 $cont_firstname =$_POST['nombre'];
 $cont_middlename ="";
 $cont_lastname1 =$_POST['apellido'];
 $cont_lastname2 ="";
 $cont_jobtitle =$_POST['posicion'];
 $cont_email =$_POST['email'];
 $cont_companyname =$_POST['empresa'];
 $cont_workphone =$_POST['telefonoTrabajo'];
 $cont_cellphone =$_POST['telefonoMovil'];
 $cont_homephone ="";
 $cont_addressline1 =$_POST['direccion'];
 $cont_addressline2 ="";
 $cont_addressline3 ="";
 $cont_country ="";
 $cont_city ="";
 $cont_zip ="";
 $cont_website1 =$_POST['website'];
 $cont_website2 ="";
 $cont_employees =$_POST['empleados'];
 $cont_birthday =$_POST['yearBirthday']."-".$_POST['monthBirthday']."-".$_POST['dayBirthday'];
 $cont_sale_volume ="";
 $cont_code ="";

 $aniversario = '0000'."-".$_POST['monthAniversary']."-".$_POST['dayAniversary'];
 $clienteProspecto = $_POST['clienteProspecto'];
 $ejecutivo = $_POST['ejecutivo'];
 $montoCompra = $_POST['montoCompra'];
 $fecha_renovacion =$_POST['yearRenovacion']."-".$_POST['monthRenovacion']."-".$_POST['dayRenovacion'];
 $lineaNegocios = $_POST['lineaNegocios'];
 $producto = $_POST['productos'];
 $grupo = $_POST['grupos'];
 $sector = $_POST['sector'];
 $genero = $_POST['genero'];
 $fuenteBd = $_POST['fuenteBd'];
 $ciudad = $_POST['ciudad'];
 $pais = $_POST['pais'];





 if(isset($_POST["grupo"]))
	{
	    //$cont_group =$_POST['grupo'];
	     //$cont_group2 = implode(', ', $cont_group);
		$cont_group2 ="";
		

	}else{
	     $cont_group2 ="";
	}

if(isset($_POST["sector"]))
	{
	    //$cont_sector =$_POST['sector'];
	    //$cont_sector2 = implode(', ', $cont_sector);
	    $cont_sector2 ="";
	   

	}else{
	     $cont_sector2 ="";
	}

if(isset($_POST["producto"]))
	{
	    //$cont_producto =$_POST['producto'];
	      //$cont_producto2 = implode(', ', $cont_producto);
		$cont_producto2 ="";
		

	}else{
	     $cont_producto2 ="";
	}

if(isset($_POST["insdustria"]))
	{
	    //$cont_insdustria =$_POST['insdustria'];
	    //$cont_insdustria2 = implode(', ', $cont_insdustria);
	    $cont_insdustria2 ="";
	   

	}else{
	     $cont_insdustria2 ="";
	}


include ("cnx.php");



$ssql = "SELECT * FROM contacts WHERE cont_email='$cont_email'";
$rs = mysql_query($ssql,$conexion);
if (mysql_num_rows($rs)>0)
{     




$consulta="UPDATE contacts SET 
	cont_firstname = '$cont_firstname',
	cont_lastname1 = '$cont_lastname1',
	cont_birthday  = '$cont_birthday',
	genero 		   = '$genero',
	cont_jobtitle  = '$cont_jobtitle',	
	cont_workphone = '$cont_workphone',
	cont_cellphone = '$cont_cellphone',
	cont_companyname = '$cont_companyname',
	aniversario    = '$aniversario',
	pais 		   = '$pais',
	ciudad  	   = '$ciudad',
	cont_addressline1 = '$cont_addressline1',
	linea_negocio  = '$lineaNegocios',
	grupo 		   = '$grupo',
	sector 		   = '$sector',
	producto 	   = '$producto',
	cliente_prospecto = '$clienteProspecto',
	ejecutivo 	   = '$ejecutivo',
	monto_compra    = '$montoCompra',
	fecha_renovacion = '$fecha_renovacion',
	cont_employees = '$cont_employees',
	fuente_bd	   = '$fuenteBd',
	cont_website1  = '$cont_website1'
	WHERE cont_email = '$cont_email'";
$sql = mysql_query($consulta, $conexion);



    echo "<div class='noGuardado'>Los datos del contacto fueron actualizados con exito</div>";
}else{



$rs = mysql_query("SELECT MAX(cont_code) AS cont_code FROM contacts");
                if ($row = mysql_fetch_row($rs)) {
                $code = trim($row[0]);
                }

                $code = ereg_replace("[^0-9]", "", $code);
                $code++;
                $count_code = "CODE-".$code;


mysql_query ("INSERT INTO contacts VALUES (
	'',
	'$cont_dateadded',
	'$cont_addedby',
	'$cont_updatedby',
	'$cont_lastupdate',
	'$cont_firstname',
	'$cont_middlename',
	'$cont_lastname1',
	'$cont_lastname2',
	'$cont_jobtitle',
	'$cont_email',
	'$cont_companyname',
	'$cont_workphone',
	'$cont_cellphone',
	'$cont_homephone',
	'$cont_addressline1',
	'$cont_addressline2',
	'$cont_addressline3',
	'$cont_country',
	'$cont_city',
	'$cont_zip',
	'$cont_website1',
	'$cont_website2',
	'$cont_group2',
	'$cont_sector2',
	'$cont_employees',
	'$cont_birthday',
	'$cont_producto2',
	'$cont_sale_volume',
	'$cont_insdustria2',
	'$count_code',
	'$aniversario',
	'$clienteProspecto',
	'$ejecutivo',
	'$montoCompra',
	'$fecha_renovacion',
	'$lineaNegocios',
	'$producto',
	'$grupo',
	'$sector',
	'$genero',
	'$fuenteBd',
	'$ciudad',
	'$pais'
)");

		echo "<div class='guardado'>El contacto fuer guardado con exito</div>";

	}



}

?>














































<br><br>
<div id="according">
	<div id="headerAcording">
		<div style="width: 200px; display: inline-block;">
			<input type="button" id="Dato1" value="Insertar Nuevo Contacto" class="input_buton" style="width: 200px;">
		</div>
		<div style="width: 230px; display: inline-block;">
			<input type="button" id="Dato2" value="Importar Archvio de Contactos" class="input_buton" style="width: 230px;">
		</div>
		<!--
		<div style="width: 200px; display: inline-block;">
			<input type="button" id="Dato3" value="Archivos Importados" class="input_buton" style="width: 200px;">
		</div>
		-->
	</div>

	<div id="elemento1Arcorderon" class="show">
			<div class="panel">
			<div class="panel-heading">Registro de Contacto</div>
			<div class="panel-body">

				<form method="post" action="#">
					<table>
						<tr>
							<td style="text-align: right;">Nombre</td>				
							<td><input type="text" name="nombre" class="input_text"></td>
							<td style="text-align: right;">Primer Apellido</td>				
							<td><input type="text" name="apellido" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Fecha de Cumpleaños</td>				
							<td>
										<select name="dayBirthday">
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
										<select name="monthBirthday">
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
										<select name="yearBirthday">
											<option value="none" selected></option>
											<option value="2003">2003</option>
											<option value="2002">2002</option>
											<option value="2001">2001</option>
											<option value="2000">2000</option>
											<option value="1999">1999</option>
											<option value="1998">1998</option>
											<option value="1997">1997</option>
											<option value="1996">1996</option>
											<option value="1995">1995</option>
											<option value="1994">1994</option>
											<option value="1993">1993</option>
											<option value="1992">1992</option>
											<option value="1991">1991</option>
											<option value="1990">1990</option>
											<option value="1989">1989</option>
											<option value="1988">1988</option>
											<option value="1987">1987</option>
											<option value="1986">1986</option>
											<option value="1985">1985</option>
											<option value="1984">1984</option>
											<option value="1983">1983</option>
											<option value="1982">1982</option>
											<option value="1981">1981</option>
											<option value="1980">1980</option>
											<option value="1979">1979</option>
											<option value="1978">1978</option>
											<option value="1977">1977</option>
											<option value="1976">1976</option>
											<option value="1975">1975</option>
											<option value="1974">1974</option>
											<option value="1973">1973</option>
											<option value="1972">1972</option>
											<option value="1971">1971</option>
											<option value="1970">1970</option>
											<option value="1969">1969</option>
											<option value="1968">1968</option>
											<option value="1967">1967</option>
											<option value="1966">1966</option>
											<option value="1965">1965</option>
											<option value="1964">1964</option>
											<option value="1963">1963</option>
											<option value="1962">1962</option>
											<option value="1961">1961</option>
											<option value="1960">1960</option>
											<option value="1959">1959</option>
											<option value="1958">1958</option>
											<option value="1957">1957</option>
											<option value="1956">1956</option>
											<option value="1955">1955</option>
											<option value="1954">1954</option>
											<option value="1953">1953</option>
											<option value="1952">1952</option>
											<option value="1951">1951</option>
											<option value="1950">1950</option>
											<option value="1949">1949</option>
											<option value="1948">1948</option>
											<option value="1947">1947</option>
											<option value="1946">1946</option>
											<option value="1945">1945</option>


										</select>
						</td>
							<td style="text-align: right;">Genero</td>
							<td>			
							<select name="genero">
									<option value="none" selected></option>
									<option value="masculino">Masculino</option>
									<option value="femenino">Femenino</option>
							</select>
							</td>
						</tr>
						<tr>
							<td style="text-align: right;">Posicion</td>				
							<td><input type="text" name="posicion" class="input_text"></td>
							<td style="text-align: right;">Correo Electronico</td>				
							<td><input type="text" name="email" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Telefono Trabajo</td>				
							<td><input type="text" name="telefonoTrabajo" class="input_text"></td>
							<td style="text-align: right;">Telefono Movil</td>				
							<td><input type="text" name="telefonoMovil" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Empresa</td>				
							<td><input type="text" name="empresa" class="input_text"></td>
							<td style="text-align: right;">Aniversario</td>
							<td>
										<select name="monthAniversary">
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

										<select name="dayAniversary">
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
						</td>
						</tr>
						<tr>							
							<td style="text-align: right;">Pais</td>				
							<td>
								<select name="pais">
									<option value="none" selected></option>
									<option value="Argentina">Argentina</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Brasil">Brasil</option>
									<option value="Chile">Chile</option>
									<option value="Colombia">Colombia</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Guyana">Guyana</option>
									<option value="Panama">Panama</option>
									<option value="Peru">Peru</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Trinidad">Trinidad y Tobago</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Venezuela">Venezuela</option>
								</select>
							</td>
							<td style="text-align: right;">Ciudad</td>				
							<td><input type="text" name="ciudad" class="input_text"></td>
						</tr>
						<tr>							
							<td style="text-align: right;">Direccion</td>				
							<td><input type="text" name="direccion" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Linea de Negocio</td>				
							<td><input type="text" name="lineaNegocios" class="input_text"></td>
							<td style="text-align: right;">Grupos</td>				
							<td><input type="text" name="grupos" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Sector</td>				
							<td><input type="text" name="sector" class="input_text"></td>
							<td style="text-align: right;">Productos</td>				
							<td><input type="text" name="productos" class="input_text"></td>
						</tr>
						<tr>
							<td style="text-align: right;">Cliente o Prospecto</td>				
							<td><input type="text" name="clienteProspecto" class="input_text"></td>
							<td style="text-align: right;">Ejecutivo</td>				
							<td><input type="text" name="ejecutivo" class="input_text"></td>
						</tr>	
						<tr>
							<td style="text-align: right;">Monto de Compra</td>				
							<td><input type="text" name="montoCompra" class="input_text"></td>
							<td style="text-align: right;">Fecha de Renovacion</td>
							<td>
										<select name="dayRenovacion">
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
										<select name="monthRenovacion">
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
										<select name="yearRenovacion">
											<option value="none" selected></option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
											<option value="2028">2028</option>
										</select>
						</td>
						</tr>			
						<tr>
							<td style="text-align: right;">Empleados</td>				
							<td><input type="text" name="empleados" class="input_text"></td>
							<td style="text-align: right;">Fuente BD</td>				
							<td><input type="text" name="fuenteBd" class="input_text"></td>
						</tr>	
						<tr>
							<td style="text-align: right;">Web Site </td>				
							<td><input type="text" name="website" class="input_text"></td>
							
						</tr>					
					</table>
<!--
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
-->

<br><br><br>
					<div style="text-align: center;"><input style ="width: 200px;" type="submit" name="guardarContacto" value="Registrar Contacto" class="input_buton"></div>
				</form>
			</div>	
		</div>
	</div><!--FIn del arcroderon 1-->

		


















	<div id="elemento2Arcorderon" class="hidden">
		<div class="panel">
		<div class="panel-heading">Importar Archivo de Contactos</div>
		<div class="panel-body">

			<div style="text-align: right; margin-right: 2%;">
			
				<input type="button" name="buscar" value="Descargar Formato" class="input_buton" style="width: 300px; background-color: #25313E;" onclick="window.location.href='upload/importarContactos.xlsx'">
			
			</div>

        <form action="#" method="post" enctype="multipart/form-data">

            <input type="file" name="archivo" id="archivo"></input>
            <br><br>

<!--
<hr>
					<table>
						<tr>
							<td>Pais:</td>
							<td>
								<select name="pais">
									<option value="none" selected></option>
									<option value="Argentina">Argentina</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Brasil">Brasil</option>
									<option value="Chile">Chile</option>
									<option value="Colombia">Colombia</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Guyana">Guyana</option>
									<option value="Panama">Panama</option>
									<option value="Peru">Peru</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Trinidad">Trinidad y Tobago</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Venezuela">Venezuela</option>	
								</select>			
							</td>
							<td>Ciudad:</td>
							<td><input type="text" name="ciudad" class="input_text"></td>
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
-->

				<div style="text-align: center;"><input style ="width: 200px;" type="submit" name="subir" value="Cargar Contactos" class="input_buton"></div>

        </form>

	</div>
	</div>
	</div><!--FIn del arcroderon 2-->



		<!--
		<div id="elemento3Arcorderon" class="hidden">
			<div class="panel">
			<div class="panel-heading">Archivos Importados</div>
			<div class="panel-body">
				Contenido
			</div>
			</div>
		</div><!--FIn del arcroderon 3-->


</div><!--FIn div  according-->





</body>
</html>

<?php

}else{
  header("location:index.php");
}

?>