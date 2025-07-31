<?php
session_start();
require_once 'conexion.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare('SELECT id, password, rol FROM usuarios WHERE usuario = ?');
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($contrasena, $row['password'])) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['rol'] = $row['rol'];
            header('Location: vacantes_internas.php');
            exit();
        }
    }
    $error = 'Credenciales incorrectas';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesi&oacute;n</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-container">
    <h2>Iniciar sesi&oacute;n</h2>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <label for="contrasena">Contrase&ntilde;a:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <button type="submit">Ingresar</button>
    </form>
    <a href="index.php" class="btn-back">Regresar al inicio</a>
</div>
</body>
</html>
