<?php
    include("conexion.php");

    if(isset($_POST['nombre'])) $nombre = $_POST['nombre'];
    if(isset($_POST['ps'])) $ps = $_POST['ps'];
    if(isset($_POST['atk'])) $atk = $_POST['atk'];
    if(isset($_POST['def'])) $def = $_POST['def'];
    if(isset($_POST['atkesp'])) $atkEsp = $_POST['atkesp'];
    if(isset($_POST['defesp'])) $defEsp = $_POST['defesp'];
    if(isset($_POST['vel'])) $vel = $_POST['vel'];
    if(isset($_POST['evo'])) $evo = $_POST['evo'];
    if(isset($_POST['gen'])) $gen = $_POST['gen'];

	$consulta = mysqli_query($conexion, "INSERT INTO pokemon VALUES ('','$nombre','$ps','$atk', '$def', 
                                                                    '$atkEsp', '$defEsp', '$vel', '$evo', '$gen')");

	header("Location:admin_menu_principal.php");
?>	