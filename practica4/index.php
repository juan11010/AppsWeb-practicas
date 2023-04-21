<!DOCTYPE html>
<html>

<head>
    <title>Usuarios</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php
    $conn = new mysqli("localhost", "root", "root", "adopcion_mascotas");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM personas";
    $result = $conn->query($sql);

    ?>
    <h2>Usuarios</h2>
    <div class="pet-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
                echo '
                <div class="pet">
                    <img src="img/user.png" alt="Usuario">
                    <h3>' . $fila['nombre'] . ' ' . $fila['apellido'] . '</h3>
                    <p>Correo: ' . $fila['correo'] . '</p>
                    <p>Número de mascotas: ' . $fila['numMascotas'] . '</p>
                    <form action="catalogoMascotas.php" method="post">
                        <input type="hidden" name="id_persona" value="' . $fila['id'] . '">
                        <input type="hidden" name="numMascotas" value="' . $fila['numMascotas'] . '">';
                        if ($fila['numMascotas'] >= 2) {
                            echo '<input class="adopt-button disabled" type="submit" value="Ver catalogo" disabled>';
                        } else {
                            echo '<input class="adopt-button" type="submit" value="Ver catalogo">';
                        }
                echo '</form>
                </div>
            ';
            }
        } else {
            echo "<h2>No hay usuarios Registrados</h2>";
        }
        ?>
    </div>
    <br><br>
    <div class="button-container">
        <a href="registroUsuario.php"><button type="button" class="adopt-button">Registro de nuevo usuario</button></a>&nbsp;&nbsp;&nbsp;
        <a href="generarPDF.php"><button type="button" class="adopt-button">Reporte adopciones</button></a>
    </div>
</body>

</html>
