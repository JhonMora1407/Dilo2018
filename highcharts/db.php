<?php

	class Conectar{
		public static function conexion(){
			$conexion=pg_connect("host=localhost port=5432 dbname=net_m user=root password=NM2018") or die("Error en la Conexión: ");
	//ss        $conexion->pg_query("SET NAMES 'utf8'");
			return $conexion;
		}
	}	

	?>