<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Confirmacion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="navbar">
        <a href="perros.php" <?php if (basename($_SERVER['PHP_SELF']) == "catalogoMascotas.php") echo "class='active'" ?>>Perros</a>
        <a href="gatos.php" <?php if (basename($_SERVER['PHP_SELF']) == "perros.php") echo "class='active'" ?>>Gatos</a>
        <a href="mascotasAdoptadas.php" <?php if (basename($_SERVER['PHP_SELF']) == "mascotasAdoptadas.php") echo "class='active'" ?>>Mascotas Adoptadas</a>
        <a href="confirmacion.php" <?php if (basename($_SERVER['PHP_SELF']) == "confirmacion.php") echo "class='active'" ?>>Adoptado</a>
        <a href="logout.php" style="float: right;">Cerrar Sesion</a>
    </div>
    <?php
    $conn = new mysqli("localhost", "root", "root", "adopcion_mascotas");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $mascota_id = $_POST['id_mascota'];
    $id_persona = $_POST['id_persona'];
    
    // if (mysqli_query($conn, $sql1)) {
    //     # code...
    //     $sql4 = "SELECT id FROM personas WHERE nombre='$nombre' AND apellido='$apellido'";
    //     $result = mysqli_query($conn, $sql4);
    //     $row = mysqli_fetch_assoc($result);
    //     $id_adoptante = $row['id'];
    // }

    $fecha_adopcion = date('Y-m-d');
    $sql2 = "INSERT INTO adopciones (id_animal, id_persona, fecha_adopcion) VALUES ('$mascota_id', '$id_persona', '$fecha_adopcion')";
    mysqli_query($conn, $sql2);

    // Actualizar el estado de la mascota a "adoptada"
    $sql3 = "UPDATE animales SET adoptado=1 WHERE id='$mascota_id'";
    mysqli_query($conn, $sql3);

    $sql5 = "SELECT * FROM animales WHERE id='$mascota_id'";
    $result = mysqli_query($conn, $sql5);
    $row = mysqli_fetch_assoc($result);
    $nombre_m = $row['nombre'];
    $edad_m = $row['edad'];
    $especie = $row['especie'];
    $descripcion_m = $row['descripcion'];
    $imagen_m = $row['imagen'];

    echo "
    
    <h2>Gracias por adoptar a " . $nombre_m . "</h2>
    
    ";


    echo '
    <div class="pet">
        <img src="img/' . $imagen_m . '" alt="mascota">
        <h3>' . $nombre_m . '</h3>
        <p>Edad: ' . $edad_m . '</p>
        <p>Especie: ' . $especie . '</p>
        <p>Descripcion: ' . $descripcion_m . '</p>
    </div>
    ';
    ?>
</body>

</html>
