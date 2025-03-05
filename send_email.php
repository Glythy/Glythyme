<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["mensaje"]);

    // Verifica que los campos no estén vacíos
    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        // Dirección de correo electrónico del destinatario
        $recipient = "githubtomas@gmail.com"; // Dirección de correo electrónico especificada por el usuario

        // Asunto del correo electrónico
        $subject = "Nuevo mensaje de contacto de $nombre";

        // Contenido del correo electrónico
        $email_content = "Nombre: $nombre\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Mensaje:\n$mensaje\n";

        // Encabezados del correo electrónico
        $email_headers = "From: $nombre <$email>";

        // Envía el correo electrónico
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            echo "Gracias! Tu mensaje ha sido enviado.";
        } else {
            http_response_code(500);
            echo "Oops! Algo salió mal y no pudimos enviar tu mensaje.";
        }
    } else {
        // Código de respuesta 400 - Solicitud incorrecta
        http_response_code(400);
        echo "Por favor completa todos los campos del formulario.";
    }
} else {
    // Código de respuesta 403 - Prohibido
    http_response_code(403);
    echo "Hubo un problema con tu envío, intenta de nuevo.";
}
?>
