<!DOCTYPE html>
<html>
<head>
    <title>Higcharts database - parsing json</title>
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" src="cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div  class="flex-container" style="width: 100%;display: -webkit-box-flex;">
        <div class='base' id="graf1" style="width:100%; height:350px;">Grafico A</div>
    </div>
    <div>
    <div id='graf2' class="flex-container" style="width: 30%;display: -webkit-box-flex;">
        <div class='base' id="graf2" style="width:100%; height:250px;">Grafico B</div>
    </div>
    <div id='graf3' class="flex-container" style="max-width: 40%; height: auto; display: -webkit-box-flex; position:absolute; top: 370px;right: 475px" >
        <div class='base' id="graf3" style="width:100%; height:250px;">Grafico C</div>
    </div>
    <div id='graf4' class="flex-container" style="width: 30%;display: -webkit-box-flex;position:absolute; top: 370px;right: 0px">
        <div class='base' id="graf4" style="width:100%; height:250px;">Grafico D</div>
    </div> 
    


    <div class="flex-container" style="width: 100%;display: -webkit-box-flex">
        <div class='base' id="graf5" style="width:100%; height:250px;">
            <table border="1" cellspacing='0' id="table" class="tabla" width="100%">
                <thead>
                    <tr>
                        <td colspan="4" rowspan="2" width="">RESPONSABLES</td>

                        <td colspan="2">Menor a 6 Horas</td>
                        <td colspan="2">Entre 6 a 12 Horas</td>
                        <td colspan="2">Entre 12 a 24 Horas</td>
                        <td colspan="2">Entre 24 a 48 Horas</td>
                        <td colspan="2">Entre 48 a 72 Horas</td>
                        <td colspan="2">Mayor a 72 Horas</td>
                        <td colspan="2">Total</td>
                    </tr>
                    <tr>
                        <td>Cant</td>
                        <td>T_prom</td>
                        <td>Cant</td>
                        <td>T_prom</td>
                        <td>Cant</td>
                        <td>T_prom</td>
                        <td>Cant</td>
                        <td>T_prom</td>
                        <td>Cant</td>
                        <td>T_prom</td>
                        <td>Cant</td>
                        <td>T_prom</td>
                        <td>Cant</td>
                        <td>T_prom</td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="4"  width="">NOMBRE DEL RESPONSABLE</td>   
                    <td >5</td>
                    <td >
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:5%">
                              5 (success)
                          </div>
                      </div>
                    </td>
                      <td >15</td>
                      <td >
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:15%">
                              15 
                          </div>
                      </div>
                    </td>
                      <td >11</td>
                      <td >
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:11%">
                              11 
                          </div>
                      </div>
                    </td>
                      <td >21</td>
                      <td >
                               <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:21%">
                              21 
                          </div>
                      </div>
                      </td>
                      <td >24</td>
                      <td >
                               <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:24%">
                              24
                          </div>
                      </div>
                      </td>
                      <td >75</td>
                      <td >
                               <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:75%">
                              75 
                          </div>
                      </div>
                      </td>
                      <td >60</td>
                      <td >
                               <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                              60
                          </div>
                      </div>
                      </td>

                  </tr>
              </tbody>
          </table>
      </div>
  </div>   
</body>
</html>

<script type="text/javascript">

    Highcharts.chart('graf1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Backlog tickets SAP - ONYX'
        },
        
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Tickets por fecha (TOTAL)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
        },
        series: [{
            name: 'Population',
            data: [
            ['a', 24.2],
            ['b', 20.8],
            ['c', 14.9],
            ['d', 13.7],
            ['e', 13.1],
            ['f', 12.7],
            ['g', 12.4],
            ['h', 12.2],
            ['i', 12.0],
            ['j', 11.7],
            ['k', 11.5],
            ['l', 11.2],
            ['m', 11.1]
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});


    Highcharts.chart('graf2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Clase Aviso'
        },
        
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total Avisos por Clase'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        "series": [
        {
            "name": "Browsers",
            "colorByPoint": true,
            "data": [
            {
                "name": "X1",
                "y": 62.74,
                "drilldown": "X1"
            },
            {
                "name": "X2",
                "y": 10.57,
                "drilldown": "X2"
            },
            {
                "name": "X3",
                "y": 7.23,
                "drilldown": "X3"
            },
            {
                "name": "X4",
                "y": 5.58,
                "drilldown": "X4"
            },
            {
                "name": "Onyx",
                "y": 4.02,
                "drilldown": "Onyx"
            }
            ]
        }
        ],
        "drilldown": {
            "series": [
            {
                "name": "Chrome",
                "id": "Chrome",
                "data": [
                [
                "v65.0",
                0.1
                ],
                [
                "v64.0",
                1.3
                ],
                [
                "v63.0",
                53.02
                ],
                [
                "v62.0",
                1.4
                ],
                [
                "v61.0",
                0.88
                ],
                [
                "v60.0",
                0.56
                ],
                [
                "v59.0",
                0.45
                ],
                [
                "v58.0",
                0.49
                ],
                [
                "v57.0",
                0.32
                ],
                [
                "v56.0",
                0.29
                ],
                [
                "v55.0",
                0.79
                ],
                [
                "v54.0",
                0.18
                ],
                [
                "v51.0",
                0.13
                ],
                [
                "v49.0",
                2.16
                ],
                [
                "v48.0",
                0.13
                ],
                [
                "v47.0",
                0.11
                ],
                [
                "v43.0",
                0.17
                ],
                [
                "v29.0",
                0.26
                ]
                ]
            },
            {
                "name": "Firefox",
                "id": "Firefox",
                "data": [
                [
                "v58.0",
                1.02
                ],
                [
                "v57.0",
                7.36
                ],
                [
                "v56.0",
                0.35
                ],
                [
                "v55.0",
                0.11
                ],
                [
                "v54.0",
                0.1
                ],
                [
                "v52.0",
                0.95
                ],
                [
                "v51.0",
                0.15
                ],
                [
                "v50.0",
                0.1
                ],
                [
                "v48.0",
                0.31
                ],
                [
                "v47.0",
                0.12
                ]
                ]
            },
            {
                "name": "Internet Explorer",
                "id": "Internet Explorer",
                "data": [
                [
                "v11.0",
                6.2
                ],
                [
                "v10.0",
                0.29
                ],
                [
                "v9.0",
                0.27
                ],
                [
                "v8.0",
                0.47
                ]
                ]
            },
            {
                "name": "Safari",
                "id": "Safari",
                "data": [
                [
                "v11.0",
                3.39
                ],
                [
                "v10.1",
                0.96
                ],
                [
                "v10.0",
                0.36
                ],
                [
                "v9.1",
                0.54
                ],
                [
                "v9.0",
                0.13
                ],
                [
                "v5.1",
                0.2
                ]
                ]
            },
            {
                "name": "Edge",
                "id": "Edge",
                "data": [
                [
                "v16",
                2.6
                ],
                [
                "v15",
                0.92
                ],
                [
                "v14",
                0.4
                ],
                [
                "v13",
                0.1
                ]
                ]
            },
            {
                "name": "Opera",
                "id": "Opera",
                "data": [
                [
                "v50.0",
                0.96
                ],
                [
                "v49.0",
                0.82
                ],
                [
                "v12.1",
                0.14
                ]
                ]
            }
            ]
        }
    });


Highcharts.chart('graf3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Prioridades'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Alta',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Media Alta',
            y: 11.84
        }, {
            name: 'Media Baja',
            y: 10.85
        }, {
            name: 'Baja',
            y: 4.67
        }, {
            name: 'Solicitudes',
            y: 4.18
        }]
    }]
});    


Highcharts.chart('graf4', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Plataformas'
    },
    
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Tickets por plataforma'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: [
        ['a', 24.2],
        ['b', 20.8],
        ['c', 14.9],
        ['d', 13.7],
        ['e', 13.1],
        ['f', 12.7],
        ['g', 12.4],
        ['h', 12.2],
        ['i', 12.0],
        ['j', 11.7],
        ['k', 11.5],
        ['l', 11.2],
        ['m', 11.1]
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});

$(document).ready( function () {
    $('#table').DataTable();
} );

</script>