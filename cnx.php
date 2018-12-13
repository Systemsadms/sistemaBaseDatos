<?php
  //define ("salto","\n<br>\n");
  
  
   //$conexion=mysql_connect("localhost","manager1_admin","mcode2016");
   //$baseDeDatos=mysql_select_db("manager1_code",$conexion);

  $conexion=mysql_connect("localhost","root","");
  $baseDeDatos=mysql_select_db("ptglatin_base",$conexion);


/*
if($conexion->connect_error)
			        {
			        	die("La conexion fallo". $conexion->connect_error);
			        }


$host 		="localhost";
$db_user 	="root";
$db_pass 	="";
$db_name 	="systems_admin";
$db_table 	="usuarios";

$conexion = new mysqli($host, $db_user, $db_pass, $db_name);

  if($conexion->connect_errno)
			        {
			        	die("La conexion fallo". $conexion->connect_errno);

			        }

http://php.net/manual/es/mysqli.ping.php
*/
?>
