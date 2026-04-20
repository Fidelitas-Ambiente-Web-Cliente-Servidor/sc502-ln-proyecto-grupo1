<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();


$desde = $_GET['desde'] ?? '';
$hasta = $_GET['hasta'] ?? '';

$whereFecha = "";

if ($desde && $hasta) {
    $whereFecha = "WHERE DATE(fecha) BETWEEN '$desde' AND '$hasta'";
}


$total = $conn->query("SELECT COUNT(*) as t FROM solicitudes $whereFecha")->fetch_assoc()['t'];

$aprobadas = $conn->query("SELECT COUNT(*) as t FROM solicitudes 
    WHERE estado='Aprobado' " . ($whereFecha ? "AND DATE(fecha) BETWEEN '$desde' AND '$hasta'" : "")
)->fetch_assoc()['t'];

$rechazadas = $conn->query("SELECT COUNT(*) as t FROM solicitudes 
    WHERE estado='Rechazado' " . ($whereFecha ? "AND DATE(fecha) BETWEEN '$desde' AND '$hasta'" : "")
)->fetch_assoc()['t'];

$revision = $conn->query("SELECT COUNT(*) as t FROM solicitudes 
    WHERE estado='En revisión' " . ($whereFecha ? "AND DATE(fecha) BETWEEN '$desde' AND '$hasta'" : "")
)->fetch_assoc()['t'];


$porcA = $total ? ($aprobadas/$total)*100 : 0;
$porcR = $total ? ($rechazadas/$total)*100 : 0;
$porcE = $total ? ($revision/$total)*100 : 0;
?>

<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
                <title>Reportes</title>

                    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
                    <link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin_reportes.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="./css/Servicios/admin-reservas.css">
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
        <a href="./admin.php" class="btn-cerrar">Salir</a>
    </div>
</header>
<main>

<section class="contenedor">

    <h2>Resumen general</h2>

    <!-- FILTRO -->
    <form method="GET" class="filtro">
        <input type="date" name="desde" value="<?= $desde ?>">
        <input type="date" name="hasta" value="<?= $hasta ?>">
        <button type="submit">Filtrar</button>
    </form>

    <!-- CARDS -->
    <div class="cards">
        <div class="card">
            <h3><?= $total ?></h3>
            <p>Total</p>
        </div>

        <div class="card">
            <h3><?= $aprobadas ?></h3>
            <p>Aprobadas</p>
        </div>

        <div class="card">
            <h3><?= $rechazadas ?></h3>
            <p>Rechazadas</p>
        </div>

        <div class="card">
            <h3><?= $revision ?></h3>
            <p>En revisión</p>
        </div>
    </div>

    <!-- BARRAS -->
    <h3>Estado de solicitudes</h3>

    <div class="barra">
        <div class="progreso verde" style="width:<?= $porcA ?>%"></div>
    </div>
    <p>Aprobadas <?= round($porcA) ?>%</p>

    <div class="barra">
        <div class="progreso rojo" style="width:<?= $porcR ?>%"></div>
    </div>
    <p>Rechazadas <?= round($porcR) ?>%</p>

    <div class="barra">
        <div class="progreso amarillo" style="width:<?= $porcE ?>%"></div>
    </div>
    <p>En revisión <?= round($porcE) ?>%</p>

    <!-- GRAFICO TIPO PASTEL -->
    <h3>Distribución</h3>

    <div class="pastel" style="
        background: conic-gradient(
            #81c784 0% <?= $porcA ?>%,
            #e57373 <?= $porcA ?>% <?= $porcA + $porcR ?>%,
            #ffe082 <?= $porcA + $porcR ?>% 100%
        );
    "></div>

</section>

</main>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>