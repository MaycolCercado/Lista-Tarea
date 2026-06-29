function crearProyecto() {
    const proyecto = document.getElementById('proyecto').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();

    if (!proyecto || !descripcion) {
        mostrarMensaje('Por favor completa todos los campos', 'error');
        return;
    }
 
    const formData = new FormData();
    formData.append('proyecto', proyecto);
    formData.append('descripcion', descripcion);
    formData.append('action', 'crear');

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            mostrarMensaje('✅ Proyecto creado exitosamente', 'success');
            document.getElementById('formulario').reset();
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1500);
        } else {
            mostrarMensaje('❌ Error: ' + data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('❌ Error en la solicitud AJAX', 'error');
    });
}

// Actualizar proyecto
function actualizarProyecto(id) {
    const proyecto = document.getElementById('proyecto').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();

    if (!proyecto || !descripcion) {
        mostrarMensaje('Por favor completa todos los campos', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('proyecto', proyecto);
    formData.append('descripcion', descripcion);
    formData.append('action', 'actualizar');
    formData.append('id', id);

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            mostrarMensaje('✅ Proyecto actualizado exitosamente', 'success');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1500);
        } else {
            mostrarMensaje('❌ Error: ' + data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('❌ Error en la solicitud AJAX', 'error');
    });
}

// Eliminar proyecto (con confirmación)
function eliminarProyecto(id) {
    if (!confirm('⚠️ ¿Estás seguro de que deseas eliminar este proyecto?')) {
        return;
    }

    const formData = new FormData();
    formData.append('action', 'eliminar');
    formData.append('id', id);

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            mostrarMensaje('✅ Proyecto eliminado exitosamente', 'success');
            setTimeout(() => {
                recargarLista();
            }, 1000);
        } else {
            mostrarMensaje('❌ Error: ' + data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('❌ Error en la solicitud AJAX', 'error');
    });
}

// Obtener proyecto por ID (para editar)
function obtenerProyecto(id) {
    const formData = new FormData();
    formData.append('action', 'obtener');
    formData.append('id', id);

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {  
            document.getElementById('proyecto').value = data.data.proyecto;
            document.getElementById('descripcion').value = data.data.descripcion;
            document.getElementById('formulario-titulo').textContent = '✏️ Editar Proyecto';
            document.getElementById('formulario-boton').textContent = '✅ Actualizar Proyecto';
            document.getElementById('formulario-boton').onclick = () => actualizarProyecto(data.data.id);
        } else {
            mostrarMensaje('❌ Error: ' + data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarMensaje('❌ Error en la solicitud AJAX', 'error');
    });
}

// Recargar tabla de proyectos
function recargarLista() {
    const formData = new FormData();
    formData.append('action', 'listar_ajax');

    fetch('index.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.ok) {
            actualizarTabla(data.data);
        }
    })
    .catch(error => console.error('Error:', error));
}

function actualizarTabla(proyectos) {
    const tbody = document.querySelector('table tbody');
    
    if (proyectos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" class="empty-message">📋 No hay proyectos para mostrar. ¡Crea uno nuevo!</td></tr>';
        return;
    }

    tbody.innerHTML = proyectos.map(proyecto => `
        <tr>
            <td><strong>${escapeHtml(proyecto.proyecto)}</strong></td>
            <td>${escapeHtml(proyecto.descripcion)}</td>
            <td>
                <div class="table-actions">
                    <a href="index.php?action=editar&id=${proyecto.id}" class="edit-link">✏️ Editar</a>
                    <a href="javascript:void(0);" onclick="eliminarProyecto(${proyecto.id})" class="delete-link">🗑️ Eliminar</a>
                </div>
            </td>
        </tr>
    `).join('');
}

// Mostrar mensajes al usuario
function mostrarMensaje(mensaje, tipo) {
    // Eliminar mensaje anterior si existe
    const mensajeAnterior = document.getElementById('mensaje-alerta');
    if (mensajeAnterior) {
        mensajeAnterior.remove();
    }

    const alerta = document.createElement('div');
    alerta.id = 'mensaje-alerta';
    alerta.className = `alert alert-${tipo}`;
    alerta.textContent = mensaje;

    const container = document.querySelector('.container');
    container.insertBefore(alerta, container.firstChild);

    // Auto-eliminar mensaje después de 5 segundos
    setTimeout(() => {
        alerta.remove();
    }, 5000);
}

// Escapar caracteres HTML para seguridad
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Inicializar cuando la página carga
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ AJAX cargado correctamente');
});
