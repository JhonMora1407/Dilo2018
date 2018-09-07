<?php

try {
    
    $conexion=pg_connect("host=localhost port=5432 dbname=net_m user=root password=NM2018") or die("Error en la Conexión: ");
    echo "test";

} catch (Exception $e) {
    
    echo "La conexion no ha sido establecida";

}
    $data = array();
    $consulta = pg_query("SELECT id_anillo_principal, nombre_anillo_principal FROM transmision.anillo_principal");
        while ($datos=pg_fetch_assoc($consulta)) {
        $data[]=$datos;
    }

    $datac = array();
        $consultac = pg_query("SELECT id_equipo, nombre_equipo 
        FROM transmision.equipo
        LEFT JOIN transmision.equipo_anillo
        ON id_equipo = equipo_id_equipo
        WHERE anillo_secundario_id_anillo_secundario = 1 ");
        while ($datos=pg_fetch_assoc($consultac)) {
            $datac[]=$datos;
        }    


    
    

    

// SELECT id_equipo, nombre_equipo 
// FROM transmision.equipo
// LEFT JOIN transmision.equipo_anillo
// ON id_equipo = equipo_id_equipo
// WHERE anillo_secundario_id_anillo_secundario = 1


    

?>

<html>
    <head>
    </head>
    <body>
        <table border = '' cellpadding="0">   
            <?php foreach ($data as $key => $value): ?>
            <tr>
                <td>
                <?php echo $value['nombre_anillo_principal']; ?>
                </td>
                <td>
                    <table>
                    <?php 
                    $datab = array();
                    $consultab = pg_query("SELECT id_anillo_secundario ,nombre_anillo_secundario FROM transmision.anillo_secundario
                    WHERE anillo_principal_id_anillo_principal = ".$value['id_anillo_principal']."");
                    while ($datos=pg_fetch_assoc($consultab)) {
                        $datab[]=$datos;
                    }  
                    foreach ($datab as $keyb => $valueb): ?>
                            
                        <tr>
                            <td><?php echo $valueb['nombre_anillo_secundario'];?></td>
                            <td>
                            <?php 
                            $datac = array();
                            $consultac = pg_query("SELECT id_equipo, nombre_equipo
                            FROM transmision.equipo
                            LEFT JOIN transmision.equipo_anillo
                            ON id_equipo = equipo_id_equipo
                            WHERE anillo_secundario_id_anillo_secundario = ".$valueb['id_anillo_secundario']." ");
                            while ($datos=pg_fetch_assoc($consultac)) {
                                $datac[]=$datos;
                            } 
                            ?>

                                <table>
                        <?php  foreach ($datac as $keyc => $valuec): ?>
                                    <tr><td><?php echo $valuec['nombre_equipo'] ?></td>
                                        <td>a</td>
                                        <td>b</td>
                                        <td>c</td>
                                        <td>d</td>
                                    </tr>
                        <?php endforeach ?>
                                </table>
                            </td>
                        </tr>
                        
                    <?php endforeach ?>
                    </table>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>

