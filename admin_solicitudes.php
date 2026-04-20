<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();

/* ACCIONES */
if (isset($_GET['accion']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $accion = $_GET['accion'];

    if ($accion == "aprobar") {
        $conn->query("UPDATE solicitudes SET estado='Aprobado' WHERE id=$id");
    }

    if ($accion == "rechazar") {
        $conn->query("UPDATE solicitudes SET estado='Rechazado' WHERE id=$id");
    }
}

/* FILTRO */
$filtro = $_GET['filtro'] ?? 'todas';

$where = "";

if ($filtro == "aprobadas") {
    $where = "WHERE estado='Aprobado'";
} elseif ($filtro == "rechazadas") {
    $where = "WHERE estado='Rechazado'";
} elseif ($filtro == "revision") {
    $where = "WHERE estado='En revisión'";
}

/* CONSULTA */
$sql = "SELECT * FROM solicitudes $where ORDER BY id DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Error en consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Solicitudes</title>

<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin.css">
<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin_solicitudes.css">
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

<section class="admin-dashboard">

    <div class="contenedor-admin">

        <h2>Solicitudes registradas</h2>

        <div class="filtros">
            <a href="?filtro=todas">Todas</a>
            <a href="?filtro=aprobadas">Aprobadas</a>
            <a href="?filtro=rechazadas">Rechazadas</a>
            <a href="?filtro=revision">En revisión</a>
        </div>

        <div class="tabla-card">

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Documento</th>
                    <th>Acciones</th>
                </tr>

                <?php while($row = $result->fetch_assoc()): ?>
                <tr>

                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['correo'] ?></td>

                    <td>
                        <?php
                        if ($row['estado'] == "Aprobado") {
                            echo "<span class='estado aprobado'>Aprobado</span>";
                        } elseif ($row['estado'] == "Rechazado") {
                            echo "<span class='estado rechazado'>Rechazado</span>";
                        } else {
                            echo "<span class='estado revision'>En revisión</span>";
                        }
                        ?>
                    </td>

                    <td>
                        <?php if (!empty($row['documento'])): ?>
                            <a href="<?= $row['documento'] ?>" target="_blank" class="btn pdf">Ver PDF</a>
                        <?php else: ?>
                            <span style="color:#777;">Sin archivo</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="admin_ver_solicitud.php?id=<?= $row['id'] ?>" class="btn ver">Ver detalle</a>
                        <a href="?accion=aprobar&id=<?= $row['id'] ?>" class="btn aprobar">Aprobar</a>
                        <a href="?accion=rechazar&id=<?= $row['id'] ?>" class="btn rechazar">Rechazar</a>
                    </td>

                </tr>
                <?php endwhile; ?>

            </table>

        </div>

    </div>

</section>

</main>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>