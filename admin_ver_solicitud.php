<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM solicitudes WHERE id = $id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Detalle de Solicitud</title>

<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin.css">

<style>
.contenedor-detalle {
    max-width: 900px;
    margin: 50px auto;
}

.card-detalle {
    background: #ffffff;
    border-radius: 18px;
    padding: 30px;
    box-shadow: 0px 8px 25px rgba(0,0,0,0.08);
}

/* TÍTULO */
.titulo {
    text-align: center;
    margin-bottom: 25px;
}

.titulo h2 {
    margin: 0;
    font-size: 24px;
}

/* GRID BONITO */
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.item {
    background: #f5f7fb;
    padding: 12px 15px;
    border-radius: 10px;
}

.item strong {
    display: block;
    font-size: 13px;
    color: #666;
}

.item span {
    font-size: 15px;
}

/* MOTIVO */
.motivo {
    margin-top: 20px;
    background: #f5f7fb;
    padding: 15px;
    border-radius: 10px;
}

/* ESTADO */
.estado {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 10px;
    margin-top: 10px;
}

.estado.aprobado { background: #c8e6c9; }
.estado.rechazado { background: #ffcdd2; }
.estado.revision { background: #ffe082; }

/* PDF */
.pdf-box {
    margin-top: 20px;
}

.btn-pdf {
    background: #2196F3;
    color: white;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
}

/* VOLVER */
.btn-volver {
    margin-top: 25px;
    display: inline-block;
    background: #607d8b;
    color: white;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
}
</style>

</head>

<body>

<header>
    <div class="logo">
        <span class="icono">💙</span>
        <div>
            <h1>AdoptaCR</h1>
            <p>Detalle de Solicitud</p>
        </div>
    </div>
</header>

<div class="contenedor-detalle">

    <div class="card-detalle">

        <div class="titulo">
            <h2>Información completa del solicitante</h2>
        </div>

        <div class="grid">

            <div class="item">
                <strong>Nombre</strong>
                <span><?= $data['nombre'] ?> <?= $data['apellidos'] ?></span>
            </div>

            <div class="item">
                <strong>Cédula</strong>
                <span><?= $data['cedula'] ?></span>
            </div>

            <div class="item">
                <strong>Edad</strong>
                <span><?= $data['edad'] ?> años</span>
            </div>

            <div class="item">
                <strong>Estado civil</strong>
                <span><?= $data['estado_civil'] ?></span>
            </div>

            <div class="item">
                <strong>Correo</strong>
                <span><?= $data['correo'] ?></span>
            </div>

            <div class="item">
                <strong>Teléfono</strong>
                <span><?= $data['telefono'] ?></span>
            </div>

            <div class="item">
                <strong>Ocupación</strong>
                <span><?= $data['ocupacion'] ?></span>
            </div>

        </div>

        <!-- MOTIVO -->
        <div class="motivo">
            <strong>Motivo de adopción</strong>
            <p><?= $data['motivo'] ?></p>
        </div>

        <!-- ESTADO -->
        <div>
            <strong>Estado:</strong><br>
            <?php
                if ($data['estado'] == "Aprobado") {
                    echo "<span class='estado aprobado'>Aprobado</span>";
                } elseif ($data['estado'] == "Rechazado") {
                    echo "<span class='estado rechazado'>Rechazado</span>";
                } else {
                    echo "<span class='estado revision'>En revisión</span>";
                }
            ?>
        </div>

        
        <div class="pdf-box">
            <strong>Documento:</strong><br><br>
            <?php if (!empty($data['documento'])): ?>
                <a class="btn-pdf" href="<?= $data['documento'] ?>" target="_blank">
                    Ver documento
                </a>
            <?php else: ?>
                No hay documento
            <?php endif; ?>
        </div>

        <a class="btn-volver" href="admin_solicitudes.php">← Volver</a>

    </div>

</div>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>