<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Contacto</title>
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
    <section class="parallax-contacto">
  <div class="contenido-parallax">
      <h2>Medios de Contacto</h2>
  </div>
</section>      
    
 <section class="seccion contacto-seccion">
  <div class="columna-contacto">
    <h3><img src="img/icono-contacto.png" alt="Contacto" class="icono"> Contacto</h3>
    <p><strong>Superintendente General TASP:</strong> 783 116 4893</p>
    <p><strong>Cap. Roy Abraham del Ángel</strong></p>
    <p><strong>Conmutador:</strong> 783 837 0138</p>
    <p><strong>Aduanas:</strong> 89236706</p>
    <p><strong>TI:</strong> 39229</p>
    <p><strong>Recursos Financieros:</strong> 82139282</p>
    <p><strong>Recursos Humanos:</strong> 82139204</p>
  </div>

<div class="columna-emergencia">
  <h3><img src="img/icono-emergencia.png" alt="Emergencia" class="icono"> Emergencias</h3>
  <p><strong>Contra Incendio:</strong> <span class="numero-rojo">82139111</span></p>
  <p><strong>Servicio Médico:</strong> <span class="numero-rojo">82139395</span></p>
  <p><strong>Fallas T.I.:</strong> <span class="numero-rojo">82149111</span></p>
</div>
</section>

<div class="redes-flotantes">
  <a href="https://www.instagram.com/pemex/" target="_blank"><img src="img/r1.png" alt="IG"></a>
  <a href="https://www.youtube.com/pemex" target="_blank"><img src="img/r2.png" alt="YT"></a>
  <a href="https://www.facebook.com/Pemex/" target="_blank"><img src="img/r3.png" alt="FB"></a>
  <a href="https://x.com/pemex" target="_blank"><img src="img/r4.png" alt="X"></a>
</div>

    <section class="seccion">
    <h3>Ubicación</h3>
<div class="mapa">
      <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.546551196367!2d-97.31284052571222!3d20.97071748977147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d989aebc4ba01d%3A0xb27bff77770ea410!2sXMCQ%2B7VQ%2C%2092773%20Barra%20Nte.%2C%20Ver.!5e0!3m2!1ses-419!2smx!4v1752692378573!5m2!1ses-419!2smx"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
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