<?php $activePage = 'conocenos';?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdoptaCR - Conócenos</title>

    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/conocenos.css">
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
                    <li><a class="nav-link" href="php/servicios.php">Servicios</a></li>
                    <li><a class="nav-link" href="tramites.php">Trámites</a></li>
                    <li><a class="nav-link active" href="faq.php">FAQ</a></li>
                    <li><a class="nav-link" href="contacto.php">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<section id="Proceso-adoptarcr">
    <div class="logo">
        <span class="icono">💙</span>
        <section id="Nombre-Agencia">
            <h1>AdoptaCR</h1>
            <p>Conoce nuestra misión y propósito</p>
        </section>
    </div>
</section>

<section class="hero">
    <div class="hero-contenido">
        <h2>Conócenos</h2>
        <p>
            Queremos que nos conozcas para brindarte una atención clara, organizada y accesible.
        </p>
        <a href="contacto.php" class="btn">Contáctanos</a>
    </div>
</section>

<section class="info">
    <h2>¿Quiénes somos?</h2>
    <p>
        AdoptaCR es una plataforma digital desarrollada con el propósito de apoyar la gestión
        inicial del proceso de adopción en Costa Rica. Nuestro objetivo es centralizar la
        información, facilitar la orientación a las personas interesadas y presentar de forma
        estructurada cada etapa del proceso.
    </p>
</section>

<section class="info-secciones">
    <h2>Nuestra Identidad</h2>

    <div class="grid-info">

        <div class="card">
            <h3 onclick="toggleSeccion('mision')">Misión</h3>
            <div id="mision" class="contenido">
                <p>
                    Facilitar el acceso a información clara y organizada sobre el proceso inicial
                    de adopción, promoviendo una experiencia digital sencilla, transparente y útil
                    para las personas interesadas.
                </p>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('vision')">Visión</h3>
            <div id="vision" class="contenido">
                <p>
                    Ser una plataforma de referencia en la orientación digital del proceso de adopción,
                    destacando por su claridad, accesibilidad y enfoque humano.
                </p>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('objetivo')">Nuestro Objetivo</h3>
            <div id="objetivo" class="contenido">
                <p>
                    Brindar a los usuarios un espacio donde puedan informarse, iniciar trámites y
                    comprender mejor cada fase del proceso de adopción de forma ordenada.
                </p>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('compromiso')">Compromiso</h3>
            <div id="compromiso" class="contenido">
                <p>
                    Estamos comprometidos con la transparencia, la responsabilidad social y el respeto
                    por el interés superior de la niñez, promoviendo una gestión informativa seria y accesible.
                </p>
            </div>
        </div>

    </div>
</section>

<section class="valores">
    <h2>Nuestros Valores</h2>

    <div class="valores-grid">
        <div class="valor">
            <h4>Empatía</h4>
            <p>Entendemos la importancia humana y emocional detrás de cada proceso de adopción.</p>
        </div>

        <div class="valor">
            <h4>Transparencia</h4>
            <p>Presentamos la información de forma clara, ordenada y fácil de comprender.</p>
        </div>

        <div class="valor">
            <h4>Responsabilidad</h4>
            <p>Promovemos un manejo serio de cada etapa informativa y administrativa.</p>
        </div>

        <div class="valor">
            <h4>Accesibilidad</h4>
            <p>Buscamos que cualquier persona pueda orientarse fácilmente dentro de la plataforma.</p>
        </div>
    </div>
</section>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

<script>
function toggleSeccion(id) {
    var seccion = document.getElementById(id);

    if (seccion.style.display === "block") {
        seccion.style.display = "none";
    } else {
        seccion.style.display = "block";
    }
}
</script>

</body>
</html>