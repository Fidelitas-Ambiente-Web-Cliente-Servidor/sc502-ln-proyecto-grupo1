<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();


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


$filtro = $_GET['filtro'] ?? 'todas';

$where = "";

if ($filtro == "aprobadas") {
    $where = "WHERE estado='Aprobado'";
} elseif ($filtro == "rechazadas") {
    $where = "WHERE estado='Rechazado'";
} elseif ($filtro == "revision") {
    $where = "WHERE estado='En revisión'";
}


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
<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin_solicitudes.css">

</head>

<body>

<header>
    <div class="logo">
        <span class="icono">💙</span>
        <div>
            <h1>AdoptaCR</h1>
            <p>Gestión de Solicitudes</p>
        </div>
    </div>
</header>

<main>

<section class="contenedor-admin">

    <h2>Solicitudes registradas</h2>

    
    <div class="filtros">
        <a href="?filtro=todas">Todas</a>
        <a href="?filtro=aprobadas">Aprobadas</a>
        <a href="?filtro=rechazadas">Rechazadas</a>
        <a href="?filtro=revision">En revisión</a>
    </div>

    <!-- TABLA -->
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
                        <a href="<?= $row['documento'] ?>" target="_blank" class="btn pdf">
                            Ver PDF
                        </a>
                    <?php else: ?>
                        <span class="sin-archivo">Sin archivo</span>
                    <?php endif; ?>
                </td>

                <td>

                    <a href="admin_ver_solicitud.php?id=<?= $row['id'] ?>" class="btn ver">
                        Ver detalle
                    </a>

                    <a href="?accion=aprobar&id=<?= $row['id'] ?>" class="btn aprobar">
                        Aprobar
                    </a>

                    <a href="?accion=rechazar&id=<?= $row['id'] ?>" class="btn rechazar">
                        Rechazar
                    </a>

                </td>

            </tr>
            <?php endwhile; ?>

        </table>

    </div>

</section>

</main>

<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>