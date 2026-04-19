<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdoptaCR - Panel Administrativo</title>

    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<header>
    <div class="logo">
        <span class="icono">💙</span>
        <section>
            <h1>AdoptaCR</h1>
            <p>Panel Administrativo</p>
        </section>
    </div>

    <div style="position:absolute; top:20px; right:20px;">
        <a href="#" id="logoutBtn" class="btn btn-danger">Cerrar sesión</a>
    </div>
</header>

<section class="hero-admin">
    <div class="hero-admin-contenido">
        <h2>Gestión Administrativa</h2>
        <p>Supervisión y control del proceso inicial de adopción</p>
    </div>
</section>

<section class="admin-bienvenida">
    <h1>Bienvenido, <?php echo $_SESSION['user']; ?> 👋</h1>
</section>

<section class="admin-dashboard">

    <h2>Opciones Administrativas</h2>

    <div class="grid-admin">

        <div class="card">
            <h3>Gestión de Solicitudes</h3>
            <p>Revisar, aprobar o rechazar solicitudes.</p>
            <a href="admin_solicitudes.php" class="btn">Ingresar</a>
        </div>

        <div class="card">
            <h3>Gestión de Usuarios</h3>
            <p>Administrar cuentas del sistema.</p>
            <a href="admin_usuarios.php" class="btn">Ingresar</a>
        </div>

        <div class="card">
            <h3>Contenido Informativo</h3>
            <p>Actualizar requisitos y etapas del proceso.</p>
            <a href="admin_contenido.php" class="btn">Ingresar</a>
        </div>

        <div class="card">
            <h3>Reportes</h3>
            <p>Visualizar estadísticas del sistema.</p>
            <a href="admin_reportes.php" class="btn">Ingresar</a>
        </div>

    </div>

</section>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

<!-- LOGOUT -->
<script>
$("#logoutBtn").click(function(e){
    e.preventDefault();

    $.post("index.php", { option: "logout" }, function(){
        window.location = "login.php";
    });
});
</script>

</body>
</html>