<?php session_start();
    $idUsuario = $_SESSION['idUser'];
    $partida_actual = $_SESSION['partida'];

    include("conexion.php");
    //ELIMINA EN LA TABLA "partidas" UN REGISTRO
    $consulta = mysqli_query($conexion, "DELETE FROM partida_pokemon WHERE `partida_pokemon`.`idPartida` = '$partida_actual'");
    //CREA EN LA TABLA "partida_pokemon" UN REGISTRO
    $consulta = mysqli_query($conexion, "DELETE FROM partidas WHERE `partidas`.`idPartida` = '$partida_actual'");
    
	header("Location:../view/seleccion_partida.php");
?>