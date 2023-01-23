<?php
    $equipo = mysqli_query($conexion, "SELECT * FROM partida_pokemon WHERE idPartida='$idP' ORDER BY idPP");
    while($row=mysqli_fetch_array($equipo))
    { //CARGA EL EQUIPO POKEMON
        $dataPokemon = mysqli_query($conexion, "SELECT idPokemon, nombrePokemon FROM pokemon WHERE idPokemon='".$row['idPokemon']."'");
        $dataPokemon = mysqli_fetch_assoc($dataPokemon);
        $ruta = "../imgPkm/" . $dataPokemon['idPokemon'] . "-" . $dataPokemon['nombrePokemon'] . ".gif";
        // imgPkm/1-Bulbasaur.gif             
        echo "<input type='radio' value='" . $row['idPP'] . "' name='slotPkm' id='1' class='hidebox' required>";
        echo "<label for='1' class='lbl-pokemon'>";
        echo "<div class='imgPokemon'>". "<img src=" . $ruta . " alt=" . $dataPokemon['nombrePokemon'] . ">"."</div>";
        echo "<div class='nomPokemon'>".$dataPokemon['nombrePokemon']."</div>";
        echo "</label>";
    }
?>