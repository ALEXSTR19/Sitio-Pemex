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
        $ubicacion = trim($_POST['ubicacion']);
        $sueldo = trim($_POST['sueldo']);
        $horario = trim($_POST['horario']);
        $requisitos = trim($_POST['requisitos']);
        $tipo_contrato = trim($_POST['tipo_contrato']);
        $fecha_publicacion = trim($_POST['fecha_publicacion']);
        $estado = trim($_POST['estado']);
        $stmt = $conn->prepare('UPDATE vacantes SET puesto=?, descripcion=?, ubicacion=?, sueldo=?, horario=?, requisitos=?, tipo_contrato=?, fecha_publicacion=?, estado=? WHERE id=?');
        $stmt->bind_param('sssssssssi', $puesto, $descripcion, $ubicacion, $sueldo, $horario, $requisitos, $tipo_contrato, $fecha_publicacion, $estado, $id);
        $stmt->execute();
    } elseif(isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        // Primero elimina posibles aplicaciones ligadas a la vacante para evitar
        // errores por restricciones de clave for\xC3\xA1nea al borrar.
        $stmt = $conn->prepare('DELETE FROM aplicaciones WHERE vacante_id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        // Ahora elimina la vacante solicitada
        $stmt = $conn->prepare('DELETE FROM vacantes WHERE id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    } elseif(isset($_POST['puesto'], $_POST['descripcion'])) {
        $puesto = trim($_POST['puesto']);
        $descripcion = trim($_POST['descripcion']);
        $ubicacion = trim($_POST['ubicacion']);
        $sueldo = trim($_POST['sueldo']);
        $horario = trim($_POST['horario']);
        $requisitos = trim($_POST['requisitos']);
        $tipo_contrato = trim($_POST['tipo_contrato']);
        $fecha_publicacion = trim($_POST['fecha_publicacion']);
        $estado = trim($_POST['estado']);
        $stmt = $conn->prepare('INSERT INTO vacantes (puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssssss', $puesto, $descripcion, $ubicacion, $sueldo, $horario, $requisitos, $tipo_contrato, $fecha_publicacion, $estado);
        $stmt->execute();
    }
}

if(isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $stmt = $conn->prepare('SELECT id, puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado FROM vacantes WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $edit_vacante = $stmt->get_result()->fetch_assoc();
}

$vacantes = $conn->query('SELECT id, puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado FROM vacantes');
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
            <li><a href="aplicaciones.php">Aplicaciones</a></li>
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
                <label for="ubicacion">Ubicaci&oacute;n:</label>
                <input type="text" id="ubicacion" name="ubicacion" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['ubicacion']) : ''; ?>">
                <label for="sueldo">Sueldo:</label>
                <input type="text" id="sueldo" name="sueldo" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['sueldo']) : ''; ?>">
                <label for="horario">Horario:</label>
                <input type="text" id="horario" name="horario" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['horario']) : ''; ?>">
                <label for="requisitos">Requisitos:</label>
                <textarea id="requisitos" name="requisitos" required><?php echo $edit_vacante ? htmlspecialchars($edit_vacante['requisitos']) : ''; ?></textarea>
                <label for="tipo_contrato">Tipo de contrato:</label>
                <input type="text" id="tipo_contrato" name="tipo_contrato" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['tipo_contrato']) : ''; ?>">
                <label for="fecha_publicacion">Fecha de publicaci&oacute;n:</label>
                <input type="date" id="fecha_publicacion" name="fecha_publicacion" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['fecha_publicacion']) : ''; ?>">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" required value="<?php echo $edit_vacante ? htmlspecialchars($edit_vacante['estado']) : ''; ?>">
                <button type="submit">Guardar</button>
                <?php if($edit_vacante): ?>
                    <a class="btn-vacantes" href="dashboard.php">Cancelar</a>
                <?php endif; ?>
            </form>
        </section>
        <section>
            <h3>Listado de vacantes</h3>
            <table class="vacantes-table">
                <tr>
                    <th>Puesto</th>
                    <th>Ubicaci&oacute;n</th>
                    <th>Sueldo</th>
                    <th>Horario</th>
                    <th>Tipo de contrato</th>
                    <th>Descripci&oacute;n</th>
                    <th>Acciones</th>
                </tr>
                <?php while($row = $vacantes->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                    <td><?php echo htmlspecialchars($row['ubicacion']); ?></td>
                    <td><?php echo htmlspecialchars($row['sueldo']); ?></td>
                    <td><?php echo htmlspecialchars($row['horario']); ?></td>
                    <td><?php echo htmlspecialchars($row['tipo_contrato']); ?></td>
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

