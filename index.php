<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Inicio</title>
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
        </ul></li>
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
    <section class="hero">
      <h1>Bienvenido a PEMEX</h1>
      
   <section class="slider">
  <div class="slide-track">
    <img src="img/im1.png" alt="Imagen 1" class="slide">
    <img src="img/im2.png" alt="Imagen 2" class="slide">  
    <img src="img/im3.png" alt="Imagen 3" class="slide">
    <img src="img/im4.png" alt="Imagen 4" class="slide">
    <img src="img/im5.png" alt="Imagen 5" class="slide">
    <img src="img/im6.png" alt="Imagen 6" class="slide">
  </div>
</section>

    <section class="parallax-sobre">
      <div class="contenido-parallax">
        <h2>¿Quiénes Somos?</h2>
        <p>Petróleos Mexicanos es la empresa productiva del Estado dedicada a la exploración,
        producción y distribución de hidrocarburos.</p>
      </div>
    </section>

    <section class="info-pemex">
      <div class="info-container">
        <div class="info-item caida" style="--delay:0s;">
          <h3>Compromiso Ambiental</h3>
          <p>Implementamos procesos sustentables para reducir nuestra huella ecológica.</p>
        </div>
        <div class="info-item caida" style="--delay:0.1s;">
          <h3>Innovación</h3>
          <p>Desarrollamos tecnología de punta para optimizar la producción energética.</p>
        </div>
        <div class="info-item caida" style="--delay:0.2s;">
          <h3>Seguridad</h3>
          <p>Priorizamos la seguridad de nuestros trabajadores y comunidades.</p>
        </div>
      </div>
    </section>
</section>

    <section class="seccion-cuadros">
      <div class="contenedor-cuadros">
  <div class="cuadro">
  <img src="img/ic1.png" alt="En contexto" style="height: 66px;">
  <h3>En contexto</h3>
  <p class="descripcion">
    <a href="docs/contexto.pdf" target="_blank" class="texto-link">Ver documento.</a>
  </p>
</div>

<div class="cuadro">
  <img src="img/ic2.png" alt="Cadena de valor" style="height: 66px;">
  <h3>Cadena de valor</h3>
  <ul class="descripcion">
    <li>Exploración</li>
    <li>Producción</li>
    <li>Transformación Industrial</li>
    <li>Logística</li>
    <li>Comercialización</li>
  </ul>
</div>

    <div class="cuadro">
      <img src="img/ic3.png" alt="Desempeño" style="height: 66px;">
      <h3>Desempeño</h3>
         <p class="descripcion">
             <a href="docs/desemp.pdf" target="_blank" class="texto-link">Ver documento.</a>
</p>
    </div>
    <div class="cuadro">
      <img src="img/ic4.png" alt="Sostenibilidad" style="height: 66px;">
      <h3>Sostenibilidad</h3>
      <p>Se han fortalecido las políticas y prioridades de Petróleos Mexicanos en materia de sostenibilidad, a través de la creación del Comité de Sostenibilidad de PEMEX.</p>
      <p>Se refrenda el compromiso de la institución por impulsar y fortalecer la sostenibilidad y rentabilidad de sus operaciones en beneficio de México.</p>
    </div>
  </div>
</section>
      </main>
  
  <footer>
    &copy; 2024 PEMEX
  </footer>
  <button id="scrollTopBtn" title="Volver arriba">&uarr;</button>
  <script src="js/script.js"></script>
</body>
</html>
