// public/JS/vista_director.js

document.addEventListener("DOMContentLoaded", () => {
    cargarDashboard();
    cargarSelectorClases();
});

// Carga contadores estadísticos y lista del ranking institucional
function cargarDashboard() {
    fetch('logic/api_datos_director.php?action=get_dashboard')
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error("Error del servidor:", data.error);
                return;
            }

            // Actualizar tarjetas superiores
            document.getElementById('stat-clases').textContent = data.stats.total_clases;
            document.getElementById('stat-alumnos').textContent = data.stats.total_alumnos;
            document.getElementById('stat-puntos').textContent = data.stats.total_puntos;

            // Actualizar contenedor del ranking
            const container = document.getElementById('ranking-container');
            container.innerHTML = '';

            if (data.ranking.length === 0) {
                container.innerHTML = '<p style="text-align:center; color: #999; padding: 15px;">No hay salones registrados en esta escuela.</p>';
                return;
            }

            data.ranking.forEach((clase, index) => {
                const item = document.createElement('div');
                item.className = 'rank-item';
                item.style.display = 'flex';
                item.style.justifyContent = 'space-between';
                item.style.padding = '12px 20px';
                item.style.background = '#fff';
                item.style.marginBottom = '8px';
                item.style.borderRadius = '10px';
                item.style.boxShadow = '0 2px 4px rgba(0,0,0,0.02)';
                
                item.innerHTML = `
                    <div>
                        <strong style="color: #f97316; margin-right: 15px;">#${index + 1}</strong>
                        <span>${clase.nombre_salon}</span>
                    </div>
                    <span style="font-weight: bold; color: #10b981;">${clase.puntos_clase} pts</span>
                `;
                container.appendChild(item);
            });
        })
        .catch(err => console.error("Error al procesar el dashboard:", err));
}

// Llena dinámicamente el campo de selección <select> con las clases creadas
function cargarSelectorClases() {
    fetch('logic/api_datos_director.php?action=get_clases')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('select-clases');
            select.innerHTML = '';

            if (!data.success || data.clases.length === 0) {
                select.innerHTML = '<option value="">Sin clases disponibles</option>';
                return;
            }

            select.innerHTML = '<option value="">-- Seleccione una clase --</option>';
            data.clases.forEach(clase => {
                const opt = document.createElement('option');
                opt.value = clase.id_salon;
                opt.textContent = clase.nombre_salon;
                select.appendChild(opt);
            });
        })
        .catch(err => console.error("Error cargando selector:", err));
}

// Ejecuta el envío de datos para crear un nuevo salón
function crearClase() {
    const input = document.getElementById('nombre-clase');
    const nombreClase = input.value.trim();

    if (nombreClase === '') {
        alert("Por favor, ingresa el nombre de la clase.");
        return;
    }

    const formData = new FormData();
    formData.append('nombre_clase', nombreClase);

    fetch('logic/api_datos_director.php?action=crear_clase', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            input.value = '';
            // Refrescar datos visuales reflejando los cambios
            cargarDashboard();
            cargarSelectorClases();
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(err => console.error("Error creando clase:", err));
}

// Ejecuta la acción de registrar un docente y asignarle un salón
function asignarDocente() {
    const idSalon = document.getElementById('select-clases').value;
    const nombreDocente = document.getElementById('nombre-docente').value.trim();
    const passDocente = document.getElementById('pass-docente').value.trim();

    if (!idSalon || nombreDocente === '' || passDocente === '') {
        alert("Todos los campos para la asignación son requeridos.");
        return;
    }

    const formData = new FormData();
    formData.append('id_salon', idSalon);
    formData.append('nombre_docente', nombreDocente);
    formData.append('pass_docente', passDocente);

    fetch('logic/api_datos_director.php?action=asignar_docente', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            document.getElementById('nombre-docente').value = '';
            document.getElementById('pass-docente').value = '';
            cargarDashboard();
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(err => console.error("Error asignando docente:", err));
}

// Cierra de forma segura la sesión activa del usuario
function cerrarSesion() {
    if (confirm("¿Estás seguro que deseas salir del sistema?")) {
        window.location.href = 'logout.php';
    }
}