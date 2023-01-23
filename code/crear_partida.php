<?php session_start();
    $idUsuario = $_SESSION['idUser'];
    $nombrePj = $_POST['nombrePj'];
	$videojuego = $_POST['games'];

    if($nombrePj == "") $nombrePj = $_SESSION['username'];

    include("conexion.php");
    //CREA EN LA TABLA "partidas" UN REGISTRO
    $consulta = mysqli_query($conexion, "INSERT INTO partidas VALUES ('','$idUsuario','$nombrePj', 10, 0, '$videojuego')");
    //CREA EN LA TABLA "partida_pokemon" UN REGISTRO
    $consulta = mysqli_query($conexion, "SELECT idPartida FROM partidas WHERE idUser = '$idUsuario' ORDER BY idPartida DESC");
    $consulta = mysqli_fetch_assoc($consulta);
    $ultimoId = $consulta['idPartida'];
    for($i = 0; $i < 6; $i++)
    {
        $consulta = mysqli_query($conexion, "INSERT INTO partida_pokemon VALUES ('','$ultimoId', 10000)");
    }
    
	header("Location:../view/seleccion_partida.php");
?>