<?php session_start();
    include("../code/conexion.php");
    $lista = mysqli_query($conexion, "SELECT pkm.idPokemon, pkm.nombrePokemon
                                        FROM partidas p, videojuegos vj, pokemon pkm
                                        WHERE p.idPartida = '".$_SESSION['idPartida']."' and p.idVideojuego = vj.idVideojuego and pkm.idGeneracion <= vj.idGeneracion");
?>