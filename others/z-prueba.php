<?php
/*
COSAS POR HACER

PROGRAMACION:
-HACER UN CARTEL PARA CONFIRMAR CIERTAS DECISIONES, EJEMPLO: ELIMINAR UNA PARTIDA.
-MOSTRAR LAS FORTALEZAS DE LOS TIPOS EN LA INFORMACION DEL POKEMON SELECCIONADO.
-HACER LA PAGINA PRINCIPAL (INDEX).
-REHACER EL APARTADO DE ADMINISTRADOR.
-AGREGAR COOKIE PARA MANTENER LA SESION INICIADA.
-AGREGAR LAS INTERACCIONES CON LAS REGIONES Y RUTAS.
-AGREGAR LA INTERACCION CON LAS FORMAS DE LOS POKEMON.
-ELEGIR MODOS DE JUEGO (NORMAL, LOCKE, ETC.).
-PERMITIR CREAR PARTIDA PERSONALIZADA (NOMBRE DEL JUEGO, MEDALLAS, VIDAS).

CSS:
-ARREGLAR LINK DE LA IMAGEN pokemon_logo.png.
-REDISEÑAR PAGINA DE SELECCION PARTIDA.
-REDISEÑAR PAGINA DE LA PARTIDA.
-DISEÑAR PAGINA agregar.php
-REDISEÑAR EL FOOTER.

BD:
-IMPLEMENTAR RUTAS PARA CADA JUEGO.
-TABLA DE LIDERES DE GYM Y ALTOS MANDO CON SUS RESPECTIVOS POKEMON.


____________________________________________________________________________________________________________________________________________________

ThePokémonProject es un sitio web en el cual puedes llevar el progreso de tu partida,
                como las medellas obtenidas a lo largo de la aventura, el equipo Pokemon que llevas en
                el momento y ver las caracteristicas de estos mismos.


admin_accion_pokemon.php------------------
<div class="pass" class="admin-user-data">
                    <label>Tipo 1:
                        <select name='tipo'>
                            <?php while($row=mysqli_fetch_array($tipos)) 
                            { 
                                echo "<option value='" . $row['idTipoElemental'] . "'  required>" . $row['nombreTipoElemental'] . "</option>";                
                            } ?>
                        </select>
                    </label>
                    <?php $tipos = mysqli_query($conexion, "SELECT * FROM tipos_elementales");?>
                    <label>Tipo 2:
                        <select name='tipo2'>
                            <option value="0">No tiene</option>
                            <?php while($row=mysqli_fetch_array($tipos)) 
                            { 
                                echo "<option value='" . $row['idTipoElemental'] . "'>" . $row['nombreTipoElemental'] . "</option>";                
                            } ?>
                        </select>
                    </label>
				</div>


admin_menu_principal.php-------------------------
echo"<td>";
                                $idPokeTipo = $row['idPokemon'];
                                $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon_elementos WHERE idPokemon = '$idPokeTipo'");
                                $i = mysqli_num_rows($dataPokemon);
                                while($fila=mysqli_fetch_array($dataPokemon)) {
                                    $tipo = $fila['idTiposElementales'];
                                    $tipo = mysqli_query($conexion, "SELECT nombreTipoElemental FROM tipos_elementales WHERE idTipoElemental ='$tipo'");
                                    $tipo = mysqli_fetch_assoc($tipo);
                                    echo $tipo['nombreTipoElemental'];
                                    if($i > 1) 
                                    {
                                        echo "-";
                                        $i = 0;
                                    }
                                }
                                echo"</td>";
                                $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon_movimientos WHERE idPokemon = '$idPokeTipo'");
                                $i = mysqli_num_rows($dataPokemon);
                                //echo"<td>".$i."</td>";
*/
?>