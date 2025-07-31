<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Transparencia</title>
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
    <section class="parallax-historia">
      <div class="contenido-parallax">
        <h2>Transparencia</h2>
      </div>
    </section>
    <section class="historia-contenido">
      <div class="historia-imagen">
        <img src="img/ic4.png" alt="Transparencia">
      </div>
      <div class="historia-texto">
        <p>En Pemex estamos comprometidos con la rendición de cuentas y la disponibilidad de información pública.</p>
        <p>Consulta reportes financieros, auditorías y normativa vigente en nuestro portal de transparencia.</p>
      </div>
    </section>
  </main>
  <footer>
    &copy; 2024 PEMEX
  </footer>
  <script src="js/script.js"></script>
</body>
</html>
