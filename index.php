<?php 
$ruta=realpath('./');
$dir = $ruta;               //Especifica el directorio a leer
$rep	 =	opendir($dir);    //Abrimos el directorio
while ($arc = readdir($rep)) {	 //Leemos el arreglo de archivos contenidos en el directorio: readdir recibe como parametro el directorio abierto
if($arc != '..' && $arc !='.' && $arc !=''){
echo "<a href=/".$arc."/".">".$arc."</a><br />"; //Imprimimos el nombre del archivo con un link
}
}
closedir($rep);         //Cerramos el directorio
clearstatcache();     //Limpia la caché de estado de un archivo

?>