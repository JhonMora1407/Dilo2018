<!--Este es el archivo que proceso la información que contiene el archivo CSV-->
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

    $sql = array();

    foreach ($xlsx->rows() as $fields => $key) {
       
    //   if ($flag) { 
    //     if ($fields == 9) {
    //     $flag = false; continue;
    //     } else {
    //         continue;
    //     }
    // };
        // $fecha = explode("/",$key[3]);
        $horaEx = explode(" ",$key[3]);
        $fechaEx = explode("/", $horaEx[0]);
        $fecha = $fechaEx[2]."/".$fechaEx[0]."/".$fechaEx[1];
        $hora = $horaEx[1];
        $fechaHora =  $fecha." ".$hora;

        $re = "~        #delimiter
                ^           # start of input
                -?          # minus, optional
                [0-9]+      # at least one digit
                (           # begin group
                    \.      # a dot
                    [0-9]+  # at least one digit
                )           # end of group
                ?           # group is optional
                $           # end of input
            ~xD";

        preg_match_all($re, $key[4], $matchA);
        preg_match_all($re, $key[5], $matchB);
        preg_match_all($re, $key[6], $matchC);
        $floatA = implode($matchA[0]);
        $floatB = implode($matchB[0]);
        $floatC = implode($matchC[0]);

        if ($floatA == '') {
            $floatA = 0;
        } 
        if ($floatB == '') {
            $floatB = 0;
        } 
        if ($floatC == '') {
            $floatC = 0;
        }

        $object = delete_all_between('(',')',$key[0]);
        $a = mb_convert_encoding($object, "windows-1252");


        $sql[] = "('".$a."','".$key[1]."','".$key[2]."','".$fechaHora."',".$floatA.",".$floatB.",".$floatC.",'".$key[7]."')";

        // $fecha = ExcelToPHP(trim($key[3]));
        // $procesado =  date('Y m d H:i',$fecha);


        // print_r($fechaHora);

        // echo $fecha;
        // echo $procesado;

       //  if ($fields[5]=='' || $fields[6]=='' || $fields[11]=='-' || $fields[13]=='-' ) {
       //      $formatoA = strtotime("2000/01/01 00:00");
       //      $formatoB = strtotime("2000/01/01 00:00");
       //      $formatoC = strtotime("2000/01/01 00:00");
       //      $formatoD = strtotime("2000/01/01 00:00");
       //  } else {
       //      $formatoA = strtotime($fields[5]);
       //      $formatoB = strtotime($fields[6]);
       //      $formatoC = strtotime($fields[11]);
       //      $formatoD = strtotime($fields[13]);
        // }  



     

       //  $consulta = pg_query($conn, "INSERT INTO transmision.alarmas_transmision (description, severity, remarks, name_alarm, alarm_reversion, last_occurred, first_occurred, fiber_cable_name, alarm_source, location_information, clearance_status, cleared_on, acknowledge_on, cleared_by, acknowledge_by, acknowledgment_status, status, maintenance_status)
       // VALUES ('".$fields[0]."','".$fields[1]."','".$fields[2]."','".$fields[3]."','".$fields[4]."','".$formatoA."','".$formatoB."','".$fields[7]."','".$fields[8]."','".$fields[9]."','".$fields[10]."','".$formatoC."','".$fields[12]."','".$formatoD."','".$fields[14]."','".$fields[15]."','".$fields[16]."','".$fields[17]."');");


    }
      echo "<pre>";
      print_r(implode(',', $sql));
      echo("</pre>");

       // $consulta = pg_query($conn, "INSERT INTO transmision.performance (monitored_object, performance_event, monitor_period, start_time, value_max, value_curr, value_min, validity)
       // VALUES ".implode(',', $sql));


}


function delete_all_between($beginning, $end, $string){
    $beginningPos = strpos($string, $beginning);
    $endPos = strpos($string, $end);
    if ($beginningPos === false || $endPos === false) {
        return $string;
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
    return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string));
}
/*
function ExcelToPHP($dateValue, $ExcelBaseDate = 1970) {
    if ($ExcelBaseDate == 1970) {
        $myExcelBaseDate = 25569;
        //    Adjust for the spurious 29-Feb-1900 (Day 60)
        if ($dateValue < 60) {
            --$myExcelBaseDate;
        }
    } else {
        $myExcelBaseDate = 24107;
    }

    // Perform conversion
    if ($dateValue >= 1) {
        $utcDays = $dateValue - $myExcelBaseDate;
        $returnValue = round($utcDays * 86401);
        if (($returnValue <= PHP_INT_MAX) && ($returnValue >= -PHP_INT_MAX)) {
            $returnValue = (integer) $returnValue;
        }
    } else {
        $hours = round($dateValue * 24);
        $mins = round($dateValue * 1440) - round($hours * 60);
        $secs = round($dateValue * 86400) - round($hours * 3600) - round($mins * 60);
        $returnValue = (integer) gmmktime($hours, $mins, $secs);
    }

    // Return

    return $returnValue;

    // echo "<pre>";
    // print_r($returnValue);
    // echo "</pre>";
} */

?>