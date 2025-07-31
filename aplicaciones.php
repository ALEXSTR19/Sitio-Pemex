<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

$applications = $conn->query("SELECT a.id, v.puesto, a.nombre, a.correo, a.telefono, a.mensaje, a.fecha FROM aplicaciones a JOIN vacantes v ON a.vacante_id = v.id ORDER BY a.fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicaciones</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dashboard-page">
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="dashboard.php">Vacantes</a></li>
            <li><a href="aplicaciones.php">Aplicaciones</a></li>
            <li><a href="logout.php">Cerrar sesi&oacute;n</a></li>
        </ul>
    </aside>
    <main class="dashboard-content">
        <h1>Aplicaciones recibidas</h1>
        <table class="vacantes-table">
            <tr>
                <th>Puesto</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tel&eacute;fono</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
            <?php while($row = $applications->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['mensaje'])); ?></td>
                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</div>
</body>
</html>
