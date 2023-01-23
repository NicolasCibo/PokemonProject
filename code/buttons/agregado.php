<?php session_start();

    if(isset($_POST['agregar']))
    {
        $idPkm = $_POST['selectPkm'];
        $idGame = $_SESSION['idPartida'];
        $slot = $_SESSION['slotPkm'];

        include("../../code/conexion.php");
        /*$query = mysqli_query($conexion, "SELECT idPokemon FROM formas_pokemon WHERE idPokemon='$idPkm' and (SELECT vj.idGeneracion FROM partidas p, videojuegos vj WHERE p.idPartida = '$idGame' and p.idVideojuego = vj.idVideojuego)");
        $cant = mysqli_num_rows($query);
        if($cant > 0)
        {
            $query = mysqli_fetch_assoc($query);
            $_SESSION['idPkmForm'] = $query['idPokemon'];                           FORMAS DESHABILITADO
            header("Location:../../view/agregar_formas.php");
        } else{*/
            $consulta = mysqli_query($conexion, "SELECT idPP FROM partida_pokemon WHERE idPartida='$idGame'");

            while($row=mysqli_fetch_array($consulta))
            {
                if($row['idPP'] == $slot) $consulta2 = mysqli_query($conexion, "UPDATE `partida_pokemon` SET `idPokemon` = '$idPkm' WHERE `partida_pokemon`.`idPartida` = '$idGame' and `partida_pokemon`.`idPP` = '$slot'");
            }

            header("Location:../../view/partida.php");
        //}    
    }
    
    if(isset($_POST['cancelar'])) header("Location:../../view/partida.php");
?>