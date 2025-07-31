<?php
require_once 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $correo = filter_var(trim($_POST["correo"]), FILTER_SANITIZE_EMAIL);
    $telefono = strip_tags(trim($_POST["telefono"]));
    $puesto = strip_tags(trim($_POST["puesto"]));
    $mensaje = trim($_POST["mensaje"]);
    $vacante_id = isset($_POST['vacante_id']) ? intval($_POST['vacante_id']) : 0;

    $destinatario = "reclutamiento@axtraltec.com";
    $asunto = "Solicitud de empleo";
    $contenido = "Nombre: $nombre\nCorreo: $correo\nTeléfono: $telefono\nPuesto de interés: $puesto\nMensaje:\n$mensaje";
    $encabezados = "From: $nombre <$correo>";

    $stmt = $conn->prepare("INSERT INTO aplicaciones (vacante_id, nombre, correo, telefono, mensaje) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('issss', $vacante_id, $nombre, $correo, $telefono, $mensaje);
    $stmt->execute();

    if (mail($destinatario, $asunto, $contenido, $encabezados)) {
        echo "<script>alert('Informaci\xC3\xB3n enviada correctamente');window.history.back();</script>";
    } else {
        echo "<script>alert('Error al enviar la informaci\xC3\xB3n');window.history.back();</script>";
    }
} else {
    http_response_code(403);
    echo "Hubo un problema al procesar el formulario.";
}
?>

