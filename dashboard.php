<?php

  session_start();
  if ($_SESSION['login'])
    {
         
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inteligencia de Mercado</title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="UTF-8"/>


<style type="text/css">
#container {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
		</style>


</head>
<body>

<script src="code/highcharts.js"></script>
<script src="code/highcharts-3d.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/series-label.js"></script>


<header>
	<img src="images/logo.png">

</header>


<nav>
	<ul>
		<li>Tablero</li>
		<a href="contactos.php"><li>Contactos</li></a>
		<a href="impContactos.php"><li>Importación de Datos</li></a>
		<a href="usuarios.php"><li>Usuarios</li></a>
		<a href="destruir.php"><li>Cerrar Sesión</li></a>	
	</ul>
</nav>


<div class="breadcrumb">Inicio /  <b>Acceso</b></div>



<!--
	<form method="post" action="#">
		<table>
			<tr>
				<td style="text-align: right;">Fecha de Busqueda</td>	
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
-->




	<form method="post" action="#">
		<table>
			<tr>
				<td class="test"><select name="tipo">
									<option value="registro">Total registros por año</option>
									<option value="producto">Total registros gruopos por año </option>			
								</select>
				</td>
				<td class="test"><input type="submit" name="ver" value="Ver" class="input_buton"></td>
			</tr>

		</table>
	</form>



<br><br>



<?php

if(isset($_POST['ver'])){

	 $tipo= $_POST['tipo'];

	if($tipo=="registro"){

		?>
		<div id="container" style="height: 400px"></div>
		<script type="text/javascript">

				Highcharts.chart('container', {
				    chart: {
				        type: 'column',
				        options3d: {
				            enabled: true,
				            alpha: 10,
				            beta: 25,
				            depth: 70
				        }
				    },
				    title: {
				        text: 'Contactos Registrados'
				    },
				    subtitle: {
				        text: 'Resumen contactos registrados por año'
				    },
				    plotOptions: {
				        column: {
				            depth: 25
				        }
				    },
				    xAxis: {
				        categories: ['2014', '2015', '2016', '2017', '2018'],
				        labels: {
				            skew3d: true,
				            style: {
				                fontSize: '16px'
				            }
				        }
				    },
				    yAxis: {
				        title: {
				            text: null
				        }
				    },
				    series: [{
				        name: 'Total Registros',
				        data: [1990, 3658, 2013, 466, 18]
				    }]
				});
						</script>

		<?php

	}else{
		?>
			<div id="container"></div>



							<script type="text/javascript">

					Highcharts.chart('container', {

					    title: {
					        text: 'Registro de Contactos por Grupo, 2014-2018'
					    },

					    subtitle: {
					        text: 'www.grupoptg.com'
					    },

					    yAxis: {
					        title: {
					            text: 'Contactos Registrados'
					        }
					    },
					    legend: {
					        layout: 'vertical',
					        align: 'right',
					        verticalAlign: 'middle'
					    },

					    plotOptions: {
					        series: {
					            label: {
					                connectorAllowed: false
					            },
					            pointStart: 2014
					        }
					    },

					    series: [{
					        name: 'TCI',
					        data: [0 , 0, 0, 16, 0]
					    },{
					        name: 'ATS',
					        data: [0, 0, 0, 0, 0]
					    }, {
					        name: 'Cliente CS',
					        data: [459, 0, 77, 0, 0]
					    }, {
					        name: 'Cliente SI',
					        data: [23, 3038, 297, 99, 0]
					    }, {
					        name: 'Prospectos CS',
					        data: [0, 0, 0, 0, 0]
					    }, {
					        name: 'Prospectos SI',
					        data: [1113, 619, 1635, 340, 5]
					    }],

					    responsive: {
					        rules: [{
					            condition: {
					                maxWidth: 500
					            },
					            chartOptions: {
					                legend: {
					                    layout: 'horizontal',
					                    align: 'center',
					                    verticalAlign: 'bottom'
					                }
					            }
					        }]
					    }

					});
		</script>
		<?php
	}

}
?>























































































































<div style="width: 90%; margin:0 auto; font-size: 13px;" >

<?php
/*
if (isset($_POST['buscar'])){



 require ("cnx.php");
 /*
 $consultaRango = "SELECT * FROM contacts WHERE cont_dateadded BETWEEN '2014-04-01 00:00:00' AND '2014-04-30 00:00:00'";
 $consultaYY = "SELECT * FROM contacts WHERE YEAR (cont_dateadded) = '2018'";
 $consultaMM = "SELECT * FROM contacts WHERE YEAR (cont_dateadded) = '2018' AND MONTH (cont_dateadded) = '03'";
 */
/*
$month = $_POST['month'];
$year = $_POST['year'];


	if($month=="none"){
		$consulta = "SELECT * FROM contacts WHERE YEAR (cont_dateadded) = $year";
	}else{
		$consulta = "SELECT * FROM contacts WHERE YEAR (cont_dateadded) = $year AND MONTH (cont_dateadded) = $month";
	}



		?>
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
}	
















if(isset($_POST["export_data"])) {
$filename = "phpzag_data_export_".date('Ymd') . ".xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename='$filename'");
$show_coloumn = false;
if(!empty($hacerconsulta)) {
foreach($hacerconsulta as $consultax) {
if(!$show_coloumn) {
// display field/column names in first row
echo implode("t", array_keys($consultax)) . "n";
$show_coloumn = true;
}
echo implode("t", array_values($consultax)) . "n";
}
}
exit;
}
*/
?>
</div>



</body>
</html>

<?php

}else{
  header("location:index.php");
}

?>