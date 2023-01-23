<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>Registrarse!</title>
</head>

<body>
	<?php include("extend/header.php"); ?>

	<section class="user-register">
		<?php include("../code/mensaje.php"); ?>
		
		<h1>Registrate</h1>
		<div>
			<form action="register.php" method="post">

				<div class="register-data">
					<h3>Usuario:*</h3>
					<input type="text" name="username" id="username" required>
				</div>

				<div class="register-data">
					<div class="register-"><h3>Contraseña:*</h3></div>
					<input type="password" name="password" id="password" required>
				</div>

                <div class="register-data">
					<h3>Nombre:*</h3>
					<input type="text" name="name" id="name" required>
				</div>

				<div class="register-data">
					<h3>Apellido:*</h3>
					<input type="text" name="subname" id="subname" required>
				</div>

                <div class="register-data">
					<h3>Email:*</h3>
					<input type="email" name="email" id="email" required>
				</div>

				<div class="boton-enviar-register">
					<input type="submit" name="register" id="register">
				</div>
			</form>
		</div>
	</section>

	<?php include("extend/footer.php"); ?>
</body>
</html>