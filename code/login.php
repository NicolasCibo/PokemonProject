<?php session_start();

$usuario=$_POST['username'];
$password=$_POST['password'];

include("conexion.php");

$consulta= mysqli_query($conexion, "SELECT idUser, username, password, nombre, apellido, email, categoria FROM usuarios WHERE username='$usuario'");
$resultado= mysqli_num_rows($consulta);

if($resultado==1){
	$respuesta= mysqli_fetch_assoc($consulta);
	$passwordHash = $respuesta['password'];

	if(password_verify($password, $passwordHash)){

        $_SESSION['logueado'] = true;
        $_SESSION['username'] = $respuesta['username'];
        $_SESSION['nombre'] = $respuesta['nombre'];
        $_SESSION['apellido'] = $respuesta['apellido'];
        $_SESSION['idUser'] = $respuesta['idUser'];
        $_SESSION['categoria'] = $respuesta['categoria'];
        $_SESSION['email'] = $respuesta['email'];
        $_SESSION['info']=10000;
        $_SESSION['adminLoad'] = "";

        header("Location:../view/seleccion_partida.php");
    }else{
        $_SESSION['mensaje'] = "Contraseña incorrecta!";
        header("Location:../view/menu_login.php");
    }
}else{
	$_SESSION['mensaje'] = "No es un usuario registrado!";
	header("Location:../view/menu_register.php");
}
?>