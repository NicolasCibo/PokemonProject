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
                            <li id="partida"><a href="#">Partida</a>
                                <ul>
                                    <li><a href="seleccion_partida.php">Actual</a></li>
                                    <li><a href="pre_seleccion.php">Cambiar</a></li>
                                    <li><a href="menu_crear_partida.php">Crear</a></li>
                                    <li><a href="eliminar_partida.php">Eliminar</a></li>
                                </ul>
                            </li>
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
        <!-- --------------------------------- LISTA DE POKEMON --------------------------------------------- -->
        
        <div class="admin-pokemon">
        <h1>Lista de Pokemon</h1>
        
        <?php
        if(isset($_POST['filtroNombre']))
        {
            $filtro = $_POST['filtro'];
            $lista = mysqli_query($conexion, "SELECT * FROM pokemon WHERE nombrePokemon LIKE '%$filtro%'");
        }

        if(isset($_POST['filtroGen']))
        {
            $filtro = $_POST['filtroGeneracion'];
            $lista = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idGeneracion='$filtro'");
        }
        
        ?>
        <div>
            <p>Cantidad de Resultados: 
            <?php
                $nros=mysqli_num_rows($lista);
                echo $nros;
            ?>
            </p>

            <form action="admin_accion_pokemon.php" method="post">
            <p>Seleccione un Pokemon y luego la accion a ejecutar</p>
            <label class="lbl-admin-accion-pokemon">
                <input type="submit" value="Modificar" name="modificar">
                <input type="submit" value="Eliminar" name="eliminar">
            </label>
                   
        </div>

        <table class="content-table">
            <thead>
            <tr>
            <?php 
            echo "<th>ID</th>";
            echo "<th>POKéMON</th>";
            echo "<th>TIPO ELEMENTAL</th>";
            echo "<th>CANT. MOV.</th>";
            echo "<th>GENERACION</th>";
            ?>
            </tr>
            </thead>
            <tbody>
            <?php  
                while($row=mysqli_fetch_array($lista)) 
                {
                    if($row['idPokemon']!=10000)
                    {
                        echo"<tr>";
                        echo"<td>". "<input type='radio' value='" . $row['idPokemon'] . "' name='selectPkm' class='radio-mod' required>" . $row['idPokemon']. "</td>";
                        echo"<td>".$row['nombrePokemon']."</td>";
                        echo"<td>";
                        $idPokeTipo = $row['idPokemon'];
                        $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon_elementos WHERE idPokemon = '$idPokeTipo'");
                        $i = mysqli_num_rows($dataPokemon);
                        while($fila=mysqli_fetch_array($dataPokemon)) {
                            $tipo = $fila['idTiposElementales'];
                            $tipo = mysqli_query($conexion, "SELECT nombreTipoElemental FROM tipos_elementales WHERE idTipoElemental ='$tipo'");
                            $tipo = mysqli_fetch_assoc($tipo);
                            echo $tipo['nombreTipoElemental'];
                            if($i > 1) 
                            {
                                echo "-";
                                $i = 0;
                            }
                        }
                        echo"</td>";
                        $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon_movimientos WHERE idPokemon = '$idPokeTipo'");
                        $i = mysqli_num_rows($dataPokemon);
                        echo"<td>".$i."</td>";
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