<?php session_start(); 
    include("../code/conexion.php");
    $filtro = $_POST['filtro'];
    $lista = mysqli_query($conexion, "SELECT idPokemon, nombrePokemon FROM pokemon WHERE nombrePokemon LIKE '%$filtro%'");
    $nros=mysqli_num_rows($lista);
?>