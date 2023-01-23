<?php session_start(); ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="css/estiloss.css">
            <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
            <title>Menú Administrador - Filtrado de usuarios</title>
        </head>

        <body id="admin-body">
            <header>
            <div class="menu_superior">
                <nav class="nav-header-admin" id="navi">
                    <a href="index.php"><img src="img/pokemon_logo.png" alt="pokemon_logo"></a>
                        
                    <ul class="menu menu-admin">
                            <?php if($_SESSION['logueado'] === true)
                            { ?>
                                <?php if($_SESSION['categoria'] == "Administrador") { ?>
                                <li id="partida"><a href="admin_menu_principal.php">Administrar</a></li>
                                <?php } ?>
                                <li id="partida"><a href="#">Partida</a>
                                    <ul>
                                        <li><a href="seleccion_partida.php">Actual</a></li>
                                        <li><a href="pre_seleccion.php">Cambiar</a></li>
                                        <li><a href="menu_crear_partida.php">Crear</a></li>
                                        <li><a href="eliminar_partida.php">Eliminar</a></li>
                                    </ul>
                                </li>
                                <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
                            <?php }
                            else{ ?>
                        <li><a href="menu_login.php">Ingresar</a></li>
                        <li><a href="menu_register.php">Registrarse</a></li>
                        <?php } ?>
                        <li><a href="menu_contacto.php">Contacto</a></li>
                    </ul>
                </nav>
            </div>
        </header>

            <section>
                <div class="admin-user">
                    <form action="admin_accion_usuarios.php" method="post">
                    <?php

                    $filtro = "";
                    $filtroVida= "";
                    $filtroMedalla ="";
                    if(isset($_POST['filtro']))  $filtro = $_POST['filtro'];
                    if(isset($_POST['filtroVida']))  $filtroVida = $_POST['filtroVida'];
                    if(isset($_POST['filtroMedalla']))  $filtroMedalla = $_POST['filtroMedalla'];

                    if($filtro != "")
                    {
                    include("conexion.php");

                    $filtro = $_POST['filtro'];
                    $usuarios = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username LIKE '%$filtro%'");
                    ?>
                    <div>
                        <p>Cantidad de Resultados: 
                        <?php
                            $nros=mysqli_num_rows($usuarios);
                            echo $nros;
                        ?>
                        </p>

                        <p>¿Qué desea hacer?: </p>
                            <input type="submit" value="Agregar" name="agregar">
                            <input type="submit" value="Modificar" name="modificar">
                            <input type="submit" value="Eliminar" name="eliminar">
                            <input type="submit" value="Ver Partidas" name="partidas">
                            <input type="submit" value="Contactar" name="contacto">
                            <?php include("userListTable.php"); ?> 
                    </div>
                    <?php }

                    if($filtroVida != "")
                    {
                    include("conexion.php");

                    $partidas = mysqli_query($conexion, "SELECT * FROM partidas WHERE vidas = 0");
                    ?>
                    <div>
                        <p>Cantidad de usuarios con 0 vidas: 
                        <?php
                            $nros=mysqli_num_rows($partidas);
                            echo $nros;
                        ?>
                        </p>

                        <p>¿Qué desea hacer?: </p>
                        <label class="lbl-admin-accion-usuarios">
                            <input type="submit" value="Modificar" name="modificar">
                            <input type="submit" value="Eliminar" name="eliminar">
                            <input type="submit" value="Contactar" name="contacto">
                        </label>
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
                                    while($fila=mysqli_fetch_array($partidas)) 
                                    {
                                        $partida = $fila['idUser'];
                                        $row = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUser='$partida'");
                                        $row = mysqli_fetch_array($row);
                                        echo"<tr class='tr-radio'>";
                                        echo"<td>". "<input type='radio' value='" . $row['idUser'] . "' name='selectUser' class='radio-mod' required>" . $row['idUser']. "</td>";
                                        echo"<td>".$row['username']."</td>";
                                        echo"<td>".$row['nombre']."</td>";
                                        echo"<td>".$row['apellido']."</td>";
                                        echo"<td>".$row['email']."</td>";
                                        $part = $row['idUser'];
                                        $part = mysqli_query($conexion, "SELECT * FROM partidas WHERE idUser='$part'");
                                        //$partidas = mysqli_num_rows($partidas);
                                        $part = mysqli_fetch_assoc($part);
                                        //echo"<td>".$partidas."</td>";
                                        echo"<td>".$part['vidas']."</td>";
                                        echo"<td>".$part['medallas']."</td>";
                                        echo"<td>".$row['categoria']."</td>";
                                        echo"<td>".$row['twitch']."</td>";
                                        echo"</tr>";                                           
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    <?php }

                    if($filtroMedalla != "")
                    {
                    include("conexion.php");

                    $partidas = mysqli_query($conexion, "SELECT * FROM partidas WHERE medallas = 8");
                    ?>
                    <div>
                        <p>Cantidad de usuarios con 8 medallas: 
                        <?php
                            $nros=mysqli_num_rows($partidas);
                            echo $nros;
                        ?>
                        </p>

                        <p>¿Qué desea hacer?: </p>
                        <label class="lbl-admin-accion-usuarios">
                            <input type="submit" value="Modificar" name="modificar">
                            <input type="submit" value="Eliminar" name="eliminar">
                            <input type="submit" value="Contactar" name="contacto">
                        </label>
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
                                    while($fila=mysqli_fetch_array($partidas)) 
                                    {
                                        $partida = $fila['idUser'];
                                        $row = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUser='$partida'");
                                        $row = mysqli_fetch_array($row);
                                        echo"<tr class='tr-radio'>";
                                        echo"<td>". "<input type='radio' value='" . $row['idUser'] . "' name='selectUser' class='radio-mod' required>" . $row['idUser']. "</td>";
                                        echo"<td>".$row['username']."</td>";
                                        echo"<td>".$row['nombre']."</td>";
                                        echo"<td>".$row['apellido']."</td>";
                                        echo"<td>".$row['email']."</td>";
                                        $part = $row['idUser'];
                                        $part = mysqli_query($conexion, "SELECT * FROM partidas WHERE idUser='$part'");
                                        //$partidas = mysqli_num_rows($partidas);
                                        $part = mysqli_fetch_assoc($part);
                                        //echo"<td>".$partidas."</td>";
                                        echo"<td>".$part['vidas']."</td>";
                                        echo"<td>".$part['medallas']."</td>";
                                        echo"<td>".$row['categoria']."</td>";
                                        echo"<td>".$row['twitch']."</td>";
                                        echo"</tr>";                                           
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                     <?php } ?>
                    
                    </form>
                </div>
            </section>
        </body>
    </html>