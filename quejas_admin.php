<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_departamento'])) {
    $nuevo = trim($_POST['nuevo_departamento']);
    if ($nuevo !== '') {
        $stmt = $conn->prepare("INSERT INTO departamentos (nombre) VALUES (?)");
        $stmt->bind_param('s', $nuevo);
        $stmt->execute();
    }
}

$departamentos = $conn->query("SELECT id, nombre FROM departamentos ORDER BY nombre");
$quejas = $conn->query("SELECT q.id, q.nombre, q.correo, d.nombre AS departamento, q.mensaje, q.fecha FROM quejas q JOIN departamentos d ON q.departamento_id = d.id ORDER BY q.fecha DESC");
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
        <h1>Departamentos</h1>
        <form method="POST" class="vacantes-form" style="max-width:300px;margin-bottom:20px;">
            <input type="text" name="nuevo_departamento" placeholder="Nombre del departamento" required>
            <button type="submit">Agregar</button>
        </form>
        <ul>
            <?php while($dep = $departamentos->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($dep['nombre']); ?></li>
            <?php endwhile; ?>
        </ul>

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
                <td><?php echo htmlspecialchars($row['departamento']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($row['mensaje'])); ?></td>
                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</div>
</body>
</html>

