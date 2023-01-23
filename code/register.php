<?php session_start();
    $usuario = $_POST['username'];
    $password = $_POST['password'];
    $cifrada = password_hash($password, PASSWORD_DEFAULT);
	$name = $_POST['name'];
	$subname = $_POST['subname'];
	$email = $_POST['email'];
	$repetido = "";

	include("conexion.php");
	$consulta = mysqli_query($conexion, "SELECT username FROM usuarios");
	
	while($row=mysqli_fetch_array($consulta))
	{
		if($row['username'] == $usuario) $repetido = $usuario;
	}

	if($repetido != "")
	{
		$_SESSION['mensaje'] = "El usuario ya existe!";
		header("Location:menu_register.php");
	}
	else{
		$consulta = mysqli_query($conexion, "INSERT INTO usuarios VALUES ('','$usuario','$cifrada','$name', '$subname', '$email', 'Normal')");
		$_SESSION['mensaje'] = "Usuario creado con exito!";
		header("Location:menu_login.php");
	}
?>	