<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Historia</title>
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
      <section class="parallax-historia">
  <div class="contenido-parallax">
      <h2>Historia de Pemex</h2>
  </div>
</section>

 <section class="historia-contenido">
      <div class="historia-imagen">
        <img src="img/history.png" alt="Historia de la empresa">
      </div>
      <div class="historia-texto">    
    <p>Pemex es la empresa más grande de México, una empresa estatal productora, transportista, refinadora y comercializadora de gas natural y petróleo de la nación, creada el 7 de Junio de 1938 por el ex Presidente Lazaro Cárdenas del Río a partir de un Decreto del Congreso de la Unión.</p>
    <p>Durante los primeros años se dieron varios conflictos entre Pemex y sus trabajadores, había desacuerdos respecto a los derechos de los empleados y riesgo de huelga, sin embargo en 1942 se firmó el primer contrato colectivo de trabajo con cláusulas que contemplaba dar a los trabajadores el derecho a prestaciones en caso de accidentes, muerte, jubilación y servicios médicos.</p>
          </div>
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