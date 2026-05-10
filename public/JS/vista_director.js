const API_URL = "http://localhost/sortlyscan/api/director.php";
const instId = localStorage.getItem('inst_id');
const schoolName = localStorage.getItem('inst_nombre');

document.addEventListener('DOMContentLoaded', () => {
    if (!instId) window.location.href = "ValidarInstitucion.html";
    
    document.getElementById('school-name').innerText = schoolName;
    cargarDashboard();
});

async function cargarDashboard() {
    try {
        const response = await fetch(`${API_URL}?action=get_data&inst_id=${instId}`);
        const data = await response.json();

        // Actualizar Estadísticas
        document.getElementById('stat-clases').innerText = data.stats.total_clases;
        document.getElementById('stat-alumnos').innerText = data.stats.total_alumnos;
        document.getElementById('stat-puntos').innerText = data.stats.total_puntos;

        // Llenar Select de Clases
        const select = document.getElementById('select-clases');
        select.innerHTML = '<option value="">Selecciona una clase</option>';
        data.clases.forEach(clase => {
            select.innerHTML += `<option value="${clase.id}">${clase.nombre_salon}</option>`;
        });

        // Generar Ranking
        const rankingContainer = document.getElementById('ranking-container');
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
    } catch (e) { console.error("Error cargando dashboard"); }
}

async function crearClase() {
    const nombre = document.getElementById('nombre-clase').value;
    if (!nombre) return alert("Nombre de clase vacío");

    const formData = new FormData();
    formData.append('action', 'crear_clase');
    formData.append('nombre', nombre);
    formData.append('inst_id', instId);

    const res = await fetch(API_URL, { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) { alert("Clase creada"); cargarDashboard(); }
}

async function asignarDocente() {
    const claseId = document.getElementById('select-clases').value;
    const nombre = document.getElementById('nombre-docente').value;
    const pass = document.getElementById('pass-docente').value;

    if (!claseId || !nombre || !pass) return alert("Completa los datos del docente");

    const formData = new FormData();
    formData.append('action', 'asignar_docente');
    formData.append('clase_id', claseId);
    formData.append('nombre_docente', nombre);
    formData.append('password', pass);

    const res = await fetch(API_URL, { method: 'POST', body: formData });
    if ((await res.json()).success) { alert("Docente asignado"); cargarDashboard(); }
}

function cerrarSesion() {
    localStorage.clear();
    window.location.href = "ValidarInstitucion.html";
}