<?php
session_start();
require_once(__DIR__ . '/../config/database.php');

$email_busqueda = '';
$reservas = [];
$mostrar_resultados = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar_email'])) {
    $email_busqueda = trim($_POST['email']);
    
    if (!empty($email_busqueda) && filter_var($email_busqueda, FILTER_VALIDATE_EMAIL)) {
        $database = new Database();
        $conn = $database->connect();
        $email_clean = $conn->real_escape_string($email_busqueda);
        
        $sql = "SELECT * FROM reservas WHERE email_cliente = '$email_clean' ORDER BY fecha DESC, hora DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reservas[] = $row;
            }
            $_SESSION['email_usuario'] = $email_busqueda;
            $mostrar_resultados = true;
        } else {
            $_SESSION['mensaje_usuario'] = "No se encontraron solicitudes para este correo";
            $_SESSION['tipo_mensaje'] = "warning";
        }
        $conn->close();
    } else {
        $_SESSION['mensaje_usuario'] = "Por favor ingrese un correo válido";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    header("Location: mi-cuenta-vista-servicios.php");
    exit();
}

// Si ya hay sesión con email, mostrar resultados
if (isset($_SESSION['email_usuario']) && !$mostrar_resultados && empty($reservas)) {
    $email_busqueda = $_SESSION['email_usuario'];
    $database = new Database();
    $conn = $database->connect();
    $email_clean = $conn->real_escape_string($email_busqueda);
    
    $sql = "SELECT * FROM reservas WHERE email_cliente = '$email_clean' ORDER BY fecha DESC, hora DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reservas[] = $row;
        }
        $mostrar_resultados = true;
    }
    $conn->close();
}

// Cerrar sesión del usuario
if (isset($_GET['logout_usuario'])) {
    unset($_SESSION['email_usuario']);
    header("Location: mi-cuenta-vista-servicios.php");
    exit();
}

function getEstadoTexto($estado) {
    $estados = [
        'pendiente' => 'Pendiente',
        'aprobada' => 'Aprobada',
        'rechazada' => 'Rechazada'
    ];
    return $estados[$estado] ?? $estado;
}

function getEstadoClase($estado) {
    return "estado-$estado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta - AdoptaCR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/servicios/mi-cuenta.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2E86C1;">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../img/logo2.png" width="125" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../servicios.php">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../tramites.php">Trámites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="mi-cuenta-vista-servicios.php">Mi Cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<section class="header-cuenta">
    <div class="container">
        <h1>Mi Cuenta</h1>
        <p>Consulta el estado de tus servicios</p>
    </div>
</section>

<div class="container mb-5">
    <?php if (isset($_SESSION['mensaje_usuario'])): ?>
        <div class="alert alert-<?php echo $_SESSION['tipo_mensaje']; ?> alert-dismissible fade show" role="alert">
            <?php 
                echo $_SESSION['mensaje_usuario'];
                unset($_SESSION['mensaje_usuario']);
                unset($_SESSION['tipo_mensaje']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['email_usuario']) && !$mostrar_resultados): ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">Bienvenido a tu espacio personal</h3>
                        <p class="card-text mb-4">Ingresa tu correo electrónico para ver todas tus servicios.</p>
                        
                        <form method="POST" action="mi-cuenta-vista-servicios.php">
                            <div class="mb-3">
                                <input type="email" class="form-control form-control-lg" 
                                       name="email" placeholder="tu@email.com" required>
                            </div>
                            <button type="submit" name="buscar_email" class="btn-buscar w-100">   
                                Ver mis solicitudes
                            </button>
                        </form>
                        
                        <hr class="my-4">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box text-start">
                                    <strong>¿Qué puedes hacer?</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Ver estado de tus reservas</li>
                                        <li>Consultar respuestas del admin</li>
                                        <li>Historial de servicios</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box text-start">
                                    <strong>Información importante</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Usa el mismo correo de la reserva</li>
                                        <li>Las reservas se actualizan en 48h</li>
                                        <li>Recibirás notificaciones por email</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card card-resumen">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-2">Bienvenido a tu panel personal</h4>
                                <p class="mb-0">Correo: <strong><?php echo htmlspecialchars($email_busqueda); ?></strong></p>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    Total solicitudes: <?php echo count($reservas); ?>
                                </span>
                                <a href="?logout_usuario=1" class="btn-cerrar-sesion">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-tabs-custom mb-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="solicitudes-tab" data-bs-toggle="tab" 
                        data-bs-target="#solicitudes" type="button" role="tab">
                    Todas mis solicitudes
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pendientes-tab" data-bs-toggle="tab" 
                        data-bs-target="#pendientes" type="button" role="tab">
                    Pendientes
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="aprobadas-tab" data-bs-toggle="tab" 
                        data-bs-target="#aprobadas" type="button" role="tab">
                    Aprobadas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rechazadas-tab" data-bs-toggle="tab" 
                        data-bs-target="#rechazadas" type="button" role="tab">
                    Rechazadas
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
           
        <div class="tab-pane fade show active" id="solicitudes" role="tabpanel">
                <?php if (empty($reservas)): ?>
                    <div class="alert alert-info">No tienes solicitudes registradas</div>
                <?php else: ?>
                    <?php foreach ($reservas as $reserva): ?>
                        <div class="card card-solicitud">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5><?php echo htmlspecialchars($reserva['servicio']); ?></h5>
                                        <p class="mb-1">
                                            <strong>Fecha solicitada:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha'])); ?><br>
                                            <strong>Hora:</strong> <?php echo $reserva['hora']; ?><br>
                                            <strong>Fecha de solicitud:</strong> <?php echo date('d/m/Y H:i', strtotime($reserva['fecha_solicitud'])); ?>
                                        </p>
                                        
                                        <?php if (!empty($reserva['comentario'])): ?>
                                            <div class="info-box mt-2">
                                                <strong>Tu comentario:</strong><br>
                                                <?php echo nl2br(htmlspecialchars($reserva['comentario'])); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($reserva['comentario_admin'])): ?>
                                            <div class="info-box mt-2" style="border-left-color: #28a745;">
                                                <strong>Respuesta del administrador:</strong><br>
                                                <?php echo nl2br(htmlspecialchars($reserva['comentario_admin'])); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="estado-badge <?php echo getEstadoClase($reserva['estado']); ?>">
                                            <?php echo getEstadoTexto($reserva['estado']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

      
            <div class="tab-pane fade" id="pendientes" role="tabpanel">
                <?php 
                $pendientes = array_filter($reservas, function($r) { return $r['estado'] == 'pendiente'; });
                if (empty($pendientes)): ?>
                    <div class="alert alert-success">No tienes solicitudes pendientes</div>
                <?php else: ?>
                    <?php foreach ($pendientes as $reserva): ?>
                        <div class="card card-solicitud">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5><?php echo htmlspecialchars($reserva['servicio']); ?></h5>
                                        <p class="mb-1">
                                            <strong>Fecha solicitada:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha'])); ?><br>
                                            <strong>Hora:</strong> <?php echo $reserva['hora']; ?>
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="estado-badge estado-pendiente">Pendiente</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="aprobadas" role="tabpanel">
                <?php 
                $aprobadas = array_filter($reservas, function($r) { return $r['estado'] == 'aprobada'; });
                if (empty($aprobadas)): ?>
                    <div class="alert alert-info">No tienes solicitudes aprobadas</div>
                <?php else: ?>
                    <?php foreach ($aprobadas as $reserva): ?>
                        <div class="card card-solicitud">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5><?php echo htmlspecialchars($reserva['servicio']); ?></h5>
                                        <p class="mb-1">
                                            <strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha'])); ?><br>
                                            <strong>Hora:</strong> <?php echo $reserva['hora']; ?>
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="estado-badge estado-aprobada">Aprobada</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="tab-pane fade" id="rechazadas" role="tabpanel">
                <?php 
                $rechazadas = array_filter($reservas, function($r) { return $r['estado'] == 'rechazada'; });
                if (empty($rechazadas)): ?>
                    <div class="alert alert-info">No tienes solicitudes rechazadas</div>
                <?php else: ?>
                    <?php foreach ($rechazadas as $reserva): ?>
                        <div class="card card-solicitud">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5><?php echo htmlspecialchars($reserva['servicio']); ?></h5>
                                        <p class="mb-1">
                                            <strong>Fecha solicitada:</strong> <?php echo date('d/m/Y', strtotime($reserva['fecha'])); ?><br>
                                            <strong>Hora:</strong> <?php echo $reserva['hora']; ?>
                                        </p>
                                        <?php if (!empty($reserva['comentario_admin'])): ?>
                                            <div class="info-box mt-2" style="border-left-color: #dc3545;">
                                                <strong>Motivo del rechazo:</strong><br>
                                                <?php echo nl2br(htmlspecialchars($reserva['comentario_admin'])); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="estado-badge estado-rechazada">Rechazada</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

       
        <div class="row mt-4">
            <div class="col text-center">
                <a href="../php/servicios.php" class="btn btn-nuevo-servicio">
                    Solicitar nuevo servicio
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>


<footer class="text-center py-4" style="background-color: #2E86C1; color: white; margin-top: 50px;">
    <p class="mb-0">Ama a un ángel | @AdoptaCR</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>