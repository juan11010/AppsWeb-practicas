<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$username = $_SESSION['username'];

$conn = new mysqli("localhost", "root", "", "adopcion_mascotas");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a4c5675b6c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="navbar">
        <a href="admin.php" <?php if (basename($_SERVER['PHP_SELF']) == "admin.php") echo "class='active'" ?>><i class="fa-solid fa-file"></i></a>
        <a href="agregarMascota.php" <?php if (basename($_SERVER['PHP_SELF']) == "agregarMascota.php") echo "class='active'" ?>><i class="fa-solid fa-paw"></i></a>
        <a href="logout.php" style="float: right;"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    <h2>Bienvenido <?php echo $username; ?></h2>
    <form action="agregarMascota.php" method="post" enctype="multipart/form-data" class="form-example">
        <h2>Agregar nueva mascota</h2>
        <label for="petName">Nombre:</label>
        <input type="text" id="nombreMascota" name="nombreMascota" required>

        <label for="especie">Especie:</label>
        <select name="especie" id="especie">
            <option value="perro">Perro</option>
            <option value="gato">Gato</option>
        </select>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>

        <label for="des">Descripcion</label>
        <input type="text" id="des" name="des" required>

        <label for="imagen">Imagen: </label>
        <input type="file" id="imagen" name="imagen" required>

        <input type="submit" name="agregar" value="Agregar">
    </form>

    <?PHP
    if (isset($_POST['agregar'])) {
        $nombreMascota = $_REQUEST['nombreMascota'];
        $especie = $_REQUEST['especie'];
        $edad = $_REQUEST['edad'];
        $des = $_REQUEST['des'];
        $imagen = $_FILES['imagen']['name'];
        $ruta = $_FILES['imagen']['tmp_name'];

        //check if the file is an image
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check === false) {
           echo "El archivo no es una imagen.";
           exit();
        }

        $destino = "img/" . $imagen;
        copy($ruta, $destino);

        $sql = "INSERT INTO animales (nombre, especie, edad, descripcion, adoptado, imagen) VALUES ('$nombreMascota', '$especie', '$edad', '$des', '0', '$imagen')";

        if ($conn->query($sql) === TRUE) {
            echo '<h2>Se agrego la mascota</h2><br><br>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>

</html>
