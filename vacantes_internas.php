<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

$stmt = $conn->prepare('SELECT puesto, descripcion FROM vacantes');
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vacantes internas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="vacantes-internas">
    <h2>Vacantes internas</h2>
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['rol']); ?>.</p>
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    <ul>
    <?php while ($vac = $result->fetch_assoc()): ?>
        <li><strong><?php echo htmlspecialchars($vac['puesto']); ?></strong>: <?php echo htmlspecialchars($vac['descripcion']); ?></li>
    <?php endwhile; ?>
    </ul>
</div>
</body>
</html>
