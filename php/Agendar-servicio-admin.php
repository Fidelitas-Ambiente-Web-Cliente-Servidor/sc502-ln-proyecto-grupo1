<?php
session_start();
require_once(__DIR__ . '/../config/database.php');

$database = new Database();
$conn = $database->connect();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);
    $comentario = isset($_GET['comentario']) ? $conn->real_escape_string($_GET['comentario']) : '';
    
    if ($action === 'aprobar') {
        $sql = "UPDATE reservas SET estado = 'aprobada', comentario_admin = '$comentario' WHERE id = $id";
        $conn->query($sql);
    } elseif ($action === 'rechazar') {
        $sql = "UPDATE reservas SET estado = 'rechazada', comentario_admin = '$comentario' WHERE id = $id";
        $conn->query($sql);
    }
    
    header("Location: /sc502-ln-proyecto-grupo1/php/agendar-servicio-admin.php");
    exit();
}

$sql = "SELECT * FROM reservas ORDER BY fecha DESC, hora DESC";
$result = $conn->query($sql);

include_once(__DIR__ . '/../visual/admin-reservas-vista.php');
?>