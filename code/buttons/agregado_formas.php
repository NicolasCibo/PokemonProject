<?php session_start();

    if(isset($_POST['agregar']))
    {
        $idPkm = $_POST['selectPkm'];
        $idGame = $_SESSION['idPartida'];
        $slot = $_SESSION['slotPkm'];

        include("../../code/conexion.php");
        $query = mysqli_query($conexion, "SELECT idForma FROM formas_pokemon WHERE idPokemon='$idPkm' and (SELECT vj.idGeneracion FROM partidas p, videojuegos vj WHERE p.idPartida = '$idGame' and p.idVideojuego = vj.idVideojuego)");
        $consulta = mysqli_query($conexion, "SELECT idPP FROM partida_pokemon WHERE idPartida='$idGame'");

        while($row=mysqli_fetch_array($consulta))
        {
            if($row['idPP'] == $slot) $consulta2 = mysqli_query($conexion, "UPDATE `partida_pokemon` SET `idPokemon` = '$idPkm' WHERE `partida_pokemon`.`idPartida` = '$idGame' and `partida_pokemon`.`idPP` = '$slot'");
        }

        header("Location:../../view/partida.php");
          
    }
    
    if(isset($_POST['cancelar'])) header("Location:../../view/partida.php");
?>