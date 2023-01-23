<?php session_start();
    include("conexion.php");
    $id = $_SESSION['idUsuarioSeleccionado'];
    $de = $_SESSION['email'];
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idUser = '$id'");
    $consulta = mysqli_fetch_assoc($consulta);
    $nombre = "Administrador de The Pokemon Project";
    $destino = $consulta['email'];

    $asunto= $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $encabezamiento = "From: " . $nombre;

    try{
        mail($destino, $asunto, $mensaje, $encabezamiento);   
    }catch(exception $e){
        echo "Su correo ha sido enviado.";    
    }finally{
        echo "Hubo un error en el envio del mail.";
    }

    $email = $de;
    include("conexion.php");
    $consulta=mysqli_query($conexion, "INSERT INTO contacto VALUES ('','$nombre','$email','$mensaje')") or die(mysqli_error($conexion));

    header("Location:admin_menu_principal.php");
?>