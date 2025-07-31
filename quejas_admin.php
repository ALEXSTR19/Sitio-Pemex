<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

$quejas = $conn->query("SELECT id, nombre, correo, destino, mensaje, fecha FROM quejas ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Quejas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dashboard-page">
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="dashboard.php">Vacantes</a></li>
            <li><a href="aplicaciones.php">Aplicaciones</a></li>
            <li><a href="quejas_admin.php">Quejas</a></li>
            <li><a href="logout.php">Cerrar sesi&oacute;n</a></li>
        </ul>
    </aside>
    <main class="dashboard-content">
        <h1>Quejas recibidas</h1>
        <table class="vacantes-table">
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Dirigido a</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
            <?php while($row = $quejas->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                <td><?php echo htmlspecialchars($row['destino']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['mensaje'])); ?></td>
                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</div>
</body>
</html>

