<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>Crear Partida</title>
</head>

<body>
	<?php include("extend/header.php"); ?>

	<section class="user-register">
		<h1>Crear Partida</h1>
		<div>
			<form action="../code/crear_partida.php" method="post">

				<div class="register-data">
					<h3>Nombre de la partida:</h3>
					<input type="text" name="nombrePj" id="email" placeholder="Inserte el nombre de la partida...">
				</div>

                <div class="register-data" >
					<label for="games">Elige un juego:</label>
					<select name="games">
					<?php
						include("../code/conexion.php");
						$desplegable = mysqli_query($conexion, "SELECT * FROM videojuegos");
					
						while($row=mysqli_fetch_array($desplegable)) 
						{ 
							echo "<option value='" . $row['idVideojuego'] . "' name='videojuego' required>" . $row['titulo'] . "</option>";                
						}
					?>
					</select>
				</div>

				<div class="register_button">
					<input type="submit" name="register" id="register">
				</div>
			</form>
		</div>
	</section>

	<?php include("extend/footer.php"); ?>
</body>
</html>