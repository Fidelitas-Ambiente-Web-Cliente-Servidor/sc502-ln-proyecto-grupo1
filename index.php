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
                <img src="./img/logo2.png" width="125">
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

                    <!-- LOGIN / LOGOUT -->
                    <?php if(isset($_SESSION['user'])): ?>

                        <li class="nav-item">
                            <span class="nav-link text-white">
                                Hola, <?php echo $_SESSION['user']; ?>
                            </span>
                        </li>

                        <li class="nav-item">
                            <button id="logoutBtn" class="btn btn-danger ms-2">
                                Cerrar sesión
                            </button>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a href="login.php" class="nav-link nav-link-custom">
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
        Esta plataforma permite iniciar el proceso de adopción de manera digital.
    </p>
</section>

<section class="info-secciones">
    <h2>Información del Proceso</h2>

    <div class="grid-info">

        <div class="card">
            <h3 onclick="toggleSeccion('quienes')">¿Quiénes Somos?</h3>
            <div id="quienes" class="contenido">
                <p>AdoptaCR gestiona el proceso de adopción.</p>
            </div>
        </div>

        <div class="card">
            <h3 onclick="toggleSeccion('requisitos')">Requisitos Básicos</h3>
            <div id="requisitos" class="contenido">
                <ul>
                    <li>Mayor de 25 años</li>
                    <li>Documentación válida</li>
                </ul>
            </div>
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