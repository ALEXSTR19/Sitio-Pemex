<?php
$current_page = basename($_SERVER['PHP_SELF']);
$pages = [
    'index.php' => 'Inicio',
    'historia.php' => 'Historia',
    'mision.php' => 'Misión y Visión',
    'principios.php' => 'Principios',
    'servicios.php' => 'Servicios',
    'transparencia.php' => 'Transparencia',
    'vacantes.php' => 'Vacantes',
    'quejas.php' => 'Buzón de quejas',
    'contacto.php' => 'Contacto'
];

echo '<div class="page-submenu">';
foreach ($pages as $file => $title) {
    if ($file !== $current_page) {
        echo "<a href='$file'>$title</a>";
    }
}
echo '</div>';
?>
