<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: cuenta.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'api/db.php';
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if ($password === $row['contrasena']) {
    $_SESSION['usuario'] = $row;
    header('Location: cuenta.php');
    exit;
} else {
    $error = 'Contraseña incorrecta';
}

    } else {
        $error = 'Usuario no encontrado';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - MusicBot</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="chat-container">
    <form class="login-form" method="post">
        <h1>Bienvenido!</h1>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>