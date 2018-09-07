<?php

try {
    
    $conexion=pg_connect("host=localhost port=5432 dbname=net_m user=root password=NM2018") or die("Error en la Conexión: ");

} catch (Exception $e) {
    
    echo "La conexion no ha sido establecida";

}

    $todo = array();
    $consultaTotal = pg_query("SELECT id_anillo_principal, nombre_anillo_principal, anillo_principal_id_anillo_principal,   nombre_anillo_secundario
FROM transmision.anillo_principal
LEFT JOIN transmision.anillo_secundario
ON id_anillo_principal = anillo_principal_id_anillo_principal");
    while ($total = pg_fetch_array($consultaTotal)) {
        $sub_data['id_anillo_principal'] = $total['id_anillo_principal'];
        $sub_data['nombre_anillo_principal'] = $total['nombre_anillo_principal'];
        $sub_data['anillo_principal_id_anillo_principal'] = $total['anillo_principal_id_anillo_principal'];
        $sub_data['nombre_anillo_secundario'] = $total['nombre_anillo_secundario'];
        $data[] = $sub_data; 
    }

    foreach ($data as $key => &$value) {
        $output[$value['id_anillo_principal']] = &$value;
    }

    foreach ($data as $key => $value) {
        if ($value['anillo_principal_id_anillo_principal'] && isset($output[$value['anillo_principal_id_anillo_principal']])) {
            $output[$value['anillo_principal_id_anillo_principal']]['nodes'][] = &$value;
        }
    }
    // foreach ($data as $key => $value) {
    //     if ($value['anillo_principal_id_anillo_principal'] && isset($output[$value['anillo_principal_id_anillo_principal']])) {
    //         unset($data[$key]);
    //     }   
    // }

    // echo json_encode($data);  
    echo "<pre>";
    print_r($data);
    echo "</pre>";
?>

    