// public/JS/Panel_Director.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Verificamos que el director haya iniciado sesión
    const idDirector = localStorage.getItem('usuario_id');
    
    if (!idDirector) {
        alert("Debes iniciar sesión primero.");
        window.location.href = 'iniciodesesion_Director.php';
        return;
    }

    // 2. Cargamos los datos del Dashboard
    cargarDatosDashboard(idDirector);
});

async function cargarDatosDashboard(idDirector) {
    try {
        const formData = new FormData();
        formData.append('id_director', idDirector);

        // Hacemos la petición a la BD
        const response = await fetch('logic/get_dashboard_director.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // --- ACTUALIZAMOS LA INTERFAZ ---

            // 1. Nombre de la escuela
            const tituloEscuela = document.getElementById('school-name');
            if (tituloEscuela && data.escuela_nombre) {
                tituloEscuela.textContent = data.escuela_nombre;
            }

            // 2. Estadísticas
            document.getElementById('stat-clases').textContent = data.stats.total_clases;
            document.getElementById('stat-alumnos').textContent = data.stats.total_alumnos;
            document.getElementById('stat-puntos').textContent = data.stats.total_puntos;

            // 3. Select de asignación de docentes
            const selectClases = document.getElementById('select-clases');
            selectClases.innerHTML = '<option value="">Selecciona un salón...</option>';
            data.salones.forEach(salon => {
                selectClases.innerHTML += `<option value="${salon.id_salon}">${salon.nombre_salon}</option>`;
            });

            // 4. Ranking de Salones
            const rankingContainer = document.getElementById('ranking-container');
            if (data.salones.length > 0) {
                rankingContainer.innerHTML = ''; // Limpiamos el mensaje de carga
                data.salones.forEach((salon, index) => {
                    rankingContainer.innerHTML += `
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; border-bottom: 1px solid #e2e8f0;">
                            <div>
                                <span style="font-weight: bold; color: #00BCD4; margin-right: 10px;">#${index + 1}</span>
                                <span>${salon.nombre_salon}</span>
                            </div>
                            <div style="font-weight: bold; color: #4CAF50;">
                                ${salon.puntos} <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    `;
                });
            } else {
                rankingContainer.innerHTML = '<p style="text-align:center; color: #999; padding: 20px;">Aún no hay salones registrados en esta institución.</p>';
            }
        } else {
            console.error("Error del servidor:", data.message);
        }
    } catch (error) {
        console.error("Error de red al cargar dashboard:", error);
    }
}

// Funciones vacías para gestión
function crearClase() {
    alert("Función para crear salón en construcción...");
}

function asignarDocente() {
    alert("Función para asignar docente en construcción...");
}

function cerrarSesion() {
    localStorage.clear();
    window.location.href = 'iniciodesesion_Director.php';
}