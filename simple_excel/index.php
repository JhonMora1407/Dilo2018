<?php

include 'simplexlsx.class.php';
$xlsx = new SimpleXLSX('INFORME GENERAL IP-RAN -- MAYO2017.xlsx');	
$fp = fopen('datos.csv', 'w');
foreach ($xlsx->rows() as $fields) {
	fputcsv($fp, $fields,'|');
}
fclose($fp);
?>