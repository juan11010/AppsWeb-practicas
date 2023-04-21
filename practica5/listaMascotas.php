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
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Edad</th>
            <th>Descripcion</th>
            <th>Adoptado</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
        $sql = "SELECT * FROM animales";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['especie'] . '</td>';
            echo '<td>' . $row['edad'] . '</td>';
            echo '<td>' . $row['descripcion'] . '</td>';
            echo '<td>' . $row['adoptado'] . '</td>';
            echo '<td><a href="editarMascota.php?id=' . $row['id'] . '"><button type="button" class="adopt-button"><i class="fa-solid fa-edit"></i></button></a></td>';
            echo '<td><a href="eliminarMascota.php?id=' . $row['id'] . '"><button type="button" class="adopt-button"><i class="fa-solid fa-trash"></i></button></a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <br><br>
</body>

</html>
