<?php

require("config.php");






class contectar{

	public static function conexion{

		$mysqli=new mysqli("localhost","root","","ptglatin_bas"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

		if(mysqli_connect_errno()){
		    echo 'Conexion Fallida : ', mysqli_connect_error();
		    exit();
			}else{
				echo "conexion establecida";
			}


		return $mysqli;	


	}

}


?>