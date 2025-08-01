<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

$edit_departamento = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'editar' && isset($_POST['id'], $_POST['nombre'])) {
        $id = intval($_POST['id']);
        $nombre = trim($_POST['nombre']);
        $stmt = $conn->prepare('UPDATE departamentos SET nombre=? WHERE id=?');
        $stmt->bind_param('si', $nombre, $id);
        $stmt->execute();
    } elseif (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare('DELETE FROM quejas WHERE departamento_id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt = $conn->prepare('DELETE FROM departamentos WHERE id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    } elseif (isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']);
        $stmt = $conn->prepare('INSERT INTO departamentos (nombre) VALUES (?)');
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
    }
}

if (isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $stmt = $conn->prepare('SELECT id, nombre FROM departamentos WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit_departamento = $stmt->get_result()->fetch_assoc();
}

$departamentos = $conn->query('SELECT id, nombre FROM departamentos ORDER BY nombre');
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Departamentos</title>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body class='dashboard-page'>
<div class='dashboard-container'>
    <aside class='sidebar'>
        <h2>Admin</h2>
        <ul>
            <li><a href='dashboard.php'>Vacantes</a></li>
            <li><a href='aplicaciones.php'>Aplicaciones</a></li>
            <li><a href='quejas_admin.php'>Quejas</a></li>
            <li><a href='departamentos_admin.php'>Departamentos</a></li>
            <li><a href='logout.php'>Cerrar sesi&oacute;n</a></li>
        </ul>
    </aside>
    <main class='dashboard-content'>
        <h1>Departamentos</h1>
        <section>
            <h3><?php echo $edit_departamento ? 'Editar departamento' : 'Agregar departamento'; ?></h3>
            <form method='POST' action='departamentos_admin.php'>
                <?php if ($edit_departamento): ?>
                    <input type='hidden' name='accion' value='editar'>
                    <input type='hidden' name='id' value='<?php echo $edit_departamento['id']; ?>'>
                <?php endif; ?>
                <label for='nombre'>Nombre:</label>
                <input type='text' id='nombre' name='nombre' required value='<?php echo $edit_departamento ? htmlspecialchars($edit_departamento['nombre']) : ''; ?>'>
                <button type='submit'>Guardar</button>
                <?php if ($edit_departamento): ?>
                    <a class='btn-vacantes' href='departamentos_admin.php'>Cancelar</a>
                <?php endif; ?>
            </form>
        </section>
        <section>
            <h3>Listado de departamentos</h3>
            <table class='vacantes-table'>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($row = $departamentos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td>
                        <a class='btn-vacantes' href='departamentos_admin.php?edit_id=<?php echo $row['id']; ?>'>Editar</a>
                        <form method='POST' action='departamentos_admin.php' style='display:inline;'>
                            <input type='hidden' name='accion' value='eliminar'>
                            <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                            <button type='submit' class='btn-vacantes' onclick='return confirm(&quot;¿Eliminar departamento?&quot;);'>Eliminar</button>
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

