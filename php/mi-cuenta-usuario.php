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
    header("Location: mi-cuenta-usuario.php");
    exit();
}

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


if (isset($_GET['logout_usuario'])) {
    unset($_SESSION['email_usuario']);
    header("Location: mi-cuenta-usuario.php");
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