<?php
    include("../code/conexion.php");
    $consulta = mysqli_query($conexion, "SELECT * FROM partidas WHERE idPartida='".$_SESSION['idPartida']."'");
    $consulta = mysqli_fetch_assoc($consulta);
    $vidas = $consulta['vidas'];
    $medallas = $consulta['medallas'];
    $_SESSION['medallas'] = $medallas;
    $nombre = $consulta['nombrePersonaje'];
    $idP = $consulta['idPartida'];
    $idPkm = $_SESSION['info'];
    $_SESSION['GAME'] = $consulta['idVideojuego'];
    if($_SESSION['GAME'] != 15 and $_SESSION['GAME'] != 16)
    {
        $medallasTotales = 8;
    } else{$medallasTotales = 16;}
?>