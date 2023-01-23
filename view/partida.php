<?php session_start(); 
    include("../code/partida/partida_inicio.php");
    include("../code/partida/pokeinfo_datos.php");
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estiloss.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
	<title>Partida de <?php echo $_SESSION['username']; ?></title>
</head>

<body>
	<?php include("extend/header.php"); ?>

	<section>
        <h3 class="mensaje-partida"><?php include("../code/mensaje.php"); ?></h3>
        <div class="poke-game">
            <div id="nombre-personaje-usuario"><h3><?php echo $nombre ?></h3></div>
        </div>

        <div class="poke-game">
            <div id="vidas"><h3>VIDAS: <?php echo $vidas ?> / 10</h3></div>
            <div id="medallas"><h3>MEDALLAS OBTENIDAS: <?php echo $medallas ?> / <?php echo $medallasTotales ?></h3></div>
        </div>

        <div class="poke-team-info">

        <div class="poke-team"> <!-- CARGA LOS DATOS DE LA PARTIDA -->  
            <div id="equipo_text"><p>Equipo POKéMON:</p></div>

            <form action="../code/buttons/botones.php" method="post">
                <?php include("../code/partida/partida_equipo.php"); ?>

                <div id="boton_informacion" class="botones-partida"><input type="submit" name="info" value="Información POKéMON"></div>
                <div id="boton_agregar" class="botones-partida"><input type="submit" name="agregar" value="Agregar POKéMON"></div>
                <div id="boton_eliminar" class="botones-partida"><input type="submit" name="eliminar" value="Eliminar POKéMON"></div>      
            </form>
            
            <form action="../code/buttons/botones.php" method="post">
                <div id="boton_medalla" class="botones-partida"><input type="submit" name="medalla" value="Agregar Medalla"></div>
            </form>
        </div>

        <div class="poke-info">
            <p>Información del POKéMON seleccionado</p>
            <div class='nombre-pokemon-seleccionado'>
                <label for="">
                    <?php $imagenPokemon = pokeinfo_imagen($idPkm); ?> 
                    <?php $nombrePokemon = pokeinfo_nombre($idPkm); ?>
                    <div class="imgPokemon"><img src= <?php echo $imagenPokemon ?> alt= <?php echo $nombrePokemon ?>></div>
                    <div class="nomPokemon"><?php echo $nombrePokemon ?></div>
                    <div class='tipos-pokemon-seleccionado'>
                        <?php $tipos = pokeinfo_tipos($idPkm); ?>
                        <p>Tipo/s: </p>
                        <?php echo $tipos[0]; if($tipos[1] != null) echo " / " . $tipos[1]; ?>
                    </div>
                    <div class='tipos-pokemon-seleccionado'>
                        <?php $debil = pokeinfo_debilidades($idPkm); ?>
                        <table>
                            <tr>      
                                <?php
                                    echo "<td>Debil a:</td>";
                                    foreach($debil as $deb)
                                    {
                                        echo "<tr>";
                                        echo "<td>" . "-" . $deb[0] . "</td>";
                                        echo "</tr>";
                                    }
 
                                    if(isset($deb[1]))
                                    {
                                        echo "<td>Super Debil a:</td>";
                                        foreach($debil as $deb)
                                        {
                                            echo "<tr>";
                                            echo "<td>" . "-" . $deb[1] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tr>
                        </table>
                    </div>   
                    <div class='estadisticas-pokemon-seleccionado'>
                        <?php $estadisticas = pokeinfo_estadisticasBase($idPkm); ?>
                        <p>PS: <?php echo $estadisticas['ps']?></p>
                        <p>Ataque: <?php echo $estadisticas['ataque']?></p>
                        <p>Defensa: <?php echo $estadisticas['defensa']?></p>
                        <p>Ataque Especial:<?php echo $estadisticas['ataqueEspecial']?></p>
                        <p>Defensa Especial: <?php echo $estadisticas['defensaEspecial']?></p>
                        <p>Velocidad: <?php echo $estadisticas['velocidad']?></p>
                    </div>
                    <div class='evolucion-pokemon-seleccionado'>
                        <?php $evolucion = pokeinfo_evolucion($idPkm); 
                        if($evolucion['idPokemon'] != $idPkm or $idPkm != 10000){ ?>
                        <p><img src=<?php echo $evolucion['rutaPokemon'] ?> alt= <?php echo $evolucion['nombrePokemon'] ?>><?php echo $evolucion['nombrePokemon'] ?></p>
                        <p>evoluciona con <?php echo $evolucion['metodoEvolucion'] ?> a </p>
                        <p><img src=<?php echo $evolucion['rutaEvolucion'] ?> alt= <?php echo $evolucion['nombreEvolucion'] ?>><?php echo $evolucion['nombreEvolucion'] ?></p>
                        <?php }else{ ?>
                        <p><?php echo $evolucion['nombrePokemon'] ?> no evoluciona</p>
                        <?php } ?>
                    </div>
                    <div class='movimientos-pokemon-seleccionado'>
                        <h3>Lista de Movimientos:</h3>
                        <table>
                            <tr>
                                <?php $movimientos = pokeinfo_movimientos($idPkm) ?>
                                <td>Nombre</td>
                                <td>Categoria</td>
                                <td>Potencia</td>
                                <td>Presición</td>
                                <td>PP</td>
                                <td>Tipo</td>
                                <?php
                                    foreach($movimientos as $mov)
                                    {
                                        echo "<tr>";
                                        echo "<td>" . "-" . $mov[0] . "</td>";
                                        echo "<td>" . $mov[1] . "</td>";
                                        echo "<td>" . $mov[2] . "</td>";
                                        echo "<td>" . $mov[3] . "</td>";
                                        echo "<td>" . $mov[4] . "</td>";
                                        echo "<td>" . $mov[5] . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tr>
                        </table>
                    </div>
                    <div class='habilidades-pokemon-seleccionado'>
                        <h3>Habilidades:</h3>
                        <table>
                            <tr>
                                <?php $habilidades = pokeinfo_habilidades($idPkm) ?>
                                <td>Nombre</td>
                                <td>En combate</td>
                                <td>Fuera de combate</td>
                                <?php
                                    foreach($habilidades as $hab)
                                    {
                                        echo "<tr>";
                                        echo "<td>" . "-" . $hab[0] . "</td>";
                                        echo "<td>" . $hab[1] . "</td>";
                                        echo "<td>" . $hab[2] . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tr>
                        </table>
                    </div>
                </label>
            </div>
        </div>
    </section>  

	<?php include("extend/footer.php"); ?>   
</body>
</html>