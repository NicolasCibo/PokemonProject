<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>Selección Partida</title>
</head>

<body>
	<header>
		<div class="menu_superior">
			<nav class="nav-header" id="navi">
				<a href="index.php"><img src="../img/pokeball_logo.png" alt="pokemon_logo"></a>
					
				<ul class="menu">
					<li><a href="../code/cerrar_sesion.php">Cerrar sesión</a></li>
				</ul>		
			</nav>
		</div>
	</header>

    <section class="user-login">
		<?php
			include("../code/conexion.php");
			$ID = $_SESSION['idUser'];
			$consulta = mysqli_query($conexion, "SELECT vj.titulo, p.vidas, p.idVideojuego, p.idPartida, p.medallas
												FROM partidas p, videojuegos vj 
												WHERE p.idUser='$ID' and p.idVideojuego = vj.idVideojuego");

			if($_SESSION['logueado']===true) 
			{ ?>
				<form action='../code/post_seleccion_partida.php' method='post'>	
					<label for='partida' class='label-pre-seleccion'>Elige la partida: </label>
					<select name='partida' class='desplegable-pre-seleccion'>
					<?php while($row=mysqli_fetch_array($consulta)) 
					{
						echo "<option value='" . $row['idPartida'] . "' name='partida' required>" . $row['titulo'] . " - Vidas restantes: " . $row['vidas'] . " - Medallas: " . $row['medallas'] . "</option>";                
					} ?>
					</select>

					<div class="boton-enviar-pre">
						<input type="submit" value="Entrar" name="register" id="register">
					</div>
				</form>
			<?php
			}
			else{
				$_SESSION['mensaje'] = "Se requiere loguearse para acceder a esta ventana!";
				header("Location:menu_login.php");
			}		
		?>
    </section>

    <?php include("extend/footer.php"); ?>
</body>