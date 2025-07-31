<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

$edit_vacante = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['accion']) && $_POST['accion'] === 'editar' && isset($_POST['id'], $_POST['puesto'], $_POST['descripcion'])) {
        $id = intval($_POST['id']);
        $puesto = trim($_POST['puesto']);
        $descripcion = trim($_POST['descripcion']);
        $stmt = $conn->prepare('UPDATE vacantes SET puesto=?, descripcion=? WHERE id=?');
        $stmt->bind_param('ssi', $puesto, $descripcion, $id);
        $stmt->execute();
    } elseif(isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare('DELETE FROM vacantes WHERE id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    } elseif(isset($_POST['puesto'], $_POST['descripcion'])) {
        $puesto = trim($_POST['puesto']);
        $descripcion = trim($_POST['descripcion']);
        $stmt = $conn->prepare('INSERT INTO vacantes (puesto, descripcion) VALUES (?, ?)');
        $stmt->bind_param('ss', $puesto, $descripcion);
        $stmt->execute();
    }
}

if(isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $stmt = $conn->prepare('SELECT id, puesto, descripcion FROM vacantes WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit_vacante = $stmt->get_result()->fetch_assoc();
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
            <h3><?php echo $edit_vacante ? 'Editar vacante' : 'Agregar vacante'; ?></h3>
            <form method="POST" action="dashboard.php">
                <?php if($edit_vacante): ?>
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id" value="<?php echo $edit_vacante['id']; ?>">
                <?php endif; ?>
                <label for="puesto_nuevo">Puesto:</label>
                <input type="text" id="puesto_nuevo" name="puesto" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['puesto']) : ''; ?>">
                <label for="descripcion_nueva">Descripci&oacute;n:</label>
                <textarea id="descripcion_nueva" name="descripcion" required><?php echo $edit_vacante ? htmlspecialchars($edit_vacante['descripcion']) : ''; ?></textarea>
                <button type="submit">Guardar</button>
                <?php if($edit_vacante): ?>
                    <a class="btn-vacantes" href="dashboard.php">Cancelar</a>
                <?php endif; ?>
            </form>
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
                        <a class="btn-vacantes" href="dashboard.php?edit_id=<?php echo $row['id']; ?>">Editar</a>
                        <form method="POST" action="dashboard.php" style="display:inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn-vacantes" onclick="return confirm('¿Eliminar vacante?');">Eliminar</button>
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

