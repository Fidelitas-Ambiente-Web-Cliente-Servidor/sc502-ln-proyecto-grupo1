<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $conn = $database->connect();
    
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $servicio = $conn->real_escape_string($_POST['servicio']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    $hora = $conn->real_escape_string($_POST['hora']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    
    if (strtotime($fecha) < strtotime(date('Y-m-d'))) {
        $_SESSION['error'] = "No se pueden seleccionar fechas pasadas";
        header("Location: servicios.php");
        exit();
    }
    
    // Verificar disponibilidad (máximo 3 reservas por hora)
    $check_sql = "SELECT COUNT(*) as total FROM reservas 
                  WHERE fecha = '$fecha' 
                  AND hora = '$hora' 
                  AND estado != 'rechazada'";
    $result = $conn->query($check_sql);
    $row = $result->fetch_assoc();
    
    if ($row['total'] >= 3) {
        $_SESSION['error'] = "Lo sentimos, ese horario no está disponible. Por favor elige otra fecha u hora.";
        header("Location: servicios.php");
        exit();
    }
    
   
    $sql = "INSERT INTO reservas (nombre_cliente, email_cliente, telefono_cliente, servicio, fecha, hora, comentario) 
            VALUES ('$nombre', '$email', '$telefono', '$servicio', '$fecha', '$hora', '$comentario')";
    
    if ($conn->query($sql)) {
        $_SESSION['success'] = "¡Reserva creada exitosamente! Espera la confirmación del administrador.";
        $to = $email;
        $subject = "Confirmación de Reserva - AdoptaCR";
        $message = "Hola $nombre,\n\nHemos recibido tu solicitud de reserva para el servicio: $servicio\nFecha: $fecha\nHora: $hora\n\nTu reserva está pendiente de aprobación. Te contactaremos pronto.\n\nSaludos,\nEquipo AdoptaCR";
        mail($to, $subject, $message);
    } else {
        $_SESSION['error'] = "Error al crear la reserva: " . $conn->error;
    }
    
    $conn->close();
    header("Location: servicios.php");
    exit();
}
?>