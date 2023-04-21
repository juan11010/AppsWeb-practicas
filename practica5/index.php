<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <form method="post" action="login.php" class="form-example">
        <h2>Login</h2>
        <label>Nombre</label>
        <input type="text" name="username" required>
        <label>password</label>
        <input type="password" name="password" required>
        <input type="submit" name="login" value="Iniciar Sesion">
        <a href="registroUsuario.php"><button type="button" class="adopt-button">Registrarse</button></a>
    </form>
</body>

</html>
