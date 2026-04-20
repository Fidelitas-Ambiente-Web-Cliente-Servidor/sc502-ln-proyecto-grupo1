let accionActual = '';
let idActual = '';

function abrirModal(accion, id, nombre) {
    accionActual = accion;
    idActual = id;
    
    if (accion === 'aprobar') {
        document.getElementById('modalTitulo').textContent = 'Aprobar Reserva';
        document.getElementById('modalMensaje').innerHTML = '¿Aprobar la reserva de <strong>' + nombre + '</strong>?';
    } else {
        document.getElementById('modalTitulo').textContent = 'Rechazar Reserva';
        document.getElementById('modalMensaje').innerHTML = '¿Rechazar la reserva de <strong>' + nombre + '</strong>?';
    }
    document.getElementById('comentarioTexto').value = '';
    new bootstrap.Modal(document.getElementById('comentarioModal')).show();
}

document.getElementById('confirmarBtn').addEventListener('click', function() {
    let comentario = document.getElementById('comentarioTexto').value;
    let url = '/sc502-ln-proyecto-grupo1/php/agendar-servicio-admin.php?action=' + accionActual + '&id=' + idActual + '&comentario=' + encodeURIComponent(comentario);
    window.location.href = url;
});