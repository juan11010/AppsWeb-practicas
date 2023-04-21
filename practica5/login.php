<?php
session_start();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials against the database
    $db = mysqli_connect("localhost", "root", "", "adopcion_mascotas");
    $query = "SELECT * FROM personas WHERE nombre='$username' AND password='$password'";
    $result = mysqli_query($db, $query);
    //get the id of the user and store it in a session variables
    $id = mysqli_fetch_assoc($result);
    $id = $id['id'];

    if(mysqli_num_rows($result) == 1) {
        // Set session variables and redirect to home page
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        if($username == "admin") {
            header("location: admin.php");
        } else {
            header("location: perros.php");
        }
    } else {
        echo "Nombre de usuario o contrasena incorrectos";
        echo "<br>";
        echo '<a href="index.php"><button type="button" class="adopt-button">Salir</button><a>';
    }
}
?>

