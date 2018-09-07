<html>
<head>
  
</head>
<body>
<canvas id="datos_porcentaje_linea" width="650" height="250"></canvas>
<canvas id="datos_porcentaje_linea_b" width="650" height="250"></canvas>
</body>

</html>

<?php

$host ="localhost";
$port ="5432";
$user ="postgres";
$password ="Dilo2018";
$dbname ="dilo";

$conne = "host='$host' port='$port' user='$user' password='$password' dbname='$dbname'";

$conn = pg_connect($conne) or die('No se ha podido conectar: ' . pg_last_error());

$consulta_porcentaje_linea = "SELECT rangos.rango, rangos.semana, energia, core, acceso FROM(
(SELECT DISTINCT rango, semana FROM public.arbol_alarmas WHERE semana in('W01','W02')) as rangos
LEFT JOIN
(SELECT rango, semana, count(ticket_remedy) as energia  from public.arbol_alarmas WHERE semana in('W01','W02') AND linea='ENERGIA' GROUP BY rango, semana) as l_energia
ON rangos.rango=l_energia.rango
LEFT JOIN
(SELECT rango, semana, count(ticket_remedy) as core  from public.arbol_alarmas WHERE semana in('W01','W02') AND linea='CORE' GROUP BY rango, semana) as l_core
ON rangos.rango=l_core.rango
LEFT JOIN
(SELECT rango, semana, count(ticket_remedy) as acceso  from public.arbol_alarmas WHERE semana in('W01','W02') AND linea='ACCESO' GROUP BY rango, semana) as l_acceso
ON rangos.rango=l_acceso.rango)
ORDER BY rangos.semana;;";
    $resultado = pg_query($conn,$consulta_porcentaje_linea);
    $datos_porcentaje_linea = pg_fetch_all($resultado);


$rangos = "'Rango de 60 a 120 Minutos' , 'Rango de 30 a 60 Minutos' , 'Rango de 0 a 30 Minutos' , 'Rango Mayor a 120  MInutos'";
$nocturna2= "";
$semana_inicio_historico = 'W01';
$semana_fin_historico = 'W15';


$consulta_porcentaje_linea_b = "SELECT totales.semana, SUM(totales.total) as generados, SUM(atendidos.atendidos) as atendidos, CAST((SUM(atendidos.atendidos) * 100) / SUM(totales.total)AS decimal (10,2)) AS porcentaje, totales.linea
FROM (
                         SELECT semana, COUNT(ticket_remedy) as total, (CASE WHEN linea <> '' THEN linea ELSE 'SIN LINEA' END) AS linea
                         FROM public.arbol_alarmas
                         WHERE rango in (".$rangos.") ".$nocturna2."
                         GROUP BY semana, linea
                         ORDER BY semana ASC
                         ) AS totales
                         LEFT JOIN
                         (
                         SELECT semana, COUNT(ticket_remedy) as atendidos, (CASE WHEN linea <> '' THEN linea ELSE 'SIN LINEA' END) AS linea
                         FROM public.arbol_alarmas
                         WHERE ticket_remedy SIMILAR TO '%INC%|%AEL%' 
                         AND rango in (".$rangos.") ".$nocturna2."
                         GROUP BY semana, linea
                         ORDER BY semana ASC
                         ) AS atendidos
                         ON totales.semana = atendidos.semana AND totales.linea = atendidos.linea
                         WHERE totales.semana BETWEEN '".$semana_inicio_historico."' AND '".$semana_fin_historico."'
                         GROUP BY totales.semana, totales.linea, atendidos.linea
                         ORDER BY totales.semana ASC";
    $resultado = pg_query($conn,$consulta_porcentaje_linea_b);
    $datos_porcentaje_linea_b = pg_fetch_all($resultado); 
       
?>


<script src="Chart.js"></script>
<script>
  var labels = [];
  var dato1 = [];
  var dato2 = [];
  var dato3 = [];

  <?php foreach ($datos_porcentaje_linea as $key => $value) { ?>
      labels.push('<?php echo $value['semana']; ?>')
      dato1.push(<?php echo $value['energia']; ?>)
      dato2.push(<?php echo $value['core']; ?>) 
      dato3.push(<?php echo $value['acceso']; ?>) 
<?php } ?>

var ctx = document.getElementById("datos_porcentaje_linea").getContext('2d');
var myChart = new Chart(ctx, {

    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: "acceso",
            data:dato1,
            backgroundColor: 
                'rgb(255, 87, 51,  0.5)', 
            borderColor: 
                'rgb(247, 0, 0, 1)',
            borderWidth: 1
        }]
    },
         // Opciones de configuracion
    options: {
    title: {
         display: true,
         text: 'Gráfica Tipificación Error de Fondo',
         fontColor: ' #6f6767 ',
         fontSize: 25  
    },
    scales: {
            xAxes:[{
                scaleLabel:{
                    display: true,
                    labelString: 'OBSERVACIONES'
                },
                stacked : true,
            }],
            yAxes:[{ 
                    scaleLabel:{
                        display: true,
                        labelString: 'CANTIDAD OBSERVACIONES'
                    },
                    stacked : true,
            }]       
    }
    }
});
    

var labels_stack_porcentaje = [];
var labels2 = [];
  var dato_a_porcentaje = [];
  var dato_b_porcentaje = [];
  var dato_c_porcentaje = [];
  var dato_d_porcentaje = [];
  var dato_e_porcentaje = [];
  var dato_f_porcentaje = [];
  var dato_g_porcentaje = [];
  var dato_h_porcentaje = [];
  var dato_i_porcentaje = [];



  <?php foreach ($datos_porcentaje_linea_b as $key => $value) { ?>
      <?php if ($value['linea']=='ENERGIA') { ?>
      labels_stack_porcentaje.push('<?php echo $value['semana']; ?>')
      dato_a_porcentaje.push(<?php echo $value['generados'] ?>)
      dato_b_porcentaje.push(<?php echo $value['atendidos']; ?>) 
      dato_c_porcentaje.push(<?php echo $value['porcentaje']; ?>) 
      <?php } ?>
      <?php if ($value['linea']=='ACCESO') { ?>
      dato_d_porcentaje.push(<?php echo $value['generados'] ?>)
      dato_e_porcentaje.push(<?php echo $value['atendidos']; ?>) 
      dato_f_porcentaje.push(<?php echo $value['porcentaje']; ?>) 
      <?php } ?>
      <?php if ($value['linea']=='CORE') { ?>
      dato_g_porcentaje.push(<?php echo $value['generados'] ?>)
      dato_h_porcentaje.push(<?php echo $value['atendidos']; ?>) 
      dato_i_porcentaje.push(<?php echo $value['porcentaje']; ?>) 
      <?php } ?>
<?php } ?>

    var barChartData = {
      labels: labels_stack_porcentaje,
      datasets: [{
        label: 'GENERADOS ENERGIA',
        stack: 0,
        data : dato_a_porcentaje,
        backgroundColor: 'rgba(255, 87, 51,  0.7)'
      }, {
        label: 'GESTIONADOS ENERGIA',
        stack: 1,
        data : dato_b_porcentaje,
        backgroundColor: 'rgba(255, 241, 51, 0.5)'
      }, {
        label: 'PORCENTAJE ENERGIA',
        stack: 2,
        data : dato_c_porcentaje,
        backgroundColor: 'rgb(51, 255, 190 , 0.5)', 
      }, {
        label: 'GENERADOS ACCESO',
        stack: 0,
        data : dato_d_porcentaje,
        backgroundColor: 'rgb(125, 94, 50 , 0.5)', 
      }, {
        label: 'GESTIONADOS ACCESO',
        stack: 1,
        data : dato_e_porcentaje,
        backgroundColor: 'rgb(243, 132, 68 , 0.5)', 
      }, {
        label: 'PORCENTAJE ACCESO',
        stack: 2,
        data : dato_f_porcentaje,
        backgroundColor: 'rgb(176, 68, 243 , 0.5)', 
      }, {
        label: 'GENERADOS CORE',
        stack: 0,
        data : dato_g_porcentaje,
        backgroundColor: 'rgb(152, 172, 109 , 0.5)', 
      }, {
        label: 'GESTIONADOS CORE',
        stack: 1,
        data : dato_h_porcentaje,
        backgroundColor: 'rgb(243, 68, 179 , 0.5)', 
      }, {
        label: 'PORCENTAJE CORE',
        stack: 2,
        data : dato_i_porcentaje,
        backgroundColor: 'rgb(68, 243, 88, 0.7)', 
      }]

    };
    window.onload = function() {
      var ctx = document.getElementById('datos_porcentaje_linea_b').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          title: {
            display: true,
            text: 'Total Gestionados por Linea de Negocio'
          },
          tooltips: {
            intersect: false
          },
          responsive: true,
          scales: {
            xAxes: [{
              stacked: true,
            }],
            yAxes: [{
              stacked: true
            }]
          }
        }
      });
    };

   function randomScalingFactor(){ return Math.round(Math.random()*1000)};

   console.log(randomScalingFactor());
</script>

