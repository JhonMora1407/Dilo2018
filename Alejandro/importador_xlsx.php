<?php
include('PHP/conexion.php');
include('simplexlsx.php');

if($_FILES['xlsx']['type']){

    $nombre_archivo = $_FILES['xlsx']['name'];
    $tipo_archivo= $_FILES['xlsx']['type'];
    $tamano_archivo = $_FILES["xlsx"]['size'];
    $direccion_temporal = $_FILES['xlsx']['tmp_name'];
    move_uploaded_file($_FILES['xlsx']['tmp_name'],"".$_FILES['xlsx']['name']);

    $xlsx = new SimpleXLSX($nombre_archivo);

    $flag = true;

    foreach ($xlsx->rows() as $fields) {
        if ($flag) { $flag = false; continue;}

        if ($fields[0]=='') {
            $formatoA = "2000/01/01 00:00";
        } else {
            $formatoA = $fields[0];
        }

        if ($fields[1]=='') {
            $formatoB = "2000/01/01 00:00";
        } else {
            $formatoB = $fields[1];
        }

        if ($fields[2]=='') {
            $formatoC = "2000/01/01 00:00";
        } else {
            $formatoC = $fields[2];
        }

        $summary = str_replace("'", "", $fields[7]);

        if ($fields[11]=='') {
            $duracion_minutos = 0;
        } else {
            $duracion_minutos = $fields[11];
        }

         
        $consulta = pg_query($conn, "INSERT INTO arbol_alarmas.arbol_alarmas (firstoccurrence, lastoccurrence, deletedattimestamp, linea, node, 
       nodealias, codalarm, summary, agent, ticket_remedy, ticket_max, duracion_minutos)
       VALUES ('".$formatoA."','".$formatoB."','".$formatoC."','".$fields[3]."','".$fields[4]."','".$fields[5]."','".$fields[6]."','".$summary."','".$fields[8]."','".$fields[9]."','".$fields[10]."',".$duracion_minutos.");");

    }

} 

?>