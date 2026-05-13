// director.js - Adaptado al estándar de SortlyScan
const API_URL = "http://localhost/sortlyscan/api/director.php";
const instId = localStorage.getItem('inst_id');
const schoolName = localStorage.getItem('inst_nombre');

document.addEventListener('DOMContentLoaded', () => {
    // Verificación de seguridad inicial
    if (!instId) {
        window.location.href = "ValidarInstitucion.html";
        return;
    }
    
    document.getElementById('school-name').innerText = schoolName;
    cargarDashboard();
});

// ==========================================
// 1. CARGAR DATOS DEL DASHBOARD
// ==========================================
async function cargarDashboard() {
    try {
        // REGLA: Usamos fetch con credentials para mantener la sesión de PHP si es necesario
        const response = await fetch(`${API_URL}?action=get_data&inst_id=${instId}`, {
            method: 'GET',
            credentials: 'include'
        });

        const data = await response.json();

        if (data.stats) {
            // Actualizar Estadísticas
            document.getElementById('stat-clases').innerText = data.stats.total_clases;
            document.getElementById('stat-alumnos').innerText = data.stats.total_alumnos;
            document.getElementById('stat-puntos').innerText = data.stats.total_puntos;
        }

        // Llenar Select de Clases
        const select = document.getElementById('select-clases');
        if (select && data.clases) {
            select.innerHTML = '<option value="">Selecciona una clase</option>';
            data.clases.forEach(clase => {
                select.innerHTML += `<option value="${clase.id}">${clase.nombre_salon}</option>`;
            });
        }

        // Generar Ranking
        const rankingContainer = document.getElementById('ranking-container');
        if (rankingContainer && data.clases) {
            rankingContainer.innerHTML = '';
            data.clases.forEach((clase, index) => {
                const medalla = index === 0 ? 'gold' : index === 1 ? 'silver' : 'teal';
                rankingContainer.innerHTML += `
                    <div class="ranking-item">
                        <div class="class-info">
                            <div class="rank-circle ${medalla}"><i class="fa-solid fa-trophy"></i></div>
                            <div>
                                <h4>${clase.nombre_salon}</h4>
                                <p>Docente: ${clase.docente || 'Sin asignar'} • ${clase.num_alumnos} estudiantes</p>
                            </div>
                        </div>
                        <div class="points">
                            <span class="points-num">${clase.puntos}</span>
                            <span class="points-label">puntos</span>
                        </div>
                    </div>`;
            });
        }
    } catch (error) {
        console.error("Error cargando dashboard:", error);
    }
}

// ==========================================
// 2. CREAR NUEVA CLASE
// ==========================================
async function crearClase() {
    const nombre = document.getElementById('nombre-clase').value;
    if (!nombre) return alert("Por favor, ingresa el nombre de la clase");

    // REGLA: Uso de FormData para compatibilidad con $_POST en PHP
    const formData = new FormData();
    formData.append('action', 'crear_clase');
    formData.append('nombre', nombre);
    formData.append('inst_id', instId);

    try {
        const res = await fetch(API_URL, { 
            method: 'POST', 
            body: formData,
            credentials: 'include' 
        });
        const data = await res.json();

        if (data.success) { 
            alert("Clase creada con éxito"); 
            cargarDashboard(); 
            document.getElementById('nombre-clase').value = ""; // Limpiar input
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al crear clase:", error);
    }
}

// ==========================================
// 3. ASIGNAR DOCENTE A CLASE
// ==========================================
async function asignarDocente() {
    const claseId = document.getElementById('select-clases').value;
    const nombre = document.getElementById('nombre-docente').value;
    const pass = document.getElementById('pass-docente').value;

    if (!claseId || !nombre || !pass) {
        return alert("Completa todos los campos del docente");
    }

    const formData = new FormData();
    formData.append('action', 'asignar_docente');
    formData.append('clase_id', claseId);
    formData.append('nombre_docente', nombre);
    formData.append('password', pass);

    try {
        const res = await fetch(API_URL, { 
            method: 'POST', 
            body: formData,
            credentials: 'include'
        });
        const data = await res.json();

        if (data.success) { 
            alert("Docente asignado correctamente"); 
            cargarDashboard(); 
            // Limpiar campos
            document.getElementById('nombre-docente').value = "";
            document.getElementById('pass-docente').value = "";
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al asignar docente:", error);
    }
}

// ==========================================
// 4. CERRAR SESIÓN
// ==========================================
function cerrarSesion() {
    // Aquí podrías agregar un fetch a logout.php si quieres destruir la sesión en servidor
    localStorage.clear();
    window.location.href = "ValidarInstitucion.html";
}