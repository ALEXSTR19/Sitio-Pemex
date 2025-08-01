<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = strip_tags(trim($_POST['nombre']));
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $departamento_id = intval($_POST['departamento_id']);
    $mensaje = trim($_POST['mensaje']);
    $captcha = intval($_POST['captcha']);

    if (!isset($_SESSION['captcha_sum']) || $captcha !== $_SESSION['captcha_sum']) {
        echo "<script>alert('Captcha incorrecto');window.history.back();</script>";
        exit();
    }

    if ($conn) {
        $stmt = $conn->prepare("INSERT INTO quejas (nombre, correo, departamento_id, mensaje) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssis', $nombre, $correo, $departamento_id, $mensaje);
        $stmt->execute();
    }
    echo "<script>alert('Queja enviada correctamente');window.location.href='index.php';</script>";
} else {
    http_response_code(403);
    echo 'Hubo un problema al procesar el formulario.';
}
?>
