<?php session_start();
    $_SESSION['slotPkm'] = $_POST['slotPkm'];
    include("../../code/conexion.php");
        
    if(isset($_POST['agregar'])) header("Location:../../view/agregar.php");
    
    if(isset($_POST['eliminar'])) //ELIMINA EL POKEMON DEL EQUIPO Y DESCUENTA UNA VIDA.
    {
        $idGame = $_SESSION['idPartida'];
        $consulta = mysqli_query($conexion, "SELECT vidas FROM `partidas` WHERE idPartida = '$idGame'");
        $consulta= mysqli_fetch_assoc($consulta);
        $vidas = $consulta['vidas'];
        $slot = $_SESSION['slotPkm'];
        $idPkm = mysqli_query($conexion, "SELECT idPokemon FROM partida_pokemon WHERE idPartida = '$idGame' and `partida_pokemon`.`idPP` = '$slot'");
        $idPkm= mysqli_fetch_assoc($idPkm);

        if($idPkm['idPokemon'] != 10000 and $vidas > 0)
        {
            $vidas = $vidas - 1;
            $consulta = mysqli_query($conexion, "UPDATE `partidas` SET `vidas` = '$vidas' WHERE `partidas`.`idPartida` = $idGame");

            $consulta = mysqli_query($conexion, "SELECT idPP FROM partida_pokemon WHERE idPartida='$idGame'");
            while($row=mysqli_fetch_array($consulta))
            {
                if($row['idPP'] == $slot) $consulta2 = mysqli_query($conexion, "UPDATE `partida_pokemon` SET `idPokemon` = 10000 WHERE `partida_pokemon`.`idPartida` = '$idGame' and `partida_pokemon`.`idPP` = '$slot'");
            }
            
            header("Location:../../view/partida.php");
        } else{
            $_SESSION['mensaje'] = "No hay ningun Pokemon en el equipo para eliminar o se quedó sin vidas!";
            header("Location:../../view/partida.php");
        }
    }

    if(isset($_POST['info'])) //CAMBIA EL NUMERO EN $_SESSION['info'] CON EL ID DEL POKEMON QUE SE ELIGIÓ
    {
        $idGame = $_SESSION['idPartida'];
        $slot = $_POST['slotPkm'];
        $consulta = mysqli_query($conexion, "SELECT * FROM partida_pokemon WHERE idPartida='$idGame'");

        while($row=mysqli_fetch_array($consulta))
        {
            if($row['idPP'] == $slot) 
            {
                $_SESSION['info'] = $row['idPokemon'];
            }       
        }

        header("Location:../../view/partida.php");
    }

    if(isset($_POST['medalla'])) //AGREGA UNA MEDALLA AL CONTADOR DE MEDALLAS
    {
        if($_SESSION['GAME'] != 15 and $_SESSION['GAME'] != 16)
        {
            $medallasTotales = 8;
        } else{$medallasTotales = 16;}

        if($_SESSION['medallas'] < $medallasTotales)
        {
            $idP = $_SESSION['idPartida'];
            include("conexion.php");
            $consulta = mysqli_query($conexion, "SELECT * FROM partidas WHERE idPartida = '$idP'");
            $consulta = mysqli_fetch_assoc($consulta);
            $i = $consulta['medallas'] + 1;
            $consulta = mysqli_query($conexion, "UPDATE `partidas` SET `medallas` = '$i' WHERE `partidas`.`idPartida` = '$idP'");
            header("Location:../../view/partida.php");
        } else{
            $_SESSION['mensaje'] = "Ya conseguiste todas las medallas. Enbuenahora!";
            header("Location:../../view/partida.php");
        }
    }
?>
