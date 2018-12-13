<?php
//-----------------------Carga de Contacto-------------------------//






class test_contactos{

	private $db;

	private $contactos;

	public function __construc(){

		require_once ("cnx.php");

		$this->$db = conectar::conexion();

		return $db;


	}





}









if(isset($_POST['guardarContacto'])){

 
 $cont_dateadded =date('Y-m-d H:i:s');
 $cont_addedby =$_SESSION['login'];
 $cont_updatedby ="";
 $cont_lastupdate ="";
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
 $cont_city =$_POST['ciudad'];
 $cont_zip =$_POST['zipCode'];
 $cont_website1 =$_POST['website'];
 $cont_website2 =$_POST['website2'];
 $cont_employees =$_POST['empleados'];
 $cont_birthday =$_POST['cumpleanos'];
 $cont_sale_volume =$_POST['ventas'];
 $cont_code ="";




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
	    $cont_insdustria =$_POST['insdustria'];
	      $cont_insdustria2 = implode(', ', $cont_insdustria);

	}else{
	     $cont_insdustria2 ="";
	}


include ("cnx.php");



$ssql = "SELECT * FROM contacts WHERE cont_email='$cont_email'";
$rs = mysql_query($ssql,$conexion);
if (mysql_num_rows($rs)>0)
{         	
    echo "<div class='noGuardado'>Ya existe un contacto registrado con ese correo electronico</div>";
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
	'$count_code'
)");

		echo "<div class='guardado'>El contacto fuer guardado con exito</div>";

	}

}

?>




























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
					

					 $cont_dateadded =date('Y-m-d H:i:s');
					 $cont_addedby =$_SESSION['login'];
					 $cont_updatedby ="";
					 $cont_lastupdate ="";
					 $cont_firstname =		$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
					 $cont_middlename =		$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
					 $cont_lastname1 =		$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
					 $cont_lastname2 =		$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
					 $cont_jobtitle =		$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
					 $cont_email =			$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
					 $cont_companyname =	$objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
					 $cont_workphone =		$objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
					 $cont_cellphone =		$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
					 $cont_homephone =		$objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
					 $cont_addressline1 =	$objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
					 $cont_addressline2 =	$objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
					 $cont_addressline3 =	$objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
					 $cont_country =$_POST['pais'];
					 $cont_city = "0";
					 $cont_zip =			$objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
					 $cont_website1 =		$objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
					 $cont_website2 = 		$objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();
					 $cont_employees ="";
					 $cont_birthday =		$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
					 $cont_sale_volume ="";
					 

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


						$rs = mysql_query("SELECT MAX(cont_code) AS cont_code FROM contacts");
					                if ($row = mysql_fetch_row($rs)) {
					                $code = trim($row[0]);
					                }

					                $code = ereg_replace("[^0-9]", "", $code);
					                $code++;
					                $count_code = "CODE-".$code;


					     $ssql = mysql_query("SELECT * FROM contacts WHERE cont_email='$cont_email'");
					      if (mysql_num_rows($ssql)>0){
					      	$log ="<font color='red'>Contacto Duplicado</font>";
					      }else{
					      	$log= "<font color='green'>Contacto Registrado</font>";
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
					cont_code
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
					'$count_code'
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



