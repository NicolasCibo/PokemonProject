<?php session_start();
    $_SESSION['adminLoad'] = "usuarios";
    header("Location:admin_menu_principal.php");
?>