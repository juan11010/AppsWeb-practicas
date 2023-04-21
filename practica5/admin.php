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
$password = 'root';

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
        <a href="logout.php" style="float: right;"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    <h2>Bienvenido <?php echo $user; ?></h2>
    <table>
        <tr>
            <th>ID Adopcion</th>
            <th>Nombre Mascota</th>
            <th>Nombre Persona</th>
            <th>Fecha de Adopcion</th>
        </tr>
        <?php
        $sql = "SELECT adopciones.id, animales.nombre AS nombre_mascota, personas.nombre AS nombre_persona, adopciones.fecha_adopcion FROM adopciones JOIN animales ON adopciones.id_animal = animales.id JOIN personas ON adopciones.id_persona = personas.id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['nombre_mascota'] . '</td>';
            echo '<td>' . $row['nombre_persona'] . '</td>';
            echo '<td>' . $row['fecha_adopcion'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <br><br>
    <div class="button-container">
        <a href="generarPDF.php"><button type="button" class="adopt-button"><i class="fa-solid fa-file-pdf fa-2x"></i></button></a>
    </div>

</body>

</html>
