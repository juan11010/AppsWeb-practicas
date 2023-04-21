<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Catalogo Mascotas</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://kit.fontawesome.com/a4c5675b6c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "adopcion_mascotas");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username'];
    $id_persona = $_SESSION['id'];

    // $sql1 = "INSERT INTO personas (nombre, apellido, correo, numMascotas) VALUES ('$nombre', '$apellido', '$correo', '0')";
    // $conn->query($sql1);

    $sql = "SELECT * FROM animales WHERE adoptado=0 AND especie='perro'";
    $result = $conn->query($sql);

    ?>
    <div class="navbar">
        <a href="perros.php" <?php if (basename($_SERVER['PHP_SELF']) == "perros.php") echo "class='active'" ?>><i class="fa-solid fa-dog"></i></a>
        <a href="gatos.php" <?php if (basename($_SERVER['PHP_SELF']) == "gatos.php") echo "class='active'" ?>><i class="fa-solid fa-cat"></i></a>
        <a href="mascotasAdoptadas.php" <?php if (basename($_SERVER['PHP_SELF']) == "mascotasAdoptadas.php") echo "class='active'" ?>>Mascotas Adoptadas</a>
        <a href="logout.php" style="float: right;"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    <h2>Bienvenido <?php echo $username ?></h2>
    <h2>Catalogo de Mascotas Disponibles</h2>
    <div class="pet-container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($fila = mysqli_fetch_assoc($result)) {
                echo '
                <div class="pet">
                    <img src="img/' . $fila['imagen'] . '" alt="mascota">
                    <h3>' . $fila['nombre'] . '</h3>
                    <p>Edad: ' . $fila['edad'] . '</p>
                    <p>Descripcion: ' . $fila['descripcion'] . '</p>
                    <form action="confirmacion.php" method="post">
                        <input type="hidden" name="id_mascota" value="' . $fila['id'] . '">
                        <input type="hidden" name="id_persona" value="' . $id_persona . '">
                        <input class="adopt-button" type="submit" value="Adoptar">
                    </form>
                </div>
            ';
            }
        } else {
            echo "<h2>No hay mascotas Disponibles</h2>";
        }
        ?>
    </div>
</body>

</html>
