<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Principios</title>
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
           <section class="parallax-principios">
  <div class="contenido-parallax">
      <h2>Principios Éticos de Pemex</h2>
  </div>
</section>
    
<section class="seccion">
  <div class="principios-dosc">
    <p class="intro">
      La compañía ha definido 9 principios que le ayudan a cumplir su misión y que se reflejan en su forma de actuar diariamente. Conócelos a continuación:
    </p>

    <div class="columnas">
      <ul>
        <li class="caida" style="--delay: 0s;"><strong>Respeto: </strong>Reconocer el valor e importancia de cada miembro, sus derechos y obligaciones.</li>
        <li class="caida" style="--delay: 0.1s;"><strong>Igualdad y no discriminación: </strong>Trato igualitario sin exclusión ni distinción.</li>
        <li class="caida" style="--delay: 0.2s;"><strong>Efectividad: </strong>Uso óptimo de recursos para lograr objetivos y fortalecer procesos.</li>
        <li class="caida" style="--delay: 0.3s;"><strong>Honradez: </strong>Actuar con justicia, verdad y equidad priorizando el bienestar general.</li>
        <li class="caida" style="--delay: 0.4s;"><strong>Lealtad: </strong>Orgullo y compromiso con la empresa.</li>
      </ul>

      <ul>
        <li class="caida" style="--delay: 0.5s;"><strong>Responsabilidad: </strong>Tomar decisiones conscientes y asumir consecuencias.</li>
        <li class="caida" style="--delay: 0.6s;"><strong>Legalidad: </strong>Cumplir con leyes y normas que rigen la empresa.</li>
        <li class="caida" style="--delay: 0.7s;"><strong>Imparcialidad: </strong>Actuar con objetividad y sin preferencias.</li>
        <li class="caida" style="--delay: 0.8s;"><strong>Integridad: </strong>Apego a valores éticos que generan confianza y previenen la corrupción.</li>
      </ul>
    </div>
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