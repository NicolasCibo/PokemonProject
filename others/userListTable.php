<table class="content-table">
    <thead>
        <tr>
        <?php 
        echo "<th>ID</th>";
        echo "<th>USUARIO</th>";
        echo "<th>NOMBRE</th>";
        echo "<th>APELLIDO</th>";
        echo "<th>EMAIL</th>";
        //echo "<th>PARTIDAS</th>";
        echo "<th>VIDAS</th>";
        echo "<th>MEDALLAS</th>";
        echo "<th>CATEGORIA</th>";
        echo "<th>TWITCH</th>";
        ?>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row=mysqli_fetch_array($usuarios)) 
        {
            echo"<tr class='tr-radio'>";
            echo"<td>". "<input type='radio' value='" . $row['idUser'] . "' name='selectUser' class='radio-mod' required>" . $row['idUser']. "</td>";
            echo"<td>".$row['username']."</td>";
            echo"<td>".$row['nombre']."</td>";
            echo"<td>".$row['apellido']."</td>";
            echo"<td>".$row['email']."</td>";
            $partidas = $row['idUser'];
            $partidas = mysqli_query($conexion, "SELECT * FROM partidas WHERE idUser='$partidas'");
            //$partidas = mysqli_num_rows($partidas);
            $partidas = mysqli_fetch_assoc($partidas);
            //echo"<td>".$partidas."</td>";
            echo"<td>".$partidas['vidas']."</td>";
            echo"<td>".$partidas['medallas']."</td>";
            echo"<td>".$row['categoria']."</td>";
            echo"<td>".$row['twitch']."</td>";
            echo"</tr>";                                           
        }
        ?>
    </tbody>
</table>