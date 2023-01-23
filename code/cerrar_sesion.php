<?php    
    session_destroy();
    session_start();
    $_SESSION['logueado'] = false;
    header("Location:../view/index.php");
?>