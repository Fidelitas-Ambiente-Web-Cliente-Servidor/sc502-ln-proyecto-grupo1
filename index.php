<?php
session_start();
require_once("config/Database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['option']) && $_POST['option'] == "login") {

        $db = new Database();
        $conn = $db->connect();

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user['username'];
            $_SESSION['rol'] = $user['rol'];

            echo json_encode([
                "response" => "00",
                "rol" => $user['rol']
            ]);

        } else {
            echo json_encode([
                "response" => "01",
                "message" => "Usuario o contraseña incorrectos"
            ]);
        }

        exit();
    }
    if (isset($_POST['option']) && $_POST['option'] == "logout") {
        session_destroy();
        echo json_encode(["response" => "00"]);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AdoptaCR - Gestión de Adopción</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/auth.js"></script>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <img src="./img/logo2.png" width="125"><br>
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="index.php">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="conocenos.php">Conócenos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="php/servicios.php">Servicios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="tramites.php">Trámites</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="faq.php">FAQ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="contacto.php">Contacto</a>
                    </li>

                
                    <?php if(isset($_SESSION['user'])): ?>

                        <li class="nav-item">
                            <span class="nav-link text-white">
                                Hola, <?php echo $_SESSION['user']; ?>
                            </span>
                        </li>

                        <li class="nav-item">
                            <a href="#" id="logoutBtn" class="nav-link nav-link-custom">
                                Cerrar sesión
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="login.php">
                                Login
                            </a>
                        </li>

                    <?php endif; ?>

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
            <p>Proceso Inicial de Adopción</p>
        </section>
    </div>
</section>

<section class="hero">
    <div class="hero-contenido">
        <h2>Construyendo nuevas familias</h2>
        <p>
            Inicia tu proceso de adopción de forma digital, segura y organizada.
        </p>
        <a href="solicitud.php" class="botonS">Iniciar Solicitud</a>
    </div>
</section>

<section class="info">
    <h2>Bienvenido</h2>
    <p>
        Esta plataforma permite a las personas interesadas iniciar 
        el proceso de adopción de manera digital facilitando el 
        registro, validación y seguimiento de solicitudes.
    </p>
</section>

<section class="info-secciones">
    <h2>Información del Proceso</h2>

    <div class="grid-info">

        <div class="card">
            <h3 onclick="toggleSeccion('quienes')">¿Quiénes Somos?</h3>
            <div id="quienes" class="contenido">
                <p>AdoptaCR es un sistema digital orientado a la gestión organizada del proceso de adopción.</p>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('requisitos')">Requisitos Básicos</h3>
            <div id="requisitos" class="contenido">
                <ul>
                    <li>Ser mayor de 25 años.</li>
                    <li>Documentación válida.</li>
                    <li>Estabilidad económica.</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('proceso')">Proceso de Adopción</h3>
            <div id="proceso" class="contenido">
                <ol>
                    <li>Registro</li>
                    <li>Validación</li>
                    <li>Evaluación</li>
                </ol>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('legal')">Marco Legal</h3>
            <div id="legal" class="contenido">
                <p>Regulado por el PANI.</p>
            </div>
        </div>

    </div>
</section>

<section class="valores">
    <h2>Nuestros Principios</h2>

    <div class="valores-grid">
        <div class="valor">
            <h4>Transparencia</h4>
        </div>
        <div class="valor">
            <h4>Responsabilidad</h4>
        </div>
        <div class="valor">
            <h4>Compromiso Social</h4>
        </div>
    </div>
</section>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

<script>
function toggleSeccion(id) {
    var seccion = document.getElementById(id);
    seccion.style.display = (seccion.style.display === "block") ? "none" : "block";
}
</script>

</body>
</html>