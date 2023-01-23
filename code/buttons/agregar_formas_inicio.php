<?php session_start();
    include("../code/conexion.php");
    $lista = mysqli_query($conexion, "SELECT idPokemon, nombreForma, idForma
                                        FROM formas_pokemon 
                                        WHERE idPokemon='".$_SESSION['idPkmForm']."' and (SELECT vj.idGeneracion FROM partidas p, videojuegos vj WHERE p.idPartida = '".$_SESSION['idPartida']."' and p.idVideojuego = vj.idVideojuego)");
?>