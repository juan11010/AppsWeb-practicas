<!DOCTYPE html>
<html lang="en">

<head>
    <title>Confirmacion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    $conn = new mysqli("localhost", "root", "root", "adopcion_mascotas");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $mascota_id = $_POST['id_mascota'];
    $id_persona = $_POST['id_persona'];
    $numMascotas = $_POST['numMascotas'];
    
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

    $numPet = $numMascotas + 1;
    $sql4 = "UPDATE personas SET numMascotas=". $numPet ." WHERE id='$id_persona'";
    mysqli_query($conn, $sql4);

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
    <a href="index.php"><button type="button" class="adopt-button">Salir</button><a>

</body>

</html>
