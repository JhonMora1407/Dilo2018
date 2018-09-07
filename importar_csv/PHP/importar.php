<!--Este es el archivo que proceso la información que contiene el archivo CSV-->
<?php
    include('conexion.php');
 
    if($_FILES["archivo"]["size"]>100000000){
    echo "Solo se permiten archivos menores de 100MB";
    }else{
        // sacamos todas las propiedades del archivo
        $nombre_archivo = $_FILES['archivo']['name'];
        $tipo_archivo= $_FILES['archivo']['type'];
        $tamano_archivo = $_FILES["archivo"]['size'];
        $direccion_temporal = $_FILES['archivo']['tmp_name'];
        // movemos el archivo a la capeta de nuestro servidor
        move_uploaded_file($_FILES['archivo']['tmp_name'],"".$_FILES['archivo']['name']);
    }
 
    if (($gestor = fopen($nombre_archivo,"r"))!== FALSE) {
        while (($data = fgetcsv($gestor,1000000,";")) !== FALSE) {
                $num = count($data);
                
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";

                $data[0]=str_replace("'","",$data[0]);
                $data[1]=str_replace("'","",$data[1]);
                $data[2]=str_replace("'","",$data[2]);
                $data[3]=str_replace("'","",$data[3]);
                $data[4]=str_replace("'","",$data[4]);
                $data[5]=str_replace("'","",$data[5]);
                $data[6]=str_replace("'","",$data[6]);
                $data[7]=str_replace("'","",$data[7]);
                $data[8]=str_replace("'","",$data[8]);
                $data[9]=str_replace("'","",$data[9]);
                $data[10]=str_replace("'","",$data[10]);
                $data[11]=str_replace("'","",$data[11]);
                $data[12]=str_replace("'","",$data[12]);



                if ($data[10]<>'') {
                $data[10]="'".$data[10]."'";
                }else{
                    $data[10]="null";
                }
                if ($data[0]<>'') {
                $data[0]="'"."20".substr($data[0],6,2)."-".substr($data[0],3,2)."-".substr($data[0],0,2)." ".substr($data[0],9,8)."'";
                }else{
                    $data[0]="null";
                }
                if ($data[1]<>'') {
                $data[1]="'"."20".substr($data[1],6,2)."-".substr($data[1],3,2)."-".substr($data[1],0,2)." ".substr($data[1],9,8)."'";
            }else{
                $data[1]="null";
            }
                if ($data[2]<>'') {
                $data[2]="'"."20".substr($data[2],6,2)."-".substr($data[2],3,2)."-".substr($data[2],0,2)." ".substr($data[2],9,8)."'";
            }else{
                $data[2]="null";
            }
        //$consulta=pg_query($pgconect,"UPDATE cm.data SET fecha='".$data[0]."', 'YYYY') WHERE id='".$fila."';");
        $consulta=pg_query($conn,"INSERT INTO public.arbol_alarmas(firstoccurrence, lastoccurrence, deletedattimestamp, linea, node, nodealias, codalarm, summary, agent, ticket_remedy, duracion_minutos, semana, rango) VALUES(".$data[0].",".$data[1].",".$data[2].",'".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."',".$data[10].",'".$data[11]."','".$data[12]."')");

        }
        fclose($gestor);
    }
?>