


<?php


			  	require 'Classes/PHPExcel/IOFactory.php'; //Agregamos la librería 
				require 'conexion.php'; //Agregamos la conexión
				
				//Variable con el nombre del archivo
				$archivoUpload = 'importarContactos.xlsx';
				$nombreArchivo = "upload/" . $archivoUpload;
				// Cargo la hoja de cálculo
				$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
				
				//Asigno la hoja de calculo activa
				$objPHPExcel->setActiveSheetIndex(0);
				//Obtengo el numero de filas del archivo
				$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


				
				
				for ($i = 2; $i <= $numRows; $i++) {
					


					$cont_email =			$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();



					echo $cont_email;
					 			

					$sql = "delete from contacts where cont_email = '$cont_email'";
					$result = $mysqli->query($sql);
					
					
				} //Fin del ciclo For
				
						

			


?>








