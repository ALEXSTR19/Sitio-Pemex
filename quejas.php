<?php
session_start();
require_once 'conexion.php';
$captcha_a = rand(1,5);
$captcha_b = rand(1,5);
$_SESSION['captcha_sum'] = $captcha_a + $captcha_b;

$departamentos = $conn ? $conn->query("SELECT id, nombre FROM departamentos ORDER BY nombre") : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Buzón de quejas</title>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
      <h2>Envía tu queja</h2>
      <form class="vacantes-form" action="enviar_queja.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <label for="destino">Dirigido a:</label>
        <select id="destino" name="departamento_id" required>
        <?php if($departamentos): ?>
          <?php while($dep = $departamentos->fetch_assoc()): ?>
            <option value="<?php echo $dep['id']; ?>"><?php echo htmlspecialchars($dep['nombre']); ?></option>
          <?php endwhile; ?>
        <?php endif; ?>
        </select>
        <label for="mensaje">Queja:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
        <label for="captcha">¿Cuánto es <?php echo $captcha_a; ?> + <?php echo $captcha_b; ?>?</label>
        <input type="number" id="captcha" name="captcha" required>
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
