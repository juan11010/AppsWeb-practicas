<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votaciones</title>
</head>

<body>
    <h2>Votaciones</h2>
    <hr>
    <form action="index.php" method="post">
        Nombre: <input type="text" name="nombre" id="nombre" required>
        <br><br>
        <h3>Selecciona un partido</h3>
        <label for="pri">
            <img src="img/pri.png" alt="Logo PRI" height="50">
            <input type="radio" name="partido" value="pri" required>
            Partido Revolucionario Institucional
        </label>
        <br><br>
        <label for="pan">
            <img src="img/pan.png" alt="Logo PAN" height="50">
            <input type="radio" name="partido" value="pan" required>
            Partido Accion Nacional
        </label>
        <br><br>
        <label for="morena">
            <img src="img/morena.png" alt="Logo MORENA" height="50">
            <input type="radio" name="partido" value="morena" required>
            Movimiento de Regeneracion Nacional
        </label>
        <br><br>
        <input type="submit" name="guardar" value="Guardar voto">
    </form>
    <br>
    <?php
    $fp = fopen("votos.txt", 'a');
    if (isset($_POST["guardar"])) {
        $nombre = $_REQUEST["nombre"];
        $partido = $_REQUEST["partido"];
        echo "Nombre: $nombre<br>";
        echo "Partido: $partido<br>";
        fwrite($fp, "$nombre, $partido\n");
    }
    fclose($fp);
    ?>

    <a href="resultados.php"><button>Ver resultados</button></a>
</body>

</html>
