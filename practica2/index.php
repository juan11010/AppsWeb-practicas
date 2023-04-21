<?php
require("conjunto.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2>Operaciones con conjuntos</h2>
        <hr>
    </div>
    <div>
        <form action="index.php" method="post">
            <fieldset>
                <label>
                    Numero de datos del conjunto A
                    <input type="text" name="conjuntoA">
                </label>
                <br><br>
                <label>
                    Numero de datos del conjunto B
                    <input type="text" name="conjuntoB">
                </label>
                <br><br>
                <input type="submit" name="enviar" value="Enviar">
            </fieldset>
        </form>
    </div>
    <?php

    function generarNumerosRandom($cantidad)
    {
        $numeros = [];
        for ($i = 0; $i < $cantidad; $i++) {
            $numeros[] = rand(1, 20);
        }
        return $numeros;
    }

    $cantidadA = null;
    $cantidadB = null;

    if (isset($_POST["enviar"])) {
        $cantidadA = $_REQUEST["conjuntoA"];
        $cantidadB = $_REQUEST["conjuntoB"];
    }

    $elementosA = generarNumerosRandom($cantidadA);
    $elementosB = generarNumerosRandom($cantidadB);

    echo "Conjunto A: ";
    foreach ($elementosA as $valor) {
        echo ", $valor ";
    }
    echo "<br>";
    echo "Conjunto B: ";
    foreach ($elementosB as $valor) {
        echo ", $valor";
    }

    $conjuntoA = new Conjunto($elementosA);
    $conjuntoB = new Conjunto($elementosB);

    $interseccion = $conjuntoA->interseccion($conjuntoB);
    $union = $conjuntoA->union($conjuntoB);
    $diferenciaAB = $conjuntoA->diferencia($conjuntoB);
    $diferenciaBA = $conjuntoB->diferencia($conjuntoA);


    echo "<br><br>Interseccion: " . implode(',', $interseccion->obtenerElementos()) . "<br>";
    echo "Union: " . implode(',', $union->obtenerElementos()) . "<br>";
    echo "Diferencia A-B: " . implode(',', $diferenciaAB->obtenerElementos()) . "<br>";
    echo "Diferencia B-A: " . implode(',', $diferenciaBA->obtenerElementos()) . "<br>";

    ?>
</body>

</html>
