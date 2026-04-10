<?php $activePage = 'tramites'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trámites - AdoptaCR</title>

    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/index.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/tramites.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./img/logo2.png" width="125">
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li><a class="nav-link" href="index.php">Inicio</a></li>
                    <li><a class="nav-link" href="conocenos.php">Conócenos</a></li>
                    <li><a class="nav-link" href="servicios.php">Servicios</a></li>
                    <li><a class="nav-link active" href="tramites.php">Trámites</a></li>
                    <li><a class="nav-link" href="faq.php">FAQ</a></li>
                    <li><a class="nav-link" href="contacto.php">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section class="hero">
    <div class="hero-contenido">
        <h2>Gestión de Trámites</h2>
        <p>Inicia, gestiona y da seguimiento a tu proceso de adopción</p>
    </div>
</section>

<section class="info">
    <h2>Centro de Trámites</h2>
    <p>
        Aquí podrás iniciar tu solicitud, adjuntar documentos en formato PDF y consultar el estado del trámite.
        Este proceso está alineado con las regulaciones del Patronato Nacional de la Infancia (PANI).
    </p>
</section>

<section class="tramites-container">

    <div class="grid-tramites">

        <!-- SOLICITUD -->
        <div class="card-tramite">
            <h3>Iniciar Solicitud</h3>
            <p>Completa el formulario inicial para comenzar el proceso.</p>
            <a href="solicitud.php" class="btn-tramite">Ir al formulario</a>
        </div>

        <!-- DOCUMENTOS -->
        <div class="card-tramite">
            <h3>Subir Documentos</h3>
            <p>Adjunta tus documentos requeridos en formato PDF.</p>

            <form>
                <label><strong>Seleccionar archivos (PDF)</strong></label>

                <input type="file" id="files" class="form-control mb-2" multiple accept=".pdf">

                <small class="text-muted">
                    Puedes subir varios archivos: cédula, constancias, certificados, etc.
                </small>

                <div id="file-list" class="mt-2"></div>

                <button type="button" class="btn-tramite mt-2">Subir documentos</button>
            </form>
        </div>

        <!-- ESTADO -->
        <div class="card-tramite">
            <h3>Estado del Trámite</h3>
            <p>Consulta el estado actual de tu solicitud.</p>

            <div class="estado">
                <span class="badge bg-warning">En revisión</span>
            </div>
        </div>

        <!-- PROCESO -->
        <div class="card-tramite">
            <h3> Ver Proceso</h3>
            <p>Consulta las etapas del proceso de adopción.</p>
            <a href="proceso.php" class="btn-tramite">Ver proceso</a>
        </div>

    </div>

</section>

<section class="documentos">
    <h2>Documentos Requeridos</h2>
    <ul>
        <li>Cédula de identidad</li>
        <li>Constancia de ingresos</li>
        <li>Antecedentes penales</li>
        <li>Certificado médico</li>
    </ul>
</section>

<section class="legal">
    <p>
        Este proceso se rige por el Código de Familia de Costa Rica y es supervisado por el 
        Patronato Nacional de la Infancia (PANI), garantizando el interés superior del menor.
    </p>
</section>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

<script>
// Mostrar archivos seleccionados
document.getElementById("files").addEventListener("change", function() {
    let lista = document.getElementById("file-list");
    lista.innerHTML = "";

    for (let i = 0; i < this.files.length; i++) {
        lista.innerHTML += "<p> " + this.files[i].name + "</p>";
    }
});
</script>

</body>
</html>