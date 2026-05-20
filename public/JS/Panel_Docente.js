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

    // 3. NUEVO: Configurar el envío del formulario de la ventana emergente
    const formNuevo = document.getElementById('form-nuevo-alumno');
    if(formNuevo) {
        formNuevo.addEventListener('submit', guardarNuevoAlumno);
    }
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

                    // MODIFICACIÓN: Estructuramos el PIN al lado del nombre (zona morada)
                    container.innerHTML += `
                        <div class="student-item">
                            <div class="student-info">
                                <div class="rank-icon ${rankClass}"><i class="fa-solid fa-trophy"></i></div>
                                <div style="flex-grow: 1;">
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <h4 style="margin: 0;">${alumno.nombre_display}</h4>
                                        
                                        <div style="display: flex; align-items: center; background: #f1f5f9; padding: 4px 10px; border-radius: 15px; border: 1px solid #e2e8f0;">
                                            <i class="fa-solid fa-key" style="color: #94a3b8; font-size: 0.8rem; margin-right: 5px;"></i>
                                            <input type="password" id="pin-${alumno.id_alumno}" value="${alumno.pin}" readonly 
                                                   style="border: none; background: transparent; font-weight: bold; letter-spacing: 2px; color: #334155; width: 40px; padding: 0; outline: none; font-family: monospace;">
                                            <button onclick="togglePin(${alumno.id_alumno}, this)" style="background: transparent; border: none; cursor: pointer; color: #94a3b8; margin-left: 5px; padding: 0;">
                                                <i class="fa-solid fa-eye-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p style="margin: 5px 0 0 0; color: #64748b; font-size: 0.9rem;">${alumno.puntos_totales} points</p>
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

// --------------------------------------------------------
// NUEVAS FUNCIONES PARA EL PIN Y EL MODAL
// --------------------------------------------------------

function togglePin(idAlumno, btnElement) {
    const pinInput = document.getElementById(`pin-${idAlumno}`);
    const icon = btnElement.querySelector('i');

    if (pinInput.type === 'password') {
        pinInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
        btnElement.style.color = '#4CAF50'; // Verde
    } else {
        pinInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        btnElement.style.color = '#94a3b8'; // Gris
    }
}

function agregarAlumno() {
    const form = document.getElementById('form-nuevo-alumno');
    if(form) form.reset();
    
    // Autogenerar PIN aleatorio de 4 dígitos
    const pinAleatorio = String(Math.floor(1000 + Math.random() * 9000));
    const pinInput = document.getElementById('modal-pin');
    if(pinInput) pinInput.value = pinAleatorio;
    
    // Mostrar la ventana emergente
    const modal = document.getElementById('modal-alumno');
    if(modal) {
        modal.style.display = 'flex';
        document.getElementById('modal-nombre').focus();
    }
}

function cerrarModal() {
    const modal = document.getElementById('modal-alumno');
    if(modal) modal.style.display = 'none';
}

async function guardarNuevoAlumno(e) {
    e.preventDefault();

    const idMaestro = localStorage.getItem('usuario_id');
    const nombre = document.getElementById('modal-nombre').value.trim();
    const pin = document.getElementById('modal-pin').value.trim();

    if (!/^\d{4}$/.test(pin)) {
        alert("El PIN debe ser estrictamente de 4 números.");
        document.getElementById('modal-pin').focus();
        return;
    }

    const formData = new FormData();
    formData.append('id_maestro', idMaestro);
    formData.append('nombre_alumno', nombre);
    formData.append('pin_alumno', pin);

    try {
        const response = await fetch('logic/agregar_alumno.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            cerrarModal();
            cargarDatosAula(idMaestro); // Recarga la lista dinámicamente
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al guardar alumno:", error);
        alert("Ocurrió un error al intentar guardar al alumno.");
    }
}

// --------------------------------------------------------
// FUNCIONES UTILITARIAS DE LA INTERFAZ
// --------------------------------------------------------

function copyCode() {
    const codeText = document.getElementById('class-code').textContent;
    if(codeText === '---') return;
    
    navigator.clipboard.writeText(codeText).then(() => {
        alert("Class code copied to clipboard: " + codeText);
    });
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