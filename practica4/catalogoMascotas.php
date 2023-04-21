<!DOCTYPE html>
<html>

<head>
    <title>Pet Catalog</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php
    $conn = new mysqli("localhost", "root", "root", "adopcion_mascotas");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id_persona = $_POST['id_persona'];
    $numMascotas = $_POST['numMascotas'];

    // $sql1 = "INSERT INTO personas (nombre, apellido, correo, numMascotas) VALUES ('$nombre', '$apellido', '$correo', '0')";
    // $conn->query($sql1);

    $sql = "SELECT * FROM animales WHERE adoptado=0";
    $result = $conn->query($sql);

    ?>
    <h2>Bienvenido</h2>
    <h2>Catalogo de Mascotas Disponibles</h2>
    <div class="pet-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
                echo '
                <div class="pet">
                    <img src="img/'.$fila['imagen'].'" alt="mascota">
                    <h3>'.$fila['nombre'].'</h3>
                    <p>Edad: '.$fila['edad'].'</p>
                    <p>Especie: '.$fila['especie'].'</p>
                    <p>Descripcion: '.$fila['descripcion'].'</p>
                    <form action="confirmacion.php" method="post">
                        <input type="hidden" name="id_mascota" value="'.$fila['id'].'">
                        <input type="hidden" name="id_persona" value="'.$id_persona.'">
                        <input type="hidden" name="numMascotas" value="'.$numMascotas.'">
                        <input class="adopt-button" type="submit" value="Adoptar">
                    </form>
                </div>
            ';
            }
        }else {
            echo "<h2>No hay mascotas Disponibles</h2>";
        }
        ?>
    </div>
</body>

</html>
