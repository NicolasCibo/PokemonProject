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
	<div class="admin-user admin-pokemon-mod">
    <?php
    $agregar = "";
    $eliminar = "";
    $modificar = "";

    if(isset($_POST['agregar'])) $agregar = $_POST['agregar'];
    if(isset($_POST['eliminar'])) $eliminar = $_POST['eliminar'];
    if(isset($_POST['modificar'])) $modificar = $_POST['modificar'];

    if($agregar != "")
    { 
        include("conexion.php");
        $tipos = mysqli_query($conexion, "SELECT * FROM tipos_elementales");
        $gen = mysqli_query($conexion, "SELECT * FROM generacion"); 
        ?>
        <div>
			<h3>Introduzca los datos del POKéMON que quiere agregar:</h3>
			<form action="admin_register_pokemon.php" method="post">

				<div class="admin-user-data">
					<h3>Nombre:</h3>
					<input type="text" name="nombre" id="email" required>
				</div>
                
                <div class="admin-user-data">
					<h3>Estadisticas base:</h3>
                    <p>PS</p>
					<input type="number" name="ps" class="estadisticas" required>
                    <p>ATAQUE</p>
                    <input type="number" name="atk" class="estadisticas" required>
                    <p>DEFENSA</p>
                    <input type="number" name="def" class="estadisticas" required>
                    <p>ATAQUE ESPECIAL</p>
                    <input type="number" name="atkesp" class="estadisticas" required>
                    <p>DEFENSA ESPECIAL</p>
                    <input type="number" name="defesp" class="estadisticas" required>
                    <p>VELOCIDAD</p>
                    <input type="number" name="vel" class="estadisticas" required> 
				</div>

                <div class="admin-user-data">
					<h3>Evolucion:</h3>
					<input type="text" name="evo" class="estadisticas" required>
				</div>

                <div class="admin-user-data">
                    <label>Generacion:
                        <select name='gen'>
                            <?php while($row=mysqli_fetch_array($gen)) 
                            { 
                                echo "<option value='" . $row['idGeneracion'] . "' required>" . $row['idGeneracion'] . "</option>";                
                            } ?>
                        </select>
                    </label>
				</div>

				<div class="admin-register_button">
					<input type="submit" name="register" id="register">
				</div>
			</form>
		</div>
        <?php
    }

    if($eliminar != "")
    {
        include("conexion.php");
        $idPkm = $_POST['selectPkm'];

        //ELIMINA LAS HABILIDADES DEL POKEMON SELECCIONADO
        $consulta = mysqli_query($conexion, "SELECT * FROM pokemon_habilidades WHERE idPokemon='$idPkm'");
        while($row=mysqli_fetch_array($consulta)) 
        { 
            $consulta2 = mysqli_query($conexion, "DELETE FROM pokemon_habiliades WHERE `pokemon_habilidades`.`idPokemon` = '$idPkm'");                
        }

        //ELIMINA LOS MOVIMIENTOS DEL POKEMON SELECCIONADO
        $consulta = mysqli_query($conexion, "SELECT * FROM pokemon_movimientos WHERE idPokemon='$idPkm'");
        while($row=mysqli_fetch_array($consulta)) 
        { 
            $consulta2 = mysqli_query($conexion, "DELETE FROM pokemon_movimientos WHERE `pokemon_movimientos`.`idPokemon` = '$idPkm'");                
        }

        //ELIMINA LOS TIPOS DEL POKEMON SELECCIONADO
        $consulta = mysqli_query($conexion, "SELECT * FROM pokemon_elementos WHERE idPokemon='$idPkm'");
        while($row=mysqli_fetch_array($consulta)) 
        { 
            $consulta2 = mysqli_query($conexion, "DELETE FROM pokemon_elementos WHERE `pokemon_elementos`.`idPokemon` = '$idPkm'");                
        }

        //ELIMINA LAS EVOLUCIONES VINCULADAS DEL POKEMON SELECCIONADO
        $consulta = mysqli_query($conexion, "SELECT * FROM pokemon_evoluciones WHERE idPokemon='$idPkm'");
        while($row=mysqli_fetch_array($consulta)) 
        { 
            $consulta2 = mysqli_query($conexion, "DELETE FROM pokemon_evoluciones WHERE `pokemon_evoluciones`.`idPokemon` = '$idPkm'");                
        }

        $consulta = mysqli_query($conexion, "DELETE FROM pokemon WHERE `pokemon`.`idPokemon` = '$idPkm'");
    }

    if($modificar != "")
    {
        include("conexion.php");
        $idPkm = $_POST['selectPkm'];
        $_SESSION['selectPkm'] = $idPkm;
        $consulta = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon='$idPkm'");
        $consulta = mysqli_fetch_array($consulta);
        ?>
        <form action="admin_modificar_pokemon.php" method="post">

        <div id="admin-pokemon-mod">
            <div>
                <h3 class="nombreActual">NOMBRE:</h3>
                <input type="text" name="nombreNuevo" id="nombreActual" value="<?php echo $consulta['nombrePokemon']; ?>">
            </div>

            <div class="estadisticas-mod">
                <h3>ESTADISTICAS:</h3>
                <h4>PS: </h4>
                <input type="number" name="ps" id="estadisticas-nuevo" value="<?php echo $consulta['ps']; ?>">
                <h4>ATK: </h4>
                <input type="number" name="atk" id="estadisticas-nuevo" value="<?php echo $consulta['ataque']; ?>">
                <h4>DEF: </h4>
                <input type="number" name="def" id="estadisticas-nuevo" value="<?php echo $consulta['defensa']; ?>">
                <h4>ATK. ESP.: </h4>
                <input type="number" name="atkesp" id="estadisticas-nuevo" value="<?php echo $consulta['ataqueEspecial']; ?>">
                <h4>DEF. ESP.: </h4>
                <input type="number" name="defesp" id="estadisticas-nuevo" value="<?php echo $consulta['defensaEspecial']; ?>">
                <h4>VEL: </h4>
                <input type="number" name="vel" id="estadisticas-nuevo" value="<?php echo $consulta['velocidad']; ?>">
            </div>
            

            <div class="habilidades-mod">
                <h3>HABILIDADES NUEVAS:</h3>
                <?php
                    $habPokemon = mysqli_query($conexion, "SELECT * FROM pokemon_habilidades WHERE idPokemon='$idPkm'");
                    $cant = mysqli_num_rows($habPokemon);
                    $i = 1;
                    if($cant != 0)
                    {
                        while($fila = mysqli_fetch_array($habPokemon))
                        {
                            echo "Habilidad " . $i . ": ";
                            echo "<select name='habilidadNueva".$i."'>";
                            echo "<option value='0'>Vacio</option>";
                                $hab = mysqli_query($conexion, "SELECT * FROM habilidades");
                                while($row=mysqli_fetch_array($hab)) 
                                {
                                    echo "<option value='" . $row['idHabilidades'] . "'"; 
                                    if($fila['idHabilidad'] == $row['idHabilidades']) 
                                    {
                                        echo "selected>" . $row['nombreHabilidad'] . "</option>";
                                    }
                                    else{
                                        echo ">" . $row['nombreHabilidad'] . "</option>";
                                    }        
                                }
                            echo "</select>";
                            echo "<br>";

                            $i++;
                        }
                    }else{
                        $cant = 3;
                        while($i <= $cant)
                        {
                            echo "Habilidad " . $i . ": ";
                            echo "<select name='habilidadNueva".$i."'>";
                                echo "<option value='0'>Vacio</option>";
                                $hab = mysqli_query($conexion, "SELECT * FROM habilidades");
                                while($row=mysqli_fetch_array($hab)) 
                                {
                                    echo "<option value='" . $row['idHabilidades'] . "'>" . $row['nombreHabilidad'] . "</option>";
                                }
                            echo "</select>";
                            echo "<br>";

                            $i++;
                        }
                    }
                ?>
            </div>

            <div class="movimientos-mod">
                <h3>MOVIMIENTOS:</h3>
                <?php
                    $movPokemon = mysqli_query($conexion, "SELECT * FROM pokemon_movimientos WHERE idPokemon = '$idPkm' ORDER BY orden ASC");
                    $cant = mysqli_num_rows($movPokemon);
                    $i = 1;
                    if($cant != 0)
                    {
                        while($fila = mysqli_fetch_array($movPokemon))
                        {
                            echo "Movimiento " . $i . ": ";
                            echo "<select name='movimientoNuevo".$i."'>";
                                echo "<option value='0'>Vacio</option>";
                                $mov = mysqli_query($conexion, "SELECT * FROM movimientos");
                                while($row=mysqli_fetch_array($mov)) 
                                {
                                    echo "<option value='" . $row['idHabilidades'] . "'"; 
                                    if($fila['idMovimiento'] == $row['idMovimiento']) 
                                    {
                                        echo "selected>" . $row['nombreMovimiento'] . "</option>";
                                    }
                                    else{
                                        echo ">" . $row['nombreMovimiento'] . "</option>";
                                    }       
                                }
                            echo "</select>";
                            echo "<br>";

                            $i++;
                        }
                    } else{
                        $cant = 15;
                        while($i <= $cant)
                        {
                            echo "Movimiento " . $i . ": ";
                            echo "<select name='movimientoNuevo".$i."'>";
                                echo "<option value='0'>Vacio</option>";
                                $mov = mysqli_query($conexion, "SELECT * FROM movimientos");
                                while($row=mysqli_fetch_array($mov)) 
                                {
                                    echo "<option value='" . $row['idHabilidades'] . "'>" . $row['nombreMovimiento'] . "</option>";          
                                }
                            echo "</select>";
                            echo "<br>";

                            $i++;
                        }
                    }    
                ?>
            </div>

            <div class="boton-enviar-register">
				<input type="submit" name="register" id="register">
			</div>

        </div>
        </form>
        
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