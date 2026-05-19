// public/JS/Panel_Docente.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Verificamos que el maestro tenga sesión activa
    const idMaestro = localStorage.getItem('usuario_id');
    const nombreMaestro = localStorage.getItem('usuario_nombre') || 'Teacher';
    
    if (!idMaestro) {
        alert("Debes iniciar sesión primero.");
        window.location.href = 'iniciodesesion_Maestro.php';
        return;
    }

    // Colocamos saludo inicial
    document.getElementById('teacher-welcome').textContent = `Hello, ${nombreMaestro}! General overview of your classroom.`;

    // 2. Cargamos los datos exclusivos de su aula
    cargarDatosAula(idMaestro);
});

async function cargarDatosAula(idMaestro) {
    try {
        const formData = new FormData();
        formData.append('id_maestro', idMaestro);

        const response = await fetch('logic/get_dashboard_docente.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // 1. Nombre del salón y código de aula
            document.getElementById('panel-title').textContent = `Panel - ${data.aula_nombre}`;
            document.getElementById('class-code').textContent = data.aula_codigo;
            document.getElementById('student-count').innerHTML = `<i class="fa-solid fa-users"></i> Students (${data.alumnos.length})`;

            // 2. Renderizar lista de alumnos (Ranking por puntos)
            const container = document.getElementById('student-list-container');
            container.innerHTML = ''; // Limpiamos mensaje de carga

            if (data.alumnos.length > 0) {
                data.alumnos.forEach((alumno, index) => {
                    // Asignamos el color de la copa según su posición en el salón
                    let rankClass = "bronze"; 
                    if (index === 0) rankClass = "gold";
                    else if (index === 1) rankClass = "silver";

                    container.innerHTML += `
                        <div class="student-item">
                            <div class="student-info">
                                <div class="rank-icon ${rankClass}"><i class="fa-solid fa-trophy"></i></div>
                                <div>
                                    <h4>${alumno.nombre_display}</h4>
                                    <p>${alumno.puntos_totales} points</p>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="edit-btn" onclick="editStudent(${alumno.id_alumno})"><i class="fa-solid fa-pen"></i></button>
                                <button class="delete-btn" onclick="deleteStudent(${alumno.id_alumno})"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </div>
                    `;
                });
            } else {
                container.innerHTML = '<p style="text-align:center; color: #999; padding: 20px;">No students registered in this class yet.</p>';
            }
        } else {
            // Si el maestro no tiene ningún salón asignado todavía
            document.getElementById('student-list-container').innerHTML = `
                <p style="text-align:center; color: #d32f2f; padding: 20px; font-weight:bold;">
                    ${data.message}
                </p>
            `;
        }
    } catch (error) {
        console.error("Error al cargar datos del docente:", error);
    }
}

// Funciones utilitarias de la interfaz
function copyCode() {
    const codeText = document.getElementById('class-code').textContent;
    if(codeText === '---') return;
    
    navigator.clipboard.writeText(codeText).then(() => {
        alert("Class code copied to clipboard: " + codeText);
    });
}

function agregarAlumno() {
    alert("Function to add students under construction...");
}

function editStudent(id) {
    alert("Function to edit student " + id + " under construction...");
}

function deleteStudent(id) {
    alert("Function to delete student " + id + " under construction...");
}

function cerrarSesion() {
    localStorage.clear();
    window.location.href = 'iniciodesesion_Maestro.php';
}