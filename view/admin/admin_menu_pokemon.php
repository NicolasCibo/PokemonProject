<?php session_start();
    $_SESSION['adminLoad'] = "pokemon";
    header("Location:admin_menu_principal.php");
?>