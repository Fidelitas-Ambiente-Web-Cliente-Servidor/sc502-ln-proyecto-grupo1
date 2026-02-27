<?php
$mensaje = "";
$claseMensaje = "";

/* variables sin warnings */
$nombre = $_POST["nombre"] ?? "";
$apellidos = $_POST["apellidos"] ?? "";
$cedula = $_POST["cedula"] ?? "";
$edad = $_POST["edad"] ?? "";
$estado = $_POST["estado"] ?? "";
$correo = $_POST["correo"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$ocupacion = $_POST["ocupacion"] ?? "";
$motivo = $_POST["motivo"] ?? "";

/* Validación */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($edad != "" && is_numeric($edad)) {

        if ($edad >= 25) {
            $mensaje = "Solicitud enviada correctamente. Será revisada por el departamento correspondiente.";
            $claseMensaje = "exito";
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

    <h2>Solicitud Inicial de Adopción</h2>

    <form method="post">

        <div class="fila">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre"
                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+" 
                title="Solo se permiten letras"
                required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="apellidos"
                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+" 
                title="Solo se permiten letras"
                required>
            </div>
        </div>

        <div class="fila">
            <div class="form-group">
                <label>Cédula</label>
                <input type="text" name="cedula"
                pattern="[0-9]+" 
                title="Solo números"
                required>
            </div>

            <div class="form-group">
                <label>Edad</label>
                <input type="number" name="edad"
                min="25"
                required>
            </div>
        </div>

        <div class="fila">
            <div class="form-group">
                <label>Estado Civil</label>
                <select name="estado" required>
                    <option value="">Seleccione</option>
                    <option>Soltero(a)</option>
                    <option>Casado(a)</option>
                    <option>Unión libre</option>
                </select>
            </div>

            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo" required>
            </div>
        </div>

        <div class="fila">
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono"
                pattern="[0-9]{8}"
                title="Debe contener 8 dígitos"
                required>
            </div>

            <div class="form-group">
                <label>Ocupación</label>
                <input type="text" name="ocupacion"
                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                title="Solo letras"
                required>
            </div>
        </div>

        <div class="form-group">
            <label>Motivo de adopción</label>
            <textarea name="motivo" required></textarea>
        </div>

        <button type="submit" class="btn">Enviar Solicitud</button>

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