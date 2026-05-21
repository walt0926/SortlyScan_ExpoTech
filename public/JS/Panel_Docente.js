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

    // Saludo inicial
    document.getElementById('teacher-welcome').textContent = `Hello, ${nombreMaestro}! General overview of your classroom.`;

    // 2. Carga de los datos exclusivos del aula
    cargarDatosAula(idMaestro);

    // 3. Envío del formulario de la ventana emergente (Crear Alumno)
    const formNuevo = document.getElementById('form-nuevo-alumno');
    if(formNuevo) {
        formNuevo.addEventListener('submit', guardarNuevoAlumno);
    }

    // 4. Configurar el envío del formulario de edición (Editar Alumno)
    const formEditar = document.getElementById('form-editar-alumno');
    if(formEditar) {
        formEditar.addEventListener('submit', guardarEditarAlumno);
    }

    // 5. Configurar el envío del formulario de borrado (Eliminar Alumno)
    const formEliminar = document.getElementById('form-eliminar-alumno');
    if(formEliminar) {
        formEliminar.addEventListener('submit', guardarEliminarAlumno);
    }

    // Configurar el formulario de ajustes de perfil del maestro
    const formAjustes = document.getElementById('form-ajustes-maestro');
    if(formAjustes) {
        formAjustes.addEventListener('submit', guardarAjustesMaestro);
    }

    // 6. Escuchar en tiempo real lo que se escribe en la confirmación de borrado
    const inputConfirm = document.getElementById('delete-modal-confirmacion');
    if(inputConfirm) {
        inputConfirm.addEventListener('input', (e) => {
            const btnEliminar = document.getElementById('btn-confirmar-eliminar');
            if(e.target.value === 'ELIMINAR') {
                btnEliminar.disabled = false;
                btnEliminar.style.cursor = 'pointer';
                btnPinStyle(btnEliminar, true);
            } else {
                btnEliminar.disabled = true;
                btnEliminar.style.cursor = 'not-allowed';
                btnPinStyle(btnEliminar, false);
            }
        });
    }
});

// Función interna para cambiar dinámicamente el estilo del botón borrar
function btnPinStyle(btn, activar) {
    if(activar) {
        btn.style.opacity = '1';
        btn.style.boxShadow = '0 4px 12px rgba(239, 68, 68, 0.4)';
    } else {
        btn.style.opacity = '0.5';
        btn.style.boxShadow = 'none';
    }
}

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
            window.alumnosActuales = data.alumnos;

            // Mapeo completo global de variables de perfil del maestro
            window.perfilMaestro = {
                aula_nombre: data.aula_nombre,
                aula_codigo: data.aula_codigo,
                maestro_nombre: data.maestro_nombre,
                maestro_user: data.maestro_user
            };

            document.getElementById('panel-title').textContent = `Panel - ${data.aula_nombre}`;
            document.getElementById('class-code').textContent = data.aula_codigo;
            document.getElementById('student-count').innerHTML = `<i class="fa-solid fa-users"></i> Students (${data.alumnos.length})`;

            const container = document.getElementById('student-list-container');
            container.innerHTML = ''; 

            if (data.alumnos.length > 0) {
                data.alumnos.forEach((alumno, index) => {
                    
                    let rankClass = "";
                    let inlineStyle = "";
                    let rankContent = "";

                    // CONFIGURACIÓN DE COLORES PERSONALIZADOS REAJUSTADA
                    if (index === 0) {
                        rankClass = "gold";
                        // 1er Puesto:
                        inlineStyle = "background-color: #facc15; color: white; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(250, 204, 21, 0.4);";
                        rankContent = '<i class="fa-solid fa-trophy"></i>';
                    } else if (index === 1) {
                        rankClass = "silver";
                        // 2do Puesto:
                        inlineStyle = "background-color: #94a3b8; color: white; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(148, 163, 184, 0.4);";
                        rankContent = '<i class="fa-solid fa-trophy"></i>';
                    } else if (index === 2) {
                        rankClass = "bronze";
                        // 3er Puesto:
                        inlineStyle = "background-color: #f28030; color: white; display: flex; align-items: center; justify-content: center;";
                        rankContent = '<i class="fa-solid fa-trophy"></i>';
                    } else {
                        rankClass = "";
                        // 4to Puesto en adelante:
                        inlineStyle = "background-color: #f1f5f9; color: #6b7280; font-size: 0.95rem; font-weight: bold; display: flex; align-items: center; justify-content: center;";
                        rankContent = `${index + 1}`;
                    }

                    container.innerHTML += `
                        <div class="student-item">
                            <div class="student-info">
                                <div class="rank-icon ${rankClass}" style="${inlineStyle}">${rankContent}</div>
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
            document.getElementById('student-list-container').innerHTML = `
                <p style="text-align:center; color: #d32f2f; padding: 20px; font-weight:bold;">${data.message}</p>
            `;
        }
    } catch (error) {
        console.error("Error al cargar datos del docente:", error);
    }
}

// CONTROL INTERACTIVO DE AJUSTES MAESTRO
function abrirModalAjustesMaestro() {
    if (!window.perfilMaestro) return;

    document.getElementById('ajustes-maestro-aula').value = window.perfilMaestro.aula_nombre;
    document.getElementById('ajustes-maestro-codigo').value = window.perfilMaestro.aula_codigo;
    document.getElementById('ajustes-maestro-nombre').value = window.perfilMaestro.maestro_nombre;
    document.getElementById('ajustes-maestro-user').value = window.perfilMaestro.maestro_user;
    document.getElementById('ajustes-maestro-pass').value = ''; 

    document.getElementById('modal-ajustes-maestro').style.display = 'flex';
    document.getElementById('ajustes-maestro-nombre').focus();
}

function cerrarModalAjustesMaestro() {
    document.getElementById('modal-ajustes-maestro').style.display = 'none';
}

async function guardarAjustesMaestro(e) {
    e.preventDefault();
    const idMaestro = localStorage.getItem('usuario_id');

    const nombre = document.getElementById('ajustes-maestro-nombre').value.trim();
    const username = document.getElementById('ajustes-maestro-user').value.trim().toLowerCase();
    const password = document.getElementById('ajustes-maestro-pass').value.trim();

    const formData = new FormData();
    formData.append('id_maestro', idMaestro);
    formData.append('nombre_maestro', nombre);
    formData.append('user_maestro', username);
    formData.append('pass_maestro', password);

    try {
        const response = await fetch('logic/editar_ajustes_maestro.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            alert("¡Tu perfil ha sido actualizado con éxito!");
            
            // Sincronizar localStorage inmediatamente sin forzar cierres de sesión
            localStorage.setItem('usuario_nombre', nombre);
            document.getElementById('teacher-welcome').textContent = `Hello, ${nombre}! General overview of your classroom.`;
            
            cerrarModalAjustesMaestro();
            cargarDatosAula(idMaestro); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        alert("Ocurrió un error al procesar la actualización.");
    }
}

function togglePin(idAlumno, btnElement) {
    const pinInput = document.getElementById(`pin-${idAlumno}`);
    const icon = btnElement.querySelector('i');

    if (pinInput.type === 'password') {
        pinInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
        btnElement.style.color = '#4CAF50'; 
    } else {
        pinInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        btnElement.style.color = '#94a3b8'; 
    }
}

// CREAR ALUMNO
function agregarAlumno() {
    const form = document.getElementById('form-nuevo-alumno');
    if(form) form.reset();
    
    const pinAleatorio = String(Math.floor(1000 + Math.random() * 9000));
    const pinInput = document.getElementById('modal-pin');
    if(pinInput) pinInput.value = pinAleatorio;
    
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
            cargarDatosAula(idMaestro); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al guardar alumno:", error);
    }
}

// EDITAR ALUMNO
function editStudent(idAlumno) {
    if (!window.alumnosActuales) return;
    const alumno = window.alumnosActuales.find(a => parseInt(a.id_alumno) === parseInt(idAlumno));

    if (alumno) {
        document.getElementById('edit-modal-id').value = alumno.id_alumno;
        document.getElementById('edit-modal-nombre').value = alumno.nombre_display;
        document.getElementById('edit-modal-pin').value = alumno.pin;
        document.getElementById('edit-modal-puntos').value = alumno.puntos_totales;

        document.getElementById('modal-editar-alumno').style.display = 'flex';
        document.getElementById('edit-modal-nombre').focus();
    }
}

function cerrarModalEditar() {
    document.getElementById('modal-editar-alumno').style.display = 'none';
}

async function guardarEditarAlumno(e) {
    e.preventDefault();

    const idMaestro = localStorage.getItem('usuario_id');
    const idAlumno = document.getElementById('edit-modal-id').value;
    const nombre = document.getElementById('edit-modal-nombre').value.trim();
    const pin = document.getElementById('edit-modal-pin').value.trim();
    const puntos = document.getElementById('edit-modal-puntos').value.trim();

    if (!/^\d{4}$/.test(pin)) {
        alert("El PIN debe ser estrictamente de 4 dígitos numéricos.");
        return;
    }

    const formData = new FormData();
    formData.append('id_alumno', idAlumno);
    formData.append('nombre_alumno', nombre);
    formData.append('pin_alumno', pin);
    formData.append('puntos_alumno', puntos);

    try {
        const response = await fetch('logic/editar_alumno.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            alert("¡Cambios guardados con éxito!");
            cerrarModalEditar();
            cargarDatosAula(idMaestro); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al editar alumno:", error);
    }
}

// ELIMINAR ALUMNO
function deleteStudent(idAlumno) {
    if (!window.alumnosActuales) return;
    const alumno = window.alumnosActuales.find(a => parseInt(a.id_alumno) === parseInt(idAlumno));

    if (alumno) {
        document.getElementById('delete-modal-id').value = alumno.id_alumno;
        document.getElementById('delete-modal-nombre-texto').textContent = alumno.nombre_display;
        
        const inputConfirm = document.getElementById('delete-modal-confirmacion');
        inputConfirm.value = '';
        
        const btnEliminar = document.getElementById('btn-confirmar-eliminar');
        btnEliminar.disabled = true;
        btnEliminar.style.cursor = 'not-allowed';
        btnPinStyle(btnEliminar, false);

        document.getElementById('modal-eliminar-alumno').style.display = 'flex';
        inputConfirm.focus();
    }
}

function cerrarModalEliminar() {
    document.getElementById('modal-eliminar-alumno').style.display = 'none';
}

async function guardarEliminarAlumno(e) {
    e.preventDefault();

    const idMaestro = localStorage.getItem('usuario_id');
    const idAlumno = document.getElementById('delete-modal-id').value;

    const formData = new FormData();
    formData.append('id_alumno', idAlumno);

    try {
        const response = await fetch('logic/eliminar_alumno.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            alert("Student completely deleted.");
            cerrarModalEliminar();
            cargarDatosAula(idMaestro); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error al eliminar alumno:", error);
        alert("Ocurrió un error en el servidor al intentar borrar al alumno.");
    }
}

// FUNCIONES UTILITARIAS
function copyCode() {
    const codeText = document.getElementById('class-code').textContent;
    if(codeText === '---') return;
    
    navigator.clipboard.writeText(codeText).then(() => {
        alert("Class code copied to clipboard: " + codeText);
    });
}

function cerrarSesion() {
    localStorage.clear();
    window.location.href = 'iniciodesesion_Maestro.php';
}