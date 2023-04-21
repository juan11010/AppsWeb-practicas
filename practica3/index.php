<!DOCTYPE html>
<html lang="en">

<head>
    <title>Votaciones</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h2>Votaciones</h2>
    <hr>
    <br><br>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="persona">
            Votantes
            <?php
            $link = mysqli_connect("localhost", "root", "root");
            mysqli_select_db($link, "votaciones");
            $result = mysqli_query($link, "SELECT id, nombre FROM persona");

            echo "<select name='persona'>";
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $nombre = $row['nombre'];
                echo "<option value='$id'>" . $nombre . "</option>";
            }
            mysqli_free_result($result);
            echo "</select>";
            ?>
        </label>
        <br><br>
        <label for="pri">
            <img src="img/pri.png" alt="Logo PRI" height="50">
            <input type="radio" name="partido" value="2" required>
            Partido Revolucionario Institucional
        </label>
        <br><br>
        <label for="pan">
            <img src="img/pan.png" alt="Logo PAN" height="50">
            <input type="radio" name="partido" value="3" required>
            Partido Accion Nacional
        </label>
        <br><br>
        <label for="morena">
            <img src="img/morena.png" alt="Logo MORENA" height="50">
            <input type="radio" name="partido" value="1" required>
            Movimiento de Regeneracion Nacional
        </label>
        <br><br>
        <input type="submit" name="guardar" value="Guardar voto">

    </form>
    <br><br>
    <hr>
    <?php
    if (isset($_POST['guardar'])) {
        $nombreID = $_REQUEST['persona'];
        $partidoID = $_REQUEST['partido'];

        $resultadoNom = mysqli_query($link, "SELECT nombre FROM persona WHERE id=" . $nombreID . "");
        $row = mysqli_fetch_array($resultadoNom);
        $nombre = $row['nombre'];
        mysqli_free_result($resultadoNom);

        $resultadoPar = mysqli_query($link, "SELECT nombre FROM partido WHERE id=" . $partidoID . "");
        $row = mysqli_fetch_array($resultadoPar);
        $partido = $row['nombre'];
        mysqli_free_result($resultadoPar);

        $queryInsertar = "INSERT INTO voto (persona_id, partido_id) VALUES (".$nombreID.", ".$partidoID.")";
        mysqli_query($link, $queryInsertar);

        echo " * Nombre: " . $nombre . "<br><br>";
        echo " * Partido: " . $partido . "<br><br>";

    }
    mysqli_close($link)
    ?>
    <a href="resultados.php">Ver resultados</a>
</body>

</html>
