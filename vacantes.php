<?php
session_start();
require_once "conexion.php";

if($conn && isset($_SESSION['usuario_id']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['puesto'], $_POST['descripcion'])) {
    $puesto = trim($_POST['puesto']);
    $descripcion = trim($_POST['descripcion']);
    $ubicacion = trim($_POST['ubicacion']);
    $sueldo = trim($_POST['sueldo']);
    $horario = trim($_POST['horario']);
    $requisitos = trim($_POST['requisitos']);
    $tipo_contrato = trim($_POST['tipo_contrato']);
    $fecha_publicacion = trim($_POST['fecha_publicacion']);
    $estado = trim($_POST['estado']);
    $stmt = $conn->prepare("INSERT INTO vacantes (puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssssss', $puesto, $descripcion, $ubicacion, $sueldo, $horario, $requisitos, $tipo_contrato, $fecha_publicacion, $estado);
    $stmt->execute();
}

$vacantes = $conn ? $conn->query("SELECT id, puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado FROM vacantes") : false;

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Vacantes</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="vacantes-page">
    <div id="preloader">Cargando sitio...</div>
  <header>
    <div class="logo"><img src="img/logo.png" alt="Pemex" style="height: 66px;"></div>
    <div class="menu-toggle">
      <span></span><span></span><span></span>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
         <li class="dropdown">
      <input type="checkbox" id="submenu-toggle">
      <label for="submenu-toggle" class="menu-parent">Pemex <span class="arrow-icon">▾</span></label>
      <ul class="submenu">
        <li><a href="historia.php">Historia</a></li>
        <li><a href="mision.php">Misión y Visión</a></li>
        <li><a href="principios.php">Principios</a></li>
            </ul>
        </li>
<li><a href="vacantes.php">Vacantes</a></li>
<li><a href="contacto.php">Contacto</a></li>
<?php if(isset($_SESSION["usuario_id"])): ?>
<li><a href="vacantes_internas.php">Vacantes internas</a></li>
<li><a href="logout.php">Cerrar sesión</a></li>
<?php else: ?>
<li class="login-icon"><a href="login.php"><img src="img/login.svg" alt="Iniciar sesión"></a></li>
<?php endif; ?>
      </ul>
    </nav>
  </header>
  <main>
    <h1>Vacantes disponibles</h1>
    <table class="vacantes-table">
      <tr>
        <th>Puesto</th>
        <th>Ubicaci&oacute;n</th>
        <th>Sueldo</th>
        <th>Horario</th>
        <th>Tipo de contrato</th>
        <th>Descripci&oacute;n</th>
        <th></th>
      </tr>
      <?php if($vacantes): while($row = $vacantes->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['puesto']); ?></td>
        <td><?php echo htmlspecialchars($row['ubicacion']); ?></td>
        <td><?php echo htmlspecialchars($row['sueldo']); ?></td>
        <td><?php echo htmlspecialchars($row['horario']); ?></td>
        <td><?php echo htmlspecialchars($row['tipo_contrato']); ?></td>
        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
        <td><a class="btn-vacantes" href="aplicar.php?vacante_id=<?php echo $row['id']; ?>">Aplicar</a></td>
      </tr>
      <?php endwhile; else: ?>
      <tr><td colspan="6">No hay vacantes disponibles.</td></tr>
      <?php endif; ?>
    </table>


<?php if(isset($_SESSION['usuario_id']) && $conn): ?>
<?php $vacantes_admin = $conn->query("SELECT puesto, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado FROM vacantes"); ?>
<section class="seccion">
  <h3>Agregar vacante</h3>
  <form method="POST" action="vacantes.php">
    <label for="puesto_nuevo">Puesto:</label>
    <input type="text" id="puesto_nuevo" name="puesto" required>
    <label for="descripcion_nueva">Descripci&oacute;n:</label>
    <textarea id="descripcion_nueva" name="descripcion" required></textarea>
    <label for="ubicacion">Ubicaci&oacute;n:</label>
    <input type="text" id="ubicacion" name="ubicacion" required>
    <label for="sueldo">Sueldo:</label>
    <input type="text" id="sueldo" name="sueldo" required>
    <label for="horario">Horario:</label>
    <input type="text" id="horario" name="horario" required>
    <label for="requisitos">Requisitos:</label>
    <textarea id="requisitos" name="requisitos" required></textarea>
    <label for="tipo_contrato">Tipo de contrato:</label>
    <input type="text" id="tipo_contrato" name="tipo_contrato" required>
    <label for="fecha_publicacion">Fecha de publicaci&oacute;n:</label>
    <input type="date" id="fecha_publicacion" name="fecha_publicacion" required>
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" required>
    <button type="submit">Guardar</button>
  </form>
</section>
<section class="seccion">
  <h3>Listado de vacantes</h3>
  <table class="vacantes-table">
    <tr>
      <th>Puesto</th>
      <th>Ubicaci&oacute;n</th>
      <th>Sueldo</th>
      <th>Horario</th>
      <th>Tipo de contrato</th>
      <th>Descripci&oacute;n</th>
    </tr>
    <?php while($vacantes_admin && $row = $vacantes_admin->fetch_assoc()): ?>
    <tr>
      <td><?php echo htmlspecialchars($row['puesto']); ?></td>
      <td><?php echo htmlspecialchars($row['ubicacion']); ?></td>
      <td><?php echo htmlspecialchars($row['sueldo']); ?></td>
      <td><?php echo htmlspecialchars($row['horario']); ?></td>
      <td><?php echo htmlspecialchars($row['tipo_contrato']); ?></td>
      <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
    </tr>
    <?php endwhile; ?>
    </table>
</section>
<?php elseif(isset($_SESSION['usuario_id'])): ?>
<p>Error de conexión con la base de datos.</p>
<?php endif; ?>
  </main>
  <footer>
    &copy; 2024 PEMEX
  </footer>
  <script src="js/script.js"></script>
</body>
</html>
