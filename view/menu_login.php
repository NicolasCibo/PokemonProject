<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>Inicio de sesión</title>
</head>

<body>
	<?php include("extend/header.php"); ?>

	<section class="user-login">
		<?php include("../code/mensaje.php"); ?>
		
		<form action="../code/login.php" method="post">
		<h1>Iniciar sesión</h1>
		<div>

				<div id="user" class="user-data">
					<input type="text" name="username" id="username" placeholder="Usuario" required>
				</div>

				<div id="pass" class="user-data">
					<input type="password" name="password" id="password" placeholder="Contraseña" required>
				</div>

				<div id="boton-enviar-login">
					<input type="submit" value="Iniciar Sesión" name="enviar" id="enviar">
				</div>
			</form>

			<p>¿No estas registrado? <a href="menu_register.php">Registrate</a></p>
		</div>
	</section>

	<?php include("extend/footer.php"); ?>
</body>
</html>