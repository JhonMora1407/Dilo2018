<?php 
$host ="localhost";
$port ="5432";
$user ="root";
$password ="NM2018";
$dbname ="net_m";

$conne = "host='$host' port='$port' user='$user' password='$password' dbname='$dbname'";

$conn = pg_connect($conne) or die ('No se ha podido conectar: ' . pg_last_error());
echo '<script language="javascript">alert("Bienvenido a GAD usuario: '. $user.' Dilo");</script>'; 
 ?>
