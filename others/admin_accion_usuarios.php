<?php session_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>Menú Administrador</title>
</head>

<body id="admin-body">
    <header>
        <div class="menu_superior">
            <nav class="nav-header-admin" id="navi">
                <a href="index.php"><img src="img/pokemon_logo.png" alt="pokemon_logo"></a>
                    
                <ul class="menu menu-admin">
                        <?php if($_SESSION['logueado'] === true)
                        { ?>
                        <?php if($_SESSION['categoria'] == "Administrador") { ?>
						    <li id="partida"><a href="admin_menu_principal.php">Administrar</a></li>
						<?php } ?>
                            <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
                        <?php }
                        else{ ?>
                    <li><a href="menu_login.php">Ingresar</a></li>
                    <li><a href="menu_register.php">Registrarse</a></li>
                    <?php } ?>
                    <li><a href="menu_contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="admin-section">
	<div class="admin-user">
<?php
    $agregar = "";
    $eliminar = "";
    $modificar = "";
    $ver_partidas = "";
	$contacto = "";

    if(isset($_POST['agregar'])) $agregar = $_POST['agregar'];
    if(isset($_POST['eliminar'])) $eliminar = $_POST['eliminar'];
    if(isset($_POST['modificar'])) $modificar = $_POST['modificar'];
    if(isset($_POST['partidas'])) $ver_partidas = $_POST['partidas'];
	if(isset($_POST['contacto'])) $contacto = $_POST['contacto'];

    if($agregar != "")
    { ?>
        <div>
			<h3>Introduzca los datos del usuario al que quiere registrar:</h3>
			<form action="admin_register.php" method="post">

				<div class="admin-user-data">
					<h3>Usuario:*</h3>
					<input type="text" name="username" id="email" required>
				</div>

				<div class="admin-user-data">
					<h3>Contraseña:*</h3>
					<input type="password" name="password" id="password" required>
				</div>

                <div class="admin-user-data">
					<h3>Nombre:*</h3>
					<input type="text" name="name" id="name" required>
				</div>

				<div class="admin-user-data">
					<h3>Apellido:*</h3>
					<input type="text" name="subname" id="subname" required>
				</div>

                <div class="admin-user-data">
					<h3>Email:*</h3>
					<input type="email" name="email" id="email" required>
				</div>

				<div class="admin-user-data">
					<h3>Canal de Twitch:*</h3>
					<input type="text" name="twitch" id="email" value="https://www.twitch.tv/" required>
				</div>

				<div class="admin-register_button">
					<input type="submit" name="register" id="register">
				</div>
			</form>
		</div>
    <?php }

	if($eliminar != "")
	{
		include("conexion.php");
		$idUsuario = $_POST['selectUser'];
		$consulta = mysqli_query($conexion, "SELECT idPartida FROM partidas WHERE idUser = '$idUsuario'");
		$row=mysqli_fetch_array($consulta);
		$par = $row['idPartida'];
		//ELIMINA LA FILA DE LA TABLA "partida_pokemon"
		$consulta2 = mysqli_query($conexion, "DELETE FROM partida_pokemon WHERE `partida_pokemon`.`idPartida` = '$par'");

		//while($fila=mysqli_fetch_array($consulta))
		//{
			//ELIMINA LAS FILAS DE LA TABLA "partidas"
			$consulta2 = mysqli_query($conexion, "DELETE FROM partidas WHERE `partidas`.`idUser` = '$idUsuario'");
		//}

		//ELIMINA LA FILA DE LA TABLA "usuarios"
		$consulta = mysqli_query($conexion, "DELETE FROM usuarios WHERE `usuarios`.`idUser` = '$idUsuario'");

		header("Location:admin_menu_principal.php");
	}

	if($modificar != "")
	{
		$_SESSION['usuario_mod'] = $_POST['selectUser'];
		include("conexion.php");
		$idUsuario = $_POST['selectUser'];
		$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUser = '$idUsuario'");
		$consulta = mysqli_fetch_assoc($consulta);
		
		echo "<h3>¿Que desea modificar de '" . $consulta['username'] . "'?" . "</h3>"; ?>
		<form action="admin_modificar_usuarios.php" method="post">
			<div class="user" class="admin-user-data">
				<h3>Usuario:</h3>
				<input type="text" name="username" id="name" value="<?php echo $consulta['username']; ?>">
			</div>

			<div class="name" class="admin-user-data">
				<h3>Nombre:</h3>
				<input type="text" name="name" id="name" value="<?php echo $consulta['nombre']; ?>">
			</div>

			<div class="subname" class="admin-user-data">
				<h3>Apellido:</h3>
				<input type="text" name="subname" id="subname" value="<?php echo $consulta['apellido']; ?>">
			</div>

			<div class="email" class="admin-user-data">
				<h3>Email:</h3>
				<input type="text" name="email" id="email" value="<?php echo $consulta['email']; ?>">
			</div>

			<div class="email" class="admin-user-data">
				<h3>Twitch:</h3>
				<input type="text" name="twitch" id="email" value="<?php echo $consulta['twitch']; ?>">

			<div class="categoria admin-user-data">
				<h3>Categoria: </h3>
				<select name='categoria'>
					<option value='Administrador'>Administrador</option>
					<option value='Normal'>Normal</option>
				</select>
			</div>
			<div class="boton-enviar-register">
				<input type="submit" value="Aceptar" id="register">
			</div>
		</form>
		<?php
	}

	if($ver_partidas != "")
	{
		$idUsuario = $_POST['selectUser'];
		include("conexion.php");
		$partida = mysqli_query($conexion, "SELECT * FROM partidas WHERE idUser = '$idUsuario'");
		 ?>

		<table class="content-table">
			<thead>
				<tr>
				<?php 
				//echo "<th>ID PARTIDA</th>";
				echo "<th>USUARIO</th>";
				echo "<th>PERSONAJE</th>";
				echo "<th>SLOT 1</th>";
				echo "<th>SLOT 2</th>";
				echo "<th>SLOT 3</th>";
				echo "<th>SLOT 4</th>";
				echo "<th>SLOT 5</th>";
				echo "<th>SLOT 6</th>";
				echo "<th>VIDAS</th>";
				echo "<th>MEDALLAS</th>";
				//echo "<th>JUEGO</th>";
				?>
				</tr>
			</thead>
			<tbody>
				<?php
				while($row=mysqli_fetch_array($partida)) 
				{
					echo"<tr class='tr-radio'>";
					//echo"<td>".$row['idPartida']. "</td>";
					$usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUser = '$idUsuario'");
					$usuario = mysqli_fetch_assoc($usuario);
					echo"<td>".$usuario['username']."</td>";
					echo"<td>".$row['nombrePersonaje']."</td>";
					$idP = $row['idPartida'];
					$pokemon = mysqli_query($conexion, "SELECT * FROM partida_pokemon WHERE idPartida = '$idP'");
					$pokemon = mysqli_fetch_assoc($pokemon);
					//SLOT 1
					$idPkm = $pokemon['Poke1'];
					$nombrePkm = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon = '$idPkm'");
					$nombrePkm = mysqli_fetch_assoc($nombrePkm);
					echo"<td>".$nombrePkm['nombrePokemon']."</td>";
					//SLOT 2
					$idPkm = $pokemon['Poke2'];
					$nombrePkm = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon = '$idPkm'");
					$nombrePkm = mysqli_fetch_assoc($nombrePkm);
					echo"<td>".$nombrePkm['nombrePokemon']."</td>";
					//SLOT 3
					$idPkm = $pokemon['Poke3'];
					$nombrePkm = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon = '$idPkm'");
					$nombrePkm = mysqli_fetch_assoc($nombrePkm);
					echo"<td>".$nombrePkm['nombrePokemon']."</td>";
					//SLOT 4
					$idPkm = $pokemon['Poke4'];
					$nombrePkm = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon = '$idPkm'");
					$nombrePkm = mysqli_fetch_assoc($nombrePkm);
					echo"<td>".$nombrePkm['nombrePokemon']."</td>";
					//SLOT 5
					$idPkm = $pokemon['Poke5'];
					$nombrePkm = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon = '$idPkm'");
					$nombrePkm = mysqli_fetch_assoc($nombrePkm);
					echo"<td>".$nombrePkm['nombrePokemon']."</td>";
					//SLOT 6
					$idPkm = $pokemon['Poke6'];
					$nombrePkm = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon = '$idPkm'");
					$nombrePkm = mysqli_fetch_assoc($nombrePkm);
					echo"<td>".$nombrePkm['nombrePokemon']."</td>";
					echo"<td>".$row['vidas']."</td>";
					echo"<td>".$row['medallas']."</td>";
					$idP = $row['idVideojuego'];
					$juego = mysqli_query($conexion, "SELECT * FROM videojuegos WHERE idVideojuego = '$idP'");
					$juego = mysqli_fetch_assoc($juego);
					//echo"<td>".$juego['titulo']."</td>";
					echo"</tr>";                                           
				}
				?>
			</tbody>
		</table>
		<a href="admin_menu_principal.php">Volver</a>
		<?php
	}

	if($contacto != "")
	{
		include("conexion.php");
		$id = $_POST['selectUser'];
		$_SESSION['idUsuarioSeleccionado'] = $id;
		$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUser = '$id'");
		$consulta = mysqli_fetch_assoc($consulta);
		?>
		<div class="cuadro">
			<form action="admin_contacto.php" method="post">
				<div class="asunto">
					<h3>Asunto:</h3>
					<input type="text" name="asunto" id="name" class="datos" required>
				</div>

				<div class="mensaje">
					<h3>Mensaje:</h3>
					<textarea name="mensaje" id="mensaje" class="datos" required></textarea>
				</div>
				
				<div class="enviar_">
					<label>Enviar email a <?php echo $consulta['email']; ?>?</label>
					<input type="submit" name="enviar" id="enviar">
				</div>
			</form>
		</div>
		<?php
	}	
?>
	</section>
	</div>
    
    <footer>		
	<div class="texto_footer texto_footer-admin">
		<p>Hecho por Nicolas Javier Cibo</p>
		<label>
		    <p>Redes Sociales: </p>
			<a href="https://www.instagram.com/nicolascibo/"><img id="insta" src="img/instagram_logo.png" alt="Instagram Logo"></a>
			<a href="https://www.facebook.com/nicolas.cibo/"><img id="face" src="img/facebook_logo.png" alt="Facebook Logo"></a>
		</label>		
	</div>
</footer>
</body>
</html>