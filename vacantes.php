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

$puesto_solicitud = isset($_GET['puesto']) ? $_GET['puesto'] : '';
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
        <td><a class="btn-vacantes" href="vacantes.php?puesto=<?php echo urlencode($row['puesto']); ?>#form-aplicar">Aplicar</a></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <section id="form-aplicar" class="seccion">
      <h2>Enviar solicitud</h2>
      <form class="vacantes-form" action="enviar_vacantes.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="telefono">Tel&eacute;fono:</label>
        <input type="tel" id="telefono" name="telefono" required>

        <label for="puesto">Puesto de inter&eacute;s:</label>
        <input type="text" id="puesto" name="puesto" required value="<?php echo htmlspecialchars($puesto_solicitud); ?>">

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <label for="cv">Curr&iacute;culum (PDF/DOC):</label>
        <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>

        <button type="submit">Enviar</button>
      </form>
    </section>

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
<div class="footer-link">
  <a href="https://www.google.com.mx/maps/place/XMCQ%2B7VQ,+92773+Barra+Nte" target="_blank" class="texto-link">
    <img src="img/icmapa.png" alt="Dirección" style="height: 24px;">Dirección</a>
</div>
  </footer>
  <script src="js/script.js"></script>
</body>
</html>
