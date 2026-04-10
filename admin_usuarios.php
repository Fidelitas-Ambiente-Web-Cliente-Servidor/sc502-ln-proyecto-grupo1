<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();


if (isset($_GET['accion']) && isset($_GET['id'])) {

    $id = intval($_GET['id']);
    $accion = $_GET['accion'];

    if ($accion == "eliminar") {
        $conn->query("DELETE FROM solicitudes WHERE id=$id");
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
<title>Gestión de Usuarios</title>

<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/style.css">
<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin.css">
<link rel="stylesheet" href="/sc502-ln-proyecto-grupo1/css/admin_usuarios.css">

</head>

<body>

<header>
    <div class="logo">
        <span class="icono">💙</span>
        <div>
            <h1>AdoptaCR</h1>
            <p>Gestión de Usuarios</p>
        </div>
    </div>
</header>

<main>

<section class="admin-dashboard">

<div class="contenedor-admin">

<h2>Usuarios registrados</h2>

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
    <th>Teléfono</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['nombre'] . " " . $row['apellidos'] ?></td>

<td><?= $row['correo'] ?></td>

<td><?= $row['telefono'] ?></td>

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

<a href="admin_ver_solicitud.php?id=<?= $row['id'] ?>" class="btn ver">
    Ver
</a>

<a href="?accion=eliminar&id=<?= $row['id'] ?>" class="btn eliminar"
   onclick="return confirm('¿Eliminar este usuario?')">
    Eliminar
</a>

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