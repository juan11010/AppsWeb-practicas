<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}

$user = $_SESSION['username'];

$host = 'localhost';
$dbname = 'adopcion_mascotas';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
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
        <a href="listaMascotas.php" <?php if (basename($_SERVER['PHP_SELF']) == "listaMascotas.php") echo "class='active'" ?>>Lista de mascotas</a>
        <a href="logout.php" style="float: right;"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    <h2>Bienvenido <?php echo $user; ?></h2>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM animales WHERE id=$id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set the values of the form fields using the data from the database
    $nombre = $row['nombre'];
    $especie = $row['especie'];
    $edad = $row['edad'];
    $descripcion = $row['descripcion'];
    $adoptado = $row['adoptado'];

    ?>
    <form action="editarMascota.php" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <label for="petName">Nombre:</label>
        <input type="text" id="nombreMascota" name="nombreMascota" value="<?php echo $nombre; ?>" required>

        <label for="especie">Especie:</label>
        <select name="especie" id="especie" required>
            <option value="perro" <?php if ($especie === 'perro') echo 'selected'; ?>>Perro</option>
            <option value="gato" <?php if ($especie === 'gato') echo 'selected'; ?>>Gato</option>
        </select>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="<?php echo $edad; ?>" required>

        <label for="des">Descripcion</label>
        <input type="text" id="des" name="des" value="<?php echo $descripcion; ?>" required>

        <input type="submit" name="actualizar" value="Actualizar">
    </form>
    <br><br>
    <?PHP
    if (isset($_POST['actualizar'])) {

        $idMascota = $_REQUEST['id'];
        echo $idMascota;
        $nombreMascota = $_REQUEST['nombreMascota'];
        $especieMascota = $_REQUEST['especie'];
        $edadMascota = $_REQUEST['edad'];
        $des = $_REQUEST['des'];

        $sql = "UPDATE animales SET nombre=?, especie=?, edad=?, descripcion=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$nombreMascota, $especieMascota, $edadMascota, $des, $idMascota]);
    }
    ?>

</body>

</html>
