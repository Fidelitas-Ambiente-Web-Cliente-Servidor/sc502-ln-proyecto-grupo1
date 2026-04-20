<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios - AdoptaCR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/Servicios/servicios.css">
</head>
<body>

<!-- Header con navegación -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../img/logo2.png" width="125"><br>
            </a>
            <button class="navbar-toggler" type="button"> 
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="../conocenos.php">Conócenos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="../servicios.php">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="../tramites.php">Trámites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="../faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="../contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Sección de Servicios -->
<section class="servicios-header">
    <div class="container">
        <h1>Nuestros Servicios</h1>
        <p>Te acompañamos en cada paso del proceso de adopción</p>
    </div>
</section>

<div class="servicios-container">
    <div class="servicios-grid">
        
        <!-- Card 1 - Asesoría Legal -->
        <div class="servicio-card">
            <div class="servicio-icono">⚖️</div>
            <h3>Asesoría Legal</h3>
            <p>Orientación legal completa sobre el proceso de adopción, requisitos y documentación necesaria.</p>
            <div class="servicio-info">
                <span class="duracion">⏱️ 1 hora</span>
                <span class="precio">₡50,000</span>
            </div>
            <button class="btn-reservar" onclick="reservarServicio('Asesoría Legal')">Reservar ahora →</button>
        </div>

        <!-- Card 2 - Evaluación Psicológica -->
        <div class="servicio-card">
            <div class="servicio-icono">🧠</div>
            <h3>Evaluación Psicológica</h3>
            <p>Evaluación profesional con psicólogo especializado en adopciones y vinculación familiar.</p>
            <div class="servicio-info">
                <span class="duracion">⏱️ 2 horas</span>
                <span class="precio">₡85,000</span>
            </div>
            <button class="btn-reservar" onclick="reservarServicio('Evaluación Psicológica')">Reservar ahora →</button>
        </div>

        <!-- Card 3 - Taller de Preparación -->
        <div class="servicio-card">
            <div class="servicio-icono">📚</div>
            <h3>Taller de Preparación</h3>
            <p>Taller grupal para futuros padres adoptivos. Conoce experiencias y herramientas.</p>
            <div class="servicio-info">
                <span class="duracion">⏱️ 4 horas</span>
                <span class="precio">₡75,000</span>
            </div>
            <button class="btn-reservar" onclick="reservarServicio('Taller de Preparación')">Reservar ahora →</button>
        </div>

        <!-- Card 4 - Estudio Socioeconómico -->
        <div class="servicio-card">
            <div class="servicio-icono">🏠</div>
            <h3>Estudio Socioeconómico</h3>
            <p>Evaluación del hogar, entorno familiar y condiciones de vida de los solicitantes.</p>
            <div class="servicio-info">
                <span class="duracion">⏱️ 3 horas</span>
                <span class="precio">₡100,000</span>
            </div>
            <button class="btn-reservar" onclick="reservarServicio('Estudio Socioeconómico')">Reservar ahora →</button>
        </div>

        <!-- Card 5 - Seguimiento Post-adopción -->
        <div class="servicio-card">
            <div class="servicio-icono">💙</div>
            <h3>Seguimiento Post-adopción</h3>
            <p>Acompañamiento profesional después de la adopción para asegurar una integración exitosa.</p>
            <div class="servicio-info">
                <span class="duracion">⏱️ 1 hora</span>
                <span class="precio">₡45,000</span>
            </div>
            <button class="btn-reservar" onclick="reservarServicio('Seguimiento Post-adopción')">Reservar ahora →</button>
        </div>

        <!-- Card 6 - Asesoría para Trámites -->
        <div class="servicio-card">
            <div class="servicio-icono">📋</div>
            <h3>Asesoría para Trámites</h3>
            <p>Ayuda con la gestión de documentos y trámites legales ante el PANI.</p>
            <div class="servicio-info">
                <span class="duracion">⏱️ 1.5 horas</span>
                <span class="precio">₡60,000</span>
            </div>
            <button class="btn-reservar" onclick="reservarServicio('Asesoría para Trámites')">Reservar ahora →</button>
        </div>

        <div class="servicio-card">
            <div class="servicio-icono">🗓️</div>
            <h3>Consulte su citas</h3>
            <p>Revise si su cita está programada.</p>
            <a href="../visual/mi-cuenta-vista-servicios.php" class="btn-reservar"> Consultar </a>
        </div>

    </div>
</div>

<!-- Modal de Reserva -->
<div class="modal fade" id="reservaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reservar Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="Agendar-servicio.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="servicio" id="servicioSeleccionado">
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo *</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono *</label>
                        <input type="tel" class="form-control" name="telefono" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha *</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label">Hora *</label>
                            <select class="form-control" name="hora" required>
                                <option value="">Seleccione una hora</option>
                                <option value="09:00">09:00 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="13:00">01:00 PM</option>
                                <option value="14:00">02:00 PM</option>
                                <option value="15:00">03:00 PM</option>
                                <option value="16:00">04:00 PM</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario Adicional</label>
                        <textarea class="form-control" name="comentario" rows="3" 
                                  placeholder="¿Alguna observación o pregunta específica?"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar Reserva</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function reservarServicio(servicio) {
    document.getElementById('servicioSeleccionado').value = servicio;
    // Establecer fecha mínima (mañana)
    const fechaInput = document.getElementById('fecha');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    fechaInput.min = tomorrow.toISOString().split('T')[0];
    
    new bootstrap.Modal(document.getElementById('reservaModal')).show();
}

// Mostrar mensajes de sesión
<?php if (isset($_SESSION['success'])): ?>
    alert("<?php echo $_SESSION['success']; ?>");
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    alert("<?php echo $_SESSION['error']; ?>");
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
</script>

<!-- Agrega Bootstrap JS si no lo tienes -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Footer -->
<footer>
    <p>Ama a un ángel 💙 | @AdoptaCR</p>
</footer>

</body>
</html>