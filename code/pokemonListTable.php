<?php   
    while($row=mysqli_fetch_array($lista)) 
    {
        if($row['idPokemon']!=10000)
        {
            echo"<tr>";
            echo"<td>".$row['idPokemon']."</td>";
            echo"<td>". "<input type='radio' value='";
            if(isset($row['idForma']))
            {
                echo $row['idForma'] . "' name='selectPkm' required>";
            } else{
                echo $row['idPokemon'] . "' name='selectPkm' required>";
            }
            if(isset($row['nombrePokemon']))
            {
                echo $row['nombrePokemon'] . "</td>";
            } else{
                echo $row['nombreForma'] . "</td>";
            }
            echo"</tr>";
        }                                   
    }
?>
