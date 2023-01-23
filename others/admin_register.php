<?php
    $usuario = $_POST['username'];
    $password = $_POST['password'];
    $cifrada = password_hash($password, PASSWORD_DEFAULT);
	$name = $_POST['name'];
	$subname = $_POST['subname'];
	$email = $_POST['email'];
	$twitch = $_POST['twitch'];

	include("conexion.php");

	$consulta = mysqli_query($conexion, "INSERT INTO usuarios VALUES ('','$usuario','$cifrada','$name', '$subname', '$email', 'Normal', '$twitch')");

	header("Location:admin_menu_usuarios.php");
?>	