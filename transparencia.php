<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PEMEX | Ética y Transparencia</title>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="preloader">Cargando sitio...</div>
  <header>
    <div class="logo"><img src="img/logo.png" alt="Pemex" style="height: 66px;"></div>
    <div class="menu-toggle"><span></span><span></span><span></span></div>
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
    <section class="parallax-historia">
      <div class="contenido-parallax">
        <h2>Ética, Transparencia y Datos Personales</h2>
      </div>
    </section>

    <section class="historia-contenido">
      <div class="historia-imagen">
        <img src="img/ic4.png" alt="Ética y Transparencia">
      </div>
      <div class="historia-texto">
        <p style="font-size: 18px; line-height: 1.6;">
          En Petróleos Mexicanos operamos y promovemos los valores de la <strong>ética institucional</strong> entre nuestro personal, incluyendo clientes, socios, proveedores, contratistas y sociedad en general. Esto para beneficio de Pemex y de México.
        </p>
        <p style="font-size: 18px; line-height: 1.6;">
          Consideramos a la <strong>transparencia</strong> como nuestro marco de referencia para dar a conocer los resultados de nuestras actividades de manera clara, puntual y accesible.
        </p>
        <p style="font-size: 18px; line-height: 1.6;">
          La <strong>protección de datos personales</strong> es un principio fundamental para garantizar que la información de las personas sea manejada con responsabilidad, protección y respeto a los derechos humanos.
        </p>
      </div>
    </section>
  </main>

  <footer>
    &copy; 2024 PEMEX
  </footer>

  <script src="js/script.js"></script>
</body>
</html>
