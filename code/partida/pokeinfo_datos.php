<?php
    function pokeinfo_nombre($idPkm)
    {
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon='$idPkm'");
        $dataPokemon = mysqli_fetch_assoc($dataPokemon);
        return $dataPokemon['nombrePokemon'];
    }

    function pokeinfo_imagen($idPkm)
    { //386/905 CARGADOS EN LA BASE DE DATOS
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon='$idPkm'");
        $dataPokemon = mysqli_fetch_assoc($dataPokemon);
        $ruta = "../imgPkm/" . $dataPokemon['idPokemon'] . "-" . $dataPokemon['nombrePokemon'] . ".gif";
        // ../imgPkm/1-Bulbasaur.gif
        return $ruta;
    }

    function pokeinfo_tipos($idPkm)
    {
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT te.nombreTipoElemental
                                                    FROM pokemon pkm, tipos_elementales te, pokemon_elementos pe
                                                    WHERE pkm.idPokemon='$idPkm' and pkm.idPokemon = pe.idPokemon and pe.idTiposElementales = te.idTipoElemental");
        $tipos = array(2);
        $lap = 1;
        while($row=mysqli_fetch_array($dataPokemon)) {
            if($lap <= 1) $tipos[0] = $row['nombreTipoElemental'];
            if($lap >= 2)
            {
                $tipos[1] = $row['nombreTipoElemental'];
            }else{
                $tipos[1] = null;
            }
            $lap++;
        }
        return $tipos;
    }

    function pokeinfo_estadisticasBase($idPkm)
    {
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT * FROM pokemon WHERE idPokemon='$idPkm'");
        $dataPokemon = mysqli_fetch_assoc($dataPokemon);
        return array(
            "ps" => $dataPokemon['ps'], 
            "ataque" => $dataPokemon['ataque'],
            "defensa" => $dataPokemon['defensa'],
            "ataqueEspecial" => $dataPokemon['ataqueEspecial'],
            "defensaEspecial" => $dataPokemon['defensaEspecial'],
            "velocidad" => $dataPokemon['velocidad']
        );
    }

    function pokeinfo_evolucion($idPkm)
    {
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT p.idPokemon, p.nombrePokemon, pe.evoluciona, pe.metodo
                                                FROM pokemon_evoluciones pe, pokemon p
                                                WHERE p.idPokemon='$idPkm' and p.idPokemon = pe.idPokemon");
        $dataPokemon = mysqli_fetch_assoc($dataPokemon);
        if(isset($dataPokemon['idPokemon']))
        {
            $evo = $dataPokemon['evoluciona'];
            $evo = mysqli_query($conexion, "SELECT idPokemon, nombrePokemon FROM pokemon WHERE idPokemon='$evo'");
            $evo = mysqli_fetch_assoc($evo);
            $ruta = "../imgPkm/" . $dataPokemon['idPokemon'] . "-" . $dataPokemon['nombrePokemon'] . ".gif";
            $rutaEvo = "../imgPkm/" . $evo['idPokemon'] . "-" . $evo['nombrePokemon'] . ".gif";
            return array(
                "idPokemon" => $dataPokemon['idPokemon'], 
                "nombrePokemon" => $dataPokemon['nombrePokemon'], 
                "rutaPokemon" => $ruta, 
                "nombreEvolucion" => $evo['nombrePokemon'], 
                "rutaEvolucion" => $rutaEvo, 
                "metodoEvolucion" => $dataPokemon['metodo']
            );
        }else{
            $dataPokemon = mysqli_query($conexion, "SELECT idPokemon, nombrePokemon FROM pokemon WHERE idPokemon='$idPkm'");
            $dataPokemon = mysqli_fetch_assoc($dataPokemon);
            return array("idPokemon" => $dataPokemon['idPokemon'], "nombrePokemon" => $dataPokemon['nombrePokemon']);
        }
    }

    function pokeinfo_movimientos($idPkm)
    { //20/905 CARGADOS EN LA BASE DE DATOS
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT m.nombreMovimiento, m.categoria, m.potencia, m.presicion, m.pp, te.nombreTipoElemental
                                                FROM pokemon pkm, tipos_elementales te, movimientos m, pokemon_movimientos pm 
                                                WHERE pkm.idPokemon='$idPkm' and pkm.idPokemon = pm.idPokemon and m.idMovimiento = pm.idMovimiento and te.idTipoElemental = m.idTipoElemental
                                                Order by pm.orden");
        $i = 0;
        while($row=mysqli_fetch_array($dataPokemon))
        {
            $movimientos[$i][0] = $row['nombreMovimiento'];
            $movimientos[$i][1] = $row['categoria'];
            $movimientos[$i][2] = $row['potencia'];
            $movimientos[$i][3] = $row['presicion'];
            $movimientos[$i][4] = $row['pp'];
            $movimientos[$i][5] = $row['nombreTipoElemental'];
            $i++;
        }
        return $movimientos;
    }

    function pokeinfo_habilidades($idPkm)
    { //20/905 CARGADOS EN LA BASE DE DATOS
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT h.nombreHabilidad, h.enCombate, h.fueraDeCombate
                                                FROM pokemon_habilidades ph, habilidades h, pokemon p, generacion g
                                                WHERE p.idPokemon='$idPkm' and p.idPokemon = ph.idPokemon and h.idHabilidades = ph.idHabilidad and g.idGeneracion = h.idGeneracion
                                                Order by ph.orden");
        $i = 0;
        while($row=mysqli_fetch_array($dataPokemon))
        {
            $habilidades[$i][0] = $row['nombreHabilidad'];
            $habilidades[$i][1] = $row['enCombate'];
            $habilidades[$i][2] = $row['fueraDeCombate'];
            $i++;
        }
        return $habilidades;
    }

    function pokeinfo_debilidades($idPkm)
    {
        include("../code/conexion.php");
        $dataPokemon = mysqli_query($conexion, "SELECT td.idTipoFortaleza, td.multiplicador
                                                FROM tipos_debilidades td, tipos_elementales te, pokemon p, pokemon_elementos pe
                                                WHERE p.idPokemon='$idPkm' and p.idPokemon = pe.idPokemon and pe.idTiposElementales = te.idTipoElemental and te.idTipoElemental = td.idTipoDebilidad");
        
        $total = mysqli_num_rows($dataPokemon);
        if($total == 18)
        {
            $i = 0;
            $j = 0;
            while($row=mysqli_fetch_array($dataPokemon))
            {
                $nombre = mysqli_query($conexion, "SELECT nombreTipoElemental FROM tipos_elementales WHERE idTipoElemental = '".$row['idTipoFortaleza']."'");
                $nombre = mysqli_fetch_array($nombre);          
                $tipo[$i][0] = $nombre['nombreTipoElemental'];
                $tipo[$i][1] = $row['multiplicador'];
                $i++;
            }
            for($i=0; $i<18; $i++)
            {
                if($tipo[$i][1] == 2.0)
                {
                    $debil[$j][0] = $tipo[$i][0];
                    $j++;
                } 
            }

        }else{
            $i = 0;
            $j = 0;
            $cont=1;
            while($row=mysqli_fetch_array($dataPokemon))
            {
                if($cont <= 18)
                {
                    $nombre = mysqli_query($conexion, "SELECT nombreTipoElemental FROM tipos_elementales WHERE idTipoElemental = '".$row['idTipoFortaleza']."'");
                    $nombre = mysqli_fetch_array($nombre);
                    $tipo1[$i][0] = $nombre['nombreTipoElemental'];
                    $tipo1[$i][1] = $row['multiplicador'];
                    $i++;
                    $cont++;
                }else{
                    $nombre = mysqli_query($conexion, "SELECT nombreTipoElemental FROM tipos_elementales WHERE idTipoElemental = '".$row['idTipoFortaleza']."'");
                    $nombre = mysqli_fetch_array($nombre);
                    $tipo2[$j][0] = $nombre['nombreTipoElemental'];
                    $tipo2[$j][1] = $row['multiplicador'];
                    $j++;
                }            
                
            }
            $j = 0;
            $s = 0;
            for($i=0; $i<18; $i++)
            {
                if(($tipo1[$i][1] == 2.0 && $tipo2[$i][1] == 1.0) or ($tipo1[$i][1] == 1.0 && $tipo2[$i][1] == 2.0))
                {
                    $debil[$j][0] = $tipo1[$i][0];
                    $j++;
                }
                if($tipo1[$i][1] == 2.0 && $tipo2[$i][1] == 2.0)
                {
                    $debil[$s][1] = $tipo1[$i][0];
                    $s++;
                }
            }
        }
        return $debil;
    } 
?>