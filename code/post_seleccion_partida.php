<?php session_start();
	include('conexion.php');

	if(isset($_POST['partida']))
	{
		$id = $_POST['partida'];
		$consulta = mysqli_query($conexion, "SELECT * FROM partidas WHERE idPartida='$id'");
		$cant= mysqli_num_rows($consulta);
		if($_SESSION['categoria'] != "Administrador") 
		{
			if($cant != 0)
			{
				$consulta= mysqli_fetch_assoc($consulta);
				$_SESSION['idPartida'] = $consulta['idPartida'];
				header("Location:../view/partida.php");
			}
			else{
				header("Location:../view/menu_crear_partida.php");
			}
		}else{
			header("Location:../view/admin/admin_menu_principal.php");
		}
	}
?>