<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Reservas - AdoptaCR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Servicios/admin-reservas.css">
</head>
<body>

<div class="admin-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1>Panel de Reservas</h1>
                <p class="mb-0">Gestionar solicitudes de servicios</p>
            </div>
            <a href="../admin.php" class="btn-cerrar">Salir</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card card-shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Contacto</th>
                            <th>Servicio</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Comentario</th>
                            <th>Estado</th>
                            <th>Respuesta Admin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($row['nombre_cliente'] ?? ''); ?></strong></td>
                            <td>
                                <?php echo htmlspecialchars($row['email_cliente'] ?? ''); ?><br>
                                <?php echo htmlspecialchars($row['telefono_cliente'] ?? ''); ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['servicio'] ?? ''); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['fecha'])); ?></td>
                            <td><?php echo htmlspecialchars($row['hora'] ?? ''); ?></td>
                            <td class="comentario-cell"><?php echo nl2br(htmlspecialchars($row['comentario'] ?? 'Sin comentario')); ?></td>
                            <td>
                                <span class="estado-<?php echo $row['estado']; ?>">
                                    <?php echo ucfirst($row['estado']); ?>
                                </span>
                            </td>
                            <td class="comentario-cell">
                                <?php 
                                $respuesta = $row['comentario_admin'] ?? '';
                                echo !empty($respuesta) ? nl2br(htmlspecialchars($respuesta)) : '—';
                                ?>
                            </td>
                            <td>
                                <?php if ($row['estado'] == 'pendiente'): ?>
                                <button class="btn-aprobar" 
                                        onclick="abrirModal('aprobar', <?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['nombre_cliente']); ?>')">
                                    Aprobar
                                </button>
                                <button class="btn-rechazar" 
                                        onclick="abrirModal('rechazar', <?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['nombre_cliente']); ?>')">
                                    Rechazar
                                </button>
                                <?php else: ?>
                                <span class="text-muted">Procesado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="comentarioModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Agregar Comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="modalMensaje"></p>
                <label class="form-label">Comentario (opcional):</label>
                <textarea id="comentarioTexto" class="form-control" rows="3" placeholder="Agrega un comentario..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn-confirmar" id="confirmarBtn">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/servicios/admin-reservas.js"></script>
</body>
</html>