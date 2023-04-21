<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro de adopcion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <form action="registroUsuario.php" method="post" class="form-example">
        <h2>Registrate para poder adoptar</h2>
        <label for="name">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="correo">Correo Electronico:</label>
        <input type="text" id="correo" name="correo" required>

        <input type="submit" name="registro" value="Registrarse">
    </form>

    <?php
    $conn = new mysqli("localhost", "root", "root", "adopcion_mascotas");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['registro'])) {
        
        $nombre = $_REQUEST['nombre'];
        $apellido = $_REQUEST['apellido'];
        $correo = $_REQUEST['correo'];
        $sql1 = "INSERT INTO personas (nombre, apellido, correo, numMascotas) VALUES ('$nombre', '$apellido', '$correo', '0')";
        $conn->query($sql1);

        echo '<h2>Registro Exitoso</h2><br><br>';
        echo '<div class="button-container">';
        echo '<a href="index.php"><button type="button" class="adopt-button">Salir</button><a>';
        echo '</div>';
    }

    ?>

</body>

</html>
