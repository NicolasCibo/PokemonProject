<?php session_start();
    $usuario = $_POST['username'];
	$name = $_POST['name'];
	$subname = $_POST['subname'];
	$email = $_POST['email'];
    $categoria = $_POST['categoria'];
    $twitch = $_POST['twitch'];
    $id = $_SESSION['usuario_mod'];

    include("conexion.php");
    $consulta = mysqli_query($conexion, "UPDATE usuarios SET username = '$usuario', nombre = '$name', apellido = '$subname', 
    email = '$email', categoria = '$categoria', twitch = '$twitch' WHERE idUser = '$id'");
    /*if($usuario != "") $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `username` = '$usuario' WHERE `usuarios`.`idUser` = '$id'");
    if($name != "") $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `nombre` = '$name' WHERE `usuarios`.`idUser` = '$id'");
    if($subname != "") $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `apellido` = '$subname' WHERE `usuarios`.`idUser` = '$id'");
    if($email != "") $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `email` = '$email' WHERE `usuarios`.`idUser` = '$id'");
    if($categoria != "") $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `categoria` = '$categoria' WHERE `usuarios`.`idUser` = '$id'");
    if($twitch != "") $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `twitch` = '$twitch' WHERE `usuarios`.`idUser` = '$id'");
*/
	header("Location:admin_menu_usuarios.php");
?>	