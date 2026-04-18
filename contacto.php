<?php
$activePage = 'contacto';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdoptaCR - Contacto</title>

    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/index.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/contacto.css">
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
            <p>Estamos para orientarte</p>
        </section>
    </div>
</section>

<section class="hero">
    <div class="hero-contenido">
        <h2>Contáctanos</h2>
        <p>
            Si tienes dudas sobre el proceso, requisitos o pasos iniciales, puedes comunicarte con nosotros por diferentes medios.
        </p>
    </div>
</section>

<section class="contacto-seccion">
    <h2>Medios de contacto</h2>
    <p>
        Contáctanos por cualquiera de los siguientes medios, con gusto te atenderemos.
    </p>

    <div class="contacto-grid">
        <div class="contacto-card">
            <h4>WhatsApp</h4>
            <a href="https://wa.me/50684185416" target="_blank" class="contacto-btn">Abrir WhatsApp</a>
        </div>

        <div class="contacto-card">
            <h4>Correo electrónico</h4>
            <a href="mailto:contacto@adoptacr.com" class="contacto-btn">Enviar correo</a>
        </div>

        <div class="contacto-card">
            <h4>Llamada telefónica</h4>
            <a href="tel:+50622785748" class="contacto-btn">Llamar ahora</a>
        </div>
    </div>
</section>

<section class="mapa-seccion">
    <h2>Nuestra ubicación</h2>
    <p>
        Visítanos, te estamos esperando.
    </p>

    <div class="mapa-contenedor">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.5410472805384!2d-84.10081782430267!3d9.972089273513022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e4cd822df535%3A0xedcce5c7084dd741!2sSanta%20Rosa!5e0!3m2!1ses-419!2scr!4v1776522632390!5m2!1ses-419!2scr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>