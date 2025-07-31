<?php
require_once 'conexion.php';

$sql = "SELECT titulo, descripcion, ubicacion, sueldo, horario, requisitos, tipo_contrato, fecha_publicacion, estado FROM vacantes ORDER BY fecha_publicacion DESC";
$result = $conn->query($sql);
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
      <h3>Oportunidades laborales</h3>
<?php if ($result && $result->num_rows > 0): ?>
      <div class="tabla-container">
        <table class="vacantes-tabla">
          <thead>
            <tr>
              <th>Título</th>
              <th>Descripción</th>
              <th>Ubicación</th>
              <th>Sueldo</th>
              <th>Horario</th>
              <th>Requisitos</th>
              <th>Tipo de contrato</th>
              <th>Fecha de publicación</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
<?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['titulo']) ?></td>
              <td><?= nl2br(htmlspecialchars($row['descripcion'])) ?></td>
              <td><?= htmlspecialchars($row['ubicacion']) ?></td>
              <td><?= htmlspecialchars($row['sueldo']) ?></td>
              <td><?= htmlspecialchars($row['horario']) ?></td>
              <td><?= nl2br(htmlspecialchars($row['requisitos'])) ?></td>
              <td><?= htmlspecialchars($row['tipo_contrato']) ?></td>
              <td><?= htmlspecialchars($row['fecha_publicacion']) ?></td>
              <td><?= ($row['estado'] ? 'Activo' : 'Inactivo') ?></td>
            </tr>
<?php endwhile; ?>
          </tbody>
        </table>
      </div>
<?php else: ?>
      <p>No hay vacantes disponibles en este momento.</p>
<?php endif; ?>
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
