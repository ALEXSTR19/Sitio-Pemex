<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexion.php';

$stmt = $conn->prepare('SELECT puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado FROM vacantes');
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
<?php include 'submenu.php'; ?>
<div class="vacantes-internas">
    <h2>Vacantes internas</h2>
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['rol']); ?>.</p>
    <a href="logout.php">Cerrar sesi&oacute;n</a>
    <table class="vacantes-table">
        <tr>
            <th>Puesto</th>
            <th>Ubicaci&oacute;n</th>
            <th>Sueldo</th>
            <th>Horario</th>
            <th>Tipo de contrato</th>
            <th>Descripci&oacute;n</th>
        </tr>
        <?php while ($vac = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($vac['puesto']); ?></td>
            <td><?php echo htmlspecialchars($vac['ubicacion']); ?></td>
            <td><?php echo htmlspecialchars($vac['sueldo']); ?></td>
            <td><?php echo htmlspecialchars($vac['horario']); ?></td>
            <td><?php echo htmlspecialchars($vac['tipo_contrato']); ?></td>
            <td><?php echo htmlspecialchars($vac['descripcion']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
