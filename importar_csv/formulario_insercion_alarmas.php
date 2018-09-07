<!--<?php //include ('PHP/coneccion.php'); ?>-->

<!DOCTYPE html>
<html lang="es">	
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GAD</title>
	<meta name="description" content="Dash Board creada para llevar los conteos hostoricos de los tickes">
	<meta name="keywords" content="Dashboard_dilo">
	<meta name="Autor" content="Jose Luis Sierra Ramirez, Ingeniero Desarrollador Dashboard_dilo">
	<link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Black+Han+Sans" rel="stylesheet">
	<link rel="stylesheet" href="estilos/estilo.css">
	<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
	<script src="js/Chart.js"></script>
	<script src="js/jquery-1.11.1.min.js"></script>
</head>
<body>
	<header class="menu">
		<nav>
			<ul>
				<li id="Home"><a href="index.php"><em class="fas fa-home"></em> Home</a></li>
				<li><a href="#"><em class="fas fa-database"></em> Datos</a>
				<ul>
					<li><a href="#"><em class= "fas fa-angle-right"></em> Datos 1</a> </li>
					<li><a href="#"><em class= "fas fa-angle-right"></em> Datos 2</a></li>
				</ul>
				</li>
				<li><a href="#"><em class="fas fa-table"></em> Tablas</a>
				<ul>
					<li><a href="#"><em class= "fas fa-angle-right"></em> Tabla 1</a></li>
					<li><a href="#"><em class= "fas fa-angle-right"></em> Tabla 2</a></li>
				</ul>
				</li>
				<li><a href="#"><em class="fas fa-chart-line"></em> Hostoricos</a>
				<ul>
					<li><a href="#"><em class= "fas fa-angle-right"></em> Historico 1</a></li>
					<li><a href="#"><em class= "fas fa-angle-right"></em> Historico 2</a></li>
				</ul>
				</li>
				<li><a href="#"><em class="fas fa-file-excel"></em> Import</a></li>
				<li><a href="#"><em class="fas fa-download"></em> export</a></li>
			</ul>
		</nav>
	</header>
	<div id="body">
	<nav class="menu-vertical">
		<em><strong><a href="#" class="active"><em class="fas fa-tachometer-alt"></em> DASHBOARD</a></strong></em>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Arbol de alarmas</a>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Zona Costa</a>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Zona Oriente Bogota</a>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Zona Oriente Costa</a>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Zona Oriente Panama</a>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Linea</a>
		<a href="#"><strong><em class= "fas fa-angle-right"></em></strong> Tiempos</a>		
	</nav>

	
	
    <section class="importar effect">  
           <header class="title">
				<h1 class="title-card">Forumalrio para ingresar Tabla Arbol de alarmas</h1>
		   </header>        
		   <form class="importar_archivo" action="PHP/importar.php" enctype="multipart/form-data" method="POST">
			<section id="impotardocsv">                     
				<p id="textoimpor">Seleccionar Archivo <em>CSV</em></p>                     
				<input type="file" class="insercion" accept=".csv" name="archivo" size="10"/>
				<input type="hidden" value="cargar" name="action"/>               
		    </section>
			<br>                
			<br>                
			<section>                     
				<input type="submit" value="Importar Archivo" id="enviar"/>                
			</section>
			</form>
  			
		</section>

	</div>
	
	
	

	<footer class="footer">
		<p><small> &copy Lorem Ipsum </small></p>	
	</footer>


	
</body>
</html>