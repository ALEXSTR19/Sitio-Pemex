<?php
session_start();
require_once "conexion.php";

if(isset($_SESSION['usuario_id']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['puesto'], $_POST['descripcion'])) {
    $puesto = trim($_POST['puesto']);
    $descripcion = trim($_POST['descripcion']);
    $stmt = $conn->prepare("INSERT INTO vacantes (puesto, descripcion) VALUES (?, ?)");
    $stmt->bind_param('ss', $puesto, $descripcion);
    $stmt->execute();
}

$vacantes = $conn->query("SELECT id, puesto, descripcion FROM vacantes");

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
      <tr><th>Puesto</th><th>Descripci&oacute;n</th><th></th></tr>
      <?php while($row = $vacantes->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['puesto']); ?></td>
        <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
        <td><a class="btn-vacantes" href="aplicar.php?puesto=<?php echo urlencode($row['puesto']); ?>">Aplicar</a></td>
      </tr>
      <?php endwhile; ?>
    </table>


<?php if(isset($_SESSION['usuario_id'])): ?>
<?php $vacantes_admin = $conn->query("SELECT puesto, descripcion FROM vacantes"); ?>
<section class="seccion">
  <h3>Agregar vacante</h3>
  <form method="POST" action="vacantes.php">
    <label for="puesto_nuevo">Puesto:</label>
    <input type="text" id="puesto_nuevo" name="puesto" required>
    <label for="descripcion_nueva">Descripci&oacute;n:</label>
    <textarea id="descripcion_nueva" name="descripcion" required></textarea>
    <button type="submit">Guardar</button>
  </form>
</section>
<section class="seccion">
  <h3>Listado de vacantes</h3>
  <table class="vacantes-table">
    <tr><th>Puesto</th><th>Descripci&oacute;n</th></tr>
    <?php while($row = $vacantes_admin->fetch_assoc()): ?>
    <tr>
      <td><?php echo htmlspecialchars($row['puesto']); ?></td>
      <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</section>
<?php endif; ?>
  </main>
  <footer>
    &copy; 2024 PEMEX
  </footer>
  <script src="js/script.js"></script>
</body>
</html>
