<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>ThePokemonProject - Pagina Principal</title>
</head>

<body>
	<?php include("extend/header.php"); ?>

	<section>
        <div class="titulo-intro-ubicacion">
            <h1 id="titulo-intro">ThePokemonProject</h1>
        </div>

		<div class="titulo-intro-ubicacion">
            <p>Caracteristicas</p>
			<p>-Llevar un registro de tus partidas</p>
			<p>-Incluye todos los juegos principales de la saga</p>
			<p>-Actualizado hasta la 8va generación</p>
			<p>-Ver las Caracteristicas de cada Pokemon
				(Al estar actualizado con la información de la 8va generación,
				los datos pueden diferir de los juegos seleccionados)
			</p>
			<p>-Modo normal y modo Locke</p>
			<p>-Ver los pokemon capturables en cada ruta según el tiempo (día, tarde, noche)</p>
        </div>
	</section>

	<?php include("extend/footer.php"); ?>
</body>
</html>