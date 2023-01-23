<?php include("../code/buttons/agregar_formas_inicio.php") ?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Listado de Pokemon</title>
    </head>
    <body>
        <div class="agregar-pokemon-menu">
        <h1>Seleccione la forma del Pokémon</h1>

        <form action="../code/buttons/agregado.php" method="post">
            <input type="submit" value="Cancelar" name="cancelar">
        </form>

        <form action="../code/buttons/agregado.php" method="post">
            <label class="agregar-partida-lista">
                <input type="submit" value="Agregar POKéMON" name="agregar">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>POKéMON</th>
                        <?php include("../code/pokemonListTable.php"); ?>
                    <tr>
                </table>
            </label>
        </form>       
    </body>
</html>