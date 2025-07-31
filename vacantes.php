<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Vacantes</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="preloader">Cargando sitio...</div>
    <div class="vacantes-top">
  <a href="vacantes.php" class="btn-vacantes">Vacantes</a>
</div>
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
<li><a href="contacto.php">Contacto</a></li>
<?php if(isset($_SESSION["usuario_id"])): ?>
<li><a href="vacantes_internas.php">Vacantes internas</a></li>
<li><a href="logout.php">Cerrar sesión</a></li>
<?php else: ?>
<li><a href="login.php">Personal</a></li>
<?php endif; ?>
      </ul>
    </nav>
  </header>
  <main>    
  <section class="parallax-vacantes">
  <div class="contenido-parallax">
      <h2>Vacantes</h2>
  </div>
</section>
    
    <section class="seccion">
      <p>Estamos buscando talento. Completa el siguiente formulario y nos pondremos en contacto contigo:</p>

      <form class="vacantes-form" action="enviar_vacantes.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required>

        <label for="puesto">Puesto de interés:</label>
        <input type="text" id="puesto" name="puesto" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <button type="submit">Enviar</button>
      </form>
      <a href="index.php" class="btn-back">Regresar al inicio</a>
    </section>

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