<?php include("../code/buttons/filtrado_inicio.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/estiloss.css">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Libre+Bodoni&family=Roboto&display=swap" rel="stylesheet">
        <title>Agregar POKéMON</title>
    </head>

    <body>
        <?php include("extend/header.php"); ?>
        <section>
            <form action="../code/buttons/agregado.php" method="post">
                <div class="agregar-pokemon-menu">
                    <h3>Cantidad de Resultados: 
                        <?php echo $nros; ?>
                    </h3>

                    <label>Elegir:
                        <input type="submit" value="Agregar POKéMON" name="agregar">
                        <input type="submit" value="Cancelar" name="cancelar">

                        <table>
                        <tr>
                            <th>ID</th>
                            <th>POKéMON</th>
                            <?php include("../code/pokemonListTable.php"); ?>
                            <tr>
                        </table>
                    </label>      
                </div>
            </form>           
        </section>

        <?php include("extend/footer.php"); ?>
        </body>
    </html>