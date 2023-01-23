<?php session_start();
    include("conexion.php");
    $usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");
    $lista = mysqli_query($conexion, "SELECT * FROM pokemon");
    $gen = mysqli_query($conexion, "SELECT * FROM generacion");
?>
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
                            <!--<li id="partida"><a href="#">Partida</a>
                                <ul>
                                    <li><a href="seleccion_partida.php">Actual</a></li>
                                    <li><a href="pre_seleccion.php">Cambiar</a></li>
                                    <li><a href="menu_crear_partida.php">Crear</a></li>
                                    <li><a href="eliminar_partida.php">Eliminar</a></li>
                                </ul>
                            </li>-->
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
        <?php echo "<h1 class='h1-admin-menu-principal'>Bienvenido " . $_SESSION['nombre'] . " " . $_SESSION['apellido'] .  "</h1>"; ?>
        <h3 class='h1-admin-menu-principal'>¿Que desea hacer?</h3>

        <div class="boton-index-ubicacion">
            <a href="admin_menu_usuarios.php" class="boton-index">Cargar Lista de Usuarios</a>
            <a href="admin_menu_pokemon.php" class="boton-index">Cargar Lista de Pokemon</a>
        </div>

        <!-- --------------------------------- LISTA DE USUARIOS --------------------------------------------- --> 
        <?php if($_SESSION['adminLoad'] == "usuarios"){ ?>
        <div class="admin-user">
            <h1>Lista de Usuarios registrados</h1>
            <!--FORMULARIO 1 -->
            <form action="admin_filtro_usuarios.php" method="post">
                <label class="lbl-admin-filtro-usuarios">Filtrar:
                    <input type="search" name="filtro" placeholder="Usuario..." />
                    <input type="submit" value="Aceptar">
                </label>
            </form>
            <!--FORMULARIO 2 -->
            <form action="admin_filtro_usuarios.php" method="post">
                <label class="lbl-admin-filtro-usuarios">Usuarios con 8 medallas:
                    <input type="submit" name="filtroMedalla" value="Mostrar">
                </label>
            </form>
            <!--FORMULARIO 3 -->
            <form action="admin_filtro_usuarios.php" method="post">
                <label class="lbl-admin-filtro-usuarios">Usuarios con 0 vidas:
                    <input type="submit" name="filtroVida" value="Mostrar">
                </label>
            </form>
            
            <form action="admin_accion_usuarios.php" method="post">
            <p>Seleccione un usuario y luego la accion a ejecutar</p>
            <label class="lbl-admin-accion-usuarios">
                <input type="submit" value="Agregar" name="agregar">
            </label>
            </form>

            <form action="admin_accion_usuarios.php" method="post">  
                 
                <label class="lbl-admin-accion-usuarios">  
                    <input type="submit" value="Modificar" name="modificar">
                    <input type="submit" value="Eliminar" name="eliminar">
                    <input type="submit" value="Ver Partidas" name="partidas">
                    <input type="submit" value="Contactar" name="contacto">     
                </label>
                <?php include("userListTable.php"); ?> 
            </form>
        </div>
        <?php } ?>

        <!-- --------------------------------- LISTA DE POKEMON --------------------------------------------- -->
        <?php if($_SESSION['adminLoad'] == "pokemon"){ ?>
        <div class="admin-pokemon">
        <h1>Lista de Pokemon</h1>
        <form action="admin_filtro_pokemon.php" method="post">
            <label class="lbl-admin-filtro-nombre-pokemon">Filtrar por NOMBRE: 
                <input type="search" name="filtro" placeholder="Nombre del POKéMON..." />
                <input type="submit" value="Aceptar" name="filtroNombre">
            </label>
            
            <label class="lbl-admin-filtro-gen-pokemon">Filtrar por GENERACION:
                <select name='filtroGeneracion'>
                    <?php while($row=mysqli_fetch_array($gen)) 
				    { 
						echo "<option value='" . $row['idGeneracion'] . "' >" . $row['idGeneracion'] . "</option>";                
					} ?>
                    <input type="submit" value="Aceptar" name="filtroGen">
                </select>
            </label>
            
        </form>

        <form action="admin_accion_pokemon.php" method="post">
            <p>Seleccione un Pokemon y luego la accion a ejecutar</p>
            <label class="lbl-admin-accion-pokemon">
                <input type="submit" value="Agregar" name="agregar">
            </label>
        </form>

        <form action="admin_accion_pokemon.php" method="post">
            <label class="lbl-admin-accion-pokemon">
                <input type="submit" value="Modificar" name="modificar">
                <input type="submit" value="Eliminar" name="eliminar">
            </label>
               

                <table class="content-table">
                    <thead>
                    <tr>
                        <?php 
                        echo "<th>ID</th>";
                        echo "<th>POKéMON</th>";
                        echo "<th>GENERACION</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                        <?php  
                        while($row=mysqli_fetch_array($lista)) {
                            if($row['idPokemon']!=10000)
                            {
                                echo"<tr>";
                                echo"<td>". "<input type='radio' value='" . $row['idPokemon'] . "' name='selectPkm' class='radio-mod' required>" . $row['idPokemon']. "</td>";
                                echo"<td>".$row['nombrePokemon']."</td>";
                                $idGen = $row['idGeneracion'];
                                $dataPokemon = mysqli_query($conexion, "SELECT * FROM generacion WHERE idGeneracion = '$idGen'");
                                $dataPokemon = mysqli_fetch_assoc($dataPokemon);
                                echo"<td>".$dataPokemon['nombreGeneracion']."</td>";
                                echo"</tr>";
                            }                                   
                        }
                        ?>
                    </tbody>
                </table>
                
        </form>
        </div>
        <?php } ?>
	</section>

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