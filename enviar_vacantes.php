<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $correo = filter_var(trim($_POST["correo"]), FILTER_SANITIZE_EMAIL);
    $telefono = strip_tags(trim($_POST["telefono"]));
    $puesto = strip_tags(trim($_POST["puesto"]));
    $mensaje = trim($_POST["mensaje"]);

    $cv_path = '';
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $dir = __DIR__ . '/cvs/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $file_name = uniqid() . '_' . basename($_FILES['cv']['name']);
        $file_path = $dir . $file_name;
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $file_path)) {
            $cv_path = $file_path;
        }
    }

    $destinatario = "reclutamiento@axtraltec.com";
    $asunto = "Solicitud de empleo";
    $contenido = "Nombre: $nombre\nCorreo: $correo\nTeléfono: $telefono\nPuesto de interés: $puesto\nMensaje:\n$mensaje";
    if ($cv_path) {
        $contenido .= "\nCV guardado en: $cv_path";
    }
    $encabezados = "From: $nombre <$correo>";

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

