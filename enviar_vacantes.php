<?php
require_once 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $correo = filter_var(trim($_POST["correo"]), FILTER_SANITIZE_EMAIL);
    $telefono = strip_tags(trim($_POST["telefono"]));
    $puesto = strip_tags(trim($_POST["puesto"]));
    $mensaje = trim($_POST["mensaje"]);

    $curriculum_path = null;
    if (isset($_FILES['curriculum']) && $_FILES['curriculum']['error'] === UPLOAD_ERR_OK) {
        $targetDir = __DIR__ . '/uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $fileName = uniqid('', true) . '-' . basename($_FILES['curriculum']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['curriculum']['tmp_name'], $targetFile)) {
            $curriculum_path = 'uploads/' . $fileName;
        }
    }
    $vacante_id = isset($_POST['vacante_id']) ? intval($_POST['vacante_id']) : 0;

    $destinatario = "reclutamiento@axtraltec.com";
    $asunto = "Solicitud de empleo";
    $contenido = "Nombre: $nombre\nCorreo: $correo\nTeléfono: $telefono\nPuesto de interés: $puesto\nMensaje:\n$mensaje";
    if ($curriculum_path) {
        $contenido .= "\nCurrículum: $curriculum_path";
    }
    $encabezados = "From: $nombre <$correo>";

    $stmt = $conn->prepare("INSERT INTO aplicaciones (vacante_id, nombre, correo, telefono, curriculum, mensaje) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssss', $vacante_id, $nombre, $correo, $telefono, $curriculum_path, $mensaje);
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

