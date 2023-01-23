<?php session_start();
    include("conexion.php");

    $idPkm = $_SESSION['selectPkm'];
    if(isset($_POST['nombreNuevo'])) $nombre = $_POST['nombreNuevo'];
    if(isset($_POST['ps'])) $ps = $_POST['ps'];
    if(isset($_POST['atk'])) $atk = $_POST['atk'];
    if(isset($_POST['def'])) $def = $_POST['def'];
    if(isset($_POST['atkesp'])) $atkEsp = $_POST['atkesp'];
    if(isset($_POST['defesp'])) $defEsp = $_POST['defesp'];
    if(isset($_POST['vel'])) $vel = $_POST['vel'];

    $consulta = mysqli_query($conexion, "UPDATE pokemon SET nombrePokemon = '$nombre', ps = '$ps', ataque = '$atk', 
                                        defensa = '$def', ataqueEspecial = '$atkEsp', defensaEspecial = '$defEsp',
                                        velocidad = '$vel'  WHERE idPokemon = '$idPkm'");
    
    header("Location:admin_menu_principal.php");  
?>