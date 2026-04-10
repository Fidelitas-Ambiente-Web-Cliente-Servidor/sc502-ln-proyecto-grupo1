<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();

$mensaje = "";
$claseMensaje = "";

/* variables */
$nombre = $_POST["nombre"] ?? "";
$apellidos = $_POST["apellidos"] ?? "";
$cedula = $_POST["cedula"] ?? "";
$edad = $_POST["edad"] ?? "";
$estado = $_POST["estado"] ?? "";
$correo = $_POST["correo"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$ocupacion = $_POST["ocupacion"] ?? "";
$motivo = $_POST["motivo"] ?? "";

/* GUARDAR */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($edad != "" && is_numeric($edad)) {

        if ($edad >= 25) {

            
            $rutaDocumento = "";

            if (isset($_FILES["documento"]) && $_FILES["documento"]["error"] == 0) {

                $archivo = $_FILES["documento"]["name"];
                $tmp = $_FILES["documento"]["tmp_name"];

                $rutaDocumento = "uploads/" . time() . "_" . $archivo;

                move_uploaded_file($tmp, $rutaDocumento);
            }

           
            $stmt = $conn->prepare("INSERT INTO solicitudes 
            (nombre, apellidos, cedula, edad, estado_civil, correo, telefono, ocupacion, motivo, documento)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param(
                "sssissssss",
                $nombre,
                $apellidos,
                $cedula,
                $edad,
                $estado,
                $correo,
                $telefono,
                $ocupacion,
                $motivo,
                $rutaDocumento
            );

            if ($stmt->execute()) {
                $mensaje = "Solicitud enviada correctamente. Será revisada por el departamento correspondiente.";
                $claseMensaje = "exito";
            } else {
                $mensaje = "Error al guardar en base de datos.";
                $claseMensaje = "error";
            }

        } else {
            $mensaje = "No cumple con el requisito mínimo de edad (25 años).";
            $claseMensaje = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Adopción</title>
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/solicitud.css">
</head>
<body>

<header>
    <div class="logo">
        <span class="icono">💙</span>
        <div>
            <h1>AdoptaCR</h1>
            <p>Formulario Oficial de Solicitud</p>
        </div>
    </div>
</header>

<main>

<div class="form-container">

    <div class="form-header">
        <h2>Solicitud Inicial de Adopción</h2>
        <p>Complete el siguiente formulario con sus datos personales para iniciar el proceso de adopción.</p>
    </div>

    
    <form method="post" enctype="multipart/form-data">

        <div class="fila">
            <div class="form-group">
                <label>Nombre <span class="requerido">*</span></label>
                <input type="text" name="nombre"
                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+" 
                title="Solo se permiten letras"
                required>
            </div>

            <div class="form-group">
                <label>Apellidos <span class="requerido">*</span></label>
                <input type="text" name="apellidos"
                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+" 
                title="Solo se permiten letras"
                required>
            </div>
        </div>

        <div class="fila">
            <div class="form-group">
                <label>Cédula <span class="requerido">*</span></label>
                <input type="text" name="cedula"
                placeholder="Ingrese tal y como aparece en su cédula"
                pattern="[0-9]+" 
                title="Solo números"
                required>
            </div>

            <div class="form-group">
                <label>Edad <span class="requerido">*</span></label>
                <input type="number" name="edad"
                min="25"
                required>
            </div>
        </div>

        <div class="fila">
            <div class="form-group">
                <label>Estado Civil <span class="requerido">*</span></label>
                <select name="estado" required>
                    <option value="">Seleccione</option>
                    <option>Soltero(a)</option>
                    <option>Casado(a)</option>
                    <option>Unión libre</option>
                </select>
            </div>

            <div class="form-group">
                <label>Correo Electrónico <span class="requerido">*</span></label>
                <input type="email" name="correo" required>
            </div>
        </div>

        <div class="fila">
            <div class="form-group">
                <label>Teléfono <span class="requerido">*</span></label>
                <input type="text" name="telefono"
                placeholder="Ingrese los 8 dígitos de su teléfono"
                pattern="[0-9]{8}"
                title="Debe contener 8 dígitos"
                required>
            </div>

            <div class="form-group">
                <label>Ocupación <span class="requerido">*</span></label>
                <input type="text" name="ocupacion"
                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                title="Solo letras"
                required>
            </div>
        </div>

        <div class="form-group">
            <label>Motivo de adopción <span class="requerido">*</span></label>
            <textarea name="motivo" placeholder="Explique brevemente por qué desea adoptar" required></textarea>
        </div>

        <!-- SUBIR PDF -->
        <div class="form-group">
            <label>Documento (PDF) <span class="requerido">*</span></label>
            <input type="file" name="documento" accept=".pdf" required>
        </div>

        <button type="submit" class="btn btn-full">Enviar Solicitud</button>

    </form>

    <?php if ($mensaje != ""): ?>
        <div class="mensaje <?php echo $claseMensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

</div>

</main>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>