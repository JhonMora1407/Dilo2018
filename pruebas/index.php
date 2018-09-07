<?php

function xmlToArray($xml, $options = array()) {
    $defaults = array(
        'namespaceSeparator' => ':',//you may want this to be something other than a colon
        'attributePrefix' => '',   //to distinguish between attributes and nodes with the same name
        'alwaysArray' => array(),   //array of xml tag names which should always become arrays
        'autoArray' => true,        //only create arrays for tags which appear more than once
        'textContent' => '$',       //key used for the text content of elements
        'autoText' => true,         //skip textContent key if node has no attributes or child nodes
        'keySearch' => false,       //optional search and replace on tag and attribute names
        'keyReplace' => false       //replace values for above search values (as passed to str_replace())
    );
    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; //add base (empty) namespace
 
    //get attributes from all namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            //replace characters in attribute name
            if ($options['keySearch']) $attributeName =
                    str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix']
                    . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                    . $attributeName;
            $attributesArray[$attributeKey] = (string)$attribute;
        }
    }
 
    //get child nodes from all namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->children($namespace) as $childXml) {
            //recurse into child nodes
            $childArray = xmlToArray($childXml, $options);
            list($childTagName, $childProperties) = each($childArray);
 
            //replace characters in tag name
            if ($options['keySearch']) $childTagName =
                    str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            //add namespace prefix, if any
            if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;
 
            if (!isset($tagsArray[$childTagName])) {
                //only entry with this key
                //test if tags of this type should always be arrays, no matter the element count
                $tagsArray[$childTagName] =
                        in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                        ? array($childProperties) : $childProperties;
            } elseif (
                is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                === range(0, count($tagsArray[$childTagName]) - 1)
            ) {
                //key already exists and is integer indexed array
                $tagsArray[$childTagName][] = $childProperties;
            } else {
                //key exists so convert to integer indexed array with previous value in position 0
                $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
            }
        }
    }
 
    //get text content of node
    $textContentArray = array();
    $plainText = trim((string)$xml);
    if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;
 
    //stick it all together
    $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;
 
    //return node as array
    return array(
        $xml->getName() => $propertiesArray
    );
}


 /*$fp = fopen("Tickets.xml", "n");
 print_r($fp);
 $fw = fopen("Tickets1.xml", "w");
 $fw=mb_convert_encoding($fp,"UTF8", "Windows-1252");
 fwrite($fw);
 fclose($fw);
 fclose($fp);*/


$xmlNode = simplexml_load_file("Tickets.xml") or die("No se puede ingresar al archivo");
$arrayData = xmlToArray($xmlNode);
$datos = array();


$numero = 0;

foreach ($arrayData['Report']['table1']['Detail_Collection']['Detail'] as $key => $value) {
	$datos[]=$value;
	$numero++;
}

// echo '<pre>';
// print_r($arrayData['Report']['table1']['Detail_Collection']['Detail'][0]);
// echo '</pre>';

for ($i=0; $i < $numero ; $i++) { 





	$datos[$i]['N_x00BA__DE_TICKET'] = mb_convert_encoding($datos[$i]['N_x00BA__DE_TICKET'],"windows-1252");
    $datos[$i]['CLIENTE'] = mb_convert_encoding($datos[$i]['CLIENTE'],"windows-1252");
    $datos[$i]['PRIORIDAD'] = mb_convert_encoding($datos[$i]['PRIORIDAD'],"windows-1252");
    $datos[$i]['ESTADO'] = mb_convert_encoding($datos[$i]['ESTADO'],"windows-1252");
    $datos[$i]['ESCALAMIENTO'] = mb_convert_encoding($datos[$i]['ESCALAMIENTO'],"windows-1252");
    $datos[$i]['ENLACE'] = mb_convert_encoding($datos[$i]['ENLACE'],"windows-1252");
    $datos[$i]['TIPO_DE_TICKET'] = mb_convert_encoding($datos[$i]['TIPO_DE_TICKET'],"windows-1252");
    $datos[$i]['TIPO'] = mb_convert_encoding($datos[$i]['TIPO'],"windows-1252");
    $datos[$i]['COMPONENTE'] = mb_convert_encoding($datos[$i]['COMPONENTE'],"windows-1252");
    $datos[$i]['SUBCOMPONENTE'] = mb_convert_encoding($datos[$i]['SUBCOMPONENTE'],"windows-1252");
    $datos[$i]['FECHA_DE_INSERCIÓN'] = mb_convert_encoding($datos[$i]['FECHA_DE_INSERCIÓN'],"windows-1252");
    $datos[$i]['FECHA_DE_SOLUCION_CLIENTE'] = mb_convert_encoding($datos[$i]['FECHA_DE_SOLUCION_CLIENTE'],"windows-1252");
    $datos[$i]['TIEMPO_SALIDA_SERVICIO'] = mb_convert_encoding($datos[$i]['TIEMPO_SALIDA_SERVICIO'],"windows-1252");
    $datos[$i]['INSERTADO_POR_'] = mb_convert_encoding($datos[$i]['INSERTADO_POR_'],"windows-1252");
    $datos[$i]['ASIGNADO_A_'] = mb_convert_encoding($datos[$i]['ASIGNADO_A_'],"windows-1252");
    $datos[$i]['ACTUALIZADO_POR_'] = mb_convert_encoding($datos[$i]['ACTUALIZADO_POR_'],"windows-1252");
    $datos[$i]['FECHA_DE_ACTUALIZACION_'] = mb_convert_encoding($datos[$i]['FECHA_DE_ACTUALIZACION_'],"windows-1252");
    $datos[$i]['GRUPO_ASIGNADO_'] = mb_convert_encoding($datos[$i]['GRUPO_ASIGNADO_'],"windows-1252");
    $datos[$i]['GRUPO_INSERTADO_POR_'] = mb_convert_encoding($datos[$i]['GRUPO_INSERTADO_POR_'],"windows-1252");

	$fechaProcesA = "";
    $fechaProcesB = "";
    $fechaProcesC = "";
    $now = date("m");

    // if($datos[$i]['FECHA_DE_INSERCIÓN'] != ''){

    //                 $fechaA = explode("/",$datos[$i]['FECHA_DE_INSERCIÓN']);
    //                 echo $fechaA;
    //             } 
    // echo $fechaA; 

		$consulta=pg_query($conn,"INSERT INTO onyx.tickets_onyx (numero_ticket, cliente, prioridad, estado, escalamiento,
		enlace, tipo_ticket, tipo, componente, subcomponente, fecha_insercion, fecha_solucion,tiempo_salida, insertado_por, asignado_a, actualizado_por, fecha_actualizacion, grupo_asignado,grupo_insertado_por) VALUES('".$datos[$i]['N_x00BA__DE_TICKET']."','".$datos[$i]['CLIENTE']."','".$datos[$i]['PRIORIDAD']."','".$datos[$i]['ESTADO']."','".$datos[$i]['ESCALAMIENTO']."','".$datos[$i]['ENLACE']."', '".$datos[$i]['TIPO_DE_TICKET']."','".$datos[$i]['TIPO']."','".$datos[$i]['COMPONENTE']."','".$datos[$i]['SUBCOMPONENTE']."',".$datos[$i]['FECHA_DE_INSERCIÓN']."', '".$datos[$i]['FECHA_DE_SOLUCION_CLIENTE']."',".$datos[$i]['TIEMPO_SALIDA_SERVICIO'].",'".$datos[$i]['INSERTADO_POR_']."','".$datos[$i]['ASIGNADO_A_']."','".$datos[$i]['ACTUALIZADO_POR_']."', '".$datos[$i]['FECHA_DE_ACTUALIZACION_']."','".$datos[$i]['GRUPO_ASIGNADO_']."','".$datos[$i]['GRUPO_INSERTADO_POR_']."') 
		ON CONFLICT (numero_ticket, enlace) DO UPDATE
		SET numero_ticket = excluded.numero_ticket,
		enlace = excluded.enlace;");  





}


// echo '<pre>';
// print_r($datos);
// echo '</pre>';




// $arrayData = xmlToArray($xmlNode);
// $datos= array(); 
// foreach ($arrayData['Report']['table1']['Detail_Collection']['Detail'] as $key => $value) {
// 	// $datos[]=$value;
// }


// $fp = fopen("pruebasJson", "w");
// fwrite($fp, json_encode($arrayData));
// fclose($fp);

//print_r($xml->table1[0]);


//$estado = $xml->table1->Detail_Collection->Detail[3]->PRIORIDAD;

/*$test = array((string)$xml->ACTUALIZADO_POR_);
print_r($test);*/

?>