<?php
session_start();
require_once 'conexion.php';
$vacante_id = isset($_GET['vacante_id']) ? intval($_GET['vacante_id']) : 0;
$puesto_solicitud = '';
if ($vacante_id > 0) {
    $stmt = $conn->prepare('SELECT puesto FROM vacantes WHERE id = ?');
    $stmt->bind_param('i', $vacante_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $puesto_solicitud = $row['puesto'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Aplicar</title>
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
            <li><a href="servicios.php">Servicios</a></li>
            <li><a href="transparencia.php">Transparencia</a></li>
          </ul>
        </li>
        <li><a href="vacantes.php">Vacantes</a></li>
        <li><a href="quejas.php">Buzón de quejas</a></li>
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
    <?php include 'submenu.php'; ?>
    <section class="seccion">
      <h2>Enviar solicitud</h2>
      <form class="vacantes-form" action="enviar_vacantes.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="vacante_id" value="<?php echo $vacante_id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="telefono">Tel&eacute;fono:</label>
        <input type="tel" id="telefono" name="telefono" required>

        <label for="puesto">Puesto de inter&eacute;s:</label>
        <input type="text" id="puesto" name="puesto" required
               value="<?php echo htmlspecialchars($puesto_solicitud); ?>" readonly>

        <label for="curriculum">Curr&iacute;culum (PDF o DOC):</label>
        <input type="file" id="curriculum" name="curriculum" accept=".pdf,.doc,.docx" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <button type="submit">Enviar</button>
      </form>
    </section>
  </main>
  <footer>
    &copy; 2024 PEMEX
  </footer>
  <script src="js/script.js"></script>
</body>
</html>
