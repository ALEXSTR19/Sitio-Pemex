
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $correo = filter_var(trim($_POST["correo"]), FILTER_SANITIZE_EMAIL);
    $asunto = strip_tags(trim($_POST["asunto"]));
    $mensaje = trim($_POST["mensaje"]);

    $destinatario = "contacto@axtraltec.com";
    $contenido = "Nombre: $nombre\nCorreo: $correo\nAsunto: $asunto\nMensaje:\n$mensaje";
    $encabezados = "From: $nombre <$correo>";

    if (mail($destinatario, $asunto, $contenido, $encabezados)) {
        echo "<script>alert('Mensaje enviado correctamente');window.history.back();</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje');window.history.back();</script>";
    }
} else {
    http_response_code(403);
    echo "Hubo un problema al procesar el formulario.";
}
?>
