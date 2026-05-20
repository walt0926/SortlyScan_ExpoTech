// public/JS/Panel_Director.js

document.addEventListener('DOMContentLoaded', () => {
    const idDirector = localStorage.getItem('usuario_id');
    
    if (!idDirector) {
        alert("Debes iniciar sesión primero.");
        window.location.href = 'iniciodesesion_Director.php';
        return;
    }

    cargarDatosDashboard(idDirector);
});

async function cargarDatosDashboard(idDirector) {
    try {
        const formData = new FormData();
        formData.append('id_director', idDirector);

        const response = await fetch('logic/get_dashboard_director.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            const tituloEscuela = document.getElementById('school-name');
            if (tituloEscuela && data.escuela_nombre) tituloEscuela.textContent = data.escuela_nombre;

            // NUEVO: Mostramos el CCT de la institución
            const cctEscuela = document.getElementById('school-cct');
            if (cctEscuela && data.escuela_cct) cctEscuela.textContent = `CCT: ${data.escuela_cct}`;

            document.getElementById('stat-clases').textContent = data.stats.total_clases;
            document.getElementById('stat-alumnos').textContent = data.stats.total_alumnos;
            document.getElementById('stat-puntos').textContent = data.stats.total_puntos;

            const selectClases = document.getElementById('select-clases');
            selectClases.innerHTML = '<option value="">Selecciona un salón...</option>';
            data.salones.forEach(salon => {
                selectClases.innerHTML += `<option value="${salon.id_salon}">${salon.nombre_salon}</option>`;
            });

            const rankingContainer = document.getElementById('ranking-container');
            if (data.salones.length > 0) {
                rankingContainer.innerHTML = ''; 
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
        }
    } catch (error) {
        console.error("Error de red al cargar dashboard:", error);
    }
}

async function crearClase() {
    const idDirector = localStorage.getItem('usuario_id');
    const nombreClase = document.getElementById('nombre-clase').value.trim();

    if (!nombreClase) {
        alert("Por favor ingresa un nombre para el salón (Ej: 3rd Grade - A).");
        return;
    }

    const formData = new FormData();
    formData.append('id_director', idDirector);
    formData.append('nombre_clase', nombreClase);

    try {
        const response = await fetch('logic/crear_clase.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            alert(`¡Salón creado! Código de aula generado: ${data.codigo_aula}`);
            document.getElementById('nombre-clase').value = ''; 
            cargarDatosDashboard(idDirector); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Ocurrió un error al contactar al servidor.");
    }
}

async function asignarDocente() {
    const idDirector = localStorage.getItem('usuario_id');
    const idSalon = document.getElementById('select-clases').value;
    const nombreDocente = document.getElementById('nombre-docente').value.trim();
    const userDocente = document.getElementById('user-docente').value.trim().toLowerCase(); 
    const passDocente = document.getElementById('pass-docente').value.trim();

    if (!idSalon || !nombreDocente || !userDocente || !passDocente) {
        alert("Por favor completa todos los campos para asignar al maestro.");
        return;
    }

    const formData = new FormData();
    formData.append('id_director', idDirector);
    formData.append('id_salon', idSalon);
    formData.append('nombre_docente', nombreDocente);
    formData.append('user_docente', userDocente); 
    formData.append('pass_docente', passDocente);

    try {
        const response = await fetch('logic/asignar_docente.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            alert(`¡Docente asignado con éxito!\nEl maestro iniciará sesión con el usuario: ${userDocente}`);
            
            document.getElementById('select-clases').value = '';
            document.getElementById('nombre-docente').value = '';
            document.getElementById('user-docente').value = '';
            document.getElementById('pass-docente').value = '';
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Ocurrió un error al contactar al servidor.");
    }
}

function cerrarSesion() {
    localStorage.clear();
    window.location.href = 'iniciodesesion_Director.php';
}