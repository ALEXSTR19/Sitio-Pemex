<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_id'], $_POST['puesto'], $_POST['descripcion'])) {
        $update_id = (int)$_POST['update_id'];
        $puesto = trim($_POST['puesto']);
        $descripcion = trim($_POST['descripcion']);
        $stmt = $conn->prepare('UPDATE vacantes SET puesto = ?, descripcion = ? WHERE id = ?');
        $stmt->bind_param('ssi', $puesto, $descripcion, $update_id);
        $stmt->execute();
    } elseif (isset($_POST['delete_id'])) {
        $delete_id = (int)$_POST['delete_id'];
        $stmt = $conn->prepare('DELETE FROM vacantes WHERE id = ?');
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();
    } elseif (isset($_POST['puesto'], $_POST['descripcion'])) {
        $puesto = trim($_POST['puesto']);
        $descripcion = trim($_POST['descripcion']);
        $stmt = $conn->prepare('INSERT INTO vacantes (puesto, descripcion) VALUES (?, ?)');
        $stmt->bind_param('ss', $puesto, $descripcion);
        $stmt->execute();
    }
}

$vacante_editar = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = $conn->prepare('SELECT id, puesto, descripcion FROM vacantes WHERE id = ?');
    $stmt->bind_param('i', $edit_id);
    $stmt->execute();
    $vacante_editar = $stmt->get_result()->fetch_assoc();
}
$vacantes = $conn->query('SELECT id, puesto, descripcion FROM vacantes');
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
<?php if ($vacante_editar): ?>
            <h3>Editar vacante</h3>
            <form method="POST" action="dashboard.php">
                <input type="hidden" name="update_id" value="<?php echo $vacante_editar['id']; ?>">
                <label for="puesto_nuevo">Puesto:</label>
                <input type="text" id="puesto_nuevo" name="puesto" required value="<?php echo htmlspecialchars($vacante_editar['puesto']); ?>">
                <label for="descripcion_nueva">Descripci&oacute;n:</label>
                <textarea id="descripcion_nueva" name="descripcion" required><?php echo htmlspecialchars($vacante_editar['descripcion']); ?></textarea>
                <button type="submit">Actualizar</button>
                <a href="dashboard.php">Cancelar</a>
            </form>
<?php else: ?>
            <h3>Agregar vacante</h3>
            <form method="POST" action="dashboard.php">
                <label for="puesto_nuevo">Puesto:</label>
                <input type="text" id="puesto_nuevo" name="puesto" required>
                <label for="descripcion_nueva">Descripci&oacute;n:</label>
                <textarea id="descripcion_nueva" name="descripcion" required></textarea>
                <button type="submit">Guardar</button>
            </form>
<?php endif; ?>
        </section>
        <section>
            <h3>Listado de vacantes</h3>
            <table class="vacantes-table">
                <tr><th>Puesto</th><th>Descripci&oacute;n</th><th>Acciones</th></tr>
                <?php while($row = $vacantes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                    <td>
                        <a href="dashboard.php?edit=<?php echo $row['id']; ?>">Editar</a>
                        <form method="POST" action="dashboard.php" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar vacante?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>
    </main>
</div>
</body>
</html>

