<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['puesto'], $_POST['descripcion'])) {
    $puesto = trim($_POST['puesto']);
    $descripcion = trim($_POST['descripcion']);
    $stmt = $conn->prepare("INSERT INTO vacantes (puesto, descripcion) VALUES (?, ?)");
    $stmt->bind_param('ss', $puesto, $descripcion);
    $stmt->execute();
}

$vacantes = $conn->query('SELECT puesto, descripcion FROM vacantes');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="dashboard-page">
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>Admin</h2>
        <ul>
            <li><a href="#vacantes">Vacantes</a></li>
            <li><a href="logout.php">Cerrar sesi&oacute;n</a></li>
        </ul>
    </aside>
    <main class="dashboard-content">
        <h1 id="vacantes">Vacantes</h1>
        <section>
            <h3>Agregar vacante</h3>
            <form method="POST" action="dashboard.php">
                <label for="puesto_nuevo">Puesto:</label>
                <input type="text" id="puesto_nuevo" name="puesto" required>
                <label for="descripcion_nueva">Descripci&oacute;n:</label>
                <textarea id="descripcion_nueva" name="descripcion" required></textarea>
                <button type="submit">Guardar</button>
            </form>
        </section>
        <section>
            <h3>Listado de vacantes</h3>
            <table class="vacantes-table">
                <tr><th>Puesto</th><th>Descripci&oacute;n</th></tr>
                <?php while($row = $vacantes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>
    </main>
</div>
</body>
</html>

